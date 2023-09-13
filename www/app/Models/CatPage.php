<?php

namespace App\Models;
use Core\DBConnector;

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

     public function __construct() {
        $this->table = 'cat_page';
    }
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
     * Delete the existing record and insert a new one with the given pageId and categoryId.
     *
     * @param int $pageId
     * @param int $categoryId
     * @return bool True if the operation was successful, false otherwise.
     */
    public static function deleteAndInsert(int $pageId, int $categoryId): bool
    {
        $dbConnector = DBConnector::getInstance();
        $pdo = $dbConnector->getPDO();

        $static = new static();

        $tableName = $static->table;
        
        // First, delete the existing record if it exists.
        $queryDelete = $pdo->prepare("DELETE FROM " .  $tableName . " WHERE page_id = :pageId");
        $queryDelete->bindValue(":pageId", $pageId);
        $queryDelete->execute();
        

        // Now, insert the new record.
        $queryInsert = $pdo->prepare("INSERT INTO " .  $tableName . " (page_id, category_id) VALUES (:pageId, :categoryId)");
        $queryInsert->bindValue(":pageId", $pageId);
        $queryInsert->bindValue(":categoryId", $categoryId);
        return $queryInsert->execute();
    }


}
