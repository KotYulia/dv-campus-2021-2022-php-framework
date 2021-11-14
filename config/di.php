<?php

declare(strict_types=1);

use YuliiaK\Framework\Database\Adapter\MySQL;

return [
    \YuliiaK\Framework\Database\Adapter\AdapterInterface::class => DI\get(
        MySQL::class
    ),
    MySQL::class => DI\autowire()->constructorParameter(
        'connectionParams',
        [
            MySQL::DB_NAME     => 'yuliiak_blog',
            MySQL::DB_USER     => 'yuliiak_blog_user',
            MySQL::DB_PASSWORD => 'lg%hW3RR6468fvfdgv;jd@',
            MySQL::DB_HOST     => 'mysql',
            MySQL::DB_PORT     => '3306'
        ]
    ),
    \YuliiaK\Framework\Http\RequestDispatcher::class => DI\autowire()->constructorParameter(
        'routers',
        [
            \DI\get(\YuliiaK\Cms\Router::class),
            \DI\get(\YuliiaK\Blog\Router::class),
            \DI\get(\YuliiaK\ContactUs\Router::class),
            \DI\get(\YuliiaK\Install\Router::class),
        ]
    )
];
