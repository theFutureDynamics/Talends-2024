<?php
session_start(); // Start the session
// print_r($_SESSION);
require_once('../../../wp-load.php');

// $rawData = 'acquirerMessage=&acquirerRRN=&cartId=cart_66fe0bbcf2cb5&customerEmail=free%40talends.com&respCode=G25344&respMessage=Authorised&respStatus=A&signature=058e2e72d6569d9db8b446305b2605c1def59bff8888e264335996e73cc9ca97&token=2C4654BC67A3EB32C6B693F466827FBB&tranRef=TST2427702130328';
$rawData = file_get_contents('php://input');
parse_str($rawData, $responseData);


// print_r($_COOKIE);
// die;
if (isset($_COOKIE['package_data'])) {
    $package_data = json_decode(stripslashes($_COOKIE['package_data']), true);
    $package_name = $package_data['package_name'];
    $user_id = $package_data['user_id'];
}

// $package_data = $_SESSION['package_data'];
// $package_name = $package_data['package_name'];
// $user_id      = $package_data['user_id'];
echo $package_name.'--'.$user_id;

if (isset($responseData['respCode'])){   
   save_payment_response($responseData, $user_id, $package_name);
} else {
    echo "Payment failed: " . ($responseData['respMessage'] ?? 'Unknown error');
}

function save_payment_response($response_data, $user_id, $package_name) {
    global $wpdb;

    // Table name
    $table_name = $wpdb->prefix . 'payment_responses';

    // Prepare data
    $data = array(
        'user_id' => $user_id,
        'package_name' => $package_name,
        'acquirerMessage' => isset($response_data['acquirerMessage']) ? $response_data['acquirerMessage'] : '',
        'acquirerRRN' => isset($response_data['acquirerRRN']) ? $response_data['acquirerRRN'] : '',
        'cartId' => isset($response_data['cartId']) ? $response_data['cartId'] : '',
        'customerEmail' => isset($response_data['customerEmail']) ? $response_data['customerEmail'] : '',
        'respCode' => isset($response_data['respCode']) ? $response_data['respCode'] : '',
        'respMessage' => isset($response_data['respMessage']) ? $response_data['respMessage'] : '',
        'respStatus' => isset($response_data['respStatus']) ? $response_data['respStatus'] : '',
        'signature' => isset($response_data['signature']) ? $response_data['signature'] : '',
        'token' => isset($response_data['token']) ? $response_data['token'] : '',
        'tranRef' => isset($response_data['tranRef']) ? $response_data['tranRef'] : '',
        'raw' => isset($response_data) ? json_encode($response_data) : null,
    );

    // Insert data
    $inserted = $wpdb->insert($table_name, $data);
    // Clear the session data
   // unset($_SESSION['package_data']);
   setcookie('package_data', '', time() - 3600, "/"); // Expire the cookie
    // Check for errors
    if ($inserted === false) {
        // Log the error for debugging
        print_r($wpdb->last_error);
        error_log('Database insert error: ' . $wpdb->last_error);
    } else {
        // Redirect to the packages page dynamically
        wp_redirect(home_url('/packages/'));
        exit; // Always call exit after wp_redirect to stop further execution
    }
}

