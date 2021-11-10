<?php

declare(strict_types=1);

namespace YuliiaK\Cms;

use YuliiaK\Cms\Controller\Page;

class Router implements \YuliiaK\Framework\Http\RouterInterface
{
    private \YuliiaK\Framework\Http\Request $request;

    /**
     * @param \YuliiaK\Framework\Http\Request $request
     */
    public function __construct(
        \YuliiaK\Framework\Http\Request $request
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