<?php
declare(strict_types=1);

namespace YuliiaK\Framework\View;

use YuliiaK\Framework\Http\Response\Html;

class PageResponse extends Html
{
    private \YuliiaK\Framework\View\Renderer $renderer;

    /**
     * @param \YuliiaK\Framework\View\Renderer $renderer
     */
    public function __construct(
        \YuliiaK\Framework\View\Renderer $renderer
    ) {
        $this->renderer = $renderer;
    }

    /**
     * @param string $contentBlocClassm
     * @param string $template
     * @return PageResponse
     */
    public function setBody(string $contentBlocClass, string $template = ''): PageResponse
    {
        return parent::setBody((string) $this->renderer->setContent($contentBlocClass, $template));
    }
}
