<?php

declare(strict_types=1);

namespace YuliiaK\Cms\Controller;

use YuliiaK\Framework\Http\Response\Raw;
use YuliiaK\Framework\View\Block;

class Page implements \YuliiaK\Framework\Http\ControllerInterface
{
    private \YuliiaK\Framework\Http\Request $request;

    private \YuliiaK\Framework\View\PageResponse $pageResponse;

    /**
     * @param \YuliiaK\Framework\Http\Request $request
     */
    public function __construct(
        \YuliiaK\Framework\Http\Request $request,
        \YuliiaK\Framework\View\PageResponse $pageResponse
    ) {
        $this->request = $request;
        $this->pageResponse = $pageResponse;
    }

    /**
     * @return Raw
     */
    public function execute(): Raw
    {
        return $this->pageResponse->setBody(
            Block::class,
            '../src/YuliiaK/Cms/view/' . $this->request->getParameter('page') . '.php'
        );
    }
}
