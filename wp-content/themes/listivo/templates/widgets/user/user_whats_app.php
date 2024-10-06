<?php


use Tangibledesign\Listivo\Widgets\User\UserWhatsAppWidget;

/* @var UserWhatsAppWidget $lstCurrentWidget */
global $lstCurrentWidget;
$lstUser = $lstCurrentWidget->getUser();

if (!$lstUser || !$lstUser->hasWhatsApp() || tdf_settings()->disableWhatsApp()) {
    return;
}

$lstModel = $lstCurrentWidget->getModel();
$lstInitialMessage = $lstCurrentWidget->getInitialMessage($lstModel);
?>
<a
        class="listivo-contact-button"
        href="https://wa.me/<?php echo esc_attr($lstUser->getWhatsAppUrl()); ?>?text=<?php echo esc_attr($lstInitialMessage); ?>"
        target="_blank"
>
    <div class="listivo-contact-button__inner">
        <div class="listivo-contact-button__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M17.0866 2.90667C15.2051 1.0337 12.7051 0 10.0423 0C4.55404 0 0.0846358 4.44589 0.0846358 9.90927C0.08138 11.6559 0.540365 13.3603 1.41276 14.8639L0 20L5.27995 18.6196C6.73177 19.4102 8.3724 19.825 10.0391 19.8283H10.0423C15.5306 19.8283 19.9967 15.3824 20 9.91575C20 7.26831 18.9648 4.77965 17.0866 2.90667ZM10.0423 18.1529H10.0391C8.55469 18.1529 7.09635 17.7544 5.82682 17.0058L5.52409 16.8276L2.38932 17.6442L3.22591 14.6047L3.0306 14.2936C2.20052 12.9812 1.76432 11.4647 1.76432 9.90927C1.76432 5.36941 5.47852 1.67531 10.0456 1.67531C12.2559 1.67531 14.3327 2.53403 15.8952 4.08944C17.4577 5.64809 18.3171 7.71549 18.3171 9.91575C18.3171 14.4588 14.6029 18.1529 10.0423 18.1529ZM14.5801 11.9831C14.3327 11.86 13.1087 11.2605 12.8809 11.1795C12.653 11.0953 12.487 11.0564 12.321 11.3027C12.1549 11.5522 11.6797 12.1095 11.5332 12.2748C11.39 12.4368 11.2435 12.4595 10.9961 12.3364C10.7454 12.2132 9.94466 11.9507 8.99414 11.105C8.25521 10.4504 7.75391 9.63707 7.61068 9.3908C7.46419 9.14128 7.5944 9.00843 7.7181 8.88529C7.83203 8.77511 7.96875 8.59689 8.09245 8.45107C8.21615 8.30849 8.25846 8.2048 8.3431 8.03953C8.42448 7.87427 8.38216 7.72845 8.32031 7.60531C8.25846 7.48218 7.76042 6.26053 7.55208 5.76474C7.35026 5.28192 7.14518 5.34997 6.99219 5.34025C6.84896 5.33377 6.68294 5.33377 6.51693 5.33377C6.35091 5.33377 6.08073 5.39533 5.85287 5.64485C5.625 5.89112 4.98372 6.4906 4.98372 7.70901C4.98372 8.92741 5.87565 10.1069 5.99935 10.2722C6.12305 10.4342 7.75391 12.9358 10.2507 14.0084C10.8431 14.2644 11.3053 14.4167 11.6667 14.5301C12.2624 14.7181 12.806 14.6922 13.2357 14.6306C13.7142 14.5593 14.707 14.0311 14.9154 13.4511C15.1204 12.8743 15.1204 12.3785 15.0586 12.2748C14.9967 12.1711 14.8307 12.1095 14.5801 11.9831Z"
                      fill="#2A3946"/>
            </svg>
        </div>

        <?php echo esc_html(tdf_string('chat_via_whatsapp')); ?>
    </div>
</a>