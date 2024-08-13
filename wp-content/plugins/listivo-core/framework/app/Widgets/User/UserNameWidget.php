<?php

namespace Tangibledesign\Framework\Widgets\User;

use Tangibledesign\Framework\Widgets\Helpers\BaseUserWidget;
use Tangibledesign\Framework\Widgets\Helpers\Controls\TextControls;
use Tangibledesign\Framework\Widgets\Helpers\PostSingleWidget;

class UserNameWidget extends BaseUserWidget implements PostSingleWidget
{
    use TextControls;

    public function getKey(): string
    {
        return 'user_name';
    }

    public function getName(): string
    {
        return tdf_admin_string('user_name');
    }

    protected function register_controls(): void
    {
        $selector = $this->getSelector();

        $this->startStyleControlsSection();

        $this->addTextColorControl($selector);

        $this->addTypographyControl($selector);

        $this->endControlsSection();

        $this->addVisibilitySection();
    }

    private function getSelector(): string
    {
        return '.' . tdf_prefix() . '-user-name';
    }
}