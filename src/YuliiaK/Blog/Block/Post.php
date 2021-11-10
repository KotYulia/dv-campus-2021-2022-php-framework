<?php
declare(strict_types=1);

namespace YuliiaK\Blog\Block;

use YuliiaK\Blog\Model\Post\Entity as PostEntity;
use YuliiaK\Blog\Model\Author\Entity as AuthorEntity;

class Post extends \YuliiaK\Framework\View\Block
{
    private \YuliiaK\Framework\Http\Request $request;

    private \YuliiaK\Blog\Model\Author\Repository $authorRepository;

    protected string $template = '../src/YuliiaK/Blog/view/post.php';

    /**
     * Post constructor.
     * @param \YuliiaK\Framework\Http\Request $request
     * @param \YuliiaK\Blog\Model\Author\Repository $authorRepository
     */
    public function __construct(
        \YuliiaK\Framework\Http\Request $request,
        \YuliiaK\Blog\Model\Author\Repository $authorRepository
    ) {
        $this->request = $request;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @return PostEntity
     */
    public function getPost(): PostEntity
    {
        return $this->request->getParameter('post');
    }

    /**
     * @return AuthorEntity
     */
    public function getAuthor(): AuthorEntity
    {
        return $this->authorRepository->getAuthorById($this->getPost()->getAuthorId());
    }
}
