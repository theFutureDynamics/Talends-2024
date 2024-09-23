<?php

use Tangibledesign\Framework\Models\User\User;
use Tangibledesign\Listivo\Widgets\General\PanelWidget;

/* @var PanelWidget $lstCurrentWidget */
global $lstCurrentWidget;

$lstCurrentUser = tdf_current_user();
if (!$lstCurrentUser instanceof User) {
    return;
}

global $wpdb;
$table_name = $wpdb->prefix . 'locations';
$locations = $wpdb->get_results("SELECT * FROM $table_name");
$locationOptions = array_map(function($location) {
    return [
        'label' => $location->title,
        'value' => $location->title
    ];
}, $locations);

$locationOptionsJson = htmlspecialchars(json_encode($locationOptions));

$table_name = $wpdb->prefix . 'skills';
$skills = $wpdb->get_results("SELECT * FROM $table_name");
$skillsOptions = array_map(function($skill) {
    return [
        'label' => $skill->title,
        'value' => $skill->title
    ];
}, $skills);

$skillOptionsJson = htmlspecialchars(json_encode($skillsOptions));
$current_user = wp_get_current_user();
$showAgencySettings = ($current_user->type == 'agency');
$showEmployerSettings = ($current_user->type == 'employer');
$showInterneSettings = ($current_user->type == 'intern');
$showFreelancerSettings = ($current_user->type == 'freelancer');

//   print_r($lstCurrentWidget->getUserSettings());die;
?>
<lst-user-settings
        class="listivo-panel-accordions__item listivo-panel-accordion"
        request-url="<?php echo esc_url(tdf_action_url('listivo/user/settings/save')); ?>"
        td-nonce="<?php echo esc_attr(wp_create_nonce('listivo_save_user_settings')); ?>"
        success-text="<?php echo esc_attr(tdf_string('changes_have_been_saved')); ?>"
        error-text="<?php echo esc_attr(tdf_string('something_went_wrong')); ?>"
        confirm-button-text="<?php echo esc_attr(tdf_string('ok')); ?>"
        :initial-user="<?php echo htmlspecialchars(json_encode($lstCurrentWidget->getUserSettings())); ?>"
        :login-min-length="<?php echo esc_attr(tdf_settings()->getLoginMinLength()); ?>"
        :locations="<?php echo htmlspecialchars(json_encode($locations)); ?>"
        :skills="<?php echo htmlspecialchars(json_encode($skills)); ?>"
    <?php if ($lstCurrentUser->isBusinessAccount() && tdf_settings()->isCompanyInformationEnabled() && tdf_settings()->requireCompanyInformation()) : ?>
        :company-information-required="true"
    <?php endif; ?>
    <?php if (
        ($lstCurrentUser->isBusinessAccount() && tdf_settings()->isFullNameEnabledForBusinessAccount() && tdf_settings()->isFullNameRequiredForBusinessAccount())
        || ($lstCurrentUser->isPrivateAccount() && tdf_settings()->isFullNameEnabledForPrivateAccount() && tdf_settings()->isFullNameRequiredForPrivateAccount())
    ) : ?>
        :full-name-required="true"
    <?php endif; ?>
>
    <div
            slot-scope="props"
            class="listivo-panel-accordions__item listivo-panel-accordion"
            :class="{'listivo-panel-accordion--active': accordions.open === 'details'}"
    >
        <div
                class="listivo-panel-accordion__top"
                @click.prevent="accordions.onOpen('details')"
        >
            <h3 class="listivo-panel-accordion__label">
                <?php echo esc_html(tdf_string('change_details')); ?>
            </h3>

            <div class="listivo-panel-accordion__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                     viewBox="0 0 16 14"
                     fill="none">
                    <path d="M6.0872 0.243733C6.25012 0.0808152 6.46304 -0.000435034 6.67637 -0.000435034C6.88971 -0.000435034 7.10263 0.0808152 7.26554 0.243733C7.59096 0.569152 7.59096 1.09666 7.26554 1.42208L2.85468 5.83294L14.1764 5.83294C14.6364 5.83294 15.0098 6.20627 15.0098 6.66628C15.0098 7.12628 14.6364 7.49962 14.1764 7.49962L2.85468 7.49962L7.26554 11.9105C7.59096 12.2359 7.59096 12.7634 7.26554 13.0888C6.94013 13.4142 6.41262 13.4142 6.0872 13.0888L0.25383 7.25545C-0.0715891 6.93003 -0.0715891 6.40253 0.25383 6.07711L6.0872 0.243733Z"
                          fill="#2A3946"/>
                </svg>
            </div>
        </div>

        <form @submit.prevent="props.onSave">
            <div class="listivo-panel-accordion__content-wrapper listivo-panel-accordion__content-wrapper--details">
                <div class="listivo-panel-accordion__content listivo-panel-user-settings">

                <lst-user-image
                        class="listivo-panel-accordions__item listivo-panel-accordion"
                        style="width:50%;float:left;height:615px;margin-right:10px"
                    <?php if ($lstCurrentUser->getImage()) : ?>
                        :initial-image="<?php echo esc_attr(json_encode($lstCurrentWidget->getUserImageData($lstCurrentUser))); ?>"
                    <?php endif; ?>
                        delete-request-url="<?php echo esc_url(tdf_action_url('listivo/user/image/delete')); ?>"
                        delete-nonce="<?php echo esc_attr(wp_create_nonce('listivo_delete_user_image')); ?>"
                        upload-nonce="<?php echo esc_attr(wp_create_nonce('listivo_save_user_image')); ?>"
                        delete-message-string="<?php echo esc_attr(tdf_string('are_you_sure')); ?>"
                        delete-success-string="<?php echo esc_attr(tdf_string('deleted')); ?>"
                        success-string="<?php echo esc_attr(tdf_string('success')); ?>"
                        confirm-string="<?php echo esc_attr(tdf_string('confirm')); ?>"
                        cancel-string="<?php echo esc_attr(tdf_string('cancel')); ?>"
                        in-progress-string="<?php echo esc_attr(tdf_string('in_progress')); ?>"
                >
                    <div
                            slot-scope="props"
                            class="listivo-panel-accordions__item listivo-panel-accordion"
                            :class="{'listivo-panel-accordion--active': accordions.open === 'user_image'}"
                    >
                        

                        

                        <div class="listivo-panel-accordion__content-wrapper listivo-panel-accordion__content-wrapper--user_image">
                            <div class="listivo-panel-accordion__content">
                                <lst-dropzone
                                        v-show="false"
                                        id="listivo-panel-user-image"
                                        :options="<?php echo htmlspecialchars(json_encode($lstCurrentWidget->getUserImageDropZoneConfig())); ?>"
                                        @vdropzone-sending="props.onSending"
                                        @vdropzone-success="props.onSuccess"
                                        @vdropzone-error="props.onError"
                                        @vdropzone-canceled="props.onError"
                                >
                                </lst-dropzone>

                                <div class="listivo-panel-user-image">
                                    <?php if ($lstCurrentUser->hasSocialImage()) : ?>
                                        <div class="listivo-panel-user-image__image">
                                            <img src="<?php echo esc_url($lstCurrentUser->getSocialImage()); ?>">

                                            <div
                                                    class="listivo-panel-user-image__close"
                                                    @click.stop.prevent="props.onDelete"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                                    viewBox="0 0 11 11" fill="none">
                                                    <path d="M1.61169 0.500482C1.39146 0.500755 1.1763 0.566706 0.993713 0.68991C0.811124 0.813114 0.66939 0.987978 0.586617 1.19216C0.503843 1.39635 0.483789 1.62059 0.529015 1.83623C0.574241 2.05188 0.682695 2.24914 0.840521 2.40281L3.93386 5.49762L0.840521 8.59243C0.734227 8.69453 0.649364 8.81683 0.590902 8.95216C0.532441 9.08748 0.501556 9.23312 0.500057 9.38054C0.498558 9.52796 0.526475 9.67419 0.582173 9.81068C0.63787 9.94717 0.720229 10.0712 0.824425 10.1754C0.928621 10.2797 1.05256 10.3621 1.18898 10.4178C1.32541 10.4735 1.47158 10.5014 1.61892 10.4999C1.76627 10.4984 1.91184 10.4675 2.0471 10.409C2.18237 10.3506 2.3046 10.2657 2.40666 10.1593L5.5 7.0645L8.59334 10.1593C8.69539 10.2657 8.81763 10.3506 8.95289 10.4091C9.08815 10.4675 9.23372 10.4984 9.38107 10.4999C9.52842 10.5014 9.67459 10.4735 9.81101 10.4178C9.94744 10.3621 10.0714 10.2797 10.1756 10.1754C10.2798 10.0712 10.3621 9.94718 10.4178 9.81069C10.4735 9.6742 10.5014 9.52796 10.4999 9.38054C10.4984 9.23312 10.4676 9.08748 10.4091 8.95216C10.3506 8.81683 10.2658 8.69453 10.1595 8.59243L7.06613 5.49762L10.1595 2.40281C10.3195 2.24717 10.4288 2.04679 10.4731 1.82792C10.5173 1.60906 10.4945 1.38192 10.4075 1.17628C10.3205 0.970635 10.1734 0.796081 9.9856 0.675491C9.79775 0.5549 9.57787 0.493899 9.35477 0.500482C9.06703 0.509059 8.79393 0.629373 8.59334 0.835933L5.5 3.93074L2.40666 0.835933C2.30332 0.729655 2.17971 0.645206 2.04316 0.587585C1.90661 0.529965 1.75989 0.500346 1.61169 0.500482Z"
                                                        fill="#FDFDFE"/>
                                                </svg>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div v-if="props.image" class="listivo-panel-user-image__image">
                                            <img :src="props.image.url">

                                            <div
                                                    class="listivo-panel-user-image__close"
                                                    @click.stop.prevent="props.onDelete"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                                    viewBox="0 0 11 11" fill="none">
                                                    <path d="M1.61169 0.500482C1.39146 0.500755 1.1763 0.566706 0.993713 0.68991C0.811124 0.813114 0.66939 0.987978 0.586617 1.19216C0.503843 1.39635 0.483789 1.62059 0.529015 1.83623C0.574241 2.05188 0.682695 2.24914 0.840521 2.40281L3.93386 5.49762L0.840521 8.59243C0.734227 8.69453 0.649364 8.81683 0.590902 8.95216C0.532441 9.08748 0.501556 9.23312 0.500057 9.38054C0.498558 9.52796 0.526475 9.67419 0.582173 9.81068C0.63787 9.94717 0.720229 10.0712 0.824425 10.1754C0.928621 10.2797 1.05256 10.3621 1.18898 10.4178C1.32541 10.4735 1.47158 10.5014 1.61892 10.4999C1.76627 10.4984 1.91184 10.4675 2.0471 10.409C2.18237 10.3506 2.3046 10.2657 2.40666 10.1593L5.5 7.0645L8.59334 10.1593C8.69539 10.2657 8.81763 10.3506 8.95289 10.4091C9.08815 10.4675 9.23372 10.4984 9.38107 10.4999C9.52842 10.5014 9.67459 10.4735 9.81101 10.4178C9.94744 10.3621 10.0714 10.2797 10.1756 10.1754C10.2798 10.0712 10.3621 9.94718 10.4178 9.81069C10.4735 9.6742 10.5014 9.52796 10.4999 9.38054C10.4984 9.23312 10.4676 9.08748 10.4091 8.95216C10.3506 8.81683 10.2658 8.69453 10.1595 8.59243L7.06613 5.49762L10.1595 2.40281C10.3195 2.24717 10.4288 2.04679 10.4731 1.82792C10.5173 1.60906 10.4945 1.38192 10.4075 1.17628C10.3205 0.970635 10.1734 0.796081 9.9856 0.675491C9.79775 0.5549 9.57787 0.493899 9.35477 0.500482C9.06703 0.509059 8.79393 0.629373 8.59334 0.835933L5.5 3.93074L2.40666 0.835933C2.30332 0.729655 2.17971 0.645206 2.04316 0.587585C1.90661 0.529965 1.75989 0.500346 1.61169 0.500482Z"
                                                        fill="#FDFDFE"/>
                                                </svg>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div
                                            class="listivo-panel-user-image__image listivo-panel-user-image__image--placeholder"
                                            @click.prevent="props.onOpen"
                                    >
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18"
                                                viewBox="0 0 16 18" fill="none">
                                                <path d="M6.09903 17.356V11.02H0.195031V7.312H6.09903V0.975998H9.91503V7.312H15.819V11.02H9.91503V17.356H6.09903Z"
                                                    fill="#D5E3EE"/>
                                            </svg>
                                        </div>

                                        <?php echo esc_html(tdf_string('upload_profile_photo')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </lst-user-image>
                <!-- listivo-panel-user-settings__field  -->
                    <div class="listivo-field-group">
                        <label
                                class="listivo-field-group__label"
                                for="listivo-name"
                        >
                            <?php echo esc_html(tdf_string('display_name')); ?>
                        </label>

                        <div class="listivo-field-group__field">
                            <div
                                    class="listivo-input-v2"
                                    :class="{
                                        'listivo-input-v2--error': props.showErrors && (!props.errors.name.required || !props.errors.name.minLength),
                                    }"
                            >
                                <input
                                        id="listivo-name"
                                        type="text"
                                        :value="props.name"
                                        @input="props.setName($event.target.value)"
                                        placeholder="<?php echo esc_attr(tdf_string('enter_your_display_name')); ?>"
                                >

                                <template>
                                    <div
                                            v-if="props.showErrors && (!props.errors.name.required || !props.errors.name.minLength)"
                                            class="listivo-input-v2__error"
                                    >
                                        <div class="listivo-field-error">
                                            <div class="listivo-field-error__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="10" height="9" viewBox="0 0 10 9"
                                                     fill="none">
                                                    <path d="M0.105217 7.80234L4.38783 0.354178C4.51386 0.135013 4.74732 0 4.99999 0C5.25265 0 5.48611 0.135013 5.61214 0.354178L9.89475 7.80234C10.0269 8.03213 10.0351 8.31277 9.91661 8.54991L9.9164 8.55032C9.78241 8.8181 9.50871 8.98722 9.20927 8.98722H0.790697C0.491259 8.98722 0.217558 8.8181 0.0837706 8.55032L0.0835662 8.54991C-0.035106 8.31277 -0.0269357 8.03213 0.105217 7.80234Z"
                                                          fill="#FDFDFE"/>
                                                    <path d="M5.40848 7.55742C5.40848 7.78313 5.22567 7.96593 4.99997 7.96593C4.77427 7.96593 4.59146 7.78313 4.59146 7.55742C4.59146 7.33172 4.77427 7.14891 4.99997 7.14891C5.22567 7.14891 5.40848 7.33172 5.40848 7.55742ZM4.99997 2.85956C4.66152 2.85956 4.38721 3.13387 4.38721 3.47232L4.5643 6.12846C4.57962 6.35783 4.77019 6.53615 4.99997 6.53615C5.22976 6.53615 5.42033 6.35783 5.43565 6.12846L5.61274 3.47232C5.61274 3.13387 5.33842 2.85956 4.99997 2.85956Z"
                                                          fill="#F09965"/>
                                                </svg>
                                            </div>

                                            <div v-if="!props.errors.name.required">
                                                <?php echo esc_html(tdf_string('field_is_required')); ?>
                                            </div>

                                            <div v-if="!props.errors.name.minLength">
                                                <?php echo sprintf(esc_html(tdf_string('display_name_min_letters')),
                                                    tdf_settings()->getLoginMinLength()); ?>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <?php if (
                        ($lstCurrentUser->isBusinessAccount() && tdf_settings()->isFullNameEnabledForBusinessAccount())
                        || ($lstCurrentUser->isPrivateAccount() && tdf_settings()->isFullNameEnabledForPrivateAccount())
                    ) : ?>
                        <div class="listivo-panel-user-settings__field listivo-field-group">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-first-name"
                            >
                                <?php echo esc_html(tdf_string('first_name')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <div
                                        class="listivo-input-v2"
                                    <?php if (
                                        ($lstCurrentUser->isBusinessAccount() && tdf_settings()->isFullNameRequiredForBusinessAccount())
                                        || ($lstCurrentUser->isPrivateAccount() && tdf_settings()->isFullNameRequiredForPrivateAccount())
                                    ) : ?>
                                        :class="{
                                            'listivo-input-v2--error': props.showErrors && !props.errors.firstName.required,
                                        }"
                                    <?php endif; ?>
                                >
                                    <input
                                            id="listivo-first-name"
                                            type="text"
                                            :value="props.firstName"
                                            @input="props.setFirstName($event.target.value)"
                                    >

                                    <?php if (
                                        ($lstCurrentUser->isBusinessAccount() && tdf_settings()->isFullNameRequiredForBusinessAccount())
                                        || ($lstCurrentUser->isPrivateAccount() && tdf_settings()->isFullNameRequiredForPrivateAccount())
                                    ) : ?>
                                        <template>
                                            <div
                                                    v-if="props.showErrors && !props.errors.firstName.required"
                                                    class="listivo-input-v2__error"
                                            >
                                                <div class="listivo-field-error">
                                                    <div class="listivo-field-error__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             width="10" height="9"
                                                             viewBox="0 0 10 9"
                                                             fill="none">
                                                            <path d="M0.105217 7.80234L4.38783 0.354178C4.51386 0.135013 4.74732 0 4.99999 0C5.25265 0 5.48611 0.135013 5.61214 0.354178L9.89475 7.80234C10.0269 8.03213 10.0351 8.31277 9.91661 8.54991L9.9164 8.55032C9.78241 8.8181 9.50871 8.98722 9.20927 8.98722H0.790697C0.491259 8.98722 0.217558 8.8181 0.0837706 8.55032L0.0835662 8.54991C-0.035106 8.31277 -0.0269357 8.03213 0.105217 7.80234Z"
                                                                  fill="#FDFDFE"/>
                                                            <path d="M5.40848 7.55742C5.40848 7.78313 5.22567 7.96593 4.99997 7.96593C4.77427 7.96593 4.59146 7.78313 4.59146 7.55742C4.59146 7.33172 4.77427 7.14891 4.99997 7.14891C5.22567 7.14891 5.40848 7.33172 5.40848 7.55742ZM4.99997 2.85956C4.66152 2.85956 4.38721 3.13387 4.38721 3.47232L4.5643 6.12846C4.57962 6.35783 4.77019 6.53615 4.99997 6.53615C5.22976 6.53615 5.42033 6.35783 5.43565 6.12846L5.61274 3.47232C5.61274 3.13387 5.33842 2.85956 4.99997 2.85956Z"
                                                                  fill="#F09965"/>
                                                        </svg>
                                                    </div>

                                                    <div v-if="!props.errors.firstName.required">
                                                        <?php echo esc_html(tdf_string('field_is_required')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="listivo-panel-user-settings__field listivo-field-group">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-last-name"
                            >
                                <?php echo esc_html(tdf_string('last_name')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <div
                                        class="listivo-input-v2"
                                    <?php if (
                                        ($lstCurrentUser->isBusinessAccount() && tdf_settings()->isFullNameRequiredForBusinessAccount())
                                        || ($lstCurrentUser->isPrivateAccount() && tdf_settings()->isFullNameRequiredForPrivateAccount())
                                    ) : ?>
                                        :class="{
                                            'listivo-input-v2--error': props.showErrors && (!props.errors.lastName.required),
                                        }"
                                    <?php endif; ?>
                                >
                                    <input
                                            id="listivo-last-name"
                                            type="text"
                                            :value="props.lastName"
                                            @input="props.setLastName($event.target.value)"
                                    >

                                    <?php if (
                                        ($lstCurrentUser->isBusinessAccount() && tdf_settings()->isFullNameRequiredForBusinessAccount())
                                        || ($lstCurrentUser->isPrivateAccount() && tdf_settings()->isFullNameRequiredForPrivateAccount())
                                    ) : ?>
                                        <template>
                                            <div
                                                    v-if="props.showErrors && (!props.errors.lastName.required)"
                                                    class="listivo-input-v2__error"
                                            >
                                                <div class="listivo-field-error">
                                                    <div class="listivo-field-error__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             width="10" height="9"
                                                             viewBox="0 0 10 9"
                                                             fill="none">
                                                            <path d="M0.105217 7.80234L4.38783 0.354178C4.51386 0.135013 4.74732 0 4.99999 0C5.25265 0 5.48611 0.135013 5.61214 0.354178L9.89475 7.80234C10.0269 8.03213 10.0351 8.31277 9.91661 8.54991L9.9164 8.55032C9.78241 8.8181 9.50871 8.98722 9.20927 8.98722H0.790697C0.491259 8.98722 0.217558 8.8181 0.0837706 8.55032L0.0835662 8.54991C-0.035106 8.31277 -0.0269357 8.03213 0.105217 7.80234Z"
                                                                  fill="#FDFDFE"/>
                                                            <path d="M5.40848 7.55742C5.40848 7.78313 5.22567 7.96593 4.99997 7.96593C4.77427 7.96593 4.59146 7.78313 4.59146 7.55742C4.59146 7.33172 4.77427 7.14891 4.99997 7.14891C5.22567 7.14891 5.40848 7.33172 5.40848 7.55742ZM4.99997 2.85956C4.66152 2.85956 4.38721 3.13387 4.38721 3.47232L4.5643 6.12846C4.57962 6.35783 4.77019 6.53615 4.99997 6.53615C5.22976 6.53615 5.42033 6.35783 5.43565 6.12846L5.61274 3.47232C5.61274 3.13387 5.33842 2.85956 4.99997 2.85956Z"
                                                                  fill="#F09965"/>
                                                        </svg>
                                                    </div>

                                                    <div v-if="!props.errors.lastName.required">
                                                        <?php echo esc_html(tdf_string('field_is_required')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (tdf_settings()->isAccountTypeEnabled() && tdf_settings()->canUserChangeAccountType()) : ?>
                        <div class="listivo-panel-user-settings__field listivo-field-group">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-account-type"
                            >
                                <?php echo esc_html(tdf_string('account_type')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <lst-select
                                        :options="<?php echo htmlspecialchars(json_encode([
                                            [
                                                'name' => tdf_string('private_account_type'),
                                                'value' => 'regular',
                                            ],
                                            [
                                                'name' => tdf_string('business'),
                                                'value' => 'business',
                                            ]
                                        ])); ?>"
                                        @input="props.setAccountType"
                                        active-text-class="listivo-select-v2__option--highlight-text"
                                        highlight-option-class="listivo-select-v2__option--highlight"
                                        :is-selected="props.isAccountType"
                                        order-type="custom"
                                >
                                    <div
                                            slot-scope="select"
                                            @click="select.onOpen"
                                            @focusin="select.focusIn"
                                            @focusout="select.focusOut"
                                            @keyup.esc="select.onClose"
                                            @keyup.up="select.decreaseOptionIndex"
                                            @keyup.down="select.increaseOptionIndex"
                                            @keyup.enter="select.setOptionByIndex"
                                            tabindex="0"
                                            class="listivo-login-form__field listivo-select-v2"
                                            :class="{
                                                                    'listivo-select-v2--open':  select.open,
                                                                }"
                                    >
                                        <div class="listivo-select-v2__arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="7"
                                                 height="5"
                                                 viewBox="0 0 7 5" fill="none">
                                                <path d="M3.5 2.56768L5.87477 0.192917C6.13207 -0.0643854 6.54972 -0.0643854 6.80702 0.192917C7.06433 0.45022 7.06433 0.86787 6.80702 1.12517L3.9394 3.99279C3.6964 4.2358 3.30298 4.2358 3.0606 3.99279L0.192977 1.12517C-0.0643257 0.86787 -0.0643257 0.45022 0.192977 0.192917C0.45028 -0.0643854 0.86793 -0.0643854 1.12523 0.192917L3.5 2.56768Z"
                                                      fill="#2A3946"/>
                                            </svg>
                                        </div>

                                        <template>
                                            <div class="listivo-select-v2__placeholder">
                                                <div v-if="props.accountType === 'regular'">
                                                    <?php echo esc_html(tdf_string('private_account_type')); ?>
                                                </div>

                                                <div v-if="props.accountType === 'business'">
                                                    <?php echo esc_html(tdf_string('business')); ?>
                                                </div>
                                            </div>

                                            <div v-if="select.open"
                                                 class="listivo-select-v2__dropdown">
                                                <div
                                                        v-for="(option, index) in select.options"
                                                        :key="option.id"
                                                        @click="select.setOption(option)"
                                                        class="listivo-select-v2__option"
                                                        :class="{
                                                            'listivo-select-v2__option--active': option.selected,
                                                            'listivo-select-v2__option--highlight': index === select.optionIndex,
                                                            'listivo-select-v2__option--disabled': option.disabled && !option.selected,
                                                        }"
                                                >
                                                    <div class="listivo-select-v2__value"
                                                         v-html="option.label"></div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </lst-select>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($lstCurrentUser->isBusinessAccount() && tdf_settings()->isCompanyInformationEnabled() && tdf_settings()->isAccountTypeEnabled()) : ?>
                        <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field--full-width listivo-field-group">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-company-information"
                            >
                                <?php echo esc_html(tdf_string('company_information')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <div
                                        class="listivo-textarea"
                                    <?php if (tdf_settings()->requireCompanyInformation()) : ?>
                                        :class="{
                                            'listivo-textarea--error': props.showErrors && (!props.errors.companyInformation.required),
                                        }"
                                    <?php endif; ?>
                                >
                                    <textarea
                                            id="listivo-company-information"
                                            :value="props.companyInformation"
                                            @input="props.setCompanyInformation($event.target.value)"
                                    ></textarea>

                                    <?php if (tdf_settings()->requireCompanyInformation()) : ?>
                                        <template>
                                            <div
                                                    class="listivo-textarea__error"
                                                    v-if="props.showErrors && !props.errors.companyInformation.required"
                                            >
                                                <div class="listivo-field-error">
                                                    <div class="listivo-field-error__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             width="10" height="9"
                                                             viewBox="0 0 10 9"
                                                             fill="none">
                                                            <path d="M0.105217 7.80234L4.38783 0.354178C4.51386 0.135013 4.74732 0 4.99999 0C5.25265 0 5.48611 0.135013 5.61214 0.354178L9.89475 7.80234C10.0269 8.03213 10.0351 8.31277 9.91661 8.54991L9.9164 8.55032C9.78241 8.8181 9.50871 8.98722 9.20927 8.98722H0.790697C0.491259 8.98722 0.217558 8.8181 0.0837706 8.55032L0.0835662 8.54991C-0.035106 8.31277 -0.0269357 8.03213 0.105217 7.80234Z"
                                                                  fill="#FDFDFE"/>
                                                            <path d="M5.40848 7.55742C5.40848 7.78313 5.22567 7.96593 4.99997 7.96593C4.77427 7.96593 4.59146 7.78313 4.59146 7.55742C4.59146 7.33172 4.77427 7.14891 4.99997 7.14891C5.22567 7.14891 5.40848 7.33172 5.40848 7.55742ZM4.99997 2.85956C4.66152 2.85956 4.38721 3.13387 4.38721 3.47232L4.5643 6.12846C4.57962 6.35783 4.77019 6.53615 4.99997 6.53615C5.22976 6.53615 5.42033 6.35783 5.43565 6.12846L5.61274 3.47232C5.61274 3.13387 5.33842 2.85956 4.99997 2.85956Z"
                                                                  fill="#F09965"/>
                                                        </svg>
                                                    </div>

                                                    <div v-if="!props.errors.companyInformation.required">
                                                        <?php echo esc_html(tdf_string('field_is_required')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (tdf_settings()->showPhoneInSettings()) : ?>
                        <div class="listivo-panel-user-settings__field listivo-field-group" style="float:left;">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-phone"
                            >
                                <?php echo esc_html(tdf_string('phone_number')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <?php if (tdf_settings()->isPhoneCountryCodeSelectEnabled()) : ?>
                                    <label for="listivo-phone-with-country-code">
                                        <div
                                                class="listivo-phone-with-country-code"
                                        >
                                            <div class="listivo-phone-with-country-code__icon listivo-icon-v2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                     height="16" viewBox="0 0 10 16"
                                                     fill="none">
                                                    <path d="M1.8 0C0.813 0 0 0.813 0 1.8V14.2C0 15.187 0.813 16 1.8 16H7.8C8.787 16 9.6 15.187 9.6 14.2V1.8C9.6 0.813 8.787 0 7.8 0H1.8ZM1.8 1.2H7.8C8.1386 1.2 8.4 1.4614 8.4 1.8V14.2C8.4 14.5386 8.1386 14.8 7.8 14.8H1.8C1.4614 14.8 1.2 14.5386 1.2 14.2V1.8C1.2 1.4614 1.4614 1.2 1.8 1.2ZM4.8 2.4C4.64087 2.4 4.48826 2.46321 4.37574 2.57574C4.26321 2.68826 4.2 2.84087 4.2 3C4.2 3.15913 4.26321 3.31174 4.37574 3.42426C4.48826 3.53679 4.64087 3.6 4.8 3.6C4.95913 3.6 5.11174 3.53679 5.22426 3.42426C5.33679 3.31174 5.4 3.15913 5.4 3C5.4 2.84087 5.33679 2.68826 5.22426 2.57574C5.11174 2.46321 4.95913 2.4 4.8 2.4ZM3.8 12.4C3.72049 12.3989 3.64156 12.4136 3.56777 12.4432C3.49399 12.4729 3.42684 12.5169 3.37022 12.5727C3.3136 12.6285 3.26864 12.6951 3.23795 12.7684C3.20726 12.8418 3.19145 12.9205 3.19145 13C3.19145 13.0795 3.20726 13.1582 3.23795 13.2316C3.26864 13.3049 3.3136 13.3715 3.37022 13.4273C3.42684 13.4831 3.49399 13.5271 3.56777 13.5568C3.64156 13.5864 3.72049 13.6011 3.8 13.6H5.8C5.87951 13.6011 5.95845 13.5864 6.03223 13.5568C6.10601 13.5271 6.17316 13.4831 6.22978 13.4273C6.2864 13.3715 6.33137 13.3049 6.36205 13.2316C6.39274 13.1582 6.40855 13.0795 6.40855 13C6.40855 12.9205 6.39274 12.8418 6.36205 12.7684C6.33137 12.6951 6.2864 12.6285 6.22978 12.5727C6.17316 12.5169 6.10601 12.4729 6.03223 12.4432C5.95845 12.4136 5.87951 12.3989 5.8 12.4H3.8Z"
                                                          fill="#FDFDFE"/>
                                                </svg>
                                            </div>

                                            <select
                                                    @change="props.setPhoneCountryCode($event.target.value)"
                                                    :value="props.phoneCountryCode"
                                            >
                                                <?php foreach (tdf_app('phone_country_codes_with_flags') as $text => $code) : ?>
                                                    <option value="<?php echo esc_attr($text); ?>">
                                                        <?php echo tdf_filter($text); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>

                                            <input
                                                    id="listivo-phone-with-country-code"
                                                    name="phone"
                                                    @input="props.setPhone($event.target.value)"
                                                    :value="props.phone"
                                                    type="tel"
                                                <?php if (tdf_settings()->isPhoneRequired()) : ?>
                                                    placeholder="<?php echo esc_attr(tdf_string('phone')); ?>*"
                                                <?php else : ?>
                                                    placeholder="<?php echo esc_attr(tdf_string('phone')); ?>"
                                                <?php endif; ?>
                                                <?php if (tdf_settings()->isPhoneRequired()) : ?>
                                                    required
                                                <?php endif; ?>
                                            >
                                        </div>
                                    </label>
                                <?php else : ?>
                                    <div class="listivo-input-v2">
                                        <input
                                                id="listivo-phone"
                                                type="tel"
                                                :value="props.phone"
                                                @input="props.setPhone($event.target.value)"
                                            <?php if (tdf_settings()->isPhoneRequired()) : ?>
                                                placeholder="<?php echo esc_attr(tdf_string('enter_your_phone_number')); ?>"
                                                required
                                            <?php else : ?>
                                                placeholder="<?php echo esc_attr(tdf_string('enter_your_phone_number')); ?>"
                                            <?php endif; ?>
                                        >
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="listivo-panel-user-settings__field  listivo-field-group" style="float:left;">
                        <label
                                class="listivo-field-group__label"
                                for="listivo-user-address"
                        >
                            <?php echo esc_html(tdf_string('address')); ?>
                        </label>

                        <div class="listivo-field-group__field">
                            <div class="listivo-input-v2">
                                <input
                                        id="listivo-user-address"
                                        type="text"
                                        @input="props.setAddress($event.target.value)"
                                        :value="props.address"
                                        placeholder="<?php echo esc_attr(tdf_string('enter_your_address')); ?>"
                                >
                            </div>
                        </div>
                    </div>
                     
                    <div class="listivo-panel-user-settings__field listivo-field-group" style="float:left;">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-account-type"
                            >
                                <?php echo esc_html(tdf_string('gender')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <lst-select
                                        :options="<?php echo htmlspecialchars(json_encode([
                                            [
                                                'name' => tdf_string('male'),
                                                'value' => 'male',
                                            ],
                                            [
                                                'name' => tdf_string('female'),
                                                'value' => 'female',
                                            ]
                                        ])); ?>"
                                        @input="props.setGender"
                                        active-text-class="listivo-select-v2__option--highlight-text"
                                        highlight-option-class="listivo-select-v2__option--highlight"
                                        :is-selected="props.iSetGender"
                                        order-type="custom"
                                >
                                    <div
                                            slot-scope="select"
                                            @click="select.onOpen"
                                            @focusin="select.focusIn"
                                            @focusout="select.focusOut"
                                            @keyup.esc="select.onClose"
                                            @keyup.up="select.decreaseOptionIndex"
                                            @keyup.down="select.increaseOptionIndex"
                                            @keyup.enter="select.setOptionByIndex"
                                            tabindex="0"
                                            class="listivo-login-form__field listivo-select-v2"
                                            :class="{
                                                                    'listivo-select-v2--open':  select.open,
                                                                }"
                                    >
                                        <div class="listivo-select-v2__arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="7"
                                                 height="5"
                                                 viewBox="0 0 7 5" fill="none">
                                                <path d="M3.5 2.56768L5.87477 0.192917C6.13207 -0.0643854 6.54972 -0.0643854 6.80702 0.192917C7.06433 0.45022 7.06433 0.86787 6.80702 1.12517L3.9394 3.99279C3.6964 4.2358 3.30298 4.2358 3.0606 3.99279L0.192977 1.12517C-0.0643257 0.86787 -0.0643257 0.45022 0.192977 0.192917C0.45028 -0.0643854 0.86793 -0.0643854 1.12523 0.192917L3.5 2.56768Z"
                                                      fill="#2A3946"/>
                                            </svg>
                                        </div>

                                        <template>
                                            <div class="listivo-select-v2__placeholder">
                                                <div v-if="props.gender === 'male'">
                                                    <?php echo esc_html(tdf_string('male')); ?>
                                                </div>

                                                <div v-else-if="props.gender === 'female'">
                                                    <?php echo esc_html(tdf_string('female')); ?>
                                                </div>
                                                <div v-else>
                                                    <?php echo esc_html(tdf_string('gender')); ?>
                                                </div>
                                            </div>

                                            <div v-if="select.open"
                                                 class="listivo-select-v2__dropdown">
                                                <div
                                                        v-for="(option, index) in select.options"
                                                        :key="option.id"
                                                        @click="select.setOption(option)"
                                                        class="listivo-select-v2__option"
                                                        :class="{
                                                            'listivo-select-v2__option--active': option.selected,
                                                            'listivo-select-v2__option--highlight': index === select.optionIndex,
                                                            'listivo-select-v2__option--disabled': option.disabled && !option.selected,
                                                        }"
                                                >
                                                    <div class="listivo-select-v2__value"
                                                         v-html="option.label"></div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </lst-select>
                            </div>
                        </div>
                        <!-- <div class="listivo-panel-user-settings__field  listivo-field-group"> -->
                    <?php // if(!$showEmployerSettings): ?>
                        <div class="listivo-panel-user-settings__field listivo-field-group" style="float:left;">
                            <label
                                class="listivo-field-group__label"
                                for="listivo-location"
                            >
                                <?php echo esc_html(tdf_string('select_location')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <lst-select
                                    :options="<?php echo $locationOptionsJson; ?>"
                                    @input="props.setLocationSelected"
                                    active-text-class="listivo-select-v2__option--highlight-text"
                                    highlight-option-class="listivo-select-v2__option--highlight"
                                    :is-selected="props.isLocationSelected"
                                    order-type="custom"
                                >
                                    <div
                                        slot-scope="select"
                                        @click="select.onOpen"
                                        @focusin="select.focusIn"
                                        @focusout="select.focusOut"
                                        @keyup.esc="select.onClose"
                                        @keyup.up="select.decreaseOptionIndex"
                                        @keyup.down="select.increaseOptionIndex"
                                        @keyup.enter="select.setOptionByIndex"
                                        tabindex="0"
                                        class="listivo-login-form__field listivo-select-v2"
                                        :class="{
                                            'listivo-select-v2--open': select.open,
                                        }"
                                    >
                                        <div class="listivo-select-v2__arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="5" viewBox="0 0 7 5" fill="none">
                                                <path d="M3.5 2.56768L5.87477 0.192917C6.13207 -0.0643854 6.54972 -0.0643854 6.80702 0.192917C7.06433 0.45022 7.06433 0.86787 6.80702 1.12517L3.9394 3.99279C3.6964 4.2358 3.30298 4.2358 3.0606 3.99279L0.192977 1.12517C-0.0643257 0.86787 -0.0643257 0.45022 0.192977 0.192917C0.45028 -0.0643854 0.86793 -0.0643854 1.12523 0.192917L3.5 2.56768Z" fill="#2A3946"/>
                                            </svg>
                                        </div>

                                        <template>
                                            <div class="listivo-select-v2__placeholder">
                                                <div v-if="!props.locationSelected">
                                                    <?php echo esc_html(tdf_string('select_location_placeholder')); ?>
                                                </div>
                                                <div v-if="props.locationSelected">
                                                    {{ props.locationSelected }}
                                                </div>
                                            </div>

                                            <div v-if="select.open" class="listivo-select-v2__dropdown">
                                                <div
                                                    v-for="(option, index) in select.options"
                                                    :key="option.value"
                                                    @click="select.setOption(option)"
                                                    class="listivo-select-v2__option"
                                                    :class="{
                                                        'listivo-select-v2__option--active': option.selected,
                                                        'listivo-select-v2__option--highlight': index === select.optionIndex,
                                                        'listivo-select-v2__option--disabled': option.disabled && !option.selected,
                                                    }"
                                                >
                                                    <div class="listivo-select-v2__value" v-html="option.label"></div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </lst-select>
                            </div>
                        </div>
                    <?php //  endif; ?>

                        

                        
                    
                    


                    <?php if (tdf_settings()->isWebsiteFieldEnabled()) : ?>
                        <div class="listivo-panel-user-settings__field listivo-field-group">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-website"
                            >
                                <?php echo esc_html(tdf_string('website')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <div class="listivo-input-v2">
                                    <input
                                            id="listivo-website"
                                            type="text"
                                            :value="props.website"
                                            @input="props.setWebsite($event.target.value)"
                                            placeholder="<?php echo esc_attr(tdf_string('enter_your_website')); ?>"
                                    >
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php if(!$showEmployerSettings):  ?>    
                    <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field--full-width listivo-field-group">
                        <label
                                class="listivo-field-group__label"
                                for="listivo-description"
                        >
                            <?php echo esc_html(tdf_string('profile_description')); ?>
                        </label>

                        <div class="listivo-field-group__field">
                            <div class="listivo-textarea">
                                <textarea
                                        id="listivo-description"
                                        :value="props.description"
                                        @input="props.setDescription($event.target.value)"
                                        placeholder="<?php echo esc_attr(tdf_string('write_something_about_yourself')); ?>"
                                ></textarea>
                            </div>
                        </div>
                    </div>
               
                    
                    <?php  if($showAgencySettings): ?>
                        <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field--full-width listivo-field-group">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-description"
                            >
                                <?php echo esc_html(tdf_string('team_info')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <div class="listivo-textarea">
                                    <textarea
                                            id="listivo-team_info"
                                            :value="props.team_info"
                                            @input="props.setTeamInfo($event.target.value)"
                                            placeholder="<?php echo esc_attr(tdf_string('write_something_about_team')); ?>"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                  
                    <?php if (tdf_settings()->isMarketingConsentsEnabled()) : ?>
                            <div class="listivo-field-group listivo-field-group--checkbox listivo-margin-top-7">
                                <div class="listivo-field-group__field">
                                    <div
                                            class="listivo-checkbox"
                                            :class="{'listivo-checkbox--checked': props.marketingConsent}"
                                            @click.prevent="props.setMarketingConsent"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                             height="11"
                                             viewBox="0 0 12 11"
                                             fill="none">
                                            <path d="M11.7142 0.779513L10.6378 0.103783C10.3399 -0.0824758 9.93186 -0.011004 9.73252 0.261887L4.45585 7.44801L2.03093 5.20858C1.77765 4.97467 1.3649 4.97467 1.11162 5.20858L0.18996 6.05974C-0.06332 6.29364 -0.06332 6.67482 0.18996 6.9109L3.91881 10.3545C4.12753 10.5473 4.45585 10.6945 4.75135 10.6945C5.04684 10.6945 5.34468 10.5235 5.53698 10.2657L11.8877 1.61335C12.0894 1.34046 12.012 0.965772 11.7142 0.779513Z"
                                                  fill="#FDFDFE"/>
                                        </svg>
                                    </div>
                                </div>

                                <div
                                        class="listivo-field-group__label"
                                        @click.prevent="props.setMarketingConsent"
                                >
                                    <?php echo wp_kses_post(tdf_settings()->getMarketingConsentsLabel()); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <!-- </div> -->
                    
                        <?php if (!tdf_settings()->disableWhatsApp()) : ?>
                            <div class="listivo-field-group listivo-field-group--checkbox listivo-margin-top-7">
                                <div class="listivo-field-group__field">
                                    <div
                                            class="listivo-checkbox"
                                            :class="{'listivo-checkbox--checked': props.whatsApp}"
                                            @click.prevent="props.setWhatsApp"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                             height="11"
                                             viewBox="0 0 12 11"
                                             fill="none">
                                            <path d="M11.7142 0.779513L10.6378 0.103783C10.3399 -0.0824758 9.93186 -0.011004 9.73252 0.261887L4.45585 7.44801L2.03093 5.20858C1.77765 4.97467 1.3649 4.97467 1.11162 5.20858L0.18996 6.05974C-0.06332 6.29364 -0.06332 6.67482 0.18996 6.9109L3.91881 10.3545C4.12753 10.5473 4.45585 10.6945 4.75135 10.6945C5.04684 10.6945 5.34468 10.5235 5.53698 10.2657L11.8877 1.61335C12.0894 1.34046 12.012 0.965772 11.7142 0.779513Z"
                                                  fill="#FDFDFE"/>
                                        </svg>
                                    </div>
                                </div>

                                <div
                                        class="listivo-field-group__label"
                                        @click.prevent="props.setWhatsApp"
                                >
                                    <?php echo esc_html(tdf_string('enable_whats_app')); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                
                        <?php if (!tdf_settings()->disableViber()) : ?>
                            <div class="listivo-field-group listivo-field-group--checkbox listivo-margin-top-7">
                                <div class="listivo-field-group__field">
                                    <div
                                            class="listivo-checkbox"
                                            :class="{'listivo-checkbox--checked': props.viber}"
                                            @click.prevent="props.setViber"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                             height="11"
                                             viewBox="0 0 12 11"
                                             fill="none">
                                            <path d="M11.7142 0.779513L10.6378 0.103783C10.3399 -0.0824758 9.93186 -0.011004 9.73252 0.261887L4.45585 7.44801L2.03093 5.20858C1.77765 4.97467 1.3649 4.97467 1.11162 5.20858L0.18996 6.05974C-0.06332 6.29364 -0.06332 6.67482 0.18996 6.9109L3.91881 10.3545C4.12753 10.5473 4.45585 10.6945 4.75135 10.6945C5.04684 10.6945 5.34468 10.5235 5.53698 10.2657L11.8877 1.61335C12.0894 1.34046 12.012 0.965772 11.7142 0.779513Z"
                                                  fill="#FDFDFE"/>
                                        </svg>
                                    </div>
                                </div>

                                <div
                                        class="listivo-field-group__label"
                                        @click.prevent="props.setViber"
                                >
                                    <?php echo esc_html(tdf_string('enable_viber')); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group" style="float:left;">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-tagline"
                            >
                                <?php echo esc_html(tdf_string('tag_line')); ?>
                            </label>

                            <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field--full-width listivo-field-group">
                                <div
                                        class="listivo-input-v2"
                                        
                                >
                                    <input
                                            id="listivo-tagline"
                                            type="text"
                                            :value="props.tagline"
                                            @input="props.setTagline($event.target.value)"
                                            placeholder="<?php echo esc_attr(tdf_string('tag_line')); ?>"
                                    >
                                </div>
                            </div>
                        </div>
                        

                        
                        <?php  if($showAgencySettings): ?>
                            <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group" style="float:left;">
                                <label
                                    style="margin-left:40px;"
                                        class="listivo-field-group__label"
                                        for="listivo-tagline"
                                >
                                    <?php echo esc_html(tdf_string('joined_since')); ?>
                                </label>


                                <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group">
                                    <div class="listivo-input-v2">
                                        <input
                                                style="margin-left:40px"
                                                id="listivo-joined_since"
                                                inputmode="numeric" oninput="this.value = this.value.replace(/\D+/g, '')"
                                                type="text"
                                                :value="props.joined_since"
                                                @input="props.setJoinedSince"
                                                placeholder="<?php echo esc_attr(tdf_string('joined_since')); ?>"
                                        >
                                    </div>
                                </div>
                            </div>
                            
                            <div style="float:right;margin-top:0px;" class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group">
                                <label
                                        style="padding-left:4%"
                                        class="listivo-field-group__label"
                                        for="listivo-tagline"
                                >
                                    <?php echo esc_html(tdf_string('agency_founded')); ?>
                                </label>


                                <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group">
                                    <div class="listivo-input-v2">
                                        <input
                                                id="listivo-agency_founded"
                                                inputmode="numeric" oninput="this.value = this.value.replace(/\D+/g, '')"
                                                type="text"
                                                :value="props.agency_founded"
                                                @input="props.setAgencyFounded"
                                                placeholder="<?php echo esc_attr(tdf_string('agency_founded')); ?>"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group">
                                <label
                                        class="listivo-field-group__label"
                                        for="listivo-tagline"
                                >
                                    <?php echo esc_html(tdf_string('total_jobs_delivered')); ?>
                                </label>


                                <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group">
                                    <div class="listivo-input-v2">
                                        <input
                                                id="listivo-total_jobs_delivered"
                                                type="text"
                                                inputmode="numeric" oninput="this.value = this.value.replace(/\D+/g, '')"
                                                :value="props.total_jobs_delivered"
                                                @input="props.setTotalJobsDelivered"
                                                placeholder="<?php echo esc_attr(tdf_string('total_jobs_delivered')); ?>"
                                        >
                                    </div>
                                </div>
                            </div>

                            

                            

                            

                        <?php endif; ?>
                       
                        
                        <?php  if($showAgencySettings): ?>
                            <div class="listivo-panel-user-settings__field listivo-field-group" style="float:right;margin-top:3%">
                                        <label
                                                class="listivo-field-group__label"
                                                for="listivo-account-type"
                                        >
                                            <?php echo esc_html(tdf_string('budget')); ?>
                                            
                                        </label>
                                        <div class="listivo-field-group__field" style="margin-top: 6%;">
                                            <lst-select
                                                    :options="<?php echo htmlspecialchars(json_encode([
                                                        [
                                                            'name' => tdf_string('500_hundard'),
                                                            'value' => '$500',
                                                        ],
                                                        [
                                                            'name' => tdf_string('5_thousand'),
                                                            'value' => '$5000',
                                                        ],
                                                        [
                                                            'name' => tdf_string('10_thousand'),
                                                            'value' => '$10000',
                                                        ],
                                                        [
                                                            'name' => tdf_string('25_thousand'),
                                                            'value' => '$25000',
                                                        ],
                                                        [
                                                            'name' => tdf_string('50_thousand'),
                                                            'value' => '$50000',
                                                        ],
                                                        [
                                                            'name' => tdf_string('1_lakh'),
                                                            'value' => '$100000',
                                                        ]
                                                    ])); ?>"
                                                    @input="props.setBudget"
                                                    active-text-class="listivo-select-v2__option--highlight-text"
                                                    highlight-option-class="listivo-select-v2__option--highlight"
                                                    :is-selected="props.isBudgetSet"
                                                    order-type="custom"
                                            >
                                                <div
                                                        slot-scope="select"
                                                        @click="select.onOpen"
                                                        @focusin="select.focusIn"
                                                        @focusout="select.focusOut"
                                                        @keyup.esc="select.onClose"
                                                        @keyup.up="select.decreaseOptionIndex"
                                                        @keyup.down="select.increaseOptionIndex"
                                                        @keyup.enter="select.setOptionByIndex"
                                                        tabindex="0"
                                                        class="listivo-login-form__field listivo-select-v2"
                                                        :class="{
                                                                                'listivo-select-v2--open':  select.open,
                                                                            }"
                                                >
                                                    <div class="listivo-select-v2__arrow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="7"
                                                            height="5"
                                                            viewBox="0 0 7 5" fill="none">
                                                            <path d="M3.5 2.56768L5.87477 0.192917C6.13207 -0.0643854 6.54972 -0.0643854 6.80702 0.192917C7.06433 0.45022 7.06433 0.86787 6.80702 1.12517L3.9394 3.99279C3.6964 4.2358 3.30298 4.2358 3.0606 3.99279L0.192977 1.12517C-0.0643257 0.86787 -0.0643257 0.45022 0.192977 0.192917C0.45028 -0.0643854 0.86793 -0.0643854 1.12523 0.192917L3.5 2.56768Z"
                                                                fill="#2A3946"/>
                                                        </svg>
                                                    </div>

                                                    <template>
                                                        <div class="listivo-select-v2__placeholder">
                                                            <div v-if="props.budget === '$500'">
                                                                <?php echo esc_html(tdf_string('500_hundard')); ?>
                                                            </div>

                                                            <div v-else-if="props.budget === '$5000'">
                                                                <?php echo esc_html(tdf_string('5_thousand')); ?>
                                                            </div>

                                                            <div v-else-if="props.budget === '$10000'">
                                                                <?php echo esc_html(tdf_string('10_thousand')); ?>
                                                            </div>

                                                            <div v-else-if="props.budget === '$25000'">
                                                                <?php echo esc_html(tdf_string('25_thousand')); ?>
                                                            </div>

                                                            <div v-else-if="props.budget === '$50000'">
                                                                <?php echo esc_html(tdf_string('50_thousand')); ?>
                                                            </div>

                                                            <div v-else-if="props.budget === '$100000'">
                                                                <?php echo esc_html(tdf_string('1_lakh')); ?>
                                                            </div>
                                                            <div v-else>
                                                                <?php echo esc_html(tdf_string('budget')); ?>
                                                            </div>
                                                        </div>

                                                        <div v-if="select.open"
                                                            class="listivo-select-v2__dropdown">
                                                            <div
                                                                    v-for="(option, index) in select.options"
                                                                    :key="option.id"
                                                                    @click="select.setOption(option)"
                                                                    class="listivo-select-v2__option"
                                                                    :class="{
                                                                        'listivo-select-v2__option--active': option.selected,
                                                                        'listivo-select-v2__option--highlight': index === select.optionIndex,
                                                                        'listivo-select-v2__option--disabled': option.disabled && !option.selected,
                                                                    }"
                                                            >
                                                                <div class="listivo-select-v2__value"
                                                                    v-html="option.label"></div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </lst-select>
                                        </div>
                            </div>
                        <?php endif; ?>
                     
                        <?php if(!$showEmployerSettings): ?>
                            <?php if($showInterneSettings): ?>
                            <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group" style="float:right;">
                            <?php else: ?> 
                                <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group">

                            <?php endif; ?>
                            <label
                                        class="listivo-field-group__label"
                                        for="listivo-tagline"
                                        style="padding-left:4%"
                                >
                                    <?php echo esc_html(tdf_string('hourly_rate')); ?>
                                </label>


                                <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field listivo-field-group">
                                    <div class="listivo-input-v2" style="padding-left:2%;">
                                        <input
                                                id="listivo-rate"
                                                inputmode="numeric" oninput="this.value = this.value.replace(/\D+/g, '')"
                                                type="text"
                                                :value="props.hourly_rate"
                                                @input="props.setHourlyRate"
                                                placeholder="<?php echo esc_attr(tdf_string('hourly_rate')); ?>"
                                        >
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>    
                        <?php  if($showAgencySettings): ?>
                            <div class="listivo-panel-user-settings__field listivo-field-group ">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-account-type"
                            >
                                <?php echo esc_html(tdf_string('client_focus')); ?>
                            </label>
                            <div class="listivo-field-group__field">
                                <input type="checkbox" id="startup" @change="props.clientFocus" :value="'startup'"  v-model="props.selectedClientFocus" /> 
                                <label for="startup"><?php echo esc_html(tdf_string('startup')); ?> </label>
                                <input type="checkbox" id="small_and_mid_enterprises" @change="props.clientFocus"  v-model="props.selectedClientFocus" :value="'small_and_mid_enterprises'" /> 
                                <label for="small_and_mid_enterprises"> <?php echo esc_html(tdf_string('small_and_mid_enterprises')); ?> </label>
                                <input type="checkbox" id="large_enterprises" @change="props.clientFocus"  v-model="props.selectedClientFocus" :value="'large_enterprises'" /> 
                                <label for="large_enterprises"> <?php echo esc_html(tdf_string('large_enterprises')); ?> </label>
                            </div>

                            </div>
                        <?php endif; ?>
                        <?php if(!$showEmployerSettings): ?>
                            <?php if ($showAgencySettings): ?>
                                <div class="listivo-panel-user-settings__field listivo-field-group" style="float: right; margin-top: -7%;">
                            <?php else: ?>
                                <div class="listivo-panel-user-settings__field listivo-field-group" style="float: right;">
                            <?php endif; ?>
                            <label
                                        class="listivo-field-group__label"
                                        for="listivo-account-type"
                                >
                                    <?php echo esc_html(tdf_string('job_type')); ?>
                                </label>
                                <div class="listivo-field-group__field" style="padding-top:15px;">
                                    <input type="checkbox" id="remote" @change="props.handleJobChange" :value="'Remote'"  v-model="props.selectedJobTypes" /> 
                                    <label for="remote"> <?php echo  esc_html(tdf_string('remote')) ?> </label>
                                    <input type="checkbox" id="onsite" @change="props.handleJobChange" :value="'On Site'"  v-model="props.selectedJobTypes" /> 
                                    <label for="onsite"> <?php echo  esc_html(tdf_string('onsite')) ?> </label>
                                    <input type="checkbox" id="hybrid" @change="props.handleJobChange"  :value="'Hybrid'"  v-model="props.selectedJobTypes" /> 
                                    <label for="hybrid"> <?php echo  esc_html(tdf_string('hybrid')) ?> </label>
                                </div>
                            </div>
                        <?php endif; ?>


                       
                        
                      

                        <?php if(!$showInterneSettings && !$showFreelancerSettings): ?>
                            
                            <?php if ($showAgencySettings): ?>
                                <div class="listivo-panel-user-settings__field listivo-field-group" style="margin-left: auto; margin-right: 0;">
                                <?php else: ?>
                                <div class="listivo-panel-user-settings__field listivo-field-group" style="float: left;padding-top: 20px;margin-left: 35px;">
                                <?php endif; ?>

                                
                            <label
                                        class="listivo-field-group__label"
                                        for="listivo-account-type"
                                >
                                    <?php echo esc_html(tdf_string('company_details')); ?>
                                    
                                </label>
                                <div class="listivo-field-group__field">
                                    <lst-select
                                            :options="<?php echo htmlspecialchars(json_encode([
                                                [
                                                    'name' => tdf_string('its_just_me'),
                                                    'value' => 'Its Just Me',
                                                ],
                                                [
                                                    'name' => tdf_string('2_to_9_employees'),
                                                    'value' => '2 - 9 Employees',
                                                ],
                                                [
                                                    'name' => tdf_string('10_to_99_employees'),
                                                    'value' => '10 - 99 Employees',
                                                ],
                                                [
                                                    'name' => tdf_string('100_to_499_employees'),
                                                    'value' => '100 - 499 Employees',
                                                ],
                                                [
                                                    'name' => tdf_string('500_to_1000_employess'),
                                                    'value' => '500 - 1000 Employees',
                                                ],
                                                [
                                                    'name' => tdf_string('more_than_1000_employees'),
                                                    'value' => 'More Than 1000 Employees',
                                                ]
                                            ])); ?>"
                                            @input="props.setCompanyDetails"
                                            active-text-class="listivo-select-v2__option--highlight-text"
                                            highlight-option-class="listivo-select-v2__option--highlight"
                                            :is-selected="props.isCompanyDetailSet"
                                            order-type="custom"
                                    >
                                        <div
                                                slot-scope="select"
                                                @click="select.onOpen"
                                                @focusin="select.focusIn"
                                                @focusout="select.focusOut"
                                                @keyup.esc="select.onClose"
                                                @keyup.up="select.decreaseOptionIndex"
                                                @keyup.down="select.increaseOptionIndex"
                                                @keyup.enter="select.setOptionByIndex"
                                                tabindex="0"
                                                class="listivo-login-form__field listivo-select-v2"
                                                :class="{
                                                                        'listivo-select-v2--open':  select.open,
                                                                    }"
                                        >
                                            <div class="listivo-select-v2__arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="7"
                                                    height="5"
                                                    viewBox="0 0 7 5" fill="none">
                                                    <path d="M3.5 2.56768L5.87477 0.192917C6.13207 -0.0643854 6.54972 -0.0643854 6.80702 0.192917C7.06433 0.45022 7.06433 0.86787 6.80702 1.12517L3.9394 3.99279C3.6964 4.2358 3.30298 4.2358 3.0606 3.99279L0.192977 1.12517C-0.0643257 0.86787 -0.0643257 0.45022 0.192977 0.192917C0.45028 -0.0643854 0.86793 -0.0643854 1.12523 0.192917L3.5 2.56768Z"
                                                        fill="#2A3946"/>
                                                </svg>
                                            </div>

                                            <template>
                                                <div class="listivo-select-v2__placeholder">
                                                    <div v-if="props.company_details === 'Its Just Me'">
                                                        <?php echo esc_html(tdf_string('its_just_me')); ?>
                                                    </div>

                                                    <div v-else-if="props.company_details === '2 - 9 Employees'">
                                                        <?php echo esc_html(tdf_string('2_to_9_employees')); ?>
                                                    </div>

                                                    <div v-else-if="props.company_details === '10 - 99 Employees'">
                                                        <?php echo esc_html(tdf_string('10_to_99_employees')); ?>
                                                    </div>

                                                    <div v-else-if="props.company_details === '100 - 499 Employees'">
                                                        <?php echo esc_html(tdf_string('100_to_499_employees')); ?>
                                                    </div>

                                                    <div v-else-if="props.company_details === '500 - 1000 Employees'">
                                                        <?php echo esc_html(tdf_string('500_to_1000_employess')); ?>
                                                    </div>

                                                    <div v-else-if="props.company_details === 'More Than 1000 Employees'">
                                                        <?php echo esc_html(tdf_string('more_than_1000_employees')); ?>
                                                    </div>
                                                    <div v-else>
                                                        <?php echo esc_html(tdf_string('no_of_employee')); ?>
                                                    </div>
                                                </div>

                                                <div v-if="select.open"
                                                    class="listivo-select-v2__dropdown">
                                                    <div
                                                            v-for="(option, index) in select.options"
                                                            :key="option.id"
                                                            @click="select.setOption(option)"
                                                            class="listivo-select-v2__option"
                                                            :class="{
                                                                'listivo-select-v2__option--active': option.selected,
                                                                'listivo-select-v2__option--highlight': index === select.optionIndex,
                                                                'listivo-select-v2__option--disabled': option.disabled && !option.selected,
                                                            }"
                                                    >
                                                        <div class="listivo-select-v2__value"
                                                            v-html="option.label"></div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </lst-select>
                                </div>
                            </div>
                        <?php endif; ?>

                        
                        <?php if($showEmployerSettings): ?>
                            <div class="listivo-panel-user-settings__field listivo-field-group" style="float:right;margin-top:0px">
                                <label
                                        class="listivo-field-group__label"
                                        for="listivo-account-type"
                                >
                                    <?php echo esc_html(tdf_string('your_department')); ?>
                                    
                                </label>
                                <div class="listivo-field-group__field">
                                    <lst-select
                                            :options="<?php echo htmlspecialchars(json_encode([
                                                [
                                                    'name' => tdf_string('accounting_finance'),
                                                    'value' => 'Accounting and Finance',
                                                ],
                                                [
                                                    'name' => tdf_string('customer_service_or_operations'),
                                                    'value' => 'Customer Service or Operations',
                                                ],
                                                [
                                                    'name' => tdf_string('engineering_or_product_management'),
                                                    'value' => 'Engineering or Product Management',
                                                ],
                                                [
                                                    'name' => tdf_string('human_resource_management'),
                                                    'value' => 'Human Resource Management',
                                                ],
                                                [
                                                    'name' => tdf_string('marketing'),
                                                    'value' => 'Marketing',
                                                ],
                                                [
                                                    'name' => tdf_string('production'),
                                                    'value' => 'Production',
                                                ],
                                                [
                                                    'name' => tdf_string('purchasing'),
                                                    'value' => 'Purchasing',
                                                ],
                                                [
                                                    'name' => tdf_string('research_and_development'),
                                                    'value' => 'Research And Development',
                                                ],
                                                [
                                                    'name' => tdf_string('sales'),
                                                    'value' => 'Sales',
                                                ]
                                            ])); ?>"
                                            @input="props.setDepartmentDetails"
                                            active-text-class="listivo-select-v2__option--highlight-text"
                                            highlight-option-class="listivo-select-v2__option--highlight"
                                            :is-selected="props.isDepartmentSet"
                                            order-type="custom"
                                    >
                                        <div
                                                slot-scope="select"
                                                @click="select.onOpen"
                                                @focusin="select.focusIn"
                                                @focusout="select.focusOut"
                                                @keyup.esc="select.onClose"
                                                @keyup.up="select.decreaseOptionIndex"
                                                @keyup.down="select.increaseOptionIndex"
                                                @keyup.enter="select.setOptionByIndex"
                                                tabindex="0"
                                                class="listivo-login-form__field listivo-select-v2"
                                                :class="{
                                                                        'listivo-select-v2--open':  select.open,
                                                                    }"
                                        >
                                            <div class="listivo-select-v2__arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="7"
                                                    height="5"
                                                    viewBox="0 0 7 5" fill="none">
                                                    <path d="M3.5 2.56768L5.87477 0.192917C6.13207 -0.0643854 6.54972 -0.0643854 6.80702 0.192917C7.06433 0.45022 7.06433 0.86787 6.80702 1.12517L3.9394 3.99279C3.6964 4.2358 3.30298 4.2358 3.0606 3.99279L0.192977 1.12517C-0.0643257 0.86787 -0.0643257 0.45022 0.192977 0.192917C0.45028 -0.0643854 0.86793 -0.0643854 1.12523 0.192917L3.5 2.56768Z"
                                                        fill="#2A3946"/>
                                                </svg>
                                            </div>

                                            <template>
                                                <div class="listivo-select-v2__placeholder">
                                                    <div v-if="props.department_details === 'Accounting and Finance'">
                                                        <?php echo esc_html(tdf_string('accounting_finance')); ?>
                                                    </div>

                                                    <div v-else-if="props.department_details === 'Customer Service or Operations'">
                                                        <?php echo esc_html(tdf_string('customer_service_or_operations')); ?>
                                                    </div>

                                                    <div v-else-if="props.department_details === 'Engineering or Product Management'">
                                                        <?php echo esc_html(tdf_string('engineering_or_product_management')); ?>
                                                    </div>

                                                    <div v-else-if="props.department_details === 'Human Resource Management'">
                                                        <?php echo esc_html(tdf_string('human_resource_management')); ?>
                                                    </div>

                                                    <div v-else-if="props.department_details === 'Marketing'">
                                                        <?php echo esc_html(tdf_string('marketing')); ?>
                                                    </div>

                                                    <div v-else-if="props.department_details === 'Production'">
                                                        <?php echo esc_html(tdf_string('production')); ?>
                                                    </div>
                                                    <div v-else-if="props.department_details === 'Purchasing'">
                                                        <?php echo esc_html(tdf_string('purchasing')); ?>
                                                    </div>
                                                    <div v-else-if="props.department_details === 'Research And Development'">
                                                        <?php echo esc_html(tdf_string('research_and_development')); ?>
                                                    </div>
                                                    <div v-else-if="props.department_details === 'Sales'">
                                                        <?php echo esc_html(tdf_string('sales')); ?>
                                                    </div>
                                                    <div v-else>
                                                        <?php echo esc_html(tdf_string('your_department')); ?>
                                                    </div>
                                                </div>

                                                <div v-if="select.open"
                                                    class="listivo-select-v2__dropdown">
                                                    <div
                                                            v-for="(option, index) in select.options"
                                                            :key="option.id"
                                                            @click="select.setOption(option)"
                                                            class="listivo-select-v2__option"
                                                            :class="{
                                                                'listivo-select-v2__option--active': option.selected,
                                                                'listivo-select-v2__option--highlight': index === select.optionIndex,
                                                                'listivo-select-v2__option--disabled': option.disabled && !option.selected,
                                                            }"
                                                    >
                                                        <div class="listivo-select-v2__value"
                                                            v-html="option.label"></div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </lst-select>
                                </div>
                            </div>

                        <?php  endif; ?>
                 
                        <?php if ($showAgencySettings): ?>
                            <div class="listivo-panel-user-settings__field listivo-field-group" style="margin-top: -98px;">
                                <?php else: ?>
                            <div class="listivo-panel-user-settings__field listivo-field-group">
                                <?php endif; ?>

                       
                            <label class="listivo-field-group__label" for="listivo-skill">
                                <?php echo esc_html(tdf_string('select_skill')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <!-- Skill Selection -->
                                <lst-select
                                    :options="<?php echo $skillOptionsJson; ?>"
                                    @input="props.setHandleSkillSelected"
                                    active-text-class="listivo-select-v2__option--highlight-text"
                                    highlight-option-class="listivo-select-v2__option--highlight"
                                    order-type="custom"
                                    :is-selected="props.isHandledSkillSelected"
                                >
                                    <div slot-scope="select">
                                        <div
                                            @click="select.onOpen"
                                            @focusin="select.focusIn"
                                            @focusout="select.focusOut"
                                            @keyup.esc="select.onClose"
                                            @keyup.up="select.decreaseOptionIndex"
                                            @keyup.down="select.increaseOptionIndex"
                                            @keyup.enter="select.setOptionByIndex"
                                            tabindex="0"
                                            class="listivo-login-form__field listivo-select-v2"
                                            :class="{ 'listivo-select-v2--open': select.open }"
                                        >
                                            <div class="listivo-select-v2__arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="5" viewBox="0 0 7 5" fill="none">
                                                    <path d="M3.5 2.56768L5.87477 0.192917C6.13207 -0.0643854 6.54972 -0.0643854 6.80702 0.192917C7.06433 0.45022 7.06433 0.86787 6.80702 1.12517L3.9394 3.99279C3.6964 4.2358 3.30298 4.2358 3.0606 3.99279L0.192977 1.12517C-0.0643257 0.86787 -0.0643257 0.45022 0.192977 0.192917C0.45028 -0.0643854 0.86793 -0.0643854 1.12523 0.192917L3.5 2.56768Z" fill="#2A3946"/>
                                                </svg>
                                            </div>

                                            <template>
                                                <div class="listivo-select-v2__placeholder">
                                                    <div v-if="!props.handleSkillSelected">
                                                        <?php  echo esc_html(tdf_string('select_skill_placeholder')); ?>
                                                    </div>
                                                    <div v-if="props.handleSkillSelected">
                                                        {{ props.handleSkillSelected }}
                                                    </div>
                                                </div>

                                                <div v-if="select.open" class="listivo-select-v2__dropdown">
                                                    <div
                                                        v-for="(option, index) in select.options"
                                                        :key="option.value"
                                                        @click="select.setOption(option)"
                                                        class="listivo-select-v2__option"
                                                        :class="{
                                                            'listivo-select-v2__option--active': option.selected,
                                                            'listivo-select-v2__option--highlight': index === select.optionIndex,
                                                            'listivo-select-v2__option--disabled': option.disabled && !option.selected,
                                                        }"
                                                    >
                                                        <div class="listivo-select-v2__value" v-html="option.label"></div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </lst-select>

                                <!-- Skill Rating -->
                                <!-- <input
                                    type="number"
                                    class="form-control"
                                    placeholder="Rate your skill (0% to 100%)"
                                /> -->

                                <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field--full-width listivo-field-group">
                                    <div class="listivo-input-v2">
                                        <input
                                                id="listivo-rate"
                                                type="number"
                                                :value="props.skill_rate"
                                                @input="props.setSkillRate($event.target.value)"
                                                placeholder="<?php echo esc_attr(tdf_string('skill_rate')); ?>"
                                        >
                                    </div>
                                </div>

                                <!-- Add Skill Button -->
                                <a href="javascript:;" style="margin-top:10px; left:100%; margin-left:8%;"  @click.prevent="props.addSkill"  class="listivo-button listivo-button--primary-1 listivo-button-primary-1-colors-with-stroke-selector">
                                    <?php echo esc_html(tdf_string('add_skill')); ?>
                                </a>
                            </div>
                            <div v-if="props.selectedSkills.length > 0" class="listivo-panel-user-settings__skills-list" style="padding: 10px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                                <ul style="list-style-type: none; padding: 0; margin: 0;">
                                    <li v-for="(skill, index) in props.selectedSkills" :key="index" style="display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid #ddd;">
                                        <span style="font-size: 16px; color: #333;">{{ skill.label }} - {{ skill.rating }}%</span>
                                        <i class="fa fa-trash" @click.prevent="props.removeSkill(index)" aria-hidden="true" style="font-size: 16px; color: #ff4d4d; cursor: pointer;"></i>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    <?php endif; ?>
                        
                
                        

                    


                </div>


                


                <div class="listivo-panel-accordion__bottom" style="width:100%">
                    <button
                            class="listivo-button listivo-button--primary-1 listivo-button-primary-1-colors-with-stroke-selector"
                            :class="{'listivo-button--loading': props.inProgress}"
                    >
                        <span>
                            <?php echo esc_html(tdf_string('save_changes')); ?>

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="10"
                                 viewBox="0 0 14 10" fill="none">
                                <rect x="12.2676" y="0.646447" width="1.53602" height="11.5509"
                                      rx="0.768011" transform="rotate(45 12.2676 0.646447)"
                                      fill="#FDFDFE" stroke="#FDFDFE" stroke-width="0.5"/>
                                <path d="M1.19345 4.98425C0.891119 5.28658 0.897654 5.77873 1.20791 6.07292L4.70642 9.39036C4.94829 9.61971 5.32032 9.64118 5.58696 9.44116C5.91859 9.1924 5.95423 8.70807 5.66258 8.41344L2.27076 4.98699C1.97447 4.68767 1.49125 4.68644 1.19345 4.98425Z"
                                      fill="#FDFDFE" stroke="#FDFDFE" stroke-width="0.5"/>
                            </svg>
                        </span>

                        <template>
                            <svg
                                    width='40'
                                    height='10'
                                    viewBox='0 0 120 30'
                                    xmlns='http://www.w3.org/2000/svg'
                                    fill='#fff'
                                    class="listivo-button__loading"
                            >
                                <circle cx='15' cy='15' r='15'>
                                    <animate attributeName='r' from='15' to='15' begin='0s'
                                             dur='0.8s' values='15;9;15'
                                             calcMode='linear' repeatCount='indefinite'/>
                                    <animate attributeName='fill-opacity' from='1' to='1' begin='0s'
                                             dur='0.8s'
                                             values='1;.5;1'
                                             calcMode='linear' repeatCount='indefinite'/>
                                </circle>

                                <circle cx='60' cy='15' r='9' fill-opacity='0.3'>
                                    <animate attributeName='r' from='9' to='9' begin='0s' dur='0.8s'
                                             values='9;15;9'
                                             calcMode='linear' repeatCount='indefinite'/>
                                    <animate attributeName='fill-opacity' from='0.5' to='0.5'
                                             begin='0s' dur='0.8s'
                                             values='.5;1;.5' calcMode='linear'
                                             repeatCount='indefinite'/>
                                </circle>

                                <circle cx='105' cy='15' r='15'>
                                    <animate attributeName='r' from='15' to='15' begin='0s'
                                             dur='0.8s' values='15;9;15'
                                             calcMode='linear' repeatCount='indefinite'/>
                                    <animate attributeName='fill-opacity' from='1' to='1' begin='0s'
                                             dur='0.8s'
                                             values='1;.5;1'
                                             calcMode='linear' repeatCount='indefinite'/>
                                </circle>
                            </svg>
                        </template>
                    </button>
                </div>
            </div>
        </form>
    </div>
</lst-user-settings>