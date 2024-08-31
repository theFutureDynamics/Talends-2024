<?php
/* @var \Tangibledesign\Framework\Search\Field\TextSearchField $lstSearchField */
global $lstSearchField;

$showLabel = $args['show_label'] ?? false;
?>
<lst-text-search-field
        :field="<?php echo htmlspecialchars(json_encode($lstSearchField)); ?>"
        :filters="props.filters"
        :dependencies="props.dependencies"
        class="listivo-field-v2 listivo-search-form-field"
>
    <div
            class="listivo-field-v2 listivo-search-form-field"
            slot-scope="textField"
            v-if="textField.isVisible"
            class="listivo-field"
    >
        <?php if ($showLabel) : ?>
            <div class="listivo-search-field-label">
                <?php echo esc_html($lstSearchField->getName()); ?>
            </div>
        <?php endif; ?>

        <div
            <?php if ($lstSearchField->hasIcon()) : ?>
                class="listivo-input-v2 listivo-input-v2--with-icon"
            <?php else : ?>
                class="listivo-input-v2"
            <?php endif; ?>
                :class="{'listivo-input-v2--active': textField.value !== ''}"
                @click.prevent="textField.focusInput"
        >
            <?php
            if ($lstSearchField->hasIcon()) :
                $lstIcon = $lstSearchField->getIcon();
                ?>
                <div class="listivo-icon-v2 listivo-input-v2__icon">
                    <?php if (isset($lstIcon['library']) && $lstIcon['library'] === 'svg' && !empty($lstIcon['value']['url'])) : ?>
                        <?php echo tdf_load_icon($lstIcon['value']['url']); ?>
                    <?php else : ?>
                        <i class="<?php echo esc_attr($lstIcon['value']); ?>"></i>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <input
                    type="text"
                    @input="textField.setValue($event.target.value)"
                    :value="textField.value"
                    placeholder="<?php echo esc_attr($lstSearchField->getPlaceholder()); ?>"
            >

            <template>
                <div
                        v-if="textField.value !== ''"
                        class="listivo-input-v2__clear"
                        @click.stop.prevent="textField.clear"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6"
                         fill="none">
                        <path d="M0.667016 0.000289049C0.534874 0.000452754 0.405782 0.0400233 0.296228 0.113946C0.186675 0.187868 0.101634 0.292787 0.05197 0.415298C0.00230608 0.53781 -0.00972662 0.672352 0.0174091 0.801739C0.0445448 0.931126 0.109617 1.04948 0.204313 1.14169L2.06032 2.99857L0.204313 4.85546C0.140536 4.91672 0.0896183 4.9901 0.0545414 5.07129C0.0194646 5.15249 0.000933792 5.23987 3.43907e-05 5.32832C-0.00086501 5.41677 0.0158851 5.50452 0.0493036 5.58641C0.0827221 5.6683 0.132137 5.7427 0.194655 5.80525C0.257173 5.8678 0.331537 5.91724 0.413391 5.95067C0.495245 5.9841 0.582945 6.00086 0.671354 5.99996C0.759763 5.99906 0.847104 5.98052 0.928262 5.94543C1.00942 5.91034 1.08276 5.85939 1.144 5.79559L3 3.9387L4.856 5.79559C4.91723 5.85939 4.99058 5.91034 5.07173 5.94543C5.15289 5.98053 5.24023 5.99907 5.32864 5.99997C5.41705 6.00087 5.50475 5.98411 5.58661 5.95067C5.66846 5.91724 5.74283 5.8678 5.80535 5.80525C5.86786 5.74271 5.91728 5.66831 5.9507 5.58641C5.98412 5.50452 6.00087 5.41678 5.99997 5.32832C5.99907 5.23987 5.98053 5.15249 5.94546 5.07129C5.91038 4.9901 5.85946 4.91672 5.79568 4.85546L3.93968 2.99857L5.79568 1.14169C5.89171 1.0483 5.9573 0.928073 5.98385 0.796753C6.01041 0.665433 5.99669 0.529151 5.94449 0.405766C5.8923 0.282381 5.80407 0.177648 5.69136 0.105294C5.57865 0.0329402 5.44672 -0.00366036 5.31286 0.000289049C5.14022 0.00543568 4.97636 0.0776237 4.856 0.20156L3 2.05844L1.144 0.20156C1.08199 0.137793 1.00783 0.0871234 0.925898 0.0525512C0.843967 0.017979 0.755935 0.000207391 0.667016 0.000289049Z"
                              fill="#F09965"/>
                    </svg>
                </div>
            </template>
        </div>
    </div>
</lst-text-search-field>
