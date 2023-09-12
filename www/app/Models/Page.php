<?php
namespace App\Models;

use App\Configs\PageConfig;
use Core\Model;

use Core\Verificator;
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

    protected ?array $fillable = [
        "user_id",
        "title",
        "updated_at",
        "slug",
        "description",
        "is_no_follow",
        "visibility",
        "page_type"
    ];


    public function __construct()
    {
        parent::__construct();
        $this->setId(-1);
        $this->setUserId(-1);
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
        strip_tags($title);
        $this->title = $title;
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
        
        strip_tags($description);
        $this->description = $description;
    }

    public function getIsNoFollow(): bool
    {

        return $this->isNoFollow;
    }

    public function setIsNoFollow(bool $isNoFollow): void
    {
        $this->isNoFollow = (bool)$isNoFollow;
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


