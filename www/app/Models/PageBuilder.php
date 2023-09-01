<?php

namespace App\Models;

use App\Models\PageBuilderMemento;

class PageBuilder {

    private string $state;
    private int $pageId;
    private string $createdAt;
    

    public function __construct(int $pageId,string $state) {
        $this->state = $state;
        $this->pageId = $pageId;
        $this->createdAt = frenchDate()->format('Y-m-d H:i:s');
    }
    public function restoreMemento(PageBuilderMemento $memento){
        $this->state = $memento->getstate();
        $this->pageId = $memento->getPageId();        
    }
    public function createMemento(): PageBuilderMemento {
        return new PageBuilderMemento($this->pageId,$this->state, $this->createdAt);
    }
    
    public function setState(string $state): void {
        $this->state = $state;
    }

    public function setPageId(int $pageId): void {
        $this->pageId = $pageId;
    }

    public function result(): string {
        $data = [
            'page_id' => $this->pageId,
            'state' => $this->state,
            'created_at' => $this->createdAt
        ];

        return json_encode($data);
    }


}
