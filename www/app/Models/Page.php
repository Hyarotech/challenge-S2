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
    private string $content;
    private string $date;
    private string $date_updated;
    private string $slug;
    private string $description;
    private bool $isNoFollow;
    private $visibility;

    protected ?array $fillable = [
        "user_id",
        "title",
        "content",
        "date_updated",
        "slug",
        "description",
        "is_no_follow",
        "visibility"
    ];


    public function __construct()
    {
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

    public function setUserId(int $User_id): void
    {
        $this->user_id = $User_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {   

        
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
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

    public function isNoFollow(): bool
    {
        return $this->isNoFollow;
    }

    public function setNoFollow(bool $isNoFollow): void
    {
        $this->isNoFollow = $isNoFollow;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setVisibility($visibility): void
    {
        $this->visibility = $visibility;
    }

    public function exist(){
        $pageData = $this->findBy('id',$this->getId()) ? true : 
                    ($this->findBy('slug',$this->getSlug()) ? true : false);

        return $pageData;
    }

    public static function hydrate(array $data): Page
    {
        $page = new Page();
        $page->setId($data["id"]);
        $page->setUserId($data["User_id"]);
        $page->setTitle($data["title"]);
        $page->setContent($data["content"]);
        $page->setDate($data["date"]);
        $page->setDateUpdated($data["date_updated"]);
        $page->setSlug($data["slug"]);
        $page->setDescription($data["description"]);
        $page->setNoFollow($data["isNoFollow"]);
        $page->setVisibility($data["visibility"]);
        return $page;
    }
}


