<?php
/* @var \Tangibledesign\Listivo\Widgets\Listing\ListingDirectionWidget $lstCurrentWidget */
global $lstCurrentWidget;

$lstModel = $lstCurrentWidget->getModel();
if (!$lstModel) {
    return;
}

$lstAddress = $lstModel->getAddress();
if (empty($lstAddress)) {
    return;
}
?>
<a
        class="listivo-contact-button"
        href="https://www.google.com/maps?saddr=My+Location&daddr=<?php echo esc_attr($lstAddress); ?>"
        target="_blank"
>
    <div class="listivo-contact-button__inner">
        <div class="listivo-contact-button__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
                <path d="M18.3202 0C16.5312 0 15.0872 1.44406 15.0872 3.23297C15.0872 3.92267 15.3028 4.56943 15.7123 5.12981L17.8028 7.97466C17.9321 8.14708 18.1262 8.23312 18.3202 8.23312C18.5357 8.23312 18.7082 8.12553 18.8375 7.97466L20.928 5.12981C21.3375 4.56943 21.5531 3.92267 21.5531 3.23297C21.5531 1.44406 20.1091 0 18.3202 0ZM18.3202 1.29319C19.3978 1.29319 20.2599 2.15531 20.2599 3.23297C20.2599 3.64248 20.1308 4.03027 19.8937 4.35356L18.3202 6.48741L16.7466 4.35356C16.5095 4.03027 16.3804 3.64248 16.3804 3.23297C16.3804 2.15531 17.2425 1.29319 18.3202 1.29319ZM5.38828 8.62125C2.41395 8.62125 0 11.0352 0 14.0095C0 15.1518 0.344682 16.251 1.01283 17.1562C1.03438 17.1993 1.07757 17.2209 1.09913 17.264L4.87092 22.3723C5.00024 22.5232 5.17275 22.6308 5.38828 22.6308C5.60381 22.6308 5.77632 22.5232 5.90564 22.3723L9.67744 17.264L9.74184 17.1777L9.76373 17.1562C10.4319 16.2294 10.7766 15.1518 10.7766 14.0095C10.7766 11.0352 8.36261 8.62125 5.38828 8.62125ZM17.1701 8.77364C16.9628 8.76459 16.7521 8.85572 16.6174 9.03084L16.2297 9.5482C16.0141 9.82839 16.0572 10.2377 16.3589 10.4533C16.4667 10.5395 16.6173 10.5825 16.7466 10.5825C16.9406 10.5825 17.1346 10.4965 17.264 10.324L17.6521 9.80667C17.8676 9.52648 17.803 9.11714 17.5229 8.90161C17.4178 8.82078 17.2945 8.77907 17.1701 8.77364ZM5.38828 9.91444C7.65136 9.91444 9.48337 11.7465 9.48337 14.0095C9.48337 14.8717 9.22482 15.7121 8.70755 16.4018V16.4233L5.38828 20.9065L2.13384 16.4881C2.11229 16.4666 2.09057 16.4449 2.06902 16.4018C1.55174 15.7121 1.29319 14.8717 1.29319 14.0095C1.29319 11.7465 3.1252 9.91444 5.38828 9.91444ZM15.2303 11.36C15.023 11.351 14.8123 11.4421 14.6776 11.6172L14.2899 12.1346C14.0744 12.4148 14.1389 12.8241 14.4191 13.0396C14.5269 13.1259 14.6775 13.1689 14.8068 13.1689C15.0008 13.1689 15.1949 13.0828 15.3242 12.9104L15.7123 12.393C15.9278 12.1129 15.8633 11.7035 15.5831 11.488C15.478 11.4072 15.3547 11.3654 15.2303 11.36ZM5.38828 11.8542C4.81666 11.8542 4.26844 12.0813 3.86424 12.4855C3.46005 12.8897 3.23297 13.4379 3.23297 14.0095C3.23297 14.5812 3.46005 15.1294 3.86424 15.5336C4.26844 15.9378 4.81666 16.1648 5.38828 16.1648C5.9599 16.1648 6.50812 15.9378 6.91232 15.5336C7.31652 15.1294 7.54359 14.5812 7.54359 14.0095C7.54359 13.4379 7.31652 12.8897 6.91232 12.4855C6.50812 12.0813 5.9599 11.8542 5.38828 11.8542ZM14.5134 13.9098C14.3491 13.9017 14.1818 13.9558 14.0525 14.0744C13.7723 14.2899 13.7509 14.6992 14.0095 14.9794L14.4406 15.4534C14.5699 15.5827 14.7422 15.669 14.9146 15.669C15.0655 15.669 15.2379 15.6045 15.3457 15.4968C15.6043 15.2597 15.6261 14.8499 15.389 14.5913L14.958 14.1173C14.8394 13.988 14.6778 13.9178 14.5134 13.9098ZM16.6902 16.2806C16.5259 16.2725 16.359 16.3267 16.2297 16.4452C15.971 16.6823 15.9492 17.0916 16.1863 17.3503L16.6174 17.8243C16.7467 17.9536 16.9194 18.0398 17.0918 18.0398C17.2427 18.0398 17.4151 17.9754 17.5229 17.8676C17.7815 17.6305 17.8029 17.2208 17.5658 16.9621L17.1347 16.4881C17.0162 16.3588 16.8545 16.2887 16.6902 16.2806ZM18.8884 18.6514C18.7241 18.6434 18.5572 18.6975 18.4279 18.816C18.1693 19.0531 18.1479 19.4625 18.385 19.7211L18.816 20.1951C18.9454 20.3244 19.1176 20.4106 19.29 20.4106C19.4409 20.4106 19.6133 20.3462 19.7211 20.2385C19.9797 20.0014 20.0011 19.5916 19.764 19.333L19.333 18.859C19.2144 18.7297 19.0528 18.6595 18.8884 18.6514ZM21.0871 21.0223C20.9228 21.0142 20.7555 21.0683 20.6262 21.1869C20.4106 21.3809 20.3676 21.7041 20.4969 21.9627V21.9842C20.4969 22.3506 20.7771 22.6308 21.1435 22.6308H21.3591C21.6177 22.6308 21.855 22.4797 21.9412 22.2427C22.049 22.0056 22.0059 21.7255 21.8335 21.5531L21.5317 21.2298C21.4131 21.1005 21.2515 21.0304 21.0871 21.0223ZM8.19019 21.3376C7.82378 21.3376 7.54359 21.6178 7.54359 21.9842C7.54359 22.3506 7.82378 22.6308 8.19019 22.6308H8.83678C9.20318 22.6308 9.48337 22.3506 9.48337 21.9842C9.48337 21.6178 9.20318 21.3376 8.83678 21.3376H8.19019ZM11.4232 21.3376C11.0568 21.3376 10.7766 21.6178 10.7766 21.9842C10.7766 22.3506 11.0568 22.6308 11.4232 22.6308H12.0697C12.4362 22.6308 12.7163 22.3506 12.7163 21.9842C12.7163 21.6178 12.4362 21.3376 12.0697 21.3376H11.4232ZM14.6561 21.3376C14.2897 21.3376 14.0095 21.6178 14.0095 21.9842C14.0095 22.3506 14.2897 22.6308 14.6561 22.6308H15.3027C15.6691 22.6308 15.9493 22.3506 15.9493 21.9842C15.9493 21.6178 15.6691 21.3376 15.3027 21.3376H14.6561ZM17.8891 21.3376C17.5227 21.3376 17.2425 21.6178 17.2425 21.9842C17.2425 22.3506 17.5227 22.6308 17.8891 22.6308H18.5357C18.9021 22.6308 19.1823 22.3506 19.1823 21.9842C19.1823 21.6178 18.9021 21.3376 18.5357 21.3376H17.8891Z"
                      fill="#2A3946"/>
            </svg>
        </div>

        <?php echo esc_html(tdf_string('get_direction')); ?>
    </div>
</a>