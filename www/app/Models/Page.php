<?php
namespace App\Models;

use App\Configs\PageConfig;
use Core\DBConnector;
use Core\Model;

use Core\Verificator;
use Exception;

class Page extends Model
{
    protected int $id;
    protected int $userId;
    protected string $title;
    protected string $createdAt;
    protected string $updatedAt;
    protected string $slug;
    protected string $description;
    protected bool $isNoFollow;
    protected $visibility;
    protected int $pageType;
    protected bool $isCommentEnabled;

    protected ?array $fillable = [
        "user_id",
        "title",
        "updated_at",
        "slug",
        "description",
        "is_no_follow",
        "visibility",
        "page_type",
        "is_comment_enabled"
    ];


    public function __construct()
    {
        parent::__construct();
        $this->setId(-1);
        $this->setUserId(-1);
        $this->setPageType(PageConfig::TYPE['page']);
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTitle(): string
    {
        
        return $this->title;
    }

    public function setTitle(string $title): void
    {   
        $this->title = strip_tags($title);
    }

  

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $date): void
    {
        $this->createdAt = $date;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $date): void
    {
        $this->updatedAt = $date;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        
        $this->description = strip_tags($description);
    }

    public function getIsNoFollow(): bool
    {

        return $this->isNoFollow;
    }

    public function setIsNoFollow(bool $isNoFollow): void
    {
        $this->isNoFollow = (bool)$isNoFollow;
    }

    /**
     * Summary of getIsCommentEnabled
     * @return bool
     */
    public function getIsCommentEnabled(): bool
    {

        return $this->isCommentEnabled;
    }

    public function setIsCommentEnabled(bool $isCommentEnabled): void
    {
        $this->isCommentEnabled = (bool)$isCommentEnabled;
    }
    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setVisibility(int $visibility): void
    {
        $this->visibility = $visibility;
    }

    public function exist(): bool
    {
        return $this->findBy('id', $this->getId()) || $this->findBy('slug', $this->getSlug());
    }

    public static function findAllByCategory(int $categoryId) : Array {
        $instance = new static();
        $table = array(
            'Page' => $instance->getTable(),
            'CatPage' => (new \App\Models\CatPage())->getTable(),
            'Category' => (new \App\Models\Category())->getTable()
        );
        $result = array();
        
        $sql = 'SELECT '.$table['Page'].'.* FROM '.$table['Page'].'
                INNER JOIN '.$table['CatPage'].' ON '.$table['CatPage'].'.page_id = '.$table['Page'].'.id
                INNER JOIN '.$table['Category'].' ON '.$table['CatPage'].'.category_id = '.$table['Category'].'.id
                WHERE 
                    '.$table['Page'].'.page_type = :page_type
                    AND '.$table['Category'].'.id = :category_id
                ORDER BY '.$table['Page'].'.created_at ASC';
        $db = DBConnector::getInstance()->getPDO();
        $req = $db->prepare($sql);

        $req->execute([
                'category_id' => $categoryId,
                'page_type' => $instance->getPageType()
        ]);
        $results = $req->fetchAll();
        return array_map(function ($result) {
            return static::hydrate($result);
        }, $results);
    }
    /**
     * Get the value of pageType
     */ 
    public function getPageType()
    {
        return $this->pageType;
    }

    /**
     * Set the value of pageType
     *
     * @return  self
     */ 
    public function setPageType($pageType)
    {
        $this->pageType = $pageType;

        return $this;
    }
}


