<?php
session_start();
require_once('../../../wp-load.php'); // Adjust path based on your plugin structure

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $amount = isset($_POST['amount']) ? $_POST['amount'] : 0;
  $current_user = wp_get_current_user();
  $user_id = $current_user->ID;
  $package_name = $_POST['package_name'];
  $package_id = $_POST['package_id'];
  $pkg = $package_id.'--'.$package_name;
  proceedPaytabPayment($amount,$pkg, $user_id);
}

function proceedPaytabPayment($amount,$package,$user_id){
  $curl = curl_init();

  $options = get_option('paytabs_settings');
  $merchant_id = $options['paytabs_merchant_id'];
  $secret_key = $options['paytabs_secret_key'];
  // Get current user info
  $current_user = wp_get_current_user();
  $email = $current_user->user_email;
  $name = $current_user->display_name;
  $phone_number =  esc_html(get_user_meta($current_user->ID, 'phone_number', true)); // Retrieve phone number
  // Store package information in session
  // $user_id = $current_user->ID;
  $_SESSION['package_data'] = [
    'package_name' => $package,
    'user_id' => $user_id
  ];
  if(empty($package) || empty($user_id)){
    wp_redirect(home_url('/packages/'));
  }
  $package_data = [
    'package_name' => $package,
    'user_id' => $user_id
];
  setcookie('package_data', json_encode($package_data), time() + 3600);

  $callback_url = site_url('/wp-content/plugins/paytabs/return.php');
  $return_url = site_url('/wp-content/plugins/paytabs/return.php');
  $profile_id = MY_PAYTAB_PROFILE_ID; 
  $cart_id = 'cart_' . uniqid();
  $data = '{
            "profile_id": '.$profile_id.',
            "tran_type": "sale",
            "tokenise": "2",
            "tran_class": "ecomtoken",
            "cart_id": "'.$cart_id.'",
            "cart_currency": "AED",
            "alt_currency": "USD",
            "cart_amount": '.$amount.',
            "cart_description": "Payment for the package",
            "customer_details": {
                "name": "'.$name.'",
                "email": "'.$email.'",
                "phone": "'.$phone_number.'",
                "country": "UAE",
                "state": "",
                "city": "",
                "street1": "",
                "zip": "12345"
            },
            "hide_shipping": true,
            "callback": "'.$callback_url.'",
            "return": "'.$return_url.'"
        }';
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://secure.paytabs.com/payment/request',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>$data,
    CURLOPT_HTTPHEADER => array(
      'authorization: '.$secret_key,
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  //print_r($response);
  curl_close($curl);

  // Decode the response
  $responseData = json_decode($response, true);

  // Check if the response contains a redirect URL
  if (isset($responseData['redirect_url'])) {
      // Redirect to the PayTabs payment page
      header('Location: ' . $responseData['redirect_url']);
      exit();
  } else {
      // Handle error (no redirect URL returned)
      echo "Error: " . $responseData['message'] ?? 'Unknown error';
  }

}

function curlPayment1(){

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://secure.paytabs.com/payment/request',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "profile_id": 91323,
      "tran_type": "sale",
      "tran_class": "ecom" ,
      "cart_id":"4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca",
      "cart_description": "Dummy Order 35925502061445345",
      "cart_currency": "AED",
      "cart_amount": 10.17,
      "callback": "http://wp_talends.test/wp-content/plugins/paytabs/return.php",
      "return": "http://wp_talends.test/wp-content/plugins/paytabs/return.php"
    }',
    CURLOPT_HTTPHEADER => array(
      'authorization: S2JN2MDR6R-JDDKDLH9JM-Z662LJRDW6',
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  echo $response;

}

function refundPayment() {
    
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://secure.paytabs.com/payment/request',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "profile_id": 91323,
      "tran_type": "refund",
      "tran_class": "ecom",
      "cart_id": "cart_66666",
      "cart_currency": "AED",
      "cart_amount": 1.3,
      "cart_description": "Refund reason",
      "tran_ref": "TST2427502129478"
  }',
    CURLOPT_HTTPHEADER => array(
      'authorization: S2JN2MDR6R-JDDKDLH9JM-Z662LJRDW6'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  echo $response;
  }

function triggerRecurringPayment(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://secure.paytabs.com/payment/request',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "profile_id": 91323,
        "tran_type": "sale",
        "tran_class": "recurring",
        "cart_id": "cart_55555",
        "cart_currency": "AED",
        "cart_amount": 33,
        "cart_description": "Description of the items/services",
        "token": "2C4654BC67A3E932C6B693F4618B7ABA",
        "tran_ref": "TST2427502129478",
        "callback": "http://54.174.237.66/"
    }',
    CURLOPT_HTTPHEADER => array(
        'authorization: S2JN2MDR6R-JDDKDLH9JM-Z662LJRDW6'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

}

function handle_paytabs_payment() {
    curlPayment();
    die;
    $options = get_option('paytabs_settings');
    $merchant_id = $options['paytabs_merchant_id'];
    $secret_key = $options['paytabs_secret_key'];
    // Get current user info
    $current_user = wp_get_current_user();
    $email = $current_user->user_email;
    $name = $current_user->display_name;

    // Get package info
    // $package = sanitize_text_field($_POST['package']); 
    // $amount = floatval($_POST['amount']); // Amount based on the selected package
       $package = "15 Days Package";
       $amount = 5;
    // Set subscription duration based on the selected package
    $subscription_duration = 30; // Default to 30 days
    if ($package == '15 Days Package') {
        $subscription_duration = 15; // Set to 15 days for this package
    }

    $merchant_id = "C6KMQ2-N96Q6D-DKDBHP-VDDDQR";
    $secret_key = "S2JN2MDR6R-JDDKDLH9JM-Z662LJRDW6";

    $data = array(
        "merchant_id" => $merchant_id,
        "secret_key" => $secret_key,
        "amount" => 5,
        "currency" => "USD",
        "title" => "Subscription for 15 Days Package",
        "email" => "zohaibyousuf456@gmail.com",
        "name" => "admin",
        "subscription_duration" => 15,
        "subscription_period" => "D",
        "return_url" => "http://54.174.237.66/"
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://www.paytabs.com/apiv2/create_pay_page");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json',
    ));

    // Execute the request
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    // Handle the response
    if ($http_code == 200) {
        $response_data = json_decode($response, true);
        print_r($response_data);
    } else {
        
        echo "Error: " . $response;
    }


    die;

    // PayTabs API endpoint
    $url = "https://www.paytabs.com/apiv2/create_pay_page";

    // Prepare the data for the API request
    $data = [
        'merchant_id' => $merchant_id,
        'secret_key' => $secret_key,
        'amount' => $amount,
        'currency' => 'USD', // Change as needed
        'title' => "Subscription for {$package}",
        'email' => $email,
        'name' => $name,
        'subscription_duration' => $subscription_duration,
        'subscription_period' => 'D', // 'D' for Days
        'return_url' => 'http://54.174.237.66/', // URL to redirect after payment
        // Add any additional required parameters here
    ];

      // Send the request to PayTabs
    $response = wp_remote_post($url, [
        'body' => json_encode($data),
        'headers' => [
            'Content-Type' => 'application/json',
        ],
    ]);

    // Handle the response
    if (is_wp_error($response)) {
        wp_die("Payment error: " . $response->get_error_message());
    } else {
        $body = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($body['response_code']) && $body['response_code'] == 100) {
            $payment_url = $body['payment_url'];
            wp_redirect($payment_url);
            exit;
        } else {
            print_r($body);die;
            wp_die("Payment failed: " . $body['message']);
        }
    }
}

//handle_paytabs_payment(); // Call the function to process payment
