<?php

namespace App\Models;

class Category extends \Core\Model
{
    protected  int $id=0;
    protected string $name;
    protected User|int $userId;
    protected string $table = "category";
    protected ?array $fillable = [
        "name",
        "user_id"
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
     * @return Category
     */
    public function setId(int $id): Category
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    public static function formatName(string $name){
        $instance = new static();
        $instance->setName($name);
        return $instance->getName();
    }
    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = strip_tags(
            ucfirst(strtolower($name))
        );
        return $this;
    }

    /**
     * @return User|int
     */
    public function getUserId(): User|int
    {
        return $this->userId;
    }

    /**
     * @param User|int $userId
     * @return Category
     */
    public function setUserId(User|int $userId): Category
    {
        $this->userId = $userId;
        return $this;
    }


}