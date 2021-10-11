<?php

declare(strict_types=1);

namespace YuliiaKotenko\Blog\Controller;

use YuliiaKotenko\Framework\Http\ControllerInterface;

class Category implements ControllerInterface
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
        $data = $this->request->getParameter('category');
        $page = 'category.php';

        ob_start();
        require_once "../src/page.php";
        return ob_get_clean();
    }
}
