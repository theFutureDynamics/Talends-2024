<?php

use Tangibledesign\Listivo\Widgets\Listing\ListingGalleryWidget;

/* @var ListingGalleryWidget $lstCurrentWidget */
global $lstCurrentWidget;

$lstImages = $lstCurrentWidget->getImages();
if ($lstImages->isEmpty()) {
    return;
}
?>
<div class="listivo-app">
    <?php if ($lstImages->count() === 1) : ?>
        <lst-gallery
                prefix="listivo"
                selector=".listivo-gallery-v1"
                zoom-selector=".listivo-gallery-v1__zoom"
                :draggable="false"
                class="listivo-gallery-v1"
        >
            <div slot-scope="props" class="listivo-gallery-v1">
                <div class="listivo-swiper-container">
                    <div class="listivo-swiper-wrapper">
                        <?php foreach ($lstImages as $lstIndex => $lstImage) :
                            $lstImageSrcset = $lstImage->getSrcset($lstCurrentWidget->getImageSize());
                            ?>
                            <div
                                    class="listivo-swiper-slide"
                                    data-index="<?php echo esc_attr($lstIndex); ?>"
                                    data-url="<?php echo esc_url($lstImage->getImageUrl()); ?>"
                                    data-width="<?php echo esc_attr($lstImage->getWidth()); ?>"
                                    data-height="<?php echo esc_attr($lstImage->getHeight()); ?>"
                            >
                                <img
                                        class="lazyload"
                                        alt="<?php echo esc_attr($lstImage->getAlt()); ?>"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAACCAQAAAA3fa6RAAAADklEQVR42mNkAANGCAUAACMAA2w/AMgAAAAASUVORK5CYII="
                                    <?php if (!empty($lstImageSrcset)) : ?>
                                        data-srcset="<?php echo esc_attr($lstImageSrcset); ?>"
                                        data-sizes="auto"
                                    <?php else : ?>
                                        data-src="<?php echo esc_url($lstImage->getImageUrl($lstCurrentWidget->getImageSize())); ?>"
                                    <?php endif; ?>
                                >
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <a class="listivo-gallery-v1__zoom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M1.55556 0C0.705396 0 0 0.705396 0 1.55556V4.66667H1.55556V1.55556H4.66667V0H1.55556ZM9.33333 0V1.55556H12.4444V4.66667H14V1.55556C14 0.705396 13.2946 0 12.4444 0H9.33333ZM0 9.33333V12.4444C0 13.2946 0.705396 14 1.55556 14H4.66667V12.4444H1.55556V9.33333H0ZM12.4444 9.33333V12.4444H9.33333V14H12.4444C13.2946 14 14 13.2946 14 12.4444V9.33333H12.4444Z"
                              fill="#FDFDFE"/>
                    </svg>
                </a>
            </div>
        </lst-gallery>
    <?php else : ?>
        <lst-gallery
                prefix="listivo"
                selector=".listivo-gallery-v1"
                zoom-selector=".listivo-gallery-v1__zoom"
                class="listivo-gallery-v1"
        >
            <div slot-scope="props" class="listivo-gallery-v1">
                <div class="listivo-swiper-container">
                    <div class="listivo-swiper-wrapper">
                        <?php foreach ($lstImages as $lstIndex => $lstImage) :
                            $lstImageSrcset = $lstImage->getSrcset($lstCurrentWidget->getImageSize());
                            ?>
                            <div
                                    class="listivo-swiper-slide"
                                    data-index="<?php echo esc_attr($lstIndex); ?>"
                                    data-url="<?php echo esc_url($lstImage->getImageUrl()); ?>"
                                    data-width="<?php echo esc_attr($lstImage->getWidth()); ?>"
                                    data-height="<?php echo esc_attr($lstImage->getHeight()); ?>"
                            >
                                <img
                                        class="lazyload"
                                        alt="<?php echo esc_attr($lstImage->getAlt()); ?>"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAACCAQAAAA3fa6RAAAADklEQVR42mNkAANGCAUAACMAA2w/AMgAAAAASUVORK5CYII="
                                    <?php if (!empty($lstImageSrcset)) : ?>
                                        data-srcset="<?php echo esc_attr($lstImageSrcset); ?>"
                                        data-sizes="auto"
                                    <?php else : ?>
                                        data-src="<?php echo esc_url($lstImage->getImageUrl($lstCurrentWidget->getImageSize())); ?>"
                                    <?php endif; ?>
                                >
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <template>
                    <div class="listivo-gallery-v1__count">
                        {{ props.swiper.realIndex + 1 }} / <?php echo esc_html($lstImages->count()); ?>
                    </div>
                </template>

                <a class="listivo-gallery-v1__zoom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M1.55556 0C0.705396 0 0 0.705396 0 1.55556V4.66667H1.55556V1.55556H4.66667V0H1.55556ZM9.33333 0V1.55556H12.4444V4.66667H14V1.55556C14 0.705396 13.2946 0 12.4444 0H9.33333ZM0 9.33333V12.4444C0 13.2946 0.705396 14 1.55556 14H4.66667V12.4444H1.55556V9.33333H0ZM12.4444 9.33333V12.4444H9.33333V14H12.4444C13.2946 14 14 13.2946 14 12.4444V9.33333H12.4444Z"
                              fill="#FDFDFE"/>
                    </svg>
                </a>

                <div class="listivo-gallery-v1__nav">
                    <button
                            class="listivo-arrow listivo-gallery-v1__arrow"
                            @click.prevent="props.swiper.slidePrev()"
                            type="button"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                            <path d="M15.509 7.19858C15.5064 7.03297 15.4382 6.87515 15.3193 6.75979C15.2004 6.64443 15.0406 6.58097 14.875 6.58335L2.63379 6.58335L7.40023 1.81691C7.46021 1.75932 7.5081 1.69034 7.54109 1.61401C7.57408 1.53768 7.59151 1.45553 7.59235 1.37238C7.5932 1.28923 7.57745 1.20675 7.54602 1.12977C7.51458 1.05278 7.46811 0.982842 7.40931 0.924043C7.35051 0.865245 7.28057 0.818769 7.20359 0.787338C7.1266 0.755907 7.04412 0.740154 6.96097 0.740999C6.87782 0.741844 6.79568 0.759272 6.71935 0.792261C6.64301 0.825251 6.57403 0.873139 6.51644 0.933121L0.68311 6.76646C0.565944 6.88367 0.500125 7.04262 0.500125 7.20835C0.500125 7.37408 0.565944 7.53303 0.68311 7.65024L6.51644 13.4836C6.57403 13.5436 6.64301 13.5914 6.71935 13.6244C6.79568 13.6574 6.87782 13.6749 6.96097 13.6757C7.04412 13.6765 7.1266 13.6608 7.20359 13.6294C7.28057 13.5979 7.35051 13.5515 7.40931 13.4927C7.46811 13.4339 7.51458 13.3639 7.54601 13.2869C7.57745 13.2099 7.5932 13.1275 7.59235 13.0443C7.59151 12.9612 7.57408 12.879 7.54109 12.8027C7.5081 12.7264 7.46021 12.6574 7.40023 12.5998L2.63379 7.83335L14.875 7.83335C14.9587 7.83455 15.0417 7.81894 15.1192 7.78746C15.1967 7.75597 15.2671 7.70925 15.3262 7.65005C15.3854 7.59086 15.432 7.5204 15.4634 7.44285C15.4948 7.3653 15.5103 7.28223 15.509 7.19858Z"
                                  fill="#455867"/>
                        </svg>
                    </button>

                    <button
                            class="listivo-arrow listivo-gallery-v1__arrow"
                            @click.prevent="props.swiper.slideNext()"
                            type="button"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                            <path d="M0.491049 6.80142C0.493636 6.96703 0.561855 7.12485 0.680721 7.24021C0.799587 7.35557 0.959379 7.41903 1.125 7.41665L13.3662 7.41665L8.59977 12.1831C8.53979 12.2407 8.4919 12.3097 8.45891 12.386C8.42592 12.4623 8.4085 12.5445 8.40765 12.6276C8.40681 12.7108 8.42256 12.7932 8.45399 12.8702C8.48542 12.9472 8.5319 13.0172 8.5907 13.076C8.64949 13.1348 8.71943 13.1812 8.79642 13.2127C8.8734 13.2441 8.95589 13.2598 9.03904 13.259C9.12219 13.2582 9.20433 13.2407 9.28066 13.2077C9.35699 13.1747 9.42597 13.1269 9.48356 13.0669L15.3169 7.23354C15.4341 7.11633 15.4999 6.95738 15.4999 6.79165C15.4999 6.62592 15.4341 6.46697 15.3169 6.34976L9.48356 0.51642C9.42597 0.456439 9.35699 0.408551 9.28066 0.375562C9.20433 0.342572 9.12219 0.325145 9.03904 0.3243C8.95589 0.323455 8.8734 0.339209 8.79642 0.370639C8.71943 0.40207 8.64949 0.448545 8.5907 0.507343C8.5319 0.566142 8.48542 0.636082 8.45399 0.713067C8.42256 0.790051 8.40681 0.872534 8.40765 0.955684C8.4085 1.03883 8.42592 1.12098 8.45891 1.19731C8.4919 1.27364 8.53979 1.34262 8.59977 1.40021L13.3662 6.16665L1.125 6.16665C1.04135 6.16545 0.958306 6.18106 0.880796 6.21254C0.803286 6.24403 0.732885 6.29075 0.673766 6.34995C0.614646 6.40914 0.568012 6.4796 0.536626 6.55715C0.50524 6.6347 0.489742 6.71777 0.491049 6.80142Z"
                                  fill="#2A3946"/>
                        </svg>
                    </button>
                </div>
            </div>
        </lst-gallery>
    <?php endif; ?>
</div>
