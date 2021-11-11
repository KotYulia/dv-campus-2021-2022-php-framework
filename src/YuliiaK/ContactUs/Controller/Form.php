<?php

declare(strict_types=1);

namespace YuliiaK\ContactUs\Controller;

use YuliiaK\Framework\Http\ControllerInterface;
use YuliiaK\Framework\Http\Response\Raw;
use YuliiaK\Framework\View\Block;

class Form implements ControllerInterface
{
    private \YuliiaK\Framework\View\PageResponse $pageResponse;

    /**
     * @param \YuliiaK\Framework\View\PageResponse $pageResponse
     */
    public function __construct(
        \YuliiaK\Framework\View\PageResponse $pageResponse
    ) {
        $this->pageResponse = $pageResponse;
    }

    /**
     * @return Raw
     */
    public function execute(): Raw
    {
        return $this->pageResponse->setBody(
            Block::class,
            '../src/YuliiaK/ContactUs/view/contact-us.php'
        );
    }
}
