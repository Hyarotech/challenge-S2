<?php
namespace App\Models;

use Core\Model;

class Comment extends Model
{
    protected int $id;
    protected ?string $message;
    protected int $userId;
    protected string $createdAt;
    protected string $updatedAt;
    protected int $pageId;

    protected string $table;
    protected ?array $fillable = [
        "message",
        "user_id",
        "page_id",
        "updated_at"
    ];

    public function __construct(){
        parent::__construct();
        $this->table = $this->getTable();
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {

        $message = strip_tags($message);
        $this->message = $message;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
    public function getPageId(): int
    {
        return $this->pageId;
    }

    public function setPageId(int $pageId): void
    {
        $this->pageId = $pageId;
    }

    public static function resortRecent(array $listComment)
    {
        $timestamps = [];
    
        foreach ($listComment as $comment) {
            $timestamps[] = strtotime($comment->getCreatedAt());
        }
    
        array_multisort($timestamps, SORT_DESC, $listComment);
    
        return $listComment;
    }
    
}