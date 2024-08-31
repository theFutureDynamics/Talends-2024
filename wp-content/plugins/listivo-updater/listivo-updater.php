<?php
/*
Plugin Name: Listivo Updater
Version: 1.0.3
Plugin URI: https://listivotheme.com
Description: You can use this plugin to update Listivo Theme
*/

add_action('admin_menu', static function () {
    if (!current_user_can('manage_options')) {
        return;
    }

    add_menu_page(
        esc_html__('Listivo Updater', 'listivo-updater'),
        esc_html__('Listivo Updater', 'listivo-updater'),
        'manage_options',
        'listivo-updater',
        static function () {
            /** @noinspection PhpIncludeInspection */
            require WP_PLUGIN_DIR.'/listivo-updater/views/updater.php';
        },
        '',
        3
    );
});

add_action('admin_post_listivo_updater_plugin', static function () {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (empty($_POST['pluginKey'])) {
        return;
    }

    $purchaseCode = listivo_get_purchase_code();
    if (empty($purchaseCode)) {
        return;
    }

    $pluginKey = trim($_POST['pluginKey']);

    require_once ABSPATH.'wp-admin/includes/misc.php';

    if (!function_exists('request_filesystem_credentials')) {
        require_once ABSPATH.'wp-admin/includes/file.php';
    }

    if (!class_exists('Plugin_Upgrader')) {
        require_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
    }

    $updatesInfo = get_option('listivo_updates');
    $pluginUpgrader = new Plugin_Upgrader(new Automatic_Upgrader_Skin());

    foreach ($updatesInfo->plugins as $plugin) {
        if ($plugin->key !== $pluginKey) {
            continue;
        }

        $pluginPath = $plugin->directory.'/'.$plugin->main_file;
        if (is_plugin_active($pluginPath)) {
            deactivate_plugins(WP_PLUGIN_DIR.'/'.$pluginPath, true);
        }
        $deletePluginsReturn = delete_plugins([$pluginPath]);

        if (is_wp_error($deletePluginsReturn)) {
            echo $deletePluginsReturn->get_error_messages();
        }

        $installPluginReturn = $pluginUpgrader->install(
            'https://updater.tangiblewp.com/api/updates/file?fileId='.$plugin->file
            .'&purchaseCode='.$purchaseCode
            .'&projectKey=listivo'
            .'&time='.time()
        );

        if (is_wp_error($installPluginReturn)) {
            echo $installPluginReturn->get_error_messages();
        }

        activate_plugin($pluginPath);
        break;
    }
});

add_action('admin_post_listivo_updater_theme', static function () {
    $updates = get_option('listivo_updates');
    if (!$updates instanceof stdClass || !property_exists($updates, 'version')) {
        return;
    }

    $purchaseCode = listivo_get_purchase_code();
    if (empty($purchaseCode)) {
        return;
    }


    if (!class_exists('Theme_Upgrader')) {
        require_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
    }

    require 'class-listivo-theme-upgrader.php';

    require_once ABSPATH.'wp-admin/includes/misc.php';

    if (!function_exists('request_filesystem_credentials')) {
        require_once ABSPATH.'wp-admin/includes/file.php';
    }

    $return = (new Listivo_Theme_Upgrader(new Automatic_Upgrader_Skin()))->upgrade(
        'listivo',
        [],
        'https://updater.tangiblewp.com/api/updates/file?fileId='
        .$updates->file
        .'&purchaseCode='.$purchaseCode
        .'&projectKey=listivo'
        .'&time='.time()
    );

    if (is_wp_error($return)) {
        echo $return->get_error_messages();
    }
});

function listivo_get_purchase_code(): string
{
    $purchaseCode = get_option('listivo_purchase_code');

    if (empty($purchaseCode)) {
        return '';
    }

    return trim($purchaseCode);
}

function listivo_check_updates()
{
    $purchaseCode = listivo_get_purchase_code();
    if (empty($purchaseCode)) {
        return;
    }

    $params = [
        'purchaseCode' => $purchaseCode,
        'projectKey' => 'listivo',
        'site' => site_url()
    ];

    $response = wp_remote_post('https://updater.tangiblewp.com/api/updates/check', [
        'body' => $params
    ]);

    if ($response instanceof WP_Error || !isset($response['body'])) {
        return;
    }

    /** @noinspection JsonEncodingApiUsageInspection */
    $data = json_decode($response['body']);
    if (!$data instanceof stdClass) {
        return;
    }

    if (property_exists($data, 'error')) {
        if ($data->error === 'invalid_purchase_code') {
            update_option('listivo_invalid_purchase_code', '1');
        }
        return;
    }

    update_option('listivo_invalid_purchase_code', '0');

    if (!property_exists($data, 'success')) {
        return;
    }

    if (property_exists($data, 'data')) {
        update_option('listivo_updates', $data->data);
    } else {
        update_option('listivo_updates', $data);
    }

    update_option('listivo_updater_notice', 1);
}

function listivo_updater_get_plugins(): array
{
    $updates = get_option('listivo_updates');
    if (!$updates instanceof stdClass || !property_exists($updates, 'plugins')) {
        return [];
    }

    $plugins = [];
    foreach ($updates->plugins as $plugin) {
        $pluginPath = $plugin->directory.'/'.$plugin->main_file;
        if (is_plugin_active($pluginPath)) {
            $plugin_data = get_plugin_data(WP_PLUGIN_DIR.'/'.$pluginPath);
            $currentVersion = $plugin_data['Version'];
        } else {
            continue;
        }

        $plugins[] = [
            'name' => $plugin->name,
            'key' => $plugin->key,
            'version_current' => $currentVersion,
            'version_new' => $plugin->version,
            'status' => version_compare($currentVersion, $plugin->version) === -1 ? 'need_update' : 'ok'
        ];
    }

    return $plugins;
}

add_action('admin_post_listivo_check_updates', static function () {
    if (!current_user_can('manage_options')) {
        return;
    }

    listivo_check_updates();

    wp_redirect(admin_url('?page=listivo-updater&show_updates_info=1'));
    exit;
});

add_action('admin_init', static function () {
    if (!wp_next_scheduled('listivo_check_updates')) {
        wp_schedule_event(time(), 'daily', 'listivo_check_updates');
    }
});

/**
 * @return bool
 */
function listivo_require_update(): bool
{
    foreach (listivo_updater_get_plugins() as $plugin) {
        if ($plugin['status'] === 'need_update') {
            return true;
        }
    }

    return listivo_updater_get_theme_status() === 'need_update';
}

/**
 * @return string
 */
function listivo_updater_get_theme_status(): string
{
    $updates = get_option('listivo_updates');

    if (!$updates instanceof stdClass || !property_exists($updates, 'version')) {
        return 'ok';
    }

    return version_compare(listivo_updater_get_version(), $updates->version) === -1 ? 'need_update' : 'ok';
}

function listivo_updater_get_version(): string
{
    if (!defined('LISTIVO_VERSION')) {
        return '1.0.0';
    }

    return LISTIVO_VERSION;
}

add_action('admin_post_listivo_updater_save_purchase_code', static function () {
    if (!current_user_can('manage_options')) {
        return;
    }

    update_option('listivo_purchase_code', $_POST['purchase_code']);
    update_option('listivo_invalid_purchase_code', '0');

    wp_redirect(admin_url('admin.php?page=listivo-updater'));
    exit;
});

add_action('admin_enqueue_scripts', static function () {
    if (isset($_GET['page']) && $_GET['page'] === 'listivo-updater') {
        wp_enqueue_script('listivo-updater', plugins_url().'/listivo-updater/assets/js/build.min.js', ['jquery'],
            '1.0.0', true);
    }
});