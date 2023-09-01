<?php

namespace App\Models;

class CatPage extends \Core\Model
{
    protected int $id = 0;
    protected Page|int $pageId;
    protected Category|int $categoryId;
    protected string $table = "cat_page";

    protected ?array $fillable = [
        "page_id",
        "category_id"

    ];
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CatPage
     */
    public function setId(int $id): CatPage
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Page|int
     */
    public function getPageId(): Page|int
    {
        return $this->pageId;
    }

    /**
     * @param Page|int $pageId
     * @return CatPage
     */
    public function setPageId(Page|int $pageId): CatPage
    {
        $this->pageId = $pageId;
        return $this;
    }

    /**
     * @return Category|int
     */
    public function getCategoryId(): int|Category
    {
        return $this->categoryId;
    }

    /**
     * @param Category|int $categoryId
     * @return CatPage
     */
    public function setCategoryId(int|Category $categoryId): CatPage
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @param string $table
     * @return CatPage
     */
    public function setTable(string $table): CatPage
    {
        $this->table = $table;
        return $this;
    }




}
