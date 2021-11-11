<?php

declare(strict_types=1);

return [
    \YuliiaK\Framework\Http\RequestDispatcher::class => DI\autowire()->constructorParameter(
        'routers',
        [
            \DI\get(\YuliiaK\Cms\Router::class),
            \DI\get(\YuliiaK\Blog\Router::class),
            \DI\get(\YuliiaK\ContactUs\Router::class),
        ]
    )
];
