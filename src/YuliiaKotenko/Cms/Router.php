<?php

declare(strict_types=1);

namespace YuliiaKotenko\Cms;

use YuliiaKotenko\Cms\Controller\Page;

class Router implements \YuliiaKotenko\Framework\Http\RouterInterface
{
    private \YuliiaKotenko\Framework\Http\Request $request;

    /**
     * @param \YuliiaKotenko\Framework\Http\Request $request
     */
    public function __construct(
        \YuliiaKotenko\Framework\Http\Request $request
    ) {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        $cmsPage = [
            '',
            'info-page',
        ];

        if (in_array($requestUrl, $cmsPage)) {
            $this->request->setParameter('page', $requestUrl ?: 'home');

            return Page::class;
        }

        return '';
    }
}