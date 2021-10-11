<?php

namespace YuliiaKotenko\Blog\Controller;

use YuliiaKotenko\Framework\Http\ControllerInterface;

class Post implements ControllerInterface
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
        $data = $this->request->getParameter('post');
        $page = 'post.php';

        ob_start();
        require_once "../src/page.php";
        return ob_get_clean();
    }
}
