<?php

declare(strict_types=1);

namespace YuliiaK\Blog;

use YuliiaK\Blog\Controller\Category;
use YuliiaK\Blog\Controller\Post;
use YuliiaK\Blog\Controller\Author;

class Router implements \YuliiaK\Framework\Http\RouterInterface
{
    private \YuliiaK\Framework\Http\Request $request;

    private \YuliiaK\Blog\Model\Category\Repository $categoryRepository;

    private \YuliiaK\Blog\Model\Post\Repository $postRepository;

    private \YuliiaK\Blog\Model\Author\Repository $authorRepository;

    /**
     * Router constructor.
     * @param \YuliiaK\Framework\Http\Request $request
     * @param Model\Category\Repository $categoryRepository
     * @param Model\Post\Repository $postRepository
     * @param Model\Author\Repository $authorRepository
     */
    public function __construct(
        \YuliiaK\Framework\Http\Request $request,
        \YuliiaK\Blog\Model\Category\Repository $categoryRepository,
        \YuliiaK\Blog\Model\Post\Repository $postRepository,
        \YuliiaK\Blog\Model\Author\Repository $authorRepository
    ) {
        $this->request = $request;
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @inheritDoc
     */
    public function match(string $requestUrl): string
    {
        if ($category = $this->categoryRepository->getByUrl($requestUrl)) {
            $this->request->setParameter('category', $category);
            return Category::class;
        }

        if ($post = $this->postRepository->getByUrl($requestUrl)) {
            $this->request->setParameter('post', $post);
            return Post::class;
        }

        if ($author = $this->authorRepository->getByUrl($requestUrl)) {
            $this->request->setParameter('author', $author);
            return Author::class;
        }

        return '';
    }
}
