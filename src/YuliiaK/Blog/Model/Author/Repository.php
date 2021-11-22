<?php
declare(strict_types=1);

namespace YuliiaK\Blog\Model\Author;

class Repository
{
    public const TABLE = 'author';

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
            1 => $this->makeEntity()
                ->setAuthorId(1)
                ->setName('Anna Mort')
                ->setUrl('anna-mort'),
            2 => $this->makeEntity()
                ->setAuthorId(2)
                ->setName('Den Smith')
                ->setUrl('den-smith'),
            3 => $this->makeEntity()
                ->setAuthorId(3)
                ->setName('Margo')
                ->setUrl('margo'),
            4 => $this->makeEntity()
                ->setAuthorId(4)
                ->setName('Alex Fil')
                ->setUrl('alex-fil')
        ];
    }

    /**
     * @param string $url
     * @return Entity|null ?Entity
     */
    public function getByUrl(string $url): ?Entity
    {
        $data = array_filter(
            $this->getList(),
            static function ($category) use ($url) {
                return $category->getUrl() === $url;
            }
        );

        return array_pop($data);
    }

    public function getAuthorById(int $authorId): Entity
    {
        $data = array_filter(
            $this->getList(),
            static function ($author) use ($authorId) {
                return $author->getAuthorId() === $authorId;
            }
        );

        return array_pop($data);
    }

    /**
     * @return Entity
     */
    private function makeEntity(): Entity
    {
        return $this->factory->make(Entity::class);
    }
}
