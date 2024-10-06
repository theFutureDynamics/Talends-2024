<?php

use Tangibledesign\Listivo\Widgets\General\PagesCarouselWidget;

/* @var PagesCarouselWidget $lstCurrentWidget */
global $lstCurrentWidget;
$lstPages = $lstCurrentWidget->getPages();
if ($lstPages->isEmpty()) {
    return;
}
?>
<div class="listivo-app listivo-term-carousel">
    <lst-term-carousel prefix="listivo">
        <div slot-scope="props">
            <div class="listivo-swiper-container">
                <div class="listivo-swiper-wrapper">
                    <?php foreach ($lstPages as $lstPageData) :
                        /* @var \Tangibledesign\Framework\Models\Page $lstPage */
                        $lstPage = $lstPageData['page'];
                        ?>
                        <div class="listivo-swiper-slide">
                            <a
                                    href="<?php echo esc_url($lstPage->getUrl()); ?>"
                                    class="listivo-term-carousel__term"
                            >
                                <div class="listivo-term-carousel__image">
                                    <img
                                            class="lazyload"
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAACCAQAAAA3fa6RAAAADklEQVR42mNkAANGCAUAACMAA2w/AMgAAAAASUVORK5CYII="
                                            data-src="<?php echo esc_url($lstPageData['image']['url']); ?>"
                                            alt="<?php echo esc_attr($lstPage->getName()); ?>"
                                    >
                                </div>

                                <div class="listivo-term-carousel__content">
                                    <h3 class="listivo-term-carousel__label">
                                        <?php echo esc_html($lstPage->getName()); ?>
                                    </h3>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="listivo-term-carousel__navigation">
                    <div class="listivo-term-carousel__pagination"></div>

                    <div class="listivo-term-carousel__arrows listivo-box-arrows">
                        <div
                                @click="props.prevSlide"
                                class="listivo-box-arrow"
                                :class="{'listivo-box-arrow--disabled': props.swiper.isBeginning}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11"
                                 fill="none">
                                <path d="M4.86195 10.4713C4.99228 10.6017 5.16262 10.6667 5.33329 10.6667C5.50395 10.6667 5.67429 10.6017 5.80462 10.4713C6.06496 10.211 6.06496 9.78898 5.80462 9.52865L2.27593 5.99996H11.3333C11.7013 5.99996 12 5.70129 12 5.33329C12 4.96528 11.7013 4.66662 11.3333 4.66662H2.27593L5.80462 1.13792C6.06496 0.877589 6.06496 0.455586 5.80462 0.195251C5.54429 -0.0650838 5.12229 -0.0650838 4.86195 0.195251L0.195251 4.86195C-0.0650838 5.12229 -0.0650838 5.54429 0.195251 5.80462L4.86195 10.4713Z"/>
                            </svg>
                        </div>

                        <div
                                @click="props.nextSlide"
                                class="listivo-box-arrow"
                                :class="{'listivo-box-arrow--disabled': props.swiper.isEnd}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11"
                                 fill="none">
                                <path d="M7.13805 10.4713C7.00772 10.6017 6.83738 10.6667 6.66671 10.6667C6.49604 10.6667 6.32571 10.6017 6.19538 10.4713C5.93504 10.211 5.93504 9.78898 6.19538 9.52865L9.72407 5.99996H0.666672C0.298669 5.99996 0 5.70129 0 5.33329C0 4.96528 0.298669 4.66662 0.666672 4.66662H9.72407L6.19538 1.13792C5.93504 0.877589 5.93504 0.455587 6.19538 0.195251C6.45571 -0.0650838 6.87771 -0.0650838 7.13805 0.195251L11.8047 4.86195C12.0651 5.12229 12.0651 5.54429 11.8047 5.80462L7.13805 10.4713Z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </lst-term-carousel>
</div>