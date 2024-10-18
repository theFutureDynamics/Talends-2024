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

global $wpdb;
$account_type = $wpdb->get_var($wpdb->prepare(
    "SELECT meta_value FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s",
    $data->ID,
    'account_type'
));


$experiences = $lstUser->getUserExperiences();
$educations = $lstUser->getUserEducation();
$servics = $lstUser->getUserExpertises();
$portfolios = $lstUser->getUserPortfolio();
$awards = $lstUser->getUserAwards();
$image_url = get_site_url() . '/wp-content/uploads/2022/08/award.png';
//print_r($educations);
?>

<style>/*! elementor - v3.23.0 - 05-08-2024 */
.elementor-widget-progress{text-align:start}.elementor-progress-wrapper{position:relative;background-color:#eee;color:#fff;height:100%;border-radius:2px}.elementor-progress-bar{display:flex;background-color:#69727d;width:0;font-size:11px;height:30px;line-height:30px;border-radius:2px;transition:width 1s ease-in-out}.elementor-progress-text{flex-grow:1;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;padding-inline-start:15px}.elementor-progress-percentage{padding-inline-end:15px}.elementor-widget-progress .elementor-progress-wrapper.progress-info .elementor-progress-bar{background-color:#5bc0de}.elementor-widget-progress .elementor-progress-wrapper.progress-success .elementor-progress-bar{background-color:#5cb85c}.elementor-widget-progress .elementor-progress-wrapper.progress-warning .elementor-progress-bar{background-color:#f0ad4e}.elementor-widget-progress .elementor-progress-wrapper.progress-danger .elementor-progress-bar{background-color:#d9534f}.elementor-progress .elementor-title{display:block}@media (max-width:767px){.elementor-progress-text{padding-inline-start:10px}}.e-con-inner .elementor-progress-wrapper,.e-con .elementor-progress-wrapper{height:auto}</style>

<style>

/* Container for aligning items */
.skills-container {
    display: flex;
    font-weight:bold;
    flex-wrap: wrap; /* Allow items to wrap to the next line */
    gap: 20px; /* Space between items */
    margin: 0 auto; /* Center the container */
    max-width: 1200px; /* Max width of the container */
}

/* Styling for each item */
.progress-item {
    flex: 1 1 calc(33.333% - 20px); /* 3 items per row with space between */
    min-width: 300px; /* Ensure a minimum width for responsiveness */
    box-sizing: border-box; /* Include padding and border in element's total width and height */
    margin: 10px; /* Spacing around each item */
}

/* Progress bar styling */
.elementor-progress-wrapper {
    background-color: #e0e0e0; /* Background color for the progress bar */
    border-radius: 5px; /* Rounded corners */
    overflow: hidden; /* Hide overflow to maintain rounded corners */
    margin-top:10px;
    height:auto;
}

.elementor-progress-bar {
    background-color: #59C23F; /* Color of the progress bar */
    height: 7px; /* Fixed height of the progress bar */
    line-height: 25px; /* Center text vertically */
    color: #fff; /* Text color inside the progress bar */
    text-align: center; /* Center text horizontally */
    border-radius: 5px; /* Rounded corners */
    transition: width 0.3s ease; /* Smooth transition for width changes */
}

/* Optional styling for progress text */
.elementor-progress-text,
.elementor-progress-percentage {
    display: inline-block; /* Align text and percentage inside the progress bar */
}

.carousel-container {
    position: relative;
    width: 80%;
    margin: auto;
    overflow: hidden;
    padding-top: 20px; /* Space for the slider controls */
}

.carousel {
    position: relative;
    width: 100%;
    /* display: flex; */
    align-items: center;
}

.carousel-items {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel-item {
    display: flex;
    align-items: center;
    min-width: 100%;
    box-sizing: border-box;
}

.carousel-image {
    width: 380px;
    height: 200px !important;
}

.carousel-content {
    width: 60%;
    padding: 20px;
}

.carousel-control {
    position: absolute;
    top: 20px;
    width: 30px;
    height: 40px;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    cursor: pointer;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.prev {
    right: 40px; /* Adjust based on your design */
}

.next {
    right: 10px;
}

.listivo-listing-features {
    display: flex;
    flex-wrap: wrap;
}

.listivo-listing-feature {
    flex: 1 1 100%; /* Full width on mobile */
    box-sizing: border-box; /* Ensure padding/margins are included in width */
}



@media (min-width: 768px) { /* Adjust the breakpoint as needed */
    .listivo-listing-feature {
        flex: 1 1 calc(33.33% - 20px); /* Three per row on larger screens */
        margin: 10px; /* Space between items */
    }

    .ewc {
        flex: auto; /* Three items per row on larger screens */
        max-width: calc(33.33% - 20px); /* Max width for larger screens */
    }

    
}

.listivo-mini-listing-carousel__nav {
    display: flex;
    justify-content: flex-end; /* Default to right alignment for larger screens */
    width: 100%;
}

.listivo-box-arrow {
    cursor: pointer; /* Optional: Makes it clear that the arrows are clickable */
}

@media (max-width: 768px) { /* Adjust this breakpoint as needed */
    .listivo-mini-listing-carousel__nav {
        justify-content: space-between; /* Use space-between on mobile */
    }
    .listivo-user-hero__content-wrapper {
        padding: 5% !important;
        text-align: center !important;
    }

    .carousel-container{
        width:100% !important;
    }

    .cls_about{
        width: 100% !important;
    }
    .edu_div {
        flex-wrap: wrap !important;
    }
    
}

.cls_about{
    width: 30%;
}
.listivo-content-v2__image-wrapper {
    max-width: 100%; /* Ensure it doesn’t exceed parent width */
    overflow: hidden; /* Hide overflow if necessary */
}

.listivo-content-v2__image {
    width: 100%; /* Make the image take full width of the container */
    height: auto; /* Maintain aspect ratio */
}

.listivo-content-v2__image img {
    width: 100%; /* Scale image to the width of its container */
    height: auto; /* Maintain aspect ratio */
    object-fit: cover; /* Ensures image covers the container without cutting off */
}


.listivo-user-hero__content-wrapper{
    padding:5%;
    text-align:left;
}

</style>
<div
    <?php if ($lstCurrentWidget->isFullWidth()) : ?>
        class="listivo-user-hero listivo-user-hero--full-width"
    <?php else : ?>
        class="listivo-user-hero"
    <?php endif; ?>
>
    <?php if ($lstCurrentWidget->decorationEnabled()) : ?>
        <div class="listivo-user-hero__decoration-container">
            <div class="listivo-user-hero__circle listivo-user-hero__circle--1"></div>

            <div class="listivo-user-hero__circle listivo-user-hero__circle--2"></div>

            <div class="listivo-user-hero__small-circle listivo-user-hero__small-circle--1"></div>

            <div class="listivo-user-hero__small-circle listivo-user-hero__small-circle--2"></div>

            <div class="listivo-user-hero__x listivo-user-hero__x--1">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none">
                    <path d="M13.7572 35.3434L9.63333 31.2196L31.2199 9.63304L35.3437 13.7569L13.7572 35.3434ZM9.0733 13.2478L13.299 9.02209L35.9547 31.6778L31.729 35.9035L9.0733 13.2478Z"
                          fill="#E6F0FA"/>
                </svg>
            </div>

            <div class="listivo-user-hero__x listivo-user-hero__x--2">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none">
                    <path d="M13.7572 35.3434L9.63333 31.2196L31.2199 9.63304L35.3437 13.7569L13.7572 35.3434ZM9.0733 13.2478L13.299 9.02209L35.9547 31.6778L31.729 35.9035L9.0733 13.2478Z"
                          fill="#E6F0FA"/>
                </svg>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($lstCurrentWidget->getBackgroundImage())) : ?>
        <div class="listivo-user-hero__top">
            <div class="listivo-user-hero__background">
                <img
                        class="lazyload"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAACCAQAAAA3fa6RAAAADklEQVR42mNkAANGCAUAACMAA2w/AMgAAAAASUVORK5CYII="
                        data-src="<?php echo esc_url($lstCurrentWidget->getBackgroundImage()); ?>"
                        alt=""
                >
            </div>
        </div>
    <?php endif; ?>

    <div class="listivo-user-hero__content-wrapper">
        <div
            <?php if (empty($lstCurrentWidget->getBackgroundImage())) : ?>
                class="listivo-user-hero__content listivo-user-hero__content--no-background"
            <?php else : ?>
                class="listivo-user-hero__content"
            <?php endif; ?>
        >
            <div class="listivo-user-hero__avatar">
            <?php if ($lstUser && $lstUser->hasImageUrl()) : ?>
                    <img
                            class="lazyload"
                            data-src="<?php echo esc_url($lstUser->getImageUrl('listivo_400_400')); ?>"
                            alt="<?php echo esc_attr($lstUser->getDisplayName()); ?>"
                    >
            <?php else : ?>
                <?php  RenderUserImage::render($lstUser, 'listivo_400_400', RenderUserImage::PLACEHOLDER_CIRCLE); ?>
            <?php endif; ?>

           
            </div>

            <h1 class="listivo-user-hero__name">
                <?php echo esc_html($lstUser->getDisplayName()); ?>
            </h1>

            <?php if ($lstCurrentWidget->showMemberSince() || (!empty($lstUser->getAddress()) && $lstCurrentWidget->showAddress())) : ?>
                <div class="listivo-user-hero__meta">
                    <?php if ($lstCurrentWidget->showMemberSince()) : ?>
                        <div class="listivo-user-hero__data">
                            <div class="listivo-user-hero__data-icon-wrapper">
                                <div class="listivo-user-hero__data-icon listivo-small-icon listivo-small-icon--circle listivo-small-icon--primary-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11"
                                         fill="none">
                                        <path d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 9.55469 1.76367 8.29688 2.90625 7.59375C3.24219 8.41797 4.06055 9 5 9C5.93945 9 6.75781 8.41797 7.09375 7.59375C8.23633 8.29688 9 9.55469 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1ZM5 7C5.41016 7 5.80078 7.05859 6.17188 7.17188C5.99805 7.6543 5.54492 8 5 8C4.45508 8 4.00195 7.6543 3.82812 7.17188C4.19922 7.05859 4.58984 7 5 7Z"
                                              fill="#FDFDFE"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="listivo-user-hero__data-text">
                                <?php echo esc_html(tdf_string('member_since') . ' ' . $lstUser->getRegistrationDateDiff()); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($lstUser->getAddress()) && $lstCurrentWidget->showAddress()) : ?>
                        <div class="listivo-user-hero__data">
                            <div class="listivo-user-hero__data-icon-wrapper">
                                <div class="listivo-user-hero__data-icon listivo-small-icon listivo-small-icon--circle listivo-small-icon--primary-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M5 0C2.24609 0 0 2.27981 0 5.07505C0 5.8601 0.316406 6.72048 0.753906 7.62843C1.19141 8.54036 1.76172 9.49193 2.33594 10.3602C3.47656 12.1008 4.61328 13.5163 4.61328 13.5163L5 14L5.38672 13.5163C5.38672 13.5163 6.52344 12.1008 7.66797 10.3602C8.23828 9.49193 8.80859 8.54036 9.24609 7.62843C9.68359 6.72048 10 5.8601 10 5.07505C10 2.27981 7.75391 0 5 0ZM5 1.01514C7.21484 1.01514 9 2.82709 9 5.07518C9 5.55096 8.75391 6.33997 8.34766 7.18449C7.94141 8.03298 7.38672 8.95283 6.83594 9.80132C5.99563 11.0789 5.40082 11.8315 5.08146 12.2356L5 12.3388L4.91854 12.2356C4.59919 11.8315 4.00437 11.0789 3.16406 9.80132C2.61328 8.95283 2.05859 8.03298 1.65234 7.18449C1.24609 6.33997 1 5.55096 1 5.07518C1 2.82709 2.78516 1.01514 5 1.01514ZM4.00002 5.06006C4.00002 4.50928 4.44924 4.06006 5.00002 4.06006C5.5508 4.06006 6.00002 4.50928 6.00002 5.06006C6.00002 5.61084 5.5508 6.06006 5.00002 6.06006C4.44924 6.06006 4.00002 5.61084 4.00002 5.06006Z"
                                              fill="#FDFDFE"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="listivo-user-hero__data-text">
                                <?php echo esc_html($lstUser->getLocation()); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="listivo-user-hero__content-wrapper">
            <div style="width: 100%; margin-top: 5%; padding: 20px; box-sizing: border-box; background-color: #f4f4f4; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" class="elementor-element elementor-element-77d10121 elementor-widget elementor-widget-lst_listing_features" data-element_type="widget" data-widget_type="lst_listing_features.default">
                <div class="elementor-widget-container">
                <div class="elementor-widget-container">
                    <div class="listivo-heading-v2-wrapper"  style="margin-bottom:50px">
                            <div class="listivo-heading-v2 listivo-heading-v2--center listivo-heading-v2--tablet-center listivo-heading-v2--mobile-center">
                                <h2 class="listivo-heading-v2__text">
                                   About
                                </h2>
                            </div>
                        </div>		
                    </div>
                    <!-- <h3 style="font-size: 28px; color: #2c3e50; margin-bottom: 20px; font-family: 'Arial', sans-serif; font-weight: 600; text-align: center;" class="listivo-listing-simple-label">Talends Activity</h3> -->
                    <?php if (!empty($lstUser->getDescription())) :
                        // Fetch the description from the user object
                            $description = $lstUser->getDescription();

                            // Truncate the description to 1000 characters if it's longer
                            $truncatedDescription = (strlen($description) > 1000) ? substr($description, 0, 1000) . '...' : $description;
                        ?>
                        <div class="listivo-user-profile__description" id="descriptionContainer">
                            <span id="shortDescription"><?php echo wp_kses_post($truncatedDescription); ?></span>
                            <span id="fullDescription" style="display:none;"><?php echo wp_kses_post($description); ?></span>
                        </div>
                        <div class="listivo-user-profile__description" style="
                            margin-bottom: 20px;
                        "><a href="javascript:void(0)" id="seeMore" style="
                            color: #59C23F;
                            font-size: 15px;
                            font-weight: bold;
                            margin: 0px;
                            cursor:pointer;
                            text-decoration: underline; /* Adds underline */
                        ">See More</a>
                        </div>

                    <?php endif; ?>

                    <div style="width:100%;margin-top:5%" class="elementor-element elementor-element-77d10121 elementor-widget elementor-widget-lst_listing_features" data-id="77d10121" data-element_type="widget" data-widget_type="lst_listing_features.default">
                            <div class="elementor-widget-container" style="text-align:left;">
                                <div class="listivo-listing-features">
                                <?php if($lstUser->getTotalJobsDelivered()): ?>
                                        <div class="cls_about">
                                            <div class="listivo-listing-feature">
                                                <div class="listivo-listing-feature__icon-wrapper">
                                                    <div class="listivo-listing-feature__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="listivo-listing-feature__text">
                                                    <?php echo 'Total Jobs <b style="font-size:18px">'.$lstUser->getTotalJobsDelivered().'</b>' ; ?>
                                                </div>
                                            </div>

                                            
                                        
                                        
                                        </div>
                                        <?php endif; ?>
                                        <?php if($lstUser->getJoined()): ?>
                                        <div class="cls_about">
                                            <div class="listivo-listing-feature">
                                                <div class="listivo-listing-feature__icon-wrapper">
                                                    <div class="listivo-listing-feature__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="listivo-listing-feature__text">
                                                    <?php echo 'Founded in <b style="font-size:18px">'.$lstUser->getJoined().'</b>' ; ?>
                                                </div>
                                            </div>  
                                        </div>
                                        <?php endif; ?>

                                        <?php if($lstUser->getCompanyDetails()): ?>
                                        <div class="cls_about">
                                            <div class="listivo-listing-feature">
                                                <div class="listivo-listing-feature__icon-wrapper">
                                                    <div class="listivo-listing-feature__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="listivo-listing-feature__text">
                                                    <?php echo 'Company Information <b style="font-size:18px">'.$lstUser->getCompanyDetails().'</b>' ; ?>
                                                </div>
                                            </div>  
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if($lstUser->getBudget()): ?>
                                        <div class="cls_about">
                                            <div class="listivo-listing-feature">
                                                <div class="listivo-listing-feature__icon-wrapper">
                                                    <div class="listivo-listing-feature__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="listivo-listing-feature__text">
                                                    <?php echo 'Budget <b style="font-size:18px">$'.$lstUser->getBudget().'</b>'; ?>
                                                </div>
                                            </div>  
                                        </div>
                                        <?php endif; ?>

                                    

                                        <?php if($lstUser->getClientFocus()): ?>
                                        <div class="cls_about">
                                            <div class="listivo-listing-feature">
                                                <div class="listivo-listing-feature__icon-wrapper">
                                                    <div class="listivo-listing-feature__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="listivo-listing-feature__text">
                                                    <?php echo 'Client Focus <b style="font-size:18px">'.ucwords(str_replace('_', ' ', implode(", ", $lstUser->getClientFocus()))).'</b>' ; ?>
                                                </div>
                                            </div>  
                                        </div>
                                        <?php endif; ?>
                                        
                                        
                                        <?php if($lstUser->getDepartment()): ?>
                                        <div class="cls_about">
                                            <div class="listivo-listing-feature">
                                                <div class="listivo-listing-feature__icon-wrapper">
                                                    <div class="listivo-listing-feature__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="listivo-listing-feature__text">
                                                    <?php echo 'Department Details <b style="font-size:18px">'.$lstUser->getDepartment().'</b>'; ?>
                                                </div>
                                            </div>  
                                        </div>
                                        <?php endif; ?>

                                    

                                        <?php if($lstUser->getJobType()): ?>
                                        <div class="cls_about">
                                            <div class="listivo-listing-feature">
                                                <div class="listivo-listing-feature__icon-wrapper">
                                                    <div class="listivo-listing-feature__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="listivo-listing-feature__text">
                                                    <?php echo 'Job Preferences <b style="font-size:18px">'.implode(", ", $lstUser->getJobType()).'</b>'; ?>
                                                </div>
                                            </div>  
                                        </div>
                                        <?php endif; ?>

                                    

                                        <?php if($lstUser->getHourlyRate()): ?>
                                        <div class="cls_about">
                                            <div class="listivo-listing-feature">
                                                <div class="listivo-listing-feature__icon-wrapper">
                                                    <div class="listivo-listing-feature__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="listivo-listing-feature__text">
                                                    <?php echo 'Hourly Rate <b style="font-size:18px">$'.$lstUser->getHourlyRate().'</b>'; ?>
                                                </div>
                                            </div>  
                                        </div>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    
                
                
                    <?php if($lstUser->getAgencyFounded()): ?>
                    <div class="listivo-listing-feature__text" style="font-size: 18px; color: #34495e; margin-bottom: 15px; display:none;">
                        <span style="color: #e74c3c; font-weight: 500;">Year Founded:</span> <?php echo $lstUser->getAgencyFounded(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if(count($servics) > 0 && $account_type =='business'): ?>
                <div style="width: 100%; margin-top: 5%; padding: 20px; box-sizing: border-box; background-color: #f4f4f4; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" class="elementor-element elementor-element-77d10121 elementor-widget elementor-widget-lst_listing_features" data-element_type="widget" data-widget_type="lst_listing_features.default">
                    <div class="elementor-widget-container">

                        <div class="listivo-heading-v2-wrapper"  style="margin-bottom:50px">
                            <div class="listivo-heading-v2 listivo-heading-v2--center listivo-heading-v2--tablet-center listivo-heading-v2--mobile-center">
                                <h2 class="listivo-heading-v2__text">
                                Services
                                </h2>
                            </div>
                        </div>		
                        
                        <?php foreach($servics as $eachService): ?>
                        <div class="elementor-element elementor-element-29a0da15 elementor-widget elementor-widget-lst_accordion" data-id="29a0da15" data-element_type="widget" data-widget_type="lst_accordion.default">
                                
                            <div class="elementor-widget-container">
                                <div>
                                    <div class="listivo-accordions listivo-accordions">
                                        <div class="listivo-user-profile__description">
                                                <div>
                                                    <h3 class="listivo-accordion__label">
                                                    <?php echo $eachService['expertise_title']; ?>
                                                    </h3> 
                                                
                                                </div> 
                                                <div  style="padding-top:0px;">
                                                <?php echo $eachService['expertise_description']; ?>                     
                                                </div>
                                        </div>
                                    </div>
                                </div>       
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($lstUser->getUserSkills() && count($lstUser->getUserSkills()) > 0): ?>
                <div class="elementor-element elementor-element-51cd12f elementor-widget elementor-widget-progress" style="width: 100%; margin-top: 5%; padding: 20px; box-sizing: border-box; background-color: #f4f4f4; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" data-id="51cd12f" data-element_type="widget" data-widget_type="progress.default">
                    <div class="listivo-heading-v2-wrapper" style="margin-bottom:15px">
                            <div class="listivo-heading-v2 listivo-heading-v2--center listivo-heading-v2--tablet-center listivo-heading-v2--mobile-center">
                                <h2 class="listivo-heading-v2__text">
                                   Skills
                                </h2>
                            </div>
                        </div>		
                 
                    <div class="skills-container">
                        <?php foreach ($lstUser->getUserSkills() as $row): ?>
                            <?php
                            $rating = intval($row['rating']);
                            $label = htmlspecialchars($row['label']);
                            $id = htmlspecialchars($row['id']);
                            ?>
                            <div class="elementor-widget-container ewc" style="flex: auto;">
                                <div class="progress-item" style="display:contents; width:100%">
                                    <div class="listivo-service-v8__text" id="elementor-progress-bar-<?php echo $id; ?>">
                                    <?php echo html_entity_decode($label) . ' (' . intval($rating) . '%)'; ?>
                                    </div>
                                    <div class="elementor-progress-wrapper">
                                        <div class="elementor-progress-bar" style="width: <?php echo $rating; ?>%;">
                                            <span class="elementor-progress-text"><?php // echo $label; ?></span>
                                            <span class="elementor-progress-percentage"><?php // echo $rating; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            
            <?php if($experiences): ?>
                <div style="width: 100%; margin-top: 5%; padding: 20px; box-sizing: border-box; background-color: #f4f4f4; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" class="elementor-element elementor-element-77d10121 elementor-widget elementor-widget-lst_listing_features" data-id="77d10121" data-element_type="widget" data-widget_type="lst_listing_features.default">
                    <div class="elementor-widget-container">
                        <div class="listivo-heading-v2-wrapper"  style="margin-bottom:50px">
                                <div class="listivo-heading-v2 listivo-heading-v2--center listivo-heading-v2--tablet-center listivo-heading-v2--mobile-center">
                                    <h2 class="listivo-heading-v2__text">
                                    Experiences
                                    </h2>
                                </div>
                            </div>
                        <div class="listivo-listing-features">
                            <?php foreach($experiences as $eachExp): ?>
                                <div>
                                    <div class="listivo-listing-feature">
                                        <div class="listivo-listing-feature__icon-wrapper">
                                            <div class="listivo-listing-feature__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                    <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="listivo-listing-feature__text">
                                            <?php echo $eachExp['job_title'] ?> ( <?php echo $eachExp['start_date'] ; ?> - <?php if(!empty($eachExp['end_date']) && $eachExp['end_date'] !== '0000-00-00') { echo $eachExp['end_date']; }else { echo 'Present';} ?>  )
                                        </div>
                                    </div>
                                    <?php if($eachExp['company_title']): ?>
                                        <div class="listivo-listing-card-v4__content" style="padding-left:0px;">
                                            <h3 class="listivo-listing-card-v4__name listivo-listing-card-name-selector">
                                            <?php echo $eachExp['company_title']; ?>                    
                                            </h3>
                                        </div>                        
                                    <?php endif; ?>
                                    <?php if(!empty($eachExp['description'])): ?>
                                        <div class="listivo-content-v2__text" style="margin-top:0px;">
                                        <?php echo $eachExp['description']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(count($portfolios)): ?>
                <div style="width: 100%; margin-top: 5%; padding: 20px; box-sizing: border-box; background-color: #f4f4f4; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" class="elementor-element elementor-element-77d10121 elementor-widget elementor-widget-lst_listing_features" data-id="77d10121" data-element_type="widget" data-widget_type="lst_listing_features.default">
                    <div class="elementor-widget-container">
                        <div class="listivo-heading-v2-wrapper">
                            <div class="listivo-heading-v2 listivo-heading-v2--center listivo-heading-v2--tablet-center listivo-heading-v2--mobile-center">
                                <h2 class="listivo-heading-v2__text">
                                   Portfolio
                                </h2>
                            </div>
                        </div>	
                        
                        <div class="listivo-mini-listing-carousel__nav" >
                            <div class="listivo-box-arrow" onclick="prevSlide()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                                    <path d="M4.86195 10.4713C4.99228 10.6017 5.16262 10.6667 5.33329 10.6667C5.50395 10.6667 5.67429 10.6017 5.80462 10.4713C6.06496 10.211 6.06496 9.78898 5.80462 9.52865L2.27593 5.99996H11.3333C11.7013 5.99996 12 5.70129 12 5.33329C12 4.96528 11.7013 4.66662 11.3333 4.66662H2.27593L5.80462 1.13792C6.06496 0.877589 6.06496 0.455586 5.80462 0.195251C5.54429 -0.0650838 5.12229 -0.0650838 4.86195 0.195251L0.195251 4.86195C-0.0650838 5.12229 -0.0650838 5.54429 0.195251 5.80462L4.86195 10.4713Z"></path>
                                </svg>
                            </div> 
                            <div onclick="nextSlide()" class="listivo-box-arrow listivo-box-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none"><path d="M7.13805 10.4713C7.00772 10.6017 6.83738 10.6667 6.66671 10.6667C6.49604 10.6667 6.32571 10.6017 6.19538 10.4713C5.93504 10.211 5.93504 9.78898 6.19538 9.52865L9.72407 5.99996H0.666672C0.298669 5.99996 0 5.70129 0 5.33329C0 4.96528 0.298669 4.66662 0.666672 4.66662H9.72407L6.19538 1.13792C5.93504 0.877589 5.93504 0.455587 6.19538 0.195251C6.45571 -0.0650838 6.87771 -0.0650838 7.13805 0.195251L11.8047 4.86195C12.0651 5.12229 12.0651 5.54429 11.8047 5.80462L7.13805 10.4713Z"></path></svg>
                            </div>
                        </div>

                        <div class="carousel-container">
                            <div class="carousel">
                                <div class="carousel-items">
                                    <?php foreach($portfolios as $eachPortfolio):  ?>
                                    <div class="carousel-item">
                                       

                                        <div class="elementor-element elementor-element-b41b050 elementor-widget elementor-widget-lst_content_v2" data-id="b41b050" data-element_type="widget" data-widget_type="lst_content_v2.default">
                                            <div class="elementor-widget-container">
                                                <div class="listivo-content-v2">
                                                    <div class="listivo-content-v2__image-wrapper">
                                                        <div class="listivo-content-v2__image">
                                                        <img decoding="async" class=" ls-is-cached lazyloaded" src="<?php echo $eachPortfolio['portfolio_image']; ?>"  alt="Portfolio" style="aspect-ratio: 1024 / 683">
                                                        </div>
                                                    </div>
                                                    <div class="listivo-content-v2__content">
                                                        <!-- <div class="listivo-content-v2__heading">
                                                            <div class="listivo-heading-v2 listivo-heading-v2--left listivo-heading-v2--tablet-center">
                                                                <h2 class="listivo-heading-v2__text">
                                                                    Celebration of A UAE flag day                
                                                                </h2>
                                                            </div>
                                                        </div> -->
                                                        <div class="listivo-content-v2__text">
                                                        <?php echo $eachPortfolio['portfolio_description']; ?>            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                    </div>
                                    <?php endforeach; ?>
                                    <!-- <div class="carousel-item">
                                        <img src="image2.jpg" alt="Portfolio 2" class="carousel-image">
                                        <div class="carousel-content">
                                            <h2>Portfolio 2</h2>
                                            <p>Description for portfolio item 2.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="image3.jpg" alt="Portfolio 3" class="carousel-image">
                                        <div class="carousel-content">
                                            <h2>Portfolio 3</h2>
                                            <p>Description for portfolio item 3.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="image4.jpg" alt="Portfolio 4" class="carousel-image">
                                        <div class="carousel-content">
                                            <h2>Portfolio 4</h2>
                                            <p>Description for portfolio item 4.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="image5.jpg" alt="Portfolio 5" class="carousel-image">
                                        <div class="carousel-content">
                                            <h2>Portfolio 5</h2>
                                            <p>Description for portfolio item 5.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="image6.jpg" alt="Portfolio 6" class="carousel-image">
                                        <div class="carousel-content">
                                            <h2>Portfolio 6</h2>
                                            <p>Description for portfolio item 6.</p>
                                        </div>
                                    </div> -->
                                </div>
                                
                            </div>
                        </div>

                        

                        <!-- <div style="margin:50px">
                            <button class="carousel-control prev" style="background:#59C23F" onclick="prevSlide()">&#10094;</button>
                            <button class="carousel-control next" style="background:#59C23F" onclick="nextSlide()">&#10095;</button>
                        </div> -->
                    </div>
                </div>
            <?php endif; ?>
            <?php if($account_type =='business' && !empty($lstUser->getTeamInfo())): ?>
                <div style="width: 100%; margin-top: 5%; padding: 20px; box-sizing: border-box; background-color: #f4f4f4; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" class="elementor-element elementor-element-77d10121 elementor-widget elementor-widget-lst_listing_features" data-id="77d10121" data-element_type="widget" data-widget_type="lst_listing_features.default">
                    <div class="elementor-widget-container">
                        <div class="listivo-heading-v2-wrapper">
                            <div class="listivo-heading-v2 listivo-heading-v2--center listivo-heading-v2--tablet-center listivo-heading-v2--mobile-center">
                                <h2 class="listivo-heading-v2__text">
                                
                                Team
                                </h2>
                            </div>
                        </div>		
                        <div class="listivo-content-v2__text">
                            <?php echo $lstUser->getTeamInfo(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($educations && $account_type == 'regular'): ?>
                <div class="elementor-element elementor-element-51cd12f elementor-widget elementor-widget-progress" style="width: 100%; margin-top: 5%; padding: 20px; box-sizing: border-box; background-color: #f4f4f4; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" data-id="51cd12f" data-element_type="widget" data-widget_type="progress.default">
                        <div class="elementor-widget-container">
                        <div class="listivo-heading-v2-wrapper" style="margin-bottom:50px">
                                <div class="listivo-heading-v2 listivo-heading-v2--center listivo-heading-v2--tablet-center listivo-heading-v2--mobile-center">
                                    <h2 class="listivo-heading-v2__text">
                                    Educations
                                    </h2>
                                </div>
                            </div>

                        <div class="listivo-listing-features edu_div" style="flex-wrap: nowrap">
                            <?php foreach($educations as $education): ?>
                            <div class="listivo-listing-feature">
                                <div class="listivo-listing-feature__icon-wrapper">
                                    <div class="listivo-listing-feature__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                            <path d="M10.6633 0.000289842C10.4901 0.0054506 10.3257 0.0778367 10.205 0.202113L3.34299 7.06409L1.14768 4.86878C1.08625 4.8048 1.01267 4.75372 0.931251 4.71853C0.849832 4.68334 0.76221 4.66474 0.673516 4.66384C0.584823 4.66294 0.49684 4.67974 0.414722 4.71327C0.332604 4.7468 0.258001 4.79637 0.195282 4.85909C0.132563 4.92181 0.0829883 4.99641 0.0494622 5.07853C0.0159361 5.16065 -0.000867871 5.24863 3.45076e-05 5.33732C0.000936886 5.42602 0.0195273 5.51364 0.0547172 5.59506C0.0899072 5.67648 0.140989 5.75006 0.204971 5.81149L2.87164 8.47816C2.99667 8.60313 3.16621 8.67334 3.34299 8.67334C3.51977 8.67334 3.68932 8.60313 3.81435 8.47816L11.1477 1.14482C11.244 1.05118 11.3098 0.930619 11.3365 0.798939C11.3631 0.667259 11.3493 0.530603 11.297 0.406879C11.2446 0.283156 11.1561 0.178136 11.043 0.105583C10.9299 0.0330305 10.7976 -0.0036704 10.6633 0.000289842Z" fill="#FDFDFE"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="listivo-listing-feature__text">
                                    <?php echo $education['degree_title'] ?> ( <?php echo $education['education_start_date'] ; ?> - <?php if(!empty($education['education_end_date']) && $education['education_end_date'] !== '0000-00-00') { echo $education['education_end_date']; }else { echo 'Present';} ?>  )
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <div class="elementor-element elementor-element-aa918a9 elementor-widget elementor-widget-spacer" data-id="aa918a9" data-element_type="widget" data-widget_type="spacer.default">
            <div class="elementor-widget-container">
                <div class="elementor-spacer">
                    <div class="elementor-spacer-inner"></div>
                </div>
            </div>
        </div>
        <?php if(count($awards) > 0): ?>

            <div class="elementor-element elementor-element-6057b14 elementor-widget elementor-widget-lst_services_v4" data-id="6057b14" data-element_type="widget" data-widget_type="lst_services_v4.default" style="width: 100%; margin-top: 5%; padding: 20px; box-sizing: border-box; background-color: #f4f4f4; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="elementor-widget-container" style="padding-top:20px;">
                    <div class="listivo-services-v4">
                    <div class="listivo-heading-v2-wrapper" style="margin-bottom:50px">
                                <div class="listivo-heading-v2 listivo-heading-v2--center listivo-heading-v2--tablet-center listivo-heading-v2--mobile-center">
                                    <h2 class="listivo-heading-v2__text">
                                    Awards
                                    </h2>
                                </div>
                            </div>
                        <div class="listivo-services-v4__list">
                            <div class="listivo-service-v4">
                                <div class="listivo-service-v4__image">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="Award2">
                                </div>
                                <h3 class="listivo-service-v4__label">
                                    Awards1                
                                </h3>
                                <div class="listivo-content-v2__text" style="text-align:center;">
                                    <?php  echo @$awards['award_title1']; ?>                                           
                                </div>
                            </div>
                            <div class="listivo-service-v4">
                            <div class="listivo-service-v4__image">
                                <img src="<?php echo esc_url($image_url); ?>" alt="Award2">
                            </div>
                            <h3 class="listivo-service-v4__label">
                                Award2                
                            </h3>
                            <div class="listivo-content-v2__text" style="text-align:center;">
                            <?php  echo @$awards['award_title2']; ?>                                            
                            </div>
                            </div>
                            <div class="listivo-service-v4">
                            <div class="listivo-service-v4__image">
                                <img src="<?php echo esc_url($image_url); ?>" alt="Awards3">
                            </div>
                            <h3 class="listivo-service-v4__label">
                                Awards3                
                            </h3>
                            <div class="listivo-content-v2__text" style="text-align:center;">
                            <?php  echo @$awards['award_title3']; ?>                                         
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php ?>
        
        


            

            <?php if ($lstCurrentWidget->showSocial()) : ?>
                <div class="listivo-user-hero__socials">
                    <div class="listivo-social-icons-wrapper">
                        <div class="listivo-social-icons">
                            <?php if (!empty($lstUser->getFacebookProfile()))  : ?>
                                <a
                                        class="listivo-social-icons__icon listivo-social-icon listivo-social-icon--color-1 listivo-social-icon--hover-color-primary"
                                        href="<?php echo esc_url($lstUser->getFacebookProfile()); ?>"
                                        target="_blank"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($lstUser->getTwitterProfile()))  : ?>
                                <a
                                        class="listivo-social-icons__icon listivo-social-icon listivo-social-icon--color-1 listivo-social-icon--hover-color-primary"
                                        href="<?php echo esc_url($lstUser->getTwitterProfile()); ?>"
                                        target="_blank"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($lstUser->getLinkedInProfile()))  : ?>
                                <a
                                        class="listivo-social-icons__icon listivo-social-icon listivo-social-icon--color-1 listivo-social-icon--hover-color-primary"
                                        href="<?php echo esc_url($lstUser->getLinkedInProfile()); ?>"
                                        target="_blank"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($lstUser->getInstagramProfile()))  : ?>
                                <a
                                        class="listivo-social-icons__icon listivo-social-icon listivo-social-icon--color-1 listivo-social-icon--hover-color-primary"
                                        href="<?php echo esc_url($lstUser->getInstagramProfile()); ?>"
                                        target="_blank"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($lstUser->getYouTubeProfile()))  : ?>
                                <a
                                        class="listivo-social-icons__icon listivo-social-icon listivo-social-icon--color-1 listivo-social-icon--hover-color-primary"
                                        href="<?php echo esc_url($lstUser->getYouTubeProfile()); ?>"
                                        target="_blank"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($lstUser->getTiktokProfile())) : ?>
                                <a
                                        class="listivo-social-icons__icon listivo-social-icon listivo-social-icon--color-1 listivo-social-icon--hover-color-primary"
                                        href="<?php echo esc_url($lstUser->getTiktokProfile()); ?>"
                                        target="_blank"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($lstUser->getTelegramProfile())) : ?>
                                <a
                                        class="listivo-social-icons__icon listivo-social-icon listivo-social-icon--color-1 listivo-social-icon--hover-color-primary"
                                        href="<?php echo esc_url($lstUser->getTelegramProfile()); ?>"
                                        target="_blank"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
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
