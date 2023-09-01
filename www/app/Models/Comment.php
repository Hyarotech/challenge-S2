<?php

namespace App\Models;

class Comment extends \Core\Model
{
    protected int $id =0;

    protected string $content;
    protected \DateTime $createdAt;
    protected \DateTime $updatedAt;
    protected User|int $userId;
    protected Page|int $pageId;
    protected string $table = "comment";

    protected ?array $fillable = [
        "content",
        "created_at",
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
     * @return Comment
     */
    public function setId(int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Comment
     */
    public function setContent(string $content): Comment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Comment
     */
    public function setCreatedAt(\DateTime $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Comment
     */
    public function setUpdatedAt(\DateTime $updatedAt): Comment
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return User
     */
    public function getUserId(): User
    {
        return $this->userId;
    }

    /**
     * @param User $userId
     * @return Comment
     */
    public function setUserId(User $userId): Comment
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return Post|int
     */
    public function getPostId(): int|Post
    {
        return $this->postId;
    }

    /**
     * @param Post|int $postId
     * @return Comment
     */
    public function setPostId(int|Post $postId): Comment
    {
        $this->postId = $postId;
        return $this;
    }



}
