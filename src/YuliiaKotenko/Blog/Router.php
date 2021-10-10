<?php

declare(strict_types=1);

namespace YuliiaKotenko\Blog;

use YuliiaKotenko\Blog\Controller\Category;
use YuliiaKotenko\Blog\Controller\Post;

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
        require_once '../src/data.php';

        if ($data = catalogGetCategoryByUrl($requestUrl)) {
            $this->request->setParameter('category', $data);
            return Category::class;
        }

        if ($data = catalogGetPostByUrl($requestUrl)) {
            $this->request->setParameter('post', $data);
            return Post::class;
        }

        return '';
    }
}
