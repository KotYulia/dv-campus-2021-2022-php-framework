<?php

declare(strict_types=1);

namespace YuliiaKotenko\Cms\Controller;

class Page implements \YuliiaKotenko\Framework\Http\ControllerInterface
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

    public function execute(): string
    {
        $page = $this->request->getParameter('page') . '.php';

        ob_start();
        require_once "../src/page.php";
        return ob_get_clean();
    }
}
