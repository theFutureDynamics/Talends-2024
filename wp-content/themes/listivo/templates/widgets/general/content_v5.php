<?php

use Tangibledesign\Listivo\Widgets\General\ContentV5Widget;

/* @var ContentV5Widget $lstCurrentWidget */
global $lstCurrentWidget;

$lstImage = $lstCurrentWidget->getImage();
$lstFeatures = $lstCurrentWidget->getFeatures();
?>
<div class="listivo-content-v5">
    <?php if ($lstImage) : ?>
        <div class="listivo-content-v5__image-wrapper">
            <div class="listivo-content-v5__image">
                <img
                        class="lazyload"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAACCAQAAAA3fa6RAAAADklEQVR42mNkAANGCAUAACMAA2w/AMgAAAAASUVORK5CYII="
                        data-src="<?php echo esc_url($lstImage->getImageUrl()); ?>"
                        alt="<?php echo esc_attr($lstCurrentWidget->getSmallHeading()); ?>"
                        style="aspect-ratio: <?php echo esc_attr($lstImage->getWidth()); ?> / <?php echo esc_attr($lstImage->getHeight()); ?>;"
                >

                <?php if (!empty($lstCurrentWidget->getAwardValue() || !empty($lstCurrentWidget->getAwardText()))) : ?>
                    <div class="listivo-content-v5__award">
                        <div class="listivo-award-box-v2">
                            <div class="listivo-award-box-v2__background">
                                <svg xmlns="http://www.w3.org/2000/svg" width="188" height="188" viewBox="0 0 188 188"
                                     fill="none">
                                    <path d="M101.861 5.40098C97.6429 0.77115 90.3571 0.77114 86.1389 5.40097L77.1649 15.2506C75.1561 17.4555 72.0471 18.2885 69.2049 17.3835L56.5084 13.3404C50.5404 11.44 44.2307 15.0829 42.8926 21.2015L40.0457 34.2185C39.4084 37.1325 37.1325 39.4084 34.2185 40.0457L21.2016 42.8926C15.0829 44.2307 11.44 50.5404 13.3404 56.5084L17.3835 69.2049C18.2885 72.0471 17.4555 75.1561 15.2506 77.1649L5.40098 86.1389C0.77115 90.3571 0.77114 97.6429 5.40097 101.861L15.2506 110.835C17.4555 112.844 18.2885 115.953 17.3835 118.795L13.3404 131.492C11.44 137.46 15.0829 143.769 21.2015 145.107L34.2185 147.954C37.1325 148.592 39.4084 150.868 40.0457 153.781L42.8926 166.798C44.2307 172.917 50.5404 176.56 56.5084 174.66L69.2049 170.617C72.0471 169.711 75.1561 170.545 77.1649 172.749L86.1389 182.599C90.3571 187.229 97.6429 187.229 101.861 182.599L110.835 172.749C112.844 170.545 115.953 169.711 118.795 170.617L131.492 174.66C137.46 176.56 143.769 172.917 145.107 166.798L147.954 153.781C148.592 150.868 150.868 148.592 153.781 147.954L166.798 145.107C172.917 143.769 176.56 137.46 174.66 131.492L170.617 118.795C169.711 115.953 170.545 112.844 172.749 110.835L182.599 101.861C187.229 97.6429 187.229 90.3571 182.599 86.1389L172.749 77.1649C170.545 75.1561 169.711 72.0471 170.617 69.2049L174.66 56.5084C176.56 50.5404 172.917 44.2307 166.798 42.8926L153.781 40.0457C150.868 39.4084 148.592 37.1325 147.954 34.2185L145.107 21.2016C143.769 15.0829 137.46 11.44 131.492 13.3404L118.795 17.3835C115.953 18.2885 112.844 17.4555 110.835 15.2506L101.861 5.40098Z"
                                          fill="#FDFDFE" stroke="#FA5343" stroke-width="3"/>
                                </svg>
                            </div>

                            <div class="listivo-award-box-v2__content">
                                <div class="listivo-award-box-v2__main">
                                    <?php echo esc_html($lstCurrentWidget->getAwardValue()); ?>
                                </div>

                                <div class="listivo-award-box-v2__text">
                                    <?php echo esc_html($lstCurrentWidget->getAwardText()); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="listivo-content-v5__content">
        <div class="listivo-content-v5__heading">
            <div class="listivo-heading-v2 listivo-heading-v2--left listivo-heading-v2--tablet-left listivo-heading-v2--mobile-left">
                <?php if ($lstCurrentWidget->hasSmallHeading())  : ?>
                    <h3 class="listivo-heading-v2__small-text">
                        <?php echo esc_html($lstCurrentWidget->getSmallHeading()); ?>
                    </h3>
                <?php endif; ?>

                <h2 class="listivo-heading-v2__text">
                    <?php echo wp_kses_post(nl2br($lstCurrentWidget->getHeading())); ?>
                </h2>
            </div>
        </div>

        <?php if (!empty($lstCurrentWidget->getText())) : ?>
            <div class="listivo-content-v5__text">
                <?php echo wp_kses_post($lstCurrentWidget->getText()); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($lstCurrentWidget->getQuote())) : ?>
            <div class="listivo-content-v5__quote">
                <div class="listivo-quote">
                    <div class="listivo-quote__left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" viewBox="0 0 30 24" fill="none">
                            <path d="M20 0C18.1782 0 16.6667 1.51156 16.6667 3.33333V10C16.6667 11.8218 18.1782 13.3333 20 13.3333H25.0163L17.5358 23.3822H21.6927L30 12.2201V8.33659V3.33333C30 1.51156 28.4884 0 26.6667 0H20ZM3.33333 0.0488281C1.51156 0.0488281 0 1.56039 0 3.38216V10.0488C0 11.8706 1.51156 13.3822 3.33333 13.3822H8.34961L0.904948 23.3822H5.05859L13.3333 12.2656V11.7155V8.38216V3.38216C13.3333 1.56039 11.8218 0.0488281 10 0.0488281H3.33333ZM20 3.33333H26.6667V10H20V3.33333ZM3.33333 3.38216H10V8.38216V10.0488H3.33333V3.38216Z"
                                  fill="#FDFDFE"/>
                        </svg>
                    </div>

                    <div class="listivo-quote__content">
                        <?php echo nl2br(wp_kses_post($lstCurrentWidget->getQuote())); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($lstFeatures)) : ?>
            <div class="listivo-content-v5__features">
                <?php foreach ($lstFeatures as $lstFeature) : ?>
                    <div class="listivo-content-v5__feature">
                        <div class="listivo-content-v5__check">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                 fill="none">
                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                      fill="#2A3946"/>
                            </svg>
                        </div>

                        <?php echo esc_html($lstFeature); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
