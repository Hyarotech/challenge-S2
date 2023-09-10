<?php
namespace App\Models;

use Core\Model;

class Setting extends Model
{
    protected int $id;
    protected string $key;
    protected string $value;
    protected string $createdAt;

    protected ?array $fillable = [
        "key",
        "value",
        "created_at"
    ];

    public function __construct()
    {
        parent::__construct();
        $this->setId(-1);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
