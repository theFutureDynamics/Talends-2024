<?php
/*
Plugin Name:  PayTabs
Description: A plugin to process PayTabs payments.
Version: 1.0
Author: Zohaib Yousuf
*/


if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/../../');
}
require_once(ABSPATH . 'wp-load.php');

// Add admin menu for settings
add_action('admin_menu', 'paytabs_add_admin_menu');
add_action('admin_init', 'paytabs_settings_init');

add_action('init', 'get_user_payment_responses');
function get_user_payment_responses($user_id) {
    global $wpdb;
    // Check if the user is logged in
    if ($user_id === 0) {
        return []; // User is not logged in
    }

    // Define the table name
    $table_name = $wpdb->prefix . 'payment_responses';

    // Prepare the SQL query
    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE user_id = %d", $user_id);

    // Execute the query and fetch results
    $packges = $wpdb->get_results($query);
    return $packges;
}

// Usage example

// if (!empty($packges)) {
//     foreach ($packges as $response) {
//         echo 'Package Name: ' . esc_html($response->package_name) . '<br>';
//         echo 'Response Code: ' . esc_html($response->respCode) . '<br>';
//         // Add more fields as needed
//     }
// } else {
//     echo 'No payment responses found for this user.';
// }


function paytabs_add_admin_menu() {
    add_options_page('PayTabs Settings', 'PayTabs', 'manage_options', 'paytabs', 'paytabs_options_page');
}

function paytabs_settings_init() {
    register_setting('pluginPage', 'paytabs_settings');

    add_settings_section(
        'paytabs_pluginPage_section',
        __('PayTabs Settings', 'wordpress'),
        null,
        'pluginPage'
    );

    add_settings_field(
        'paytabs_merchant_id',
        __('Merchant ID', 'wordpress'),
        'paytabs_merchant_id_render',
        'pluginPage',
        'paytabs_pluginPage_section'
    );

    add_settings_field(
        'paytabs_secret_key',
        __('Secret Key', 'wordpress'),
        'paytabs_secret_key_render',
        'pluginPage',
        'paytabs_pluginPage_section'
    );
}

function paytabs_merchant_id_render() {
    $options = get_option('paytabs_settings');
    // Check if $options is an array and has the expected keys
    if (!is_array($options) || empty($options['paytabs_merchant_id']) || empty($options['paytabs_secret_key'])) {
        // Set default values or handle the error
        $options = [
            'paytabs_merchant_id' => '',
            'paytabs_secret_key' => ''
        ];
        error_log('PayTabs settings are not properly configured.');
    }
    ?>
    <input type='text' name='paytabs_settings[paytabs_merchant_id]' value='<?php echo $options['paytabs_merchant_id']; ?>'>
    <?php
}

function paytabs_secret_key_render() {
    $options = get_option('paytabs_settings');
    // Check if $options is an array and has the expected keys
    if (!is_array($options) || empty($options['paytabs_merchant_id']) || empty($options['paytabs_secret_key'])) {
        // Set default values or handle the error
        $options = [
            'paytabs_merchant_id' => '',
            'paytabs_secret_key' => ''
        ];
        error_log('PayTabs settings are not properly configured.');
    }
    ?>
    <input type='text' name='paytabs_settings[paytabs_secret_key]' value='<?php echo $options['paytabs_secret_key']; ?>'>
    <?php
}

function paytabs_options_page() {
    ?>
    <form action='options.php' method='post'>
        <!-- <h2>PayTabs Settings</h2> -->
        <?php
        settings_fields('pluginPage');
        do_settings_sections('pluginPage');
        submit_button();
        ?>
    </form>
    <?php
}

add_shortcode('paytabs_payment_form', 'paytabs_payment_form_shortcode');

function paytabs_payment_form_shortcode() { 
    // Get the current user's ID
    $user_id = get_current_user_id();
    $pkgName = '';
    $currentPkgId = 0;
    $packges = get_user_payment_responses($user_id);
    if(!empty($packges)){
        $lastPkg = count($packges)-1;
        $lstPkgName = $packges[$lastPkg]->package_name;
        $pkgNameArr = explode("--",$lstPkgName);
        $pkgName = $pkgNameArr[1];
        $currentPkgId = $pkgNameArr[0];
    }

    ?>

    <div class="listivo-pricing-table">
        <div class="listivo-panel-package-v2 <?php echo (!empty($pkgName) && $pkgName == 'Easy Start') ? 'listivo-panel-package-v2--featured' : ''; ?> listivo-panel-package-v2--no-bottom">

            <div class="listivo-panel-package-v2__head listivo-panel-package-v2__head--listivo_3004">
                <div>
                    Easy Start                
                </div>
            </div>
            <div class="listivo-panel-package-v2__body">
                <div class="listivo-panel-package-v2__main-value">
                    $5.00                    
                </div>
                
                <div class="listivo-panel-package-v2__button">
                <form id="payment-form" method="POST" action="<?php echo esc_url(plugin_dir_url(__FILE__) . 'process_payment.php'); ?>">
                <?php if(!empty($pkgName) && ($pkgName == 'Easy Start')){ ?>
                    <a href="javascript:void(0)" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                        Selected Package                 
                </a>
                <?php }else{ ?>
                    <button type="submit" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                        Choose this package                    
                    </button>
                <?php } ?>    
                
                    <input type="hidden" name="amount" value="5.00" />
                    <input type="hidden" name="package_id" value="1" />
                    <input type="hidden" name="package_name" value="Easy Start" />
                </form>
                </div>
                <div class="listivo-panel-package-v2__attributes">
                    <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                        Duration:
                        <span>
                        7
                        Days                                                                                    </span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="listivo-panel-package-v2 <?php echo (!empty($pkgName) && $pkgName == 'Value Plus') ? 'listivo-panel-package-v2--featured' : ''; ?> listivo-panel-package-v2--no-bottom">
            <div class="listivo-panel-package-v2__head listivo-panel-package-v2__head--listivo_4209">
                <div>
                    Value Plus                
                </div>
                <div class="listivo-panel-package-v2__label">
                    Most Popular                    
                </div>
            </div>
            <div class="listivo-panel-package-v2__body">
                <div class="listivo-panel-package-v2__main-value">
                    $9.00                    
                </div>
                <form id="payment-form" method="POST" action="<?php echo esc_url(plugin_dir_url(__FILE__) . 'process_payment.php'); ?>">
               
                <input type="hidden" name="amount" value="9.00" />
                <input type="hidden" name="package_id" value="2" />
                <input type="hidden" name="package_name" value="Value Plus" />
                <div class="listivo-panel-package-v2__button">
                <?php
                 if(!empty($pkgName) && ($pkgName == 'Value Plus')){ ?>
                    <a href="javascript:void(0)" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                        Selected Package                    
                    </a>
                <?php }else{ ?>
                    <button type="submit" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                        Choose this package                    
                    </button>
                <?php } ?>  
               
                </div>
                </form>
                <div class="listivo-panel-package-v2__attributes">
                    <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                        Duration:
                        <span>
                        14
                        Days                                                                                    </span>
                    </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                        Featured:
                        <span>
                        3
                        Days                                                            </span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="listivo-panel-package-v2 <?php echo (!empty($pkgName) && $pkgName == 'All Inclusive') ? 'listivo-panel-package-v2--featured' : ''; ?> listivo-panel-package-v2--no-bottom">
            <div class="listivo-panel-package-v2__head listivo-panel-package-v2__head--listivo_4211">
                <div>
                    All Inclusive                
                </div>
            </div>
            <div class="listivo-panel-package-v2__body">
                <div class="listivo-panel-package-v2__main-value">
                    $19.00                    
                </div>
                <form id="payment-form" method="POST" action="<?php echo esc_url(plugin_dir_url(__FILE__) . 'process_payment.php'); ?>">
               
                    <input type="hidden" name="amount" value="19.00" />
                    <input type="hidden" name="package_id" value="3" />
                    <input type="hidden" name="package_name" value="All Inclusive" />
                    <div class="listivo-panel-package-v2__button">
                    <?php
                    if(!empty($pkgName) && ($pkgName == 'All Inclusive')){ ?>
                        <a href="javascript:void(0)" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                            Selected Package                    
                        </a>
                    <?php }else{ ?>
                        <button type="submit" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                            Choose this package                    
                        </button>
                    <?php } ?>
                    </div>
                </form>
                <div class="listivo-panel-package-v2__attributes">
                    <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                        Duration:
                        <span>
                        30
                        Days                                                                                    </span>
                    </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                        Featured:
                        <span>
                        7
                        Days                                                            </span>
                    </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                        Bump up:
                        <span>
                        2x
                        </span>
                    </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                        Bump up every:
                        <span>
                        10 Days                                                            </span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="listivo-panel-package-v2 <?php echo (!empty($pkgName) && $pkgName == 'Steady Growth') ? 'listivo-panel-package-v2--featured' : ''; ?> listivo-panel-package-v2--no-bottom">
            <div class="listivo-panel-package-v2__head listivo-panel-package-v2__head--listivo_4213">
                <div>
                    Steady Growth                
                </div>
            </div>
            <div class="listivo-panel-package-v2__body">
                <div class="listivo-panel-package-v2__main-value">
                    $49.00                    
                </div>
                <form id="payment-form" method="POST" action="<?php echo esc_url(plugin_dir_url(__FILE__) . 'process_payment.php'); ?>">
                
                <input type="hidden" name="amount" value="49.00" />
                <input type="hidden" name="package_id" value="4" />
                <input type="hidden" name="package_name" value="Steady Growth" />
                <div class="listivo-panel-package-v2__button">
                <?php if(!empty($pkgName) && ($pkgName == 'Steady Growth')){ ?>
                    <a href="javascript:void(0)" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                        Selected Package                    
                    </a>
                <?php }else{ ?>
                    <button type="submit" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                        Choose this package                    
                    </button>
                <?php } ?>
                </div>
                </form>
                <div class="listivo-panel-package-v2__attributes">
                    <div class="listivo-panel-package-v2__attribute">
                        <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                        </div>
                        <div class="listivo-panel-package-v2__attribute-value">
                        Listings:
                        <span>5</span>x
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute">
                        <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                        </div>
                        <div class="listivo-panel-package-v2__attribute-value">
                        Duration:
                        <span>
                        30
                        Days                                                                                    </span>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute">
                        <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                        </div>
                        <div class="listivo-panel-package-v2__attribute-value">
                        Featured:
                        <span>
                        7
                        Days                                                            </span>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute">
                        <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                        </div>
                        <div class="listivo-panel-package-v2__attribute-value">
                        Bump up:
                        <span>
                        2x
                        </span>
                        </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute">
                        <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                            </svg>
                        </div>
                        </div>
                        <div class="listivo-panel-package-v2__attribute-value">
                        Bump up every:
                        <span>
                        10 Days                                                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="listivo-panel-package-v2 <?php echo (!empty($pkgName) && $pkgName == 'Exponential Growth') ? 'listivo-panel-package-v2--featured' : ''; ?> listivo-panel-package-v2--no-bottom">

        <div class="listivo-panel-package-v2__head listivo-panel-package-v2__head--listivo_4215">
            <div>
                Exponential Growth                
            </div>
        </div>
        <div class="listivo-panel-package-v2__body">
            <div class="listivo-panel-package-v2__main-value">
                $99.00                    
            </div>
            <form id="payment-form" method="POST" action="<?php echo esc_url(plugin_dir_url(__FILE__) . 'process_payment.php'); ?>">
                <input type="hidden" name="amount" value="99.00" />
                <input type="hidden" name="package_id" value="5" />
                <input type="hidden" name="package_name" value="Exponential Growth" />
                <div class="listivo-panel-package-v2__button">
                <?php if(!empty($pkgName) && ($pkgName == 'Exponential Growth')){ ?>
                    <a href="javascript:void(0)" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                        Selected Package                    
                    </a>
                <?php }else{ ?>
                    <button type="submit" style="width:100%" class="listivo-simple-button listivo-simple-button--background-primary-1">
                        Choose this package                    
                    </button>
                <?php } ?>
                
                </div>
            </form>
            <div class="listivo-panel-package-v2__attributes">
                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                    <div class="listivo-panel-package-v2__attribute-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                    Listings:
                    <span>20</span>x
                    </div>
                </div>
                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                    <div class="listivo-panel-package-v2__attribute-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                    Duration:
                    <span>
                    30
                    Days                                                                                    </span>
                    </div>
                </div>
                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                    <div class="listivo-panel-package-v2__attribute-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                    Featured:
                    <span>
                    7
                    Days                                                            </span>
                    </div>
                </div>
                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                    <div class="listivo-panel-package-v2__attribute-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                    Bump up:
                    <span>
                    2x
                    </span>
                    </div>
                </div>
                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                    <div class="listivo-panel-package-v2__attribute-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#374B5C"></path>
                        </svg>
                    </div>
                    </div>
                    <div class="listivo-panel-package-v2__attribute-value">
                    Bump up every:
                    <span>
                    10 Days                                                            </span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>



<?php
//  return ob_get_clean();
}

// Handle payment processing
add_action('admin_post_nopriv_process_payment', 'process_payment');
add_action('admin_post_process_payment', 'process_payment');

function process_payment() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $options = get_option('paytabs_settings');
        $merchant_id = $options['paytabs_merchant_id'];
        $secret_key = $options['paytabs_secret_key'];

        // Sanitize inputs
        $amount = sanitize_text_field($_POST['amount']);
        $currency = sanitize_text_field($_POST['currency']);
        $email = sanitize_email($_POST['email']);
        $recurring = sanitize_text_field($_POST['recurring']);

        // Prepare PayTabs request
        $data = [
            "merchant_id" => $merchant_id,
            "amount" => $amount,
            "currency" => $currency,
            "email" => $email,
            "recurring" => $recurring,
            "payment_option" => "C"
        ];

        // API URL for creating a payment
        $url = 'https://secure.paytabs.com/payment/request';

        // Initialize cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: '.$secret_key
        ]);

        // Execute cURL
        $response = curl_exec($ch);
        $response = json_decode($response, true);
        curl_close($ch);

        if ($response['response_code'] == 100) {
            // Payment success
            wp_redirect($response['payment_url']);
            exit;
        } else {
            // Handle payment failure
            wp_die('Payment failed: ' . $response['message']);
        }
    }
}

// Handle PayTabs webhook
add_action('init', 'handle_paytabs_webhook');

function handle_paytabs_webhook() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['paytabs_webhook'])) {
        $payload = json_decode(file_get_contents('php://input'), true);
        
        // Validate the webhook and process the payment status
        // Example: Log the status or update database
        error_log(print_r($payload, true));
    }
}


?>