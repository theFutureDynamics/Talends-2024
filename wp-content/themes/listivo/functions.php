<?php

const LISTIVO_VERSION = '2.3.62';

require get_template_directory() . '/basic.php';
require get_template_directory() . '/src/tgm/class-tgm-plugin-activation.php';

//add_action('template_redirect', 'redirect_after_successful_payment1');

//function redirect_after_successful_payment1() {
    // Check if the specific query parameter is set for successful payments
    if (isset($_GET['wc-api']) && $_GET['wc-api'] === 'wc_gateway_r_paytabs_all') {
        // Redirect to the home URL
        wp_redirect('http://54.174.237.66/'); // Your target URL
        exit; // Always call exit after redirecting
    }
//}

add_action('after_setup_theme', static function () {
    add_theme_support('post-thumbnails');
    add_theme_support('nav-menus');
    add_theme_support('title-tag');
    add_theme_support('woocommerce');
    add_theme_support('custom-logo', [
        'width' => 160,
        'height' => 36,
    ]);
    add_theme_support(
        'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]
    );

    load_theme_textdomain('listivo', get_template_directory() . '/languages');

    register_nav_menus(['listivo-primary' => esc_html__('Listivo Theme Default Menu', 'listivo')]);
});

add_action('widgets_init', static function () {
    register_sidebar(
        [
            'name' => esc_html__('Listivo Sidebar', 'listivo'),
            'id' => 'listivo-sidebar',
            'description' => esc_html__('Add widgets here.', 'listivo'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="listivo-widget-title">',
            'after_title' => '</h3>',
        ]
    );
});

add_action('tgmpa_register', static function () {
    tgmpa(
        apply_filters('listivo/plugins', [
            [
                'name' => esc_html__('Contact Form 7', 'listivo'),
                'slug' => 'contact-form-7',
                'required' => true,
            ],
            [
                'name' => esc_html__('Elementor', 'listivo'),
                'slug' => 'elementor',
                'required' => true,
                'version' => '3.1.4',
                'force_activation' => false,
                'force_deactivation' => false,
            ],
            [
                'name' => esc_html__('Listivo Core', 'listivo'),
                'slug' => 'listivo-core',
                'source' => get_template_directory() . '/src/tgm/plugins/listivo-core.zip',
                'required' => true,
                'version' => '2.3.62',
                'force_activation' => false,
                'force_deactivation' => false,
            ],
            [
                'name' => esc_html__('Listivo Updater', 'listivo'),
                'slug' => 'listivo-updater',
                'source' => get_template_directory() . '/src/tgm/plugins/listivo-updater.zip',
                'required' => false,
                'version' => '1.0.2',
                'force_activation' => false,
                'force_deactivation' => false,
            ],
            [
                'name' => esc_html__('MC4WP', 'listivo'),
                'slug' => 'mailchimp-for-wp',
                'required' => false,
                'version' => '4.8.1',
                'force_activation' => false,
                'force_deactivation' => false,
            ],
        ])
    );
});

add_action('wp_enqueue_scripts', static function () {
    $deps = [];

    if (class_exists(\Elementor\Plugin::class)) {
        $deps[] = 'elementor-frontend';
    }

    if (is_rtl()) {
        wp_enqueue_style('listivo-rtl', get_template_directory_uri() . '/style-rtl.css', $deps, LISTIVO_VERSION);
    } else {
        wp_enqueue_style('listivo', get_stylesheet_uri(), $deps, LISTIVO_VERSION);
    }

    if (!class_exists(\Tangibledesign\Framework\Core\App::class)) {
        wp_enqueue_style('comfortaa-font',
            'https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap');
        wp_enqueue_style('inter-font',
            'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');

        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/all.css');
        wp_enqueue_script('listivo-js', get_template_directory_uri() . '/assets/js/blog.min.js', ['jquery'],
            LISTIVO_VERSION, true);
    }
});

add_action('widgets_init', static function () {
    register_sidebar(
        [
            'name' => esc_html__('Listivo Sidebar', 'listivo'),
            'id' => 'listivo-sidebar',
            'description' => esc_html__('Add widgets here.', 'listivo'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="listivo-widget-title">',
            'after_title' => '</h3>',
        ]
    );
});

if (!\Tangibledesign\Framework\Core\App::class) {
    add_theme_support('automatic-feed-links');
}

function enqueue_stripe_js() {
    wp_enqueue_script('stripe', 'https://js.stripe.com/v3/');
}
add_action('wp_enqueue_scripts', 'enqueue_stripe_js');

function listivo_enqueue_styles_and_scripts() {
    wp_enqueue_style('listivo-main-style', get_stylesheet_uri());
    // Enqueue other necessary stylesheets or scripts here
}
add_action('wp_enqueue_scripts', 'listivo_enqueue_styles_and_scripts');

if (!isset($content_width)) {
    $content_width = 900;
}

// add_action('wp_ajax_listivo_save_user_settings', 'handle_user_settings_submission');
// add_action('wp_ajax_nopriv_listivo_save_user_settings', 'handle_user_settings_submission'); // Optional, if you want non-logged-in users to access

// function handle_user_settings_submission() {
//     global $wpdb;

//     // Verify nonce
//     if (!isset($_POST['_ajax_nonce']) || !wp_verify_nonce($_POST['_ajax_nonce'], 'listivo_save_user_settings')) {
//         wp_send_json_error(array('error' => 'Invalid nonce.'));
//         wp_die();
//     }

//     // Check if a file was uploaded
//     if (isset($_FILES['portfolio_image'])) {
//         $uploaded_file = $_FILES['portfolio_image'];
//         $upload = wp_handle_upload($uploaded_file, array('test_form' => false));

//         if ($upload && !isset($upload['error'])) {
//             $file_url = $upload['url']; // URL of the uploaded file

//             // Handle other form data if needed
//             $description = isset($_POST['portfolio_description']) ? sanitize_text_field($_POST['portfolio_description']) : '';

//             // Define the custom table name
//             $table_name = $wpdb->prefix . 'portfolio';

//             // Insert or update data in the custom table
//             $user_id = get_current_user_id();

//             $existing = $wpdb->get_var($wpdb->prepare(
//                 "SELECT COUNT(*) FROM $table_name WHERE user_id = %d",
//                 $user_id
//             ));

//             if ($existing) {
//                 // Update existing record
//                 $wpdb->update(
//                     $table_name,
//                     array(
//                         'portfolio_image' => $file_url,
//                         'portfolio_description' => $description
//                     ),
//                     array('user_id' => $user_id),
//                     array(
//                         '%s',
//                         '%s'
//                     ),
//                     array('%d')
//                 );
//             } else {
//                 // Insert new record
//                 $wpdb->insert(
//                     $table_name,
//                     array(
//                         'user_id' => $user_id,
//                         'portfolio_image' => $file_url,
//                         'portfolio_description' => $description
//                     ),
//                     array(
//                         '%d',
//                         '%s',
//                         '%s'
//                     )
//                 );
//             }

//             // Send success response
//             wp_send_json_success(array('message' => 'Settings saved successfully.'));
//         } else {
//             wp_send_json_error(array('error' => $upload['error']));
//         }
//     } else {
//         wp_send_json_error(array('error' => 'No file uploaded.'));
//     }

//     wp_die(); // This is required to terminate immediately and return a proper response
// }


add_action('wp_ajax_listivo_save_user_settings', 'handle_user_settings_submission');
add_action('wp_ajax_nopriv_listivo_save_user_settings', 'handle_user_settings_submission');

function handle_user_settings_submission() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'portfolio';
    $user_id = get_current_user_id();

    // Delete record from the custom table
    $result = $wpdb->delete(
        $table_name,
        array('user_id' => $user_id),
        array('%d')
    );

    // Verify nonce
    if (!isset($_POST['_ajax_nonce']) || !wp_verify_nonce($_POST['_ajax_nonce'], 'listivo_save_user_settings')) {
        wp_send_json_error(array('error' => 'Invalid nonce.'));
        wp_die();
    }

    // Check if files and descriptions were uploaded
    if (!empty($_FILES['portfolio_image']['name']) && !empty($_POST['portfolio_description'])) {
        $file_count = count($_FILES['portfolio_image']['name']);
        $descriptions = $_POST['portfolio_description'];

        // Define the custom table name
       
       

        for ($i = 0; $i < $file_count; $i++) {
            $uploaded_file = array(
                'name'     => $_FILES['portfolio_image']['name'][$i],
                'type'     => $_FILES['portfolio_image']['type'][$i],
                'tmp_name' => $_FILES['portfolio_image']['tmp_name'][$i],
                'error'    => $_FILES['portfolio_image']['error'][$i],
                'size'     => $_FILES['portfolio_image']['size'][$i]
            );

            $upload = wp_handle_upload($uploaded_file, array('test_form' => false));

            if ($upload && !isset($upload['error'])) {
                $file_url = $upload['url']; // URL of the uploaded file
                $description = isset($descriptions[$i]) ? sanitize_text_field($descriptions[$i]) : '';

                // Insert new record
                $wpdb->insert(
                    $table_name,
                    array(
                        'user_id'               => $user_id,
                        'portfolio_image'       => $file_url,
                        'portfolio_description' => $description
                    ),
                    array(
                        '%d',
                        '%s',
                        '%s'
                    )
                );
            } else {
                wp_send_json_error(array('error' => $upload['error']));
                wp_die();
            }
        }

        // Send success response
        wp_send_json_success(array('message' => 'Settings saved successfully.'));
    } else {
        wp_send_json_error(array('error' => 'No files or descriptions found.'));
    }

    wp_die();
}

// function start_session() {
//     if (!session_id()) {
//         session_start();
//     }
// }
// add_action('init', 'start_session');

function enqueue_my_scripts() {
    wp_enqueue_script('my-custom-script', get_template_directory_uri() . '/path-to-your-script.js', array('jquery'), null, true);

    // Pass the AJAX URL and nonce to the script
    wp_localize_script('my-custom-script', 'myAjax', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('listivo_save_user_settings')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');
