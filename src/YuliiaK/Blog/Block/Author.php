<?php
declare(strict_types=1);

namespace YuliiaK\Blog\Block;

use YuliiaK\Blog\Model\Author\Entity as AuthorEntity;
use YuliiaK\Blog\Model\Post\Entity as PostEntity;

class Author extends \YuliiaK\Framework\View\Block
{
    private \YuliiaK\Framework\Http\Request $request;

    private \YuliiaK\Blog\Model\Post\Repository $postRepository;

    protected string $template = '../src/YuliiaK/Blog/view/author.php';

    /**
     * Category constructor.
     * @param \YuliiaK\Framework\Http\Request $request
     * @param \YuliiaK\Blog\Model\Post\Repository $postRepository
     */
    public function __construct(
        \YuliiaK\Framework\Http\Request $request,
        \YuliiaK\Blog\Model\Post\Repository $postRepository
    ) {
        $this->request = $request;
        $this->postRepository = $postRepository;
    }

    /**
     * @return AuthorEntity
     */
    public function getAuthor(): AuthorEntity
    {
        return $this->request->getParameter('author');
    }

    /**
     * @return PostEntity[]
     */
    public function getPostsByAuthor(): array
    {
        return $this->postRepository->getByIds(
            $this->getAuthor()->getPostIds()
        );
    }
}
