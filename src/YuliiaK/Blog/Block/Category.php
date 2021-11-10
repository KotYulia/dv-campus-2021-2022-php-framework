<?php
declare(strict_types=1);

namespace YuliiaK\Blog\Block;

use YuliiaK\Blog\Model\Category\Entity as CategoryEntity;
use YuliiaK\Blog\Model\Post\Entity as PostEntity;
use YuliiaK\Blog\Model\Author\Entity as AuthorEntity;

class Category extends \YuliiaK\Framework\View\Block
{
    private \YuliiaK\Framework\Http\Request $request;

    private \YuliiaK\Blog\Model\Post\Repository $postRepository;

    private \YuliiaK\Blog\Model\Author\Repository $authorRepository;

    protected string $template = '../src/YuliiaK/Blog/view/category.php';

    /**
     * Category constructor.
     * @param \YuliiaK\Framework\Http\Request $request
     * @param \YuliiaK\Blog\Model\Post\Repository $postRepository
     * @param \YuliiaK\Blog\Model\Author\Repository $authorRepository
     */
    public function __construct(
        \YuliiaK\Framework\Http\Request $request,
        \YuliiaK\Blog\Model\Post\Repository $postRepository,
        \YuliiaK\Blog\Model\Author\Repository $authorRepository
    ) {
        $this->request = $request;
        $this->postRepository = $postRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @return CategoryEntity
     */
    public function getCategory(): CategoryEntity
    {
        return $this->request->getParameter('category');
    }

    /**
     * @return PostEntity[]
     */
    public function getPostsByCategory(): array
    {
        return $this->postRepository->getByIds(
            $this->getCategory()->getPostIds()
        );
    }

    /**
     * @param PostEntity $post
     * @return AuthorEntity
     */
    public function getAuthorByPost(PostEntity $post): AuthorEntity
    {
        return $this->authorRepository->getAuthorById($post->getAuthorId());
    }
}
