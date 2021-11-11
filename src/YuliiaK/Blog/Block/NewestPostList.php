<?php
declare(strict_types=1);

namespace YuliiaK\Blog\Block;

use YuliiaK\Blog\Model\Post\Entity as PostEntity;

class NewestPostList extends \YuliiaK\Framework\View\Block
{
    private \YuliiaK\Blog\Model\Post\Repository $postRepository;

    protected string $template = '../src/YuliiaK/Blog/view/home.php';

    /**
     * NewestPostList constructor.
     * @param \YuliiaK\Blog\Model\Post\Repository $postRepository
     */
    public function __construct(\YuliiaK\Blog\Model\Post\Repository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return PostEntity[]
     */
    public function getNewestPosts(): array
    {
        return $this->postRepository->getNewestList();
    }
}
