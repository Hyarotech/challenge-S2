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
    protected string $date;
    protected string $dateUpdated;
    protected string $slug;
    protected string $description;
    protected bool $isNoFollow;
    protected $visibility;

    protected ?array $fillable = [
        "user_id",
        "title",
        "date_updated",
        "slug",
        "description",
        "is_no_follow",
        "visibility"
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

        
        $this->title = $title;
    }

  

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getDateUpdated(): string
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(string $dateUpdated): void
    {
        $this->dateUpdated = $dateUpdated;
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
        $this->description = $description;
    }

    public function getIsNoFollow(): bool
    {
        return $this->isNoFollow;
    }

    public function setIsNoFollow(bool $isNoFollow): void
    {
        $this->isNoFollow = $isNoFollow;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setVisibility(int $visibility): void
    {
        $this->visibility = $visibility;
    }

    public function exist(){
        $pageData = $this->findBy('id',$this->getId()) ? true : 
                    ($this->findBy('slug',$this->getSlug()) ? true : false);

        return $pageData;
    }
    
}


