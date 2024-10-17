<?php

use Tangibledesign\Framework\Models\User\User;
use Tangibledesign\Listivo\Widgets\General\PanelWidget;

/* @var PanelWidget $lstCurrentWidget */
global $lstCurrentWidget;

$lstCurrentUser = tdf_current_user();
if (!$lstCurrentUser instanceof User) {
    return;
}

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
            :class="{'listivo-panel-accordion--active': accordions.open === 'education'}"
    >
        <div
                class="listivo-panel-accordion__top"
                @click.prevent="accordions.onOpen('education')"
        >
            <h3 class="listivo-panel-accordion__label">
                <?php echo esc_html(tdf_string('education')); ?>
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
            <div class="listivo-panel-accordion__content-wrapper listivo-panel-accordion__content-wrapper--education">
                <div class="listivo-panel-accordion__content listivo-panel-user-settings">
                    
                <div class="listivo-panel-user-settings__field listivo-field-group">
                        <label
                                class="listivo-field-group__label"
                                for="listivo-name"
                        >
                            <?php echo esc_html(tdf_string('degree_title')); ?>
                        </label>

                        <div class="listivo-field-group__field">
                            <div
                                    class="listivo-input-v2"
                                    :class="{
                                        'listivo-input-v2--error': props.showErrors && (!props.errors.degree_title.required || !props.errors.degree_title.minLength),
                                    }"
                            >
                                <input
                                        id="listivo-degree_title"
                                        type="text"
                                        :value="props.degree_title"
                                        @input="props.setDegreeTitle($event.target.value)"
                                        placeholder="<?php echo esc_attr(tdf_string('degree_title')); ?>"
                                >

                                <template>
                                    <div
                                            v-if="props.showErrors && (!props.errors.degree_title.required || !props.errors.degree_title.minLength)"
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

                                            <div v-if="!props.errors.degree_title.required">
                                                <?php echo esc_html(tdf_string('field_is_required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="listivo-panel-user-settings__field listivo-field-group">
                        <label
                                class="listivo-field-group__label"
                                for="listivo-name"
                        >
                            <?php echo esc_html(tdf_string('education_start_date')); ?>
                        </label>

                        <div class="listivo-field-group__field">
                            <div
                                    class="listivo-input-v2"
                                    :class="{
                                        'listivo-input-v2--error': props.showErrors && (!props.errors.education_start_date.required || !props.errors.education_start_date.minLength),
                                    }"
                            >
                                <input
                                        id="listivo-education_start_date"
                                        type="date"
                                        :value="props.education_start_date"
                                        @input="props.setEducationStartDate($event.target.value)"
                                        placeholder="<?php echo esc_attr(tdf_string('education_start_date')); ?>"
                                >

                                <template>
                                    <div
                                            v-if="props.showErrors && (!props.errors.education_start_date.required || !props.errors.education_start_date.minLength)"
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

                                            <div v-if="!props.errors.education_start_date.required">
                                                <?php echo esc_html(tdf_string('field_is_required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="listivo-panel-user-settings__field listivo-field-group">
                        <label
                                class="listivo-field-group__label"
                                for="listivo-name"
                        >
                            <?php echo esc_html(tdf_string('education_end_date')); ?>
                        </label>

                        <div class="listivo-field-group__field">
                            <div
                                    class="listivo-input-v2"
                                    :class="{
                                        'listivo-input-v2--error': props.showErrors && (!props.errors.education_end_date.required),
                                    }"
                            >
                                <input
                                        id="listivo-education_end_date"
                                        type="date"
                                        :value="props.education_end_date"
                                        @input="props.setEducationEndDate($event.target.value)"
                                        placeholder="<?php echo esc_attr(tdf_string('education_end_date')); ?>"
                                >

                                <template>
                                    <div
                                            v-if="props.showErrors && (!props.errors.education_end_date.required || !props.errors.education_end_date.minLength)"
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

                                            <div v-if="!props.errors.education_end_date.required">
                                                <?php echo esc_html(tdf_string('field_is_required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="listivo-panel-user-settings__field listivo-field-group">
                        <label
                                class="listivo-field-group__label"
                                for="listivo-name"
                        >
                            <?php echo esc_html(tdf_string('insitute_title')); ?>
                        </label>

                        <div class="listivo-field-group__field">
                            <div
                                    class="listivo-input-v2"
                                    :class="{
                                        'listivo-input-v2--error': props.showErrors && (!props.errors.insitute_title.required || !props.errors.insitute_title.minLength),
                                    }"
                            >
                                <input
                                        id="listivo-insitute_title"
                                        type="text"
                                        :value="props.insitute_title"
                                        @input="props.setInsituteTitle($event.target.value)"
                                        placeholder="<?php echo esc_attr(tdf_string('insitute_title')); ?>"
                                >

                                <template>
                                    <div
                                            v-if="props.showErrors && (!props.errors.insitute_title.required || !props.errors.insitute_title.minLength)"
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

                                            <div v-if="!props.errors.insitute_title.required">
                                                <?php echo esc_html(tdf_string('field_is_required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field--full-width listivo-field-group" style="height:200px">
                        <label
                                class="listivo-field-group__label"
                                for="listivo-name"
                        >
                            <?php echo esc_html(tdf_string('education_description')); ?>
                        </label>

                        <div style="margin-top:100px" class="listivo-field-group__field">
                            <div
                                    class="listivo-input-v2"
                                    :class="{
                                        'listivo-input-v2--error': props.showErrors && (!props.errors.education_description.required || !props.errors.education_description.minLength),
                                    }"
                            >
                            <div>
                                <textarea style="padding:20px; border: 1px solid var(--e-global-color-lcolor3);" rows="10" cols="125" :value="props.education_description"  placeholder="<?php echo esc_attr(tdf_string('education_description')); ?>" @input="props.setEducationDescription($event.target.value)" id="listivo-education_description"></textarea>
                            </div>    
                                <template>
                                    <div
                                            v-if="props.showErrors && (!props.errors.education_description.required || !props.errors.education_description.minLength)"
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

                                            <div v-if="!props.errors.insitute_title.required">
                                                <?php echo esc_html(tdf_string('field_is_required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:80px;" class="listivo-panel-user-settings__field listivo-field-group">
                        <a href="javascript:;" @click.prevent="props.addEducation"   class="listivo-simple-button listivo-simple-button--background-primary-1">
                            <?php echo esc_html(tdf_string('add_education')); ?>
                        </a>
                    </div>

                   
                
                </div>
                <div v-if="props.addedEducations && props.addedEducations.length > 0" class="listivo-panel-user-settings__skills-list skill-set-listings listings-custom-class" style="padding: 10px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <ul style="list-style-type: none; padding: 0; margin: 0;">
                        <li v-for="(education, index) in props.addedEducations" :key="index" style="display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid #ddd;">
                            <span style="cursor:pointer;width:90%;overflow-y:scroll;" @click.prevent="props.editEducation(education,index)" v-if="education.education_end_date && education.education_end_date.trim() !== '0000-00-00'" style="font-size: 16px; color: #333;">{{ education.degree_title }} ( {{ education.education_start_date }} - {{ education.education_end_date }} )</span>
                            <span style="cursor:pointer;width:90%;overflow-y:scroll;" @click.prevent="props.editEducation(education,index)" v-else style="font-size: 16px; color: #333;">{{ education.degree_title }} ( {{ education.education_start_date }} - Present )</span>
                            <i class="fa fa-trash" @click.prevent="props.removeEducation(index)" aria-hidden="true" style="font-size: 16px; color: rgb(89, 194, 63); cursor: pointer;"></i>
                        </li>
                    </ul>
                </div>


                


                <div class="listivo-panel-accordion__bottom">
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