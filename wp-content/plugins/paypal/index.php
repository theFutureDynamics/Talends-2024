<?php

/*
Plugin Name:  Paypal
*/

// Include Composer's autoload file
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/paypal-config.php';

use PayPal\Api\Plan;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\Agreement;
use PayPal\Api\AgreementDetails;
use PayPal\Api\Payer;


if(isset($_GET['create_plan']) && $_GET['create_plan'] == 1){
    $plan = new Plan();
    $plan->setName('Basic Plan')
        ->setDescription('Monthly subscription plan')
        ->setType('INFINITE');

    $paymentDefinition = new PaymentDefinition();
    $paymentDefinition->setName('Monthly Payment')
        ->setType('REGULAR')
        ->setFrequency('MONTH')
        ->setFrequencyInterval('1')
        ->setCycles('0')
        ->setAmount(new \PayPal\Api\Currency('{
            "currency": "USD",
            "value": "10.00"
        }'));

    $merchantPreferences = new MerchantPreferences();
    $merchantPreferences->setReturnUrl('https://yourdomain.com/success')
        ->setCancelUrl('https://yourdomain.com/cancel')
        ->setAutoBillAmount('YES')
        ->setInitialFailAmountAction('CONTINUE')
        ->setMaxFailAttempts('0');

    $plan->setPaymentDefinitions([$paymentDefinition])
        ->setMerchantPreferences($merchantPreferences);
    $planId = '';
    try {
        $createdPlan = $plan->create($apiContext);
        // Retrieve the plan ID
        $planId = $createdPlan->getId();   
        echo 'Plan Created Successfully';
    } catch (Exception $ex) {
        echo 'Error: ' . $ex->getMessage();
    }
    exit;
    $planId = "P-46831648ET092764MM3IXBUQ";
    if($planId){

        // Create and configure the agreement
        $agreement = new Agreement();
        $agreement->setName('Basic Plan Subscription')
            ->setDescription('Agreement for basic plan subscription')
            ->setStartDate(date('Y-m-d\TH:i:s\Z', strtotime('+1 day')));

        // Set the plan ID you created earlier
        $plan = new Plan();
        $plan->setId($planId); // Replace with your plan ID

        $agreement->setPlan($plan)
            ->setPayer(['payment_method' => 'paypal']);

        // Create and send the agreement
        try {
            $agreement->create($apiContext);
            // dd($agreement);
            $approvalUrl = $agreement->getApprovalLink(); // Get approval URL
            echo $approvalUrl;die;
            header('Location: ' . $approvalUrl); // Redirect user to PayPal
            exit();
        } catch (Exception $ex) {
            echo 'Error: ' . $ex->getMessage();
        }

    }


}
function testpayment() {
    ?>



<div class="listivo-pricing-table">
    <div class="listivo-panel-package-v2 listivo-panel-package-v2--no-bottom">
        <div class="listivo-panel-package-v2__head listivo-panel-package-v2__head--listivo_4211">
            <div>
                Featured Max </div>

        </div>

        <div class="listivo-panel-package-v2__body">
            <div class="listivo-panel-package-v2__main-value">
                $19.00 </div>

            <div class="listivo-panel-package-v2__button">
                <a class="listivo-simple-button listivo-simple-button--background-primary-1"
                    href="http://ec2-3-82-203-177.compute-1.amazonaws.com/wp-admin/admin-ajax.php?action=listivo/paymentPackage/purchase&amp;id=4211">
                    Choose this package </a>
            </div>


            <div class="listivo-panel-package-v2__attributes">

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Duration:

                        <span>
                            30
                            Days </span>
                    </div>
                </div>

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Featured:

                        <span>
                            7
                            Days </span>
                    </div>
                </div>

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Bump up every:

                        <span>
                            10 Days </span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="listivo-panel-package-v2 listivo-panel-package-v2--no-bottom">
        <div class="listivo-panel-package-v2__head listivo-panel-package-v2__head--listivo_4211">
            <div>
                Featured Max </div>

        </div>

        <div class="listivo-panel-package-v2__body">
            <div class="listivo-panel-package-v2__main-value">
                $19.00 </div>

            <div class="listivo-panel-package-v2__button">
                <a class="listivo-simple-button listivo-simple-button--background-primary-1"
                    href="http://ec2-3-82-203-177.compute-1.amazonaws.com/wp-admin/admin-ajax.php?action=listivo/paymentPackage/purchase&amp;id=4211">
                    Choose this package </a>
            </div>


            <div class="listivo-panel-package-v2__attributes">

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Duration:

                        <span>
                            30
                            Days </span>
                    </div>
                </div>

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Featured:

                        <span>
                            7
                            Days </span>
                    </div>
                </div>

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Bump up every:

                        <span>
                            10 Days </span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="listivo-panel-package-v2 listivo-panel-package-v2--no-bottom">
        <div class="listivo-panel-package-v2__head listivo-panel-package-v2__head--listivo_4211">
            <div>
                Featured Max </div>

        </div>

        <div class="listivo-panel-package-v2__body">
            <div class="listivo-panel-package-v2__main-value">
                $19.00 </div>

            <div class="listivo-panel-package-v2__button">
                <a class="listivo-simple-button listivo-simple-button--background-primary-1"
                    href="http://ec2-3-82-203-177.compute-1.amazonaws.com/wp-admin/admin-ajax.php?action=listivo/paymentPackage/purchase&amp;id=4211">
                    Choose this package </a>
            </div>


            <div class="listivo-panel-package-v2__attributes">

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Duration:

                        <span>
                            30
                            Days </span>
                    </div>
                </div>

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Featured:

                        <span>
                            7
                            Days </span>
                    </div>
                </div>

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Bump up every:

                        <span>
                            10 Days </span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="listivo-panel-package-v2 listivo-panel-package-v2--no-bottom">
        <div class="listivo-panel-package-v2__head listivo-panel-package-v2__head--listivo_4211">
            <div>
                Featured Max </div>

        </div>

        <div class="listivo-panel-package-v2__body">
            <div class="listivo-panel-package-v2__main-value">
                $19.00 </div>

            <div class="listivo-panel-package-v2__button">
                <a class="listivo-simple-button listivo-simple-button--background-primary-1"
                    href="http://ec2-3-82-203-177.compute-1.amazonaws.com/wp-admin/admin-ajax.php?action=listivo/paymentPackage/purchase&amp;id=4211">
                    Choose this package </a>
            </div>


            <div class="listivo-panel-package-v2__attributes">

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Duration:

                        <span>
                            30
                            Days </span>
                    </div>
                </div>

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Featured:

                        <span>
                            7
                            Days </span>
                    </div>
                </div>

                <div class="listivo-panel-package-v2__attribute">
                    <div class="listivo-panel-package-v2__attribute-icon-wrapper">
                        <div class="listivo-panel-package-v2__attribute-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                    fill="#374B5C"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="listivo-panel-package-v2__attribute-value">
                        Bump up every:

                        <span>
                            10 Days </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script>




<?php
}

add_shortcode('paypal_payment', 'testpayment');

?>