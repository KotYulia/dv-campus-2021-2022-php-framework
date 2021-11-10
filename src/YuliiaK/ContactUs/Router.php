<?php

declare(strict_types=1);

namespace YuliiaK\ContactUs;

use YuliiaK\ContactUs\Controller\Form;

class Router implements \YuliiaK\Framework\Http\RouterInterface
{
    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        if ($requestUrl === 'contact-us') {
            return Form::class;
        }

        return '';
    }
}
