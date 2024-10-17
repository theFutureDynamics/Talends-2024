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
        request-url="<?php echo esc_url(tdf_action_url('listivo/user/portfolio/save')); ?>"
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
            :class="{'listivo-panel-accordion--active': accordions.open === 'portfolio'}"
    >
        <div
                class="listivo-panel-accordion__top"
                @click.prevent="accordions.onOpen('portfolio')"
        >
            <h3 class="listivo-panel-accordion__label">
                <?php echo esc_html(tdf_string('portfolio')); ?>
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
        <!-- ?action=listivo/save_portfolio -->
        <form @submit.prevent="props.onSavePortfolio" id="portfolioForm" action_url="<?php echo esc_url(admin_url('admin-ajax.php?action=listivo/save_portfolio')); ?>" enctype="multipart/form-data">
        <div class="listivo-panel-accordion__content-wrapper listivo-panel-accordion__content-wrapper--portfolio">
                <div class="listivo-panel-accordion__content listivo-panel-user-settings">
                    <div  v-for="(image, index) in props.portfolio_images">
                        <div class="listivo-panel-user-settings__field listivo-field-group">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-portfolio_image"
                            >
                                <?php echo esc_html(tdf_string('portfolio_image')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <div
                                        class="listivo-input-v2"
                                        :class="{
                                            'listivo-input-v2--error': props.showErrors && (!props.errors.award_title1.required || !props.errors.award_title1 .minLength),
                                        }"
                                >
                                    <input
                                        id="listivo-portfolio_image"
                                        type="file"
                                        :name="'portfolio_image[]'"
                                        accept="image/*"
                                    >

                                    <template>
                                        <div
                                                v-if="props.showErrors && (!props.errors.award_title3.required || !props.errors.award_title3.minLength)"
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

                                                <div v-if="!props.errors.award_title1.required">
                                                    <?php echo esc_html(tdf_string('field_is_required')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="listivo-panel-user-settings__field listivo-panel-user-settings__field--full-width listivo-field-group" style="height:200px;margin-top:20px;">
                            <label
                                    class="listivo-field-group__label"
                                    for="listivo-name"
                            >
                                <?php echo esc_html(tdf_string('portfolio_description')); ?>
                            </label>

                            <div style="margin-top:100px;" class="listivo-field-group__field">
                                <div
                                        class="listivo-input-v2"
                                        :class="{
                                            'listivo-input-v2--error': props.showErrors && (!props.errors.award_description1.required || !props.errors.award_description1.minLength),
                                        }"
                                >
                                <div>
                                    
                                    <textarea style="padding:20px; border: 1px solid var(--e-global-color-lcolor3);" 
                                        rows="10" 
                                        :name="'portfolio_description[]'"
                                        cols="125" 
                                        :placeholder="`Description for image ${index + 1}`">
                                    </textarea> 
                                </div>

                                
                                    <template>
                                        <div
                                                v-if="props.showErrors && (!props.errors.award_description1.required || !props.errors.award_description1.minLength)"
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

                                                <div v-if="!props.errors.award_description1.required">
                                                    <?php echo esc_html(tdf_string('field_is_required')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                    </div>  
                <div style="margin-top:80px;" class="listivo-panel-user-settings__field listivo-field-group">
                    <a href="javascript:;"  @click="props.addPortfolioItem"  class="listivo-simple-button listivo-simple-button--background-primary-1">
                        <?php echo esc_html(tdf_string('add_portfolio')); ?>
                    </a>
                </div>

                
                <!-- <div v-for="(image, index) in props.portfolio_images" :key="index">
                        <div class="listivo-panel-user-settings__field listivo-field-group">
                            <label class="listivo-field-group__label" for="listivo-name">
                                <?php echo esc_html(tdf_string('portfolio_image')); ?>
                            </label>
                            <div class="listivo-field-group__field">
                                <input
                                    id="listivo-portfolio_image"
                                    type="file"
                                    :name="'portfolio_image[]'"
                                    accept="image/*"
                                >
                                <template>
                                        <div
                                                v-if="props.showErrors && (!props.errors.award_title3.required || !props.errors.award_title3.minLength)"
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

                                                <div v-if="!props.errors.award_title1.required">
                                                    <?php echo esc_html(tdf_string('field_is_required')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                            </div>
                        </div>
                        <div class="listivo-field-group" style="height:200px;margin-top:20px;">
                            <label class="listivo-field-group__label" for="listivo-name" >
                                <?php echo esc_html(tdf_string('portfolio_description')); ?>
                            </label>

                            <div class="listivo-field-group__field">
                                <textarea
                                    :name="'portfolio_description[]'"
                                    rows="4"
                                    :placeholder="`Description for image ${index + 1}`"
                                ></textarea>

                                <template>
                                        <div
                                                v-if="props.showErrors && (!props.errors.portfolio_description.required || !props.errors.portfolio_description.minLength)"
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

                                                <div v-if="!props.errors.portfolio_description.required">
                                                    <?php echo esc_html(tdf_string('field_is_required')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    
                            </div>
                        </div>
                    </div>
                    <button @click="props.addPortfolioItem" type="button">Add More</button>
                </div> -->
                <!-- <button @click="props.addPortfolioItem" type="button">Add More</button> --> 
            </div>
            <div class="listivo-panel-accordion__bottom">
                    <button
                        class="listivo-button listivo-button--primary-1 listivo-button-primary-1-colors-with-stroke-selector"
                        :class="{'listivo-button--loading': props.inProgress}"
                    >
                        <span>
                            <?php echo esc_html(tdf_string('save_changes')); ?>
                        </span>
                    </button>
                </div>
        </form>

        <div class="portfolio_listings" v-if="props.portfolios && props.portfolios.length > 0" 
     >
  <ul style="list-style-type: none; padding: 0; margin: 0;">
    <li v-for="(portfolio, index) in props.portfolios" :key="index" 
        style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border-bottom: 1px solid #e0e0e0; transition: background-color 0.3s; background-color: #f9f9f9;">
      <span v-if="portfolio.portfolio_description" 
            style="font-size: 16px; color: #333333; flex: 1; margin-right: 15px; word-break: break-word; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
        {{ portfolio.portfolio_description.split(' ').length > 10 ? portfolio.portfolio_description.split(' ').slice(0, 10).join(' ') + '...' : portfolio.portfolio_description }}
      </span>
      <i class="fa fa-trash" @click.prevent="props.removePortfolio(index)" aria-hidden="true" 
         style="font-size: 20px; color: #59C23F; cursor: pointer; transition: color 0.3s; margin-left: 10px;">
        <span style="display: none;">Delete</span>
      </i>
    </li>
  </ul>
</div>




    </div>
    </div>
</lst-user-settings>