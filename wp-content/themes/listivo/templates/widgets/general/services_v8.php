<?php

use Tangibledesign\Listivo\Widgets\General\ServicesV8Widget;

/* @var ServicesV8Widget $lstCurrentWidget */
global $lstCurrentWidget;
?>
<div class="listivo-services-v8">
    <?php foreach ($lstCurrentWidget->getServices() as $lstService) : ?>
        <div class="listivo-service-v8">
            <?php if (!empty($lstService['image']['url'])) : ?>
                <div
                    <?php if ($lstCurrentWidget->hasIconShadow()) : ?>
                        class="listivo-service-v8__icon"
                    <?php else : ?>
                        class="listivo-service-v8__icon listivo-service-v8__icon--no-shadow"
                    <?php endif; ?>
                >
                    <img
                            class="lazyload"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAACCAQAAAA3fa6RAAAADklEQVR42mNkAANGCAUAACMAA2w/AMgAAAAASUVORK5CYII="
                            data-src="<?php echo esc_url($lstService['image']['url']); ?>"
                            alt="<?php echo esc_attr($lstService['title']); ?>"
                    >
                </div>
            <?php endif; ?>

            <h3 class="listivo-service-v8__label">
                <?php echo esc_html($lstService['title']); ?>
            </h3>

            <div class="listivo-service-v8__text">
                <?php echo nl2br(wp_kses_post($lstService['text'])); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>