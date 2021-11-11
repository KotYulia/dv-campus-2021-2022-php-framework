<?php
declare(strict_types=1);

namespace YuliiaK\Blog\Model\Author;

class Entity
{
    private int $authorId;

    private string $name;

    private string $url;

    private array $posts;

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @param int $authorId
     * @return Entity
     */
    public function setAuthorId(int $authorId): Entity
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Entity
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): Entity
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function getPostIds(): array
    {
        return $this->posts;
    }

    /**
     * @param array $posts
     * @return Entity
     */
    public function setPostIds(array $posts): Entity
    {
        $this->posts = $posts;

        return $this;
    }
}
