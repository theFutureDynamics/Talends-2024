<?php

namespace Tangibledesign\Listivo\Widgets\User;


use Tangibledesign\Framework\Widgets\Helpers\BaseUserWidget;
use Tangibledesign\Framework\Widgets\Helpers\Controls\FlexAlignmentControl;
use Tangibledesign\Framework\Widgets\Helpers\ModelSingleWidget;

class UserAddressWidget extends BaseUserWidget implements ModelSingleWidget
{
    use FlexAlignmentControl;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'user_address';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return tdf_admin_string('user_address');
    }

    protected function register_controls(): void
    {
        $this->startStyleControlsSection();

        $this->addFlexAlignmentControl($this->getSelector());

        $this->endControlsSection();

        $this->addVisibilitySection();
    }

    /**
     * @return string
     */
    protected function getSelector(): string
    {
        return '.' . tdf_prefix() . '-user-address-wrapper';
    }
}