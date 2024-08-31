<?php

namespace Tangibledesign\Framework\Widgets\Helpers;

use Tangibledesign\Framework\Widgets\Widget;

abstract class BaseUserWidget extends Widget implements UserWidget
{
    use HasUser, HasVisibilitySection;

    protected function getTemplateDirectory(): string
    {
        return 'user/';
    }

    protected function render(): void
    {
        if (!$this->isVisible()) {
            return;
        }

        parent::render();
    }

}