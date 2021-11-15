<?php
declare(strict_types=1);

namespace YuliiaK\Blog\Model\Post;

class Repository
{
    private \DI\FactoryInterface $factory;

    /**
     * @param \DI\FactoryInterface $factory
     */
    public function __construct(\DI\FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return Entity[]
     */
    public function getList(): array
    {
        return [
            1 => $this->makeEntity()->setPostId(1)
                ->setName('Post 1')
                ->setUrl('post-1')
                ->setDescription('Post 1 Description')
                ->setAuthorId(1)
                ->setDate('09-10-2021'),
            2 => $this->makeEntity()->setPostId(2)
                ->setName('Post 2')
                ->setUrl('post-2')
                ->setDescription('Post 2 Description')
                ->setAuthorId(2)
                ->setDate('04-10-2021'),
            3 => $this->makeEntity()->setPostId(3)
                ->setName('Post 3')
                ->setUrl('post-3')
                ->setDescription('Post 3 Description')
                ->setAuthorId(3)
                ->setDate('01-10-2021'),
            4 => $this->makeEntity()->setPostId(4)
                ->setName('Post 4')
                ->setUrl('post-4')
                ->setDescription('Post 4 Description')
                ->setAuthorId(1)
                ->setDate('06-10-2021'),
            5 => $this->makeEntity()->setPostId(5)
                ->setName('Post 5')
                ->setUrl('post-5')
                ->setDescription('Post 5 Description')
                ->setAuthorId(2)
                ->setDate('10-10-2021'),
            6 => $this->makeEntity()->setPostId(6)
                ->setName('Post 6')
                ->setUrl('post-6')
                ->setDescription('Post 6 Description')
                ->setAuthorId(4)
                ->setDate('08-10-2021')
        ];
    }

    /**
     * @param string $url
     * @return ?Entity
     */
    public function getByUrl(string $url): ?Entity
    {
        $data = array_filter(
            $this->getList(),
            static function ($post) use ($url) {
                return $post->getUrl() === $url;
            }
        );

        return array_pop($data);
    }

    /**
     * @param array $postIds
     * @return Entity[]
     */
    public function getByIds(array $postIds): array
    {
        return array_intersect_key(
            $this->getList(),
            array_flip($postIds)
        );
    }

    /**
     * @param int $authorId
     * @return Entity[]
     */
    public function getByAuthorId(int $authorId): array
    {
        return array_filter(
            $this->getList(),
            static function ($post) use ($authorId) {
                return $post->getAuthorId() === $authorId;
            }
        );
    }

    /**
     * @param $post1
     * @param $post2
     * @return int
     */
    public function blogSortPostsByDate($post1, $post2): int
    {
        return strtotime($post2->getDate()) - strtotime($post1->getDate());
    }

    /**
     * @return Entity[]
     */
    public function getNewestList(): array
    {
        $posts = $this->getList();
        usort($posts, array($this, "blogSortPostsByDate"));

        return $posts;
    }

    /**
     * @return Entity
     */
    private function makeEntity(): Entity
    {
        return $this->factory->make(Entity::class);
    }
}
