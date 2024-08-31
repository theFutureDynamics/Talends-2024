<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

// PayPal API context setup
$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'AXJnktzOZptj2mXFAjhCmEuR6oAnG8jcM177v-uWTqOLO93nSy120wyHcMv_4cK24rf9SMsVINfF0Crb',     // Client ID from PayPal
        'EOtr-OpwHOthGPCdB_iAd9LQe43UKiExqij9DBYlQbd_-B5q8Y1sarg-rfphKerrb5Kul1AemnIpRz5h'  // Client Secret from PayPal
    )
);

$apiContext->setConfig([
    'mode' => 'sandbox', // Use 'live' for production
]);
?>