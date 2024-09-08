<?php

use Tangibledesign\Framework\Models\User\User;
use Tangibledesign\Listivo\Widgets\General\PanelWidget;

/* @var PanelWidget $lstCurrentWidget */
global $lstCurrentWidget;

get_template_part('templates/widgets/general/panel/header');

$lstCurrentUser = tdf_current_user();
if (!$lstCurrentUser instanceof User) {
    return;
}
// $expertises = $lstCurrentUser->getUserExpertises();
?>
<div class="listivo-panel-section">
    <div class="listivo-container">
        <div class="listivo-panel-section__top">
            <h1 class="listivo-panel-section__label">
                <?php echo esc_html($lstCurrentWidget->getTitle()); ?>
            </h1>

            <div class="">
                <button class="listivo-button listivo-button--primary-1 listivo-button-primary-1-colors-with-stroke-selector"><span>
                    Buy The Package
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="10" viewBox="0 0 14 10" fill="none"><rect x="12.2676" y="0.646447" width="1.53602" height="11.5509" rx="0.768011" transform="rotate(45 12.2676 0.646447)" fill="#FDFDFE" stroke="#FDFDFE" stroke-width="0.5"></rect> <path d="M1.19345 4.98425C0.891119 5.28658 0.897654 5.77873 1.20791 6.07292L4.70642 9.39036C4.94829 9.61971 5.32032 9.64118 5.58696 9.44116C5.91859 9.1924 5.95423 8.70807 5.66258 8.41344L2.27076 4.98699C1.97447 4.68767 1.49125 4.68644 1.19345 4.98425Z" fill="#FDFDFE" stroke="#FDFDFE" stroke-width="0.5"></path></svg></span> <svg width="40" height="10" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="#fff" class="listivo-button__loading"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate> <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle> <circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate> <animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle> <circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate> <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg> -->
                </button>
            </div>

            <?php get_template_part('templates/widgets/general/panel/packages_bar'); ?>
        </div>

        <div class="listivo-panel-section__content">
       
            <lst-accordion
                    class="listivo-panel-accordions"
                    item-selector=".listivo-panel-accordion__content-wrapper--"
                <?php if (tdf_settings()->subscriptionsEnabled() && $lstCurrentUser->hasUserSubscription()) : ?>
                    initial-open="subscription"
                <?php else : ?>
                    initial-open="details"
                <?php endif; ?>
            >
                <div slot-scope="accordions" class="listivo-panel-accordions">
                    <?php get_template_part('templates/widgets/general/panel/settings/subscription'); ?>

                    <?php get_template_part('templates/widgets/general/panel/settings/details'); ?>

                    <?php get_template_part('templates/widgets/general/panel/settings/experience'); ?>

                    <?php get_template_part('templates/widgets/general/panel/settings/expertise'); ?>
                    
                    <?php get_template_part('templates/widgets/general/panel/settings/education'); ?>

                    <?php get_template_part('templates/widgets/general/panel/settings/awards'); ?>

                    <?php get_template_part('templates/widgets/general/panel/settings/portfolio'); ?>

                    <?php // get_template_part('templates/widgets/general/panel/settings/image'); ?>

                    <?php get_template_part('templates/widgets/general/panel/settings/socials'); ?>

                    <?php get_template_part('templates/widgets/general/panel/settings/change_password'); ?>

                    <?php get_template_part('templates/widgets/general/panel/settings/change_email'); ?>
                </div>
            </lst-accordion>
        </div>

        <div class="listivo-panel-section__bottom">
            <lst-delete-account
                    request-url="<?php echo esc_url(tdf_action_url('listivo/users/delete')); ?>"
                    redirect-url="<?php echo esc_url(tdf_settings()->getLoginPageUrl()); ?>"
                    delete-title-text="<?php echo esc_attr(tdf_string('delete_account')); ?>"
                    delete-text="<?php echo esc_attr(tdf_string('account_delete_confirm_text')); ?>"
                    confirm-button-text="<?php echo esc_attr(tdf_string('confirm')); ?>"
                    cancel-button-text="<?php echo esc_attr(tdf_string('cancel')); ?>"
            >
                <div
                        slot-scope="deleteAccount"
                        class="listivo-panel-section__delete-account"
                        @click="deleteAccount.onClick"
                >
                    <?php echo esc_html(tdf_string('delete_account')); ?>
                </div>
            </lst-delete-account>
        </div>
    </div>
</div>