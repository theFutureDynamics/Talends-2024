<?php

namespace Tangibledesign\Framework\Widgets\Helpers;

use Tangibledesign\Framework\Widgets\Widget;

abstract class BasePostSingleWidget extends Widget implements PostSingleWidget
{
    use HasBlogPost;

    protected function getTemplateDirectory(): string
    {
        return 'blog-post/';
    }
}