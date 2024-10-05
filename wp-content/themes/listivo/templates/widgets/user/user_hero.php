<?php
use Tangibledesign\Framework\Core\Image\RenderUserImage;
use Tangibledesign\Listivo\Widgets\User\UserHeroWidget;

/* @var UserHeroWidget $lstCurrentWidget */
global $lstCurrentWidget;
$lstUser = $lstCurrentWidget->getUser();
if (!$lstUser) {
    return;
}

// Create a reflection class for the User class
$reflection = new ReflectionClass($lstUser);

// Get the protected property 'user'
$property = $reflection->getProperty('user');
$property->setAccessible(true); // Allow access to the protected property

// Get the WP_User object from the protected 'user' property
$wpUser = $property->getValue($lstUser);

// Access the 'data' property of the WP_User object
$data = $wpUser->data;

// Access the 'type' property from the stdClass object
$type = $data->type;

$experiences = $lstUser->getUserExperiences();
$educations = $lstUser->getUserEducation();
$servics = $lstUser->getUserExpertises();
$portfolios = $lstUser->getUserPortfolio();
$awards = $lstUser->getUserAwards();
$image_url = get_site_url() . '/wp-content/uploads/2022/08/award.png';
?>

<section class="elementor-section elementor-top-section elementor-element elementor-element-252faf0a elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="252faf0a" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-74ae94b2" data-id="74ae94b2" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-6c61dd8 elementor-widget elementor-widget-spacer" data-id="6c61dd8" data-element_type="widget" data-widget_type="spacer.default">
                    <div class="elementor-widget-container">
                        <style>
                            /*! elementor - v3.23.0 - 05-08-2024 */
                            .elementor-column .elementor-spacer-inner{height:var(--spacer-size)}.e-con{--container-widget-width:100%}.e-con-inner>.elementor-widget-spacer,.e-con>.elementor-widget-spacer{width:var(--container-widget-width,var(--spacer-size));--align-self:var(--container-widget-align-self,initial);--flex-shrink:0}.e-con-inner>.elementor-widget-spacer>.elementor-widget-container,.e-con>.elementor-widget-spacer>.elementor-widget-container{height:100%;width:100%}.e-con-inner>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer,.e-con>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer{height:100%}.e-con-inner>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer>.elementor-spacer-inner,.e-con>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer>.elementor-spacer-inner{height:var(--container-widget-height,var(--spacer-size))}.e-con-inner>.elementor-widget-spacer.elementor-widget-empty,.e-con>.elementor-widget-spacer.elementor-widget-empty{position:relative;min-height:22px;min-width:22px}.e-con-inner>.elementor-widget-spacer.elementor-widget-empty .elementor-widget-empty-icon,.e-con>.elementor-widget-spacer.elementor-widget-empty .elementor-widget-empty-icon{position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;padding:0;width:22px;height:22px}
                        </style>
                        <div class="elementor-spacer">
                            <div class="elementor-spacer-inner"></div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-168830f elementor-widget elementor-widget-lst_user_hero" data-id="168830f" data-element_type="widget" data-widget_type="lst_user_hero.default">
                    <div class="elementor-widget-container">


                        <div class="listivo-user-hero">
                            <div class="listivo-user-hero__decoration-container">
                                <div class="listivo-user-hero__circle listivo-user-hero__circle--1"></div>

                                <div class="listivo-user-hero__circle listivo-user-hero__circle--2"></div>

                                <div class="listivo-user-hero__small-circle listivo-user-hero__small-circle--1"></div>

                                <div class="listivo-user-hero__small-circle listivo-user-hero__small-circle--2"></div>

                                <div class="listivo-user-hero__x listivo-user-hero__x--1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none">
                                        <path d="M13.7572 35.3434L9.63333 31.2196L31.2199 9.63304L35.3437 13.7569L13.7572 35.3434ZM9.0733 13.2478L13.299 9.02209L35.9547 31.6778L31.729 35.9035L9.0733 13.2478Z" fill="#E6F0FA"></path>
                                    </svg>
                                </div>

                                <div class="listivo-user-hero__x listivo-user-hero__x--2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none">
                                        <path d="M13.7572 35.3434L9.63333 31.2196L31.2199 9.63304L35.3437 13.7569L13.7572 35.3434ZM9.0733 13.2478L13.299 9.02209L35.9547 31.6778L31.729 35.9035L9.0733 13.2478Z" fill="#E6F0FA"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="listivo-user-hero__top">
                                <div class="listivo-user-hero__background">
                                    <img class=" ls-is-cached lazyloaded" src="http://wp_talends.test/wp-content/uploads/2022/08/solid-color-image-1.png" data-src="http://wp_talends.test/wp-content/uploads/2022/08/solid-color-image-1.png" alt="">
                                </div>
                            </div>

                            <div class="listivo-user-hero__content-wrapper">
                                <div class="listivo-user-hero__content">
                                    <div class="listivo-user-hero__avatar">
                                        <img class=" ls-is-cached lazyloaded" data-src="https://wp_talends.test/wp-content/uploads/2024/09/46560e2b702147fdcf1f87dd73c856e3-3-400x400.jpg" alt="freelance" src="https://wp_talends.test/wp-content/uploads/2024/09/46560e2b702147fdcf1f87dd73c856e3-3-400x400.jpg">


                                    </div>

                                    <h1 class="listivo-user-hero__name">
                freelance            </h1>

                                    <div class="listivo-user-hero__meta">
                                        <div class="listivo-user-hero__data">
                                            <div class="listivo-user-hero__data-icon-wrapper">
                                                <div class="listivo-user-hero__data-icon listivo-small-icon listivo-small-icon--circle listivo-small-icon--primary-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" fill="none">
                                                        <path d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 9.55469 1.76367 8.29688 2.90625 7.59375C3.24219 8.41797 4.06055 9 5 9C5.93945 9 6.75781 8.41797 7.09375 7.59375C8.23633 8.29688 9 9.55469 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1ZM5 7C5.41016 7 5.80078 7.05859 6.17188 7.17188C5.99805 7.6543 5.54492 8 5 8C4.45508 8 4.00195 7.6543 3.82812 7.17188C4.19922 7.05859 4.58984 7 5 7Z"
                                                        fill="#FDFDFE"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="listivo-user-hero__data-text">
                                                Member since 2 weeks </div>
                                        </div>

                                        <div class="listivo-user-hero__data">
                                            <div class="listivo-user-hero__data-icon-wrapper">
                                                <div class="listivo-user-hero__data-icon listivo-small-icon listivo-small-icon--circle listivo-small-icon--primary-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5 0C2.24609 0 0 2.27981 0 5.07505C0 5.8601 0.316406 6.72048 0.753906 7.62843C1.19141 8.54036 1.76172 9.49193 2.33594 10.3602C3.47656 12.1008 4.61328 13.5163 4.61328 13.5163L5 14L5.38672 13.5163C5.38672 13.5163 6.52344 12.1008 7.66797 10.3602C8.23828 9.49193 8.80859 8.54036 9.24609 7.62843C9.68359 6.72048 10 5.8601 10 5.07505C10 2.27981 7.75391 0 5 0ZM5 1.01514C7.21484 1.01514 9 2.82709 9 5.07518C9 5.55096 8.75391 6.33997 8.34766 7.18449C7.94141 8.03298 7.38672 8.95283 6.83594 9.80132C5.99563 11.0789 5.40082 11.8315 5.08146 12.2356L5 12.3388L4.91854 12.2356C4.59919 11.8315 4.00437 11.0789 3.16406 9.80132C2.61328 8.95283 2.05859 8.03298 1.65234 7.18449C1.24609 6.33997 1 5.55096 1 5.07518C1 2.82709 2.78516 1.01514 5 1.01514ZM4.00002 5.06006C4.00002 4.50928 4.44924 4.06006 5.00002 4.06006C5.5508 4.06006 6.00002 4.50928 6.00002 5.06006C6.00002 5.61084 5.5508 6.06006 5.00002 6.06006C4.44924 6.06006 4.00002 5.61084 4.00002 5.06006Z"
                                                        fill="#FDFDFE"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="listivo-user-hero__data-text">
                                                Pakistan </div>
                                        </div>
                                    </div>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            $("#seeMore").on("click", function() {
                                                var shortDescription = $("#shortDescription");
                                                var fullDescription = $("#fullDescription");
                                                var seeMoreLink = $("#seeMore");
                                        
                                                if (fullDescription.is(":visible")) {
                                                    // Hide full description and show truncated
                                                    fullDescription.hide();
                                                    shortDescription.show();
                                                    seeMoreLink.text("See More");
                                                } else {
                                                    // Show full description and hide truncated
                                                    fullDescription.show();
                                                    shortDescription.hide();
                                                    seeMoreLink.text("See Less");
                                                }
                                            });
                                        });
                                        let currentIndex = 0;
                                        
                                        function showSlide(index) {
                                            const items = document.querySelectorAll('.carousel-item');
                                            if (index >= items.length) currentIndex = 0;
                                            else if (index < 0) currentIndex = items.length - 1;
                                            else currentIndex = index;
                                        
                                            const offset = -currentIndex * 100;
                                            document.querySelector('.carousel-items').style.transform = `translateX(${offset}%)`;
                                        }
                                        
                                        function nextSlide() {
                                            showSlide(currentIndex + 1);
                                        }
                                        
                                        function prevSlide() {
                                            showSlide(currentIndex - 1);
                                        }
                                        
                                        // Initialize the first slide
                                        showSlide(currentIndex);
                                    </script>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-86f4a59 elementor-widget elementor-widget-spacer" data-id="86f4a59" data-element_type="widget" data-widget_type="spacer.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-5da5d9a elementor-widget elementor-widget-heading" data-id="5da5d9a" data-element_type="widget" data-widget_type="heading.default">
                                <div class="elementor-widget-container">
                                    <style>
                                        /*! elementor - v3.23.0 - 05-08-2024 */
                                        .elementor-heading-title{padding:0;margin:0;line-height:1}.elementor-widget-heading .elementor-heading-title[class*=elementor-size-]>a{color:inherit;font-size:inherit;line-height:inherit}.elementor-widget-heading .elementor-heading-title.elementor-size-small{font-size:15px}.elementor-widget-heading .elementor-heading-title.elementor-size-medium{font-size:19px}.elementor-widget-heading .elementor-heading-title.elementor-size-large{font-size:29px}.elementor-widget-heading .elementor-heading-title.elementor-size-xl{font-size:39px}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl{font-size:59px}
                                    </style>
                                    <h3 class="elementor-heading-title elementor-size-default">About Agency1</h3> </div>
                            </div>
                            <div class="elementor-element elementor-element-3f81c6e elementor-widget__width-auto elementor-widget elementor-widget-text-editor" data-id="3f81c6e" data-element_type="widget" data-widget_type="text-editor.default">
                                <div class="elementor-widget-container">
                                    <style>
                                        /*! elementor - v3.23.0 - 05-08-2024 */
                                        .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap{background-color:#69727d;color:#fff}.elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap{color:#69727d;border:3px solid;background-color:transparent}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap{margin-top:8px}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter{width:1em;height:1em}.elementor-widget-text-editor .elementor-drop-cap{float:left;text-align:center;line-height:1;font-size:50px}.elementor-widget-text-editor .elementor-drop-cap-letter{display:inline-block}
                                    </style>
                                    <p><span style="font-family: Joan, sans-serif; background-color: rgb(244, 244, 244);">What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>
                                        <span
                                        style="color: var(--e-global-color-lcolor2); font-size: var(--e-global-typography-ltext1-font-size); font-style: var(--e-global-typography-ltext1-font-style); font-weight: var(--e-global-typography-ltext1-font-weight); letter-spacing: var(--e-global-typography-ltext1-letter-spacing); text-transform: var(--e-global-typography-ltext1-text-transform); background-color: rgb(244, 244, 244); font-family: var(--e-global-typography-ltext1-font-family);">What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley
                                            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                                            with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><span style="color: var(--e-global-color-lcolor2); font-size: var(--e-global-typography-ltext1-font-size); font-style: var(--e-global-typography-ltext1-font-style); font-weight: var(--e-global-typography-ltext1-font-weight); letter-spacing: var(--e-global-typography-ltext1-letter-spacing); text-transform: var(--e-global-typography-ltext1-text-transform); background-color: rgb(244, 244, 244); font-family: var(--e-global-typography-ltext1-font-family);">What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>
                                            <br>
                                    </p>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-cbe1c5a e-grid e-con-boxed e-con e-parent e-lazyloaded" data-id="cbe1c5a" data-element_type="container">
                                <div class="e-con-inner">
                                    <div class="elementor-element elementor-element-751b4c7 elementor-widget elementor-widget-lst_simple_list" data-id="751b4c7" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                        <div class="elementor-widget-container">
                                            <div class="listivo-simple-list">
                                                <div class="listivo-simple-list__item">
                                                    <div class="listivo-simple-list__icon-wrapper">
                                                        <div class="listivo-simple-list__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                fill="#374B5C"></path>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="listivo-simple-list__text">
                                                        Job Preferences Remote, On Site, Hybrid </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-cfdb17c elementor-widget elementor-widget-lst_simple_list" data-id="cfdb17c" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                        <div class="elementor-widget-container">
                                            <div class="listivo-simple-list">
                                                <div class="listivo-simple-list__item">
                                                    <div class="listivo-simple-list__icon-wrapper">
                                                        <div class="listivo-simple-list__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                fill="#374B5C"></path>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="listivo-simple-list__text">
                                                        Hourly Rate $100.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-c59bfec elementor-widget elementor-widget-lst_simple_list" data-id="c59bfec" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                        <div class="elementor-widget-container">
                                            <div class="listivo-simple-list">
                                                <div class="listivo-simple-list__item">
                                                    <div class="listivo-simple-list__icon-wrapper">
                                                        <div class="listivo-simple-list__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                fill="#374B5C"></path>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="listivo-simple-list__text">
                                                        Hourly Rate $100.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-cbe6ae4 elementor-widget elementor-widget-lst_simple_list" data-id="cbe6ae4" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                        <div class="elementor-widget-container">
                                            <div class="listivo-simple-list">
                                                <div class="listivo-simple-list__item">
                                                    <div class="listivo-simple-list__icon-wrapper">
                                                        <div class="listivo-simple-list__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                fill="#374B5C"></path>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="listivo-simple-list__text">
                                                        Hourly Rate $100.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-c64a70c elementor-widget elementor-widget-lst_simple_list" data-id="c64a70c" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                        <div class="elementor-widget-container">
                                            <div class="listivo-simple-list">
                                                <div class="listivo-simple-list__item">
                                                    <div class="listivo-simple-list__icon-wrapper">
                                                        <div class="listivo-simple-list__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                fill="#374B5C"></path>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="listivo-simple-list__text">
                                                        Hourly Rate $100.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-f6b5550 elementor-widget elementor-widget-lst_simple_list" data-id="f6b5550" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                        <div class="elementor-widget-container">
                                            <div class="listivo-simple-list">
                                                <div class="listivo-simple-list__item">
                                                    <div class="listivo-simple-list__icon-wrapper">
                                                        <div class="listivo-simple-list__icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                fill="#374B5C"></path>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="listivo-simple-list__text">
                                                        Hourly Rate $100.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section class="elementor-section elementor-inner-section elementor-element elementor-element-26dc4b26 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="26dc4b26" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-4f5b92d0" data-id="4f5b92d0" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-73f26a2 elementor-widget elementor-widget-heading" data-id="73f26a2" data-element_type="widget" data-widget_type="heading.default">
                                                <div class="elementor-widget-container">
                                                    <h3 class="elementor-heading-title elementor-size-default">Skills</h3> </div>
                                            </div>
                                            <div class="elementor-element elementor-element-ad55a4a elementor-widget elementor-widget-spacer" data-id="ad55a4a" data-element_type="widget" data-widget_type="spacer.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-spacer">
                                                        <div class="elementor-spacer-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-5992a8b e-grid e-con-boxed e-con e-parent e-lazyloaded" data-id="5992a8b" data-element_type="container">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-c195156 elementor-widget elementor-widget-progress" data-id="c195156" data-element_type="widget" data-widget_type="progress.default">
                                                        <div class="elementor-widget-container">
                                                            <style>
                                                                /*! elementor - v3.23.0 - 05-08-2024 */
                                                                .elementor-widget-progress{text-align:start}.elementor-progress-wrapper{position:relative;background-color:#eee;color:#fff;height:100%;border-radius:2px}.elementor-progress-bar{display:flex;background-color:#69727d;width:0;font-size:11px;height:30px;line-height:30px;border-radius:2px;transition:width 1s ease-in-out}.elementor-progress-text{flex-grow:1;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;padding-inline-start:15px}.elementor-progress-percentage{padding-inline-end:15px}.elementor-widget-progress .elementor-progress-wrapper.progress-info .elementor-progress-bar{background-color:#5bc0de}.elementor-widget-progress .elementor-progress-wrapper.progress-success .elementor-progress-bar{background-color:#5cb85c}.elementor-widget-progress .elementor-progress-wrapper.progress-warning .elementor-progress-bar{background-color:#f0ad4e}.elementor-widget-progress .elementor-progress-wrapper.progress-danger .elementor-progress-bar{background-color:#d9534f}.elementor-progress .elementor-title{display:block}@media (max-width:767px){.elementor-progress-text{padding-inline-start:10px}}.e-con-inner .elementor-progress-wrapper,.e-con .elementor-progress-wrapper{height:auto}
                                                            </style> <span class="elementor-title" id="elementor-progress-bar-c195156">
				Font Design (70%)			</span>

                                                            <div aria-labelledby="elementor-progress-bar-c195156" class="elementor-progress-wrapper" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" aria-valuetext="50% (Web Designer)">
                                                                <div class="elementor-progress-bar" data-max="50" style="width: 50%;">
                                                                    <span class="elementor-progress-text">Web Designer</span>
                                                                    <span class="elementor-progress-percentage">50%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-4c20fab elementor-widget elementor-widget-progress" data-id="4c20fab" data-element_type="widget" data-widget_type="progress.default">
                                                        <div class="elementor-widget-container">
                                                            <span class="elementor-title" id="elementor-progress-bar-4c20fab">
				Backgrounds &amp; Environments (80%)			</span>

                                                            <div aria-labelledby="elementor-progress-bar-4c20fab" class="elementor-progress-wrapper" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" aria-valuetext="50% (Web Designer)">
                                                                <div class="elementor-progress-bar" data-max="50" style="width: 50%;">
                                                                    <span class="elementor-progress-text">Web Designer</span>
                                                                    <span class="elementor-progress-percentage">50%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-ec05de5 elementor-widget elementor-widget-progress" data-id="ec05de5" data-element_type="widget" data-widget_type="progress.default">
                                                        <div class="elementor-widget-container">
                                                            <span class="elementor-title" id="elementor-progress-bar-ec05de5">
				UI &amp; UX (90%)			</span>

                                                            <div aria-labelledby="elementor-progress-bar-ec05de5" class="elementor-progress-wrapper" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" aria-valuetext="50% (Web Designer)">
                                                                <div class="elementor-progress-bar" data-max="50" style="width: 50%;">
                                                                    <span class="elementor-progress-text">Web Designer</span>
                                                                    <span class="elementor-progress-percentage">50%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-e7b9e97 elementor-widget elementor-widget-progress" data-id="e7b9e97" data-element_type="widget" data-widget_type="progress.default">
                                                        <div class="elementor-widget-container">
                                                            <span class="elementor-title" id="elementor-progress-bar-e7b9e97">
				UI &amp; UX (90%)			</span>

                                                            <div aria-labelledby="elementor-progress-bar-e7b9e97" class="elementor-progress-wrapper" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" aria-valuetext="50% (Web Designer)">
                                                                <div class="elementor-progress-bar" data-max="50" style="width: 50%;">
                                                                    <span class="elementor-progress-text">Web Designer</span>
                                                                    <span class="elementor-progress-percentage">50%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-34a4874 elementor-widget elementor-widget-progress" data-id="34a4874" data-element_type="widget" data-widget_type="progress.default">
                                                        <div class="elementor-widget-container">
                                                            <span class="elementor-title" id="elementor-progress-bar-34a4874">
				UI &amp; UX (90%)			</span>

                                                            <div aria-labelledby="elementor-progress-bar-34a4874" class="elementor-progress-wrapper" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" aria-valuetext="50% (Web Designer)">
                                                                <div class="elementor-progress-bar" data-max="50" style="width: 50%;">
                                                                    <span class="elementor-progress-text">Web Designer</span>
                                                                    <span class="elementor-progress-percentage">50%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-2a955ee elementor-widget elementor-widget-spacer" data-id="2a955ee" data-element_type="widget" data-widget_type="spacer.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-spacer">
                                                        <div class="elementor-spacer-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-922ba8a elementor-widget elementor-widget-heading" data-id="922ba8a" data-element_type="widget" data-widget_type="heading.default">
                                                <div class="elementor-widget-container">
                                                    <h3 class="elementor-heading-title elementor-size-default">Experiences</h3> </div>
                                            </div>
                                            <div class="elementor-element elementor-element-e458842 elementor-widget elementor-widget-spacer" data-id="e458842" data-element_type="widget" data-widget_type="spacer.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-spacer">
                                                        <div class="elementor-spacer-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-5767954 e-grid e-con-boxed e-con e-parent e-lazyloaded" data-id="5767954" data-element_type="container">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-c1694a2 elementor-widget elementor-widget-lst_simple_list" data-id="c1694a2" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="listivo-simple-list">
                                                                <div class="listivo-simple-list__item">
                                                                    <div class="listivo-simple-list__icon-wrapper">
                                                                        <div class="listivo-simple-list__icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                                fill="#374B5C"></path>
                                                                            </svg>
                                                                        </div>
                                                                    </div>

                                                                    <div class="listivo-simple-list__text">
                                                                        Associate Software Engineer ( 2024-09-01 - 2024-09-02 ) </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-b7bca00 elementor-widget elementor-widget-lst_simple_list" data-id="b7bca00" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="listivo-simple-list">
                                                                <div class="listivo-simple-list__item">
                                                                    <div class="listivo-simple-list__icon-wrapper">
                                                                        <div class="listivo-simple-list__icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                                fill="#374B5C"></path>
                                                                            </svg>
                                                                        </div>
                                                                    </div>

                                                                    <div class="listivo-simple-list__text">
                                                                        Associate Software Engineer ( 2024-09-01 - 2024-09-02 ) </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-457c8cc elementor-widget elementor-widget-lst_simple_list" data-id="457c8cc" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="listivo-simple-list">
                                                                <div class="listivo-simple-list__item">
                                                                    <div class="listivo-simple-list__icon-wrapper">
                                                                        <div class="listivo-simple-list__icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                                fill="#374B5C"></path>
                                                                            </svg>
                                                                        </div>
                                                                    </div>

                                                                    <div class="listivo-simple-list__text">
                                                                        Associate Software Engineer ( 2024-09-01 - 2024-09-02 ) </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-3ad4574 elementor-widget elementor-widget-lst_simple_list" data-id="3ad4574" data-element_type="widget" data-widget_type="lst_simple_list.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="listivo-simple-list">
                                                                <div class="listivo-simple-list__item">
                                                                    <div class="listivo-simple-list__icon-wrapper">
                                                                        <div class="listivo-simple-list__icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                                                <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                                                fill="#374B5C"></path>
                                                                            </svg>
                                                                        </div>
                                                                    </div>

                                                                    <div class="listivo-simple-list__text">
                                                                        Associate Software Engineer ( 2024-09-01 - 2024-09-02 ) </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-f2dec18 elementor-widget elementor-widget-spacer" data-id="f2dec18" data-element_type="widget" data-widget_type="spacer.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-spacer">
                                                        <div class="elementor-spacer-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="elementor-section elementor-top-section elementor-element elementor-element-5cea32b3 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="5cea32b3" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-1b5bc158" data-id="1b5bc158" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-4ddd5d3 elementor-widget elementor-widget-lst_content_v2" data-id="4ddd5d3" data-element_type="widget" data-widget_type="lst_content_v2.default">
                    <div class="elementor-widget-container">
                        <div class="listivo-content-v2">
                            <div class="listivo-content-v2__image-wrapper">
                                <div class="listivo-content-v2__image">
                                    <img class=" ls-is-cached lazyloaded" src="http://wp_talends.test/wp-content/uploads/2022/08/home_bg.jpeg" data-src="http://wp_talends.test/wp-content/uploads/2022/08/home_bg.jpeg" alt="" style="aspect-ratio: 1024 / 682">
                                </div>
                            </div>

                            <div class="listivo-content-v2__content">
                                <div class="listivo-content-v2__heading">
                                    <div class="listivo-heading-v2 listivo-heading-v2--left listivo-heading-v2--tablet-center">

                                        <h2 class="listivo-heading-v2__text">
                                    </h2>
                                    </div>
                                </div>

                                <div class="listivo-content-v2__text">
                                    What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
                                    Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-4bdea6d elementor-widget elementor-widget-spacer" data-id="4bdea6d" data-element_type="widget" data-widget_type="spacer.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-spacer">
                            <div class="elementor-spacer-inner"></div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-c9ba797 elementor-widget elementor-widget-heading" data-id="c9ba797" data-element_type="widget" data-widget_type="heading.default">
                    <div class="elementor-widget-container">
                        <h3 class="elementor-heading-title elementor-size-default">Education &amp; Certificates</h3> </div>
                </div>
                <div class="elementor-element elementor-element-5b5e880 elementor-widget elementor-widget-spacer" data-id="5b5e880" data-element_type="widget" data-widget_type="spacer.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-spacer">
                            <div class="elementor-spacer-inner"></div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-67aef56 e-grid e-con-boxed e-con e-parent e-lazyloaded" data-id="67aef56" data-element_type="container">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-1d596f2 elementor-widget elementor-widget-lst_simple_list" data-id="1d596f2" data-element_type="widget" data-widget_type="lst_simple_list.default">
                            <div class="elementor-widget-container">
                                <div class="listivo-simple-list">
                                    <div class="listivo-simple-list__item">
                                        <div class="listivo-simple-list__icon-wrapper">
                                            <div class="listivo-simple-list__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                    <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                    fill="#374B5C"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="listivo-simple-list__text">
                                            A level </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-3814d73 elementor-widget elementor-widget-lst_simple_list" data-id="3814d73" data-element_type="widget" data-widget_type="lst_simple_list.default">
                            <div class="elementor-widget-container">
                                <div class="listivo-simple-list">
                                    <div class="listivo-simple-list__item">
                                        <div class="listivo-simple-list__icon-wrapper">
                                            <div class="listivo-simple-list__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                    <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                    fill="#374B5C"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="listivo-simple-list__text">
                                            BSC </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-aa684bc elementor-widget elementor-widget-lst_simple_list" data-id="aa684bc" data-element_type="widget" data-widget_type="lst_simple_list.default">
                            <div class="elementor-widget-container">
                                <div class="listivo-simple-list">
                                    <div class="listivo-simple-list__item">
                                        <div class="listivo-simple-list__icon-wrapper">
                                            <div class="listivo-simple-list__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                    <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z"
                                                    fill="#374B5C"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="listivo-simple-list__text">
                                            MSC </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-c0a8c2d elementor-widget elementor-widget-lst_simple_list" data-id="c0a8c2d" data-element_type="widget" data-widget_type="lst_simple_list.default">
                            <div class="elementor-widget-container">
                                <div class="listivo-simple-list">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-0534c6a elementor-widget elementor-widget-spacer" data-id="0534c6a" data-element_type="widget" data-widget_type="spacer.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-spacer">
                            <div class="elementor-spacer-inner"></div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-4a6d262 elementor-widget elementor-widget-heading" data-id="4a6d262" data-element_type="widget" data-widget_type="heading.default">
                    <div class="elementor-widget-container">
                        <h3 class="elementor-heading-title elementor-size-default">Awards</h3> </div>
                </div>
                <div class="elementor-element elementor-element-51bf6b1 elementor-widget elementor-widget-spacer" data-id="51bf6b1" data-element_type="widget" data-widget_type="spacer.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-spacer">
                            <div class="elementor-spacer-inner"></div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-a8cab8c elementor-widget elementor-widget-lst_services_v4" data-id="a8cab8c" data-element_type="widget" data-widget_type="lst_services_v4.default">
                    <div class="elementor-widget-container">
                        <div class="listivo-services-v4">
                            <div class="listivo-services-v4__list">
                                <div class="listivo-service-v4">

                                    <div class="listivo-service-v4__image">
                                        <img src="http://wp_talends.test/wp-content/uploads/2022/08/contact_phone-1.png" alt="Award1">
                                    </div>

                                    <h3 class="listivo-service-v4__label">
                    Award1                </h3>

                                    <div class="listivo-service-v4__text">
                                        EOM one line description for each award that user has won from his carrier
                                        <br>
                                    </div>
                                </div>
                                <div class="listivo-service-v4">

                                    <div class="listivo-service-v4__image">
                                        <img src="http://wp_talends.test/wp-content/uploads/2022/08/contact_phone-1.png" alt="Award2">
                                    </div>

                                    <h3 class="listivo-service-v4__label">
                    Award2                </h3>

                                    <div class="listivo-service-v4__text">
                                        EOM one line description for each award that user has won from his carrier
                                        <br>
                                    </div>
                                </div>
                                <div class="listivo-service-v4">

                                    <div class="listivo-service-v4__image">
                                        <img src="http://wp_talends.test/wp-content/uploads/2022/08/contact_phone-1.png" alt="award3">
                                    </div>

                                    <h3 class="listivo-service-v4__label">
                    award3                </h3>

                                    <div class="listivo-service-v4__text">
                                        EOM one line description for each award that user has won from his carrier
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#seeMore").on("click", function() {
        var shortDescription = $("#shortDescription");
        var fullDescription = $("#fullDescription");
        var seeMoreLink = $("#seeMore");

        if (fullDescription.is(":visible")) {
            // Hide full description and show truncated
            fullDescription.hide();
            shortDescription.show();
            seeMoreLink.text("See More");
        } else {
            // Show full description and hide truncated
            fullDescription.show();
            shortDescription.hide();
            seeMoreLink.text("See Less");
        }
    });
});
let currentIndex = 0;

function showSlide(index) {
    const items = document.querySelectorAll('.carousel-item');
    if (index >= items.length) currentIndex = 0;
    else if (index < 0) currentIndex = items.length - 1;
    else currentIndex = index;

    const offset = -currentIndex * 100;
    document.querySelector('.carousel-items').style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
    showSlide(currentIndex + 1);
}

function prevSlide() {
    showSlide(currentIndex - 1);
}

// Initialize the first slide
showSlide(currentIndex);

</script>