<?php

declare(strict_types=1);

namespace YuliiaKotenko\ContactUs;

use YuliiaKotenko\ContactUs\Controller\Form;

class Router implements \YuliiaKotenko\Framework\Http\RouterInterface
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
