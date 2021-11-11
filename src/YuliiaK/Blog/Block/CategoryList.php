<?php
declare(strict_types=1);

namespace YuliiaK\Blog\Block;

use YuliiaK\Blog\Model\Category\Entity as CategoryEntity;

class CategoryList extends \YuliiaK\Framework\View\Block
{
    private \YuliiaK\Blog\Model\Category\Repository $categoryRepository;

    protected string $template = '../src/YuliiaK/Blog/view/category_list.php';

    /**
     * @param \YuliiaK\Blog\Model\Category\Repository $categoryRepository
     */
    public function __construct(\YuliiaK\Blog\Model\Category\Repository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return CategoryEntity[]
     */
    public function getCategories(): array
    {
        return $this->categoryRepository->getList();
    }
}
