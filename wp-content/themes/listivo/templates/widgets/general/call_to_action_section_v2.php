<?php

use Tangibledesign\Listivo\Widgets\General\CallToActionSectionV2Widget;

/* @var CallToActionSectionV2Widget $lstCurrentWidget */
global $lstCurrentWidget;
?>
<div class="listivo-call-to-action-section-v2">
    <div
            class="listivo-call-to-action-section-v2__background"
        <?php if (!empty($lstCurrentWidget->getBackgroundImage())) : ?>
            style="background-image: url('<?php echo esc_url($lstCurrentWidget->getBackgroundImage()); ?>');"
        <?php endif; ?>
    ></div>

    <div class="listivo-container">
        <div class="listivo-call-to-action-section-v2__content">
            <div class="listivo-call-to-action-section-v2__heading">
                <div class="listivo-heading-v2-wrapper">
                    <div class="listivo-heading-v2 listivo-heading-v2--<?php echo esc_attr($lstCurrentWidget->getAlignment()); ?> listivo-heading-v2--tablet-<?php echo esc_attr($lstCurrentWidget->getTabletAlignment()); ?> listivo-heading-v2--mobile-<?php echo esc_attr($lstCurrentWidget->getMobileAlignment()); ?>">
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
            </div>

            <div class="listivo-call-to-action-section-v2__button">
                <a
                    <?php if ($lstCurrentWidget->isPrimary1Type()) : ?>
                        class="listivo-button listivo-button--primary-1"
                    <?php else : ?>
                        class="listivo-button listivo-button--primary-2"
                    <?php endif; ?>
                        href="<?php echo esc_url($lstCurrentWidget->getButtonUrl()); ?>"
                        title="<?php echo esc_attr($lstCurrentWidget->getButtonText()); ?>"
                >
                    <span>
                        <?php echo esc_html($lstCurrentWidget->getButtonText()); ?>

                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11"
                             fill="none">
                            <path d="M7.13805 10.4713C7.00772 10.6017 6.83738 10.6667 6.66671 10.6667C6.49605 10.6667 6.32571 10.6017 6.19538 10.4713C5.93504 10.211 5.93504 9.78898 6.19538 9.52865L9.72407 5.99996H0.666672C0.298669 5.99996 0 5.70129 0 5.33329C0 4.96528 0.298669 4.66662 0.666672 4.66662H9.72407L6.19538 1.13792C5.93504 0.877589 5.93504 0.455586 6.19538 0.195251C6.45571 -0.0650838 6.87771 -0.0650838 7.13805 0.195251L11.8047 4.86195C12.0651 5.12229 12.0651 5.54429 11.8047 5.80462L7.13805 10.4713Z"
                                  fill="#FDFDFE"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
