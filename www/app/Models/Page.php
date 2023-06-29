<?php
namespace App\Models;

use App\Configs\PageConfig;
use Core\Model;

use Core\Verificator;
class Page extends Model
{
    private int $id;
    private int $user_id;
    private string $title;
    private string $date;
    private string $date_updated;
    private string $slug;
    private string $description;
    private bool $is_no_follow;
    private $visibility;

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
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
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
        return $this->date_updated;
    }

    public function setDateUpdated(string $date_updated): void
    {
        $this->date_updated = $date_updated;
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
        return $this->is_no_follow;
    }

    public function setIsNoFollow(bool $is_no_follow): void
    {
        $this->is_no_follow = $is_no_follow;
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


