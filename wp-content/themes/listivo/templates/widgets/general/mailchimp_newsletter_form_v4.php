<?php

use Tangibledesign\Listivo\Widgets\General\MailchimpNewsletterFormV4Widget;

/* @var MailchimpNewsletterFormV4Widget $lstCurrentWidget */
global $lstCurrentWidget;

if (!function_exists('mc4wp_show_form')) {
    return;
}
?>
<div class="listivo-newsletter-v4">
    <div class="listivo-newsletter-v4__background">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 384" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M1321.73 -358.571C1207.86 -323.218 1087.58 -305.607 996.978 -250.448C886.755 -183.341 737.804 -85.4393 762.379 -12.6625C822.003 143.548 985.496 31.1454 1094.81 63.9207C1204.18 96.7139 1303.64 269.899 1432.86 326.589C1517.22 363.598 1789.61 500.585 2132.04 305.811C2263.28 231.165 2081.11 -165.793 2061.41 -260.664C2042.4 -352.162 1964.82 -479.931 1811.57 -503.34C1659.08 -526.634 1490.27 -410.893 1321.73 -358.571Z"
                  fill="#E6F0FA"
                  class="listivo-newsletter-v4__pattern-4"
            />
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M1166.99 642.063C1252.31 644.616 1339.74 653.401 1411.33 647.093C1498.43 639.418 1617.12 626.82 1609.73 601.462C1589.01 546.22 1458.05 561.573 1385.29 538.539C1312.48 515.493 1265.93 450.306 1182.38 417.541C1127.83 396.151 954.109 321.69 685.394 341.305C582.41 348.822 656.731 492.824 657.652 524.423C658.539 554.899 695.856 603.489 800.948 628.825C905.532 654.038 1040.7 638.283 1166.99 642.063Z"
                  fill="#E6F0FA"
                  class="listivo-newsletter-v4__pattern-4"
            />
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M0.677734 -56.2015C66.1287 -8.8164 129.69 44.8114 189.395 77.6094C262.034 117.512 362.232 170.126 370.814 145.323C385.884 88.8362 274.507 31.9811 230.517 -25.6002C186.503 -83.2128 186.963 -161.595 140.03 -232.916C109.39 -279.477 15.3986 -432.986 -206.398 -559.437C-291.401 -607.899 -314.767 -449.877 -331.959 -423.369C-348.54 -397.802 -346.829 -337.987 -278.798 -261.353C-211.096 -185.09 -96.1898 -126.332 0.677734 -56.2015Z"
                  fill="#E6F0FA"
                  class="listivo-newsletter-v4__pattern-4"
            />
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M1296.18 -390.453C1182.3 -355.1 1062.02 -337.489 971.423 -282.33C861.2 -215.224 712.249 -117.321 736.824 -44.5446C796.448 111.666 959.942 -0.736645 1069.26 32.0386C1178.63 64.8318 1278.09 238.017 1407.31 294.706C1491.67 331.716 1764.06 468.703 2106.49 273.929C2237.72 199.283 2055.56 -197.675 2035.85 -292.546C2016.85 -384.045 1939.26 -511.813 1786.02 -535.222C1633.52 -558.516 1464.72 -442.775 1296.18 -390.453Z"
                  fill="#FA823E"
                  class="listivo-newsletter-v4__pattern-primary-2"
            />
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M480.173 619.771C494.635 580.11 488.052 401.914 452.024 360.762C420.665 324.944 305.844 369.759 258.395 346.312C196.664 315.808 103.821 239.543 44.0001 251C-16.5263 262.592 -39.5143 283.365 -50.0382 330.812C-59.3945 372.996 -43.0638 418.421 -11.8569 462.102C19.4027 505.857 97.4385 552.224 157.157 569.862C212.816 586.302 308.932 564.266 357.942 552.735C409.35 540.64 465.747 659.333 480.173 619.771Z"
                  fill="#E6F0FA"
                  class="listivo-newsletter-v4__pattern-4"
            />
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M515.977 621.074C530.439 581.413 523.856 403.217 487.828 362.065C456.469 326.247 303.867 355.938 256.418 332.491C194.687 301.986 145.321 248.043 85.5001 259.5C24.9738 271.092 -11.5143 297.865 -22.0382 345.312C-31.3946 387.496 -7.25988 419.723 23.9471 463.404C55.2066 507.159 116.474 564.237 192.961 571.165C276.724 578.751 344.736 565.569 393.746 554.038C445.154 541.943 501.551 660.635 515.977 621.074Z"
                  fill="#3F71F0"
                  class="listivo-newsletter-v4__pattern-primary-1"
            />
        </svg>
    </div>

    <div class="listivo-newsletter-v4__content">
        <?php if (!empty($lstCurrentWidget->getHeading())) : ?>
            <h3 class="listivo-newsletter-v4__heading">
                <?php echo esc_html($lstCurrentWidget->getHeading()); ?>
            </h3>
        <?php endif; ?>

        <div class="listivo-newsletter-v4__form">
            <?php mc4wp_show_form(); ?>
        </div>
    </div>
</div>