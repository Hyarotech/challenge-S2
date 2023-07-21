<?php
namespace App\Models;

class PageBuilderMemento {
    private string $state;
    private string $createdAt;
    private int $pageId;

    private int $id;

    public function __construct(int $pageId,string $state, string $createdAt) {
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->pageId = $pageId;
    }

    public function getState(): string {
        return $this->state;
    }

    public function getCreatedAt(): string{
        return $this->createdAt;
    }

    public function getPageId(): int {
        return $this->pageId;
    }


    public function getId(): int {
        return $this->pageId;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

}