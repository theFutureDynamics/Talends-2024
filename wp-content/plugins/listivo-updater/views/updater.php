<?php
$listivoUpdaterNotice = get_option('listivo_updater_notice');
update_option('listivo_updater_notice', '0');
?>
<style>
    body {
        background: #fff !important;
    }

    #wpfooter {
        display: none !important;
    }

    #wpbody-content {
        padding-bottom: 0 !important;
    }

    #wpcontent {
        padding-left: 0 !important;
    }

    .error,
    .notice,
    .updated,
    .update-nag {
        display: none !important;
    }

    .clearfix::after {
        display: block;
        content: "";
        clear: both;
    }

    h1 {
        font-size: 36px;
        margin-bottom: 20px;
        margin-top: 0;
        font-size: 36px;
        height: 36px;
        float: left;
        width: 100%;
    }

    .listivo-updater-container {
        padding: 60px
    }

    .listivo-updater__box {
        max-width: 770px;
        min-height: 92px;
        border: 1px solid #D9E2EC;
        padding: 40px;
        border-radius: 5px;
        font-size: 16px;
        line-height: 22px;
        background: #f3f3f3;
        color: #23282d;
    }
</style>

<div class="listivo-updater-container">
    <h1><?php esc_html_e('Listivo Updater', 'listivo-updater'); ?></h1>
    <div class="clearfix"></div>
    <div class="listivo-updater__box">
        <div>
            <form
                    action="<?php echo esc_url(admin_url('admin-post.php?action=listivo_updater_save_purchase_code')); ?>"
                    method="post"
            >
                <div style="margin:0 0 10px 0">
                    <strong><?php esc_html_e('Enter your purchase code', 'listivo-updater'); ?></strong>
                </div>

                <div>
                    <input
                            placeholder="e.g. 10101010-10aa-0101-01010-a1b010a01b10"
                            name="purchase_code"
                            style="padding: 6px 10px; width: 400px; font-size: 16px;"
                            type="text"
                            value="<?php echo esc_attr(listivo_get_purchase_code()); ?>"
                    >
                    <button class="tdf-button-save">
                        <?php esc_html_e('Save', 'listivo-updater'); ?>
                    </button>
                </div>

                <?php if (!empty(get_option('listivo_invalid_purchase_code'))) : ?>
                    <div>
                        <h3 style="color: #23282d; font-size: 2em; line-height: 2em; margin: 30px 0 30px 0; font-weight: 900;">Invalid purchase code</h3>
                    </div>
                <?php endif; ?>


                <ul style="margin:20px 0 0 0;">
                    <li style="margin-bottom:10px;">
                        <a
                                target="_blank"
                                href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-"
                        >
                            Where to find the purchase code?
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://listivotheme.com">
                            Where to buy a legal Listivo WordPress Theme?
                        </a>
                    </li>
                </ul>
                <div style="margin-top:30px;">
                    If you have any question or problem please email
                    us via <a style="font-weight:500; text-decoration:underline!important;"
                            target="_blank"
                              href="https://support.listivotheme.com/support/tickets/new">Support Contact Form</a>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty(listivo_get_purchase_code()) && empty(get_option('listivo_invalid_purchase_code'))) : ?>
        <div class="listivo-updater__box" style="margin-top:30px">
            <div>
                <div class="listivo-updater-app">
                    <div>
                        <listivo-updater
                                :plugins="<?php echo htmlspecialchars(json_encode(listivo_updater_get_plugins())); ?>"
                                theme-status="<?php echo esc_attr(listivo_updater_get_theme_status()); ?>"
                                query-url="<?php echo esc_url(admin_url('admin-post.php?action=')); ?>"
                        >
                            <div slot-scope="updater">
                                <div>
                                    With each new Listivo update comes new features, options, code improvements and fixes.
                                </div>
                                <div style="margin-top:20px;">
                                    <a
                                            v-if="updater.showUpdateButton"
                                            href="<?php echo esc_url(admin_url('admin-post.php?action=listivo_check_updates')); ?>"
                                            class="tdf-button-add"
                                            style="float:left; margin-bottom:0;"
                                    >
                                        <?php esc_html_e('Check for new updates', 'listivo-updater'); ?>
                                    </a>
                                </div>
                                <div class="clearfix"></div>

                                <?php if (listivo_require_update()) : ?>
                                    <div>
                                        <template>

                                            <h2 v-if="updater.showFinished"
                                                style="margin: 30px 0px 30px; border-top: 2px solid white; padding-top: 30px;">
                                                Update was finished successfully!</h2>

                                            <div v-if="updater.showUpdateButton">
                                                <h2 style="margin: 30px 0px 30px; border-top: 2px solid white; padding-top: 30px;">
                                                    New update for Listivo Theme is available!</h2>

                                                <div>

                                                    The update will remove <strong>/wp-content/themes/listivo/</strong>
                                                     folder and install in this place a brand new version of a theme.
                                                    All added/modified pages, listings, theme settings will work correctly after the update. Please consider that if you
                                                    are a developer and you customized files in the <strong>/wp-content/themes/listivo/</strong> folder - the customizations will be lost.
                                                    Please make sure that customized files (e.g., PHP files) are stored in the <a target="_blank"
                                                                                          href="https://support.listivotheme.com/support/solutions/articles/101000373821">Child
                                                        Theme</a>.
                                                </div>
                                                <div style="margin-top:30px">
                                                    Are you ready to update the theme and all plugins to the newest version?
                                                </div>

                                                <div style="margin-top:30px;">
                                                    <button
                                                            @click="updater.onStart"
                                                            class="tdf-button-add"
                                                    >
                                                        <?php esc_html_e('Yes - Update Listivo Theme Now', 'listivo-updater'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <h2 style="margin: 30px 0px 30px; border-top: 2px solid white; padding-top: 30px;"
                                                v-if="updater.updateInProgress"
                                                class="listivo-importer__progress"
                                            >
                                                <i class="fas fa-spinner fa-spin mr-3"></i>
                                                <?php esc_html_e('Update In Progress...', 'listivo-updater'); ?>
                                            </h2>
                                            <div class="clearfix"></div>
                                        </template>
                                    </div>
                                <?php elseif (!empty($listivoUpdaterNotice)) : ?>
                                    <h2 style="margin: 30px 0px 30px; border-top: 2px solid white; padding-top: 30px;">
                                        You are using the latest version of Listivo Theme
                                        (<?php echo LISTIVO_VERSION; ?>).</h2>
                                <?php endif; ?>
                            </div>
                        </listivo-updater>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>