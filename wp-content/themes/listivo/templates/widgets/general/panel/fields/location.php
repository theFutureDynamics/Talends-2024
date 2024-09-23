<?php
/* @var \Tangibledesign\Framework\Models\PanelFields\LocationPanelField $lstPanelField */
global $lstPanelField;
/* @var \Tangibledesign\Framework\Models\Field\LocationField $lstLocationField */
$lstLocationField = $lstPanelField->getField();

if (empty(tdf_settings()->getGoogleMapsApiKey())) {
    return;
}
?>
<lst-location-model-field
        class="listivo-panel-form__single-column <?php echo esc_attr($lstPanelField->getKey()); ?>"
        map-provider="<?php echo esc_attr(tdf_settings()->getMapProvider()); ?>"
        :model="modelForm.model"
        :field="<?php echo htmlspecialchars(json_encode($lstLocationField)); ?>"
        map-type="<?php echo esc_attr($lstLocationField->getMapType()); ?>"
        map-id="listivo-panel-form__map--<?php echo esc_attr($lstLocationField->getId()); ?>"
        input-id="listivo-model-form__address--<?php echo esc_attr($lstLocationField->getId()); ?>"
        :dependency-terms="modelForm.dependencyTerms"
        :selected-term-ids="modelForm.taxonomyFieldsValueIds"
>
    <div
            class="listivo-panel-form__single-column"
            slot-scope="locationField"
            v-if="locationField.isVisible"
    >
        <div class="listivo-panel-form-label listivo-panel-form-label--margin-bottom listivo-panel-form-label--small-margin-top">
            <h3 class="listivo-panel-form-label__text">
                <?php echo esc_html($lstPanelField->getLabel()); ?>

                <?php if ($lstPanelField->isRequired()) : ?>
                    <span>*</span>
                <?php endif; ?>

                <?php if (!empty($lstPanelField->getField()->getHint())): ?>
                    <div class="listivo-field-hint">
                        <div class="listivo-field-hint__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13"
                                 fill="none">
                                <path d="M6.5 0C2.91592 0 0 2.91592 0 6.5C0 10.0841 2.91592 13 6.5 13C10.0841 13 13 10.0841 13 6.5C13 2.91592 10.0841 0 6.5 0ZM6.5 0.975C9.55715 0.975 12.025 3.44285 12.025 6.5C12.025 9.55715 9.55715 12.025 6.5 12.025C3.44285 12.025 0.975 9.55715 0.975 6.5C0.975 3.44285 3.44285 0.975 6.5 0.975ZM6.5 3.25C6.32761 3.25 6.16228 3.31848 6.04038 3.44038C5.91848 3.56228 5.85 3.72761 5.85 3.9C5.85 4.07239 5.91848 4.23772 6.04038 4.35962C6.16228 4.48152 6.32761 4.55 6.5 4.55C6.67239 4.55 6.83772 4.48152 6.95962 4.35962C7.08152 4.23772 7.15 4.07239 7.15 3.9C7.15 3.72761 7.08152 3.56228 6.95962 3.44038C6.83772 3.31848 6.67239 3.25 6.5 3.25ZM6.49238 5.51802C6.3632 5.52004 6.2401 5.57325 6.15012 5.66596C6.06015 5.75868 6.01065 5.88332 6.0125 6.0125V9.5875C6.01159 9.6521 6.02352 9.71624 6.04761 9.77619C6.0717 9.83613 6.10746 9.89069 6.15282 9.9367C6.19818 9.9827 6.25223 10.0192 6.31183 10.0442C6.37143 10.0691 6.43539 10.0819 6.5 10.0819C6.56461 10.0819 6.62857 10.0691 6.68817 10.0442C6.74777 10.0192 6.80182 9.9827 6.84718 9.9367C6.89254 9.89069 6.9283 9.83613 6.95239 9.77619C6.97648 9.71624 6.98841 9.6521 6.9875 9.5875V6.0125C6.98844 5.94725 6.97626 5.88248 6.9517 5.82202C6.92715 5.76156 6.8907 5.70665 6.84453 5.66054C6.79836 5.61442 6.7434 5.57805 6.68291 5.55357C6.62242 5.52909 6.55763 5.517 6.49238 5.51802Z"
                                      fill="#9CCC65"/>
                            </svg>
                        </div>

                        <div class="listivo-field-hint__text">
                            <?php echo esc_html($lstPanelField->getField()->getHint()); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </h3>

            <div class="listivo-panel-form-label__line"></div>

            <div class="listivo-panel-form-label__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12"
                     fill="none">
                    <path d="M0.195669 7.13805C0.0653349 7.00772 0.00033474 6.83738 0.00033474 6.66671C0.00033474 6.49604 0.0653349 6.32571 0.195669 6.19538C0.456004 5.93504 0.878008 5.93504 1.13834 6.19538L4.66703 9.72407L4.66703 0.666672C4.66703 0.298669 4.9657 0 5.3337 0C5.70171 0 6.00038 0.298669 6.00038 0.666672L6.00038 9.72407L9.52907 6.19538C9.7894 5.93504 10.2114 5.93504 10.4717 6.19538C10.7321 6.45571 10.7321 6.87771 10.4717 7.13805L5.80504 11.8047C5.54471 12.0651 5.1227 12.0651 4.86237 11.8047L0.195669 7.13805Z"
                          fill="#D5E3EE"/>
                </svg>
            </div>
        </div>

        <div
                class="listivo-input-v2"
                :class="{
                    'listivo-input-v2--active': locationField.address !== '',
                    'listivo-input-v2--error': modelForm.showErrors && locationField.hasError,
                }"
        >
            <input
                    id="listivo-model-form__address--<?php echo esc_attr($lstLocationField->getId()); ?>"
                    type="text"
                    placeholder="<?php echo esc_attr(tdf_string('enter_location')); ?>"
            >

            <template>
                <div class="listivo-input-v2__error">
                    <div class="listivo-field-error">
                        <div class="listivo-field-error__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9"
                                 fill="none">
                                <path d="M0.105217 7.80234L4.38783 0.354178C4.51386 0.135013 4.74732 0 4.99999 0C5.25265 0 5.48611 0.135013 5.61214 0.354178L9.89475 7.80234C10.0269 8.03213 10.0351 8.31277 9.91661 8.54991L9.9164 8.55032C9.78241 8.8181 9.50871 8.98722 9.20927 8.98722H0.790697C0.491259 8.98722 0.217558 8.8181 0.0837706 8.55032L0.0835662 8.54991C-0.035106 8.31277 -0.0269357 8.03213 0.105217 7.80234Z"
                                      fill="#FDFDFE"/>
                                <path d="M5.40848 7.55742C5.40848 7.78313 5.22567 7.96593 4.99997 7.96593C4.77427 7.96593 4.59146 7.78313 4.59146 7.55742C4.59146 7.33172 4.77427 7.14891 4.99997 7.14891C5.22567 7.14891 5.40848 7.33172 5.40848 7.55742ZM4.99997 2.85956C4.66152 2.85956 4.38721 3.13387 4.38721 3.47232L4.5643 6.12846C4.57962 6.35783 4.77019 6.53615 4.99997 6.53615C5.22976 6.53615 5.42033 6.35783 5.43565 6.12846L5.61274 3.47232C5.61274 3.13387 5.33842 2.85956 4.99997 2.85956Z"
                                      fill="#F09965"/>
                            </svg>
                        </div>

                        <?php echo esc_html(tdf_string('field_is_required')); ?>
                    </div>
                </div>

                <div
                        v-if="locationField.address !== ''"
                        @click.prevent="locationField.clear"
                        class="listivo-input-v2__clear"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6"
                         fill="none">
                        <path d="M0.667016 0.000289049C0.534874 0.000452754 0.405782 0.0400233 0.296228 0.113946C0.186675 0.187868 0.101634 0.292787 0.05197 0.415298C0.00230608 0.53781 -0.00972662 0.672352 0.0174091 0.801739C0.0445448 0.931126 0.109617 1.04948 0.204313 1.14169L2.06032 2.99857L0.204313 4.85546C0.140536 4.91672 0.0896183 4.9901 0.0545414 5.07129C0.0194646 5.15249 0.000933792 5.23987 3.43907e-05 5.32832C-0.00086501 5.41677 0.0158851 5.50452 0.0493036 5.58641C0.0827221 5.6683 0.132137 5.7427 0.194655 5.80525C0.257173 5.8678 0.331537 5.91724 0.413391 5.95067C0.495245 5.9841 0.582945 6.00086 0.671354 5.99996C0.759763 5.99906 0.847104 5.98052 0.928262 5.94543C1.00942 5.91034 1.08276 5.85939 1.144 5.79559L3 3.9387L4.856 5.79559C4.91723 5.85939 4.99058 5.91034 5.07173 5.94543C5.15289 5.98053 5.24023 5.99907 5.32864 5.99997C5.41705 6.00087 5.50475 5.98411 5.58661 5.95067C5.66846 5.91724 5.74283 5.8678 5.80535 5.80525C5.86786 5.74271 5.91728 5.66831 5.9507 5.58641C5.98412 5.50452 6.00087 5.41678 5.99997 5.32832C5.99907 5.23987 5.98053 5.15249 5.94546 5.07129C5.91038 4.9901 5.85946 4.91672 5.79568 4.85546L3.93968 2.99857L5.79568 1.14169C5.89171 1.0483 5.9573 0.928073 5.98385 0.796753C6.01041 0.665433 5.99669 0.529151 5.94449 0.405766C5.8923 0.282381 5.80407 0.177648 5.69136 0.105294C5.57865 0.0329402 5.44672 -0.00366036 5.31286 0.000289049C5.14022 0.00543568 4.97636 0.0776237 4.856 0.20156L3 2.05844L1.144 0.20156C1.08199 0.137793 1.00783 0.0871234 0.925898 0.0525512C0.843967 0.017979 0.755935 0.000207391 0.667016 0.000289049Z"
                              fill="#F09965"/>
                    </svg>
                </div>
            </template>
        </div>

        <div class="listivo-panel-form__checkbox-wrapper">
            <div class="listivo-panel-form__checkbox">
                <div
                        @click.prevent="locationField.setMarkerChangeAddress"
                        class="listivo-checkbox"
                        :class="{'listivo-checkbox--checked': locationField.markerChangeAddress}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                        <path d="M11.7142 0.779513L10.6378 0.103783C10.3399 -0.0824758 9.93186 -0.011004 9.73252 0.261887L4.45585 7.44801L2.03093 5.20858C1.77765 4.97467 1.3649 4.97467 1.11162 5.20858L0.18996 6.05974C-0.06332 6.29364 -0.06332 6.67482 0.18996 6.9109L3.91881 10.3545C4.12753 10.5473 4.45585 10.6945 4.75135 10.6945C5.04684 10.6945 5.34468 10.5235 5.53698 10.2657L11.8877 1.61335C12.0894 1.34046 12.012 0.965772 11.7142 0.779513Z"
                              fill="#FDFDFE"/>
                    </svg>
                </div>
            </div>

            <label
                    @click.prevent="locationField.setMarkerChangeAddress"
                    for="listivo-locaton-sync-<?php echo esc_attr($lstLocationField->getId()); ?>"
            >
                <?php echo esc_html(tdf_string('autocomplete_map')); ?>
            </label>
        </div>

        <div
                id="listivo-panel-form__map--<?php echo esc_attr($lstLocationField->getId()); ?>"
                class="listivo-panel-form__map"
        ></div>
    </div>
</lst-location-model-field>