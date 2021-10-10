<?php

declare(strict_types=1);

return [
    \YuliiaKotenko\Framework\Http\RequestDispatcher::class => DI\autowire()->constructorParameter(
        'routers',
        [
            \DI\get(\YuliiaKotenko\Cms\Router::class),
            \DI\get(\YuliiaKotenko\Blog\Router::class),
            \DI\get(\YuliiaKotenko\ContactUs\Router::class),
        ]
    )
];
