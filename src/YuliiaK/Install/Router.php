<?php
declare(strict_types=1);

namespace YuliiaK\Install;

use YuliiaK\Install\Controller\Index;

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
        if ($this->request->getRequestUrl() === 'install') {
            return Index::class;
        }

        return '';
    }
}
