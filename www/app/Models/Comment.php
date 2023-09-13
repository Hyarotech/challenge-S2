<?php
namespace App\Models;

use Core\Model;

class Comment extends Model
{
    protected int $id;
    protected ?string $message;
    protected int $user_id;
    protected string $created_at;
    protected string $updated_at;
    protected int $page_id;

    protected ?array $fillable = [
        "message",
        "user_id",
        "page_id"
    ];

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
        $this->message = $message;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getPageId(): int
    {
        return $this->page_id;
    }

    public function setPageId(int $page_id): void
    {
        $this->page_id = $page_id;
    }
}