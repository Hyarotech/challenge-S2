<?php


namespace App\Models;

use Core\DBConnector;
use Core\Model;

class PageBuilderManager extends Model {
    
    protected int $pageId;
    protected string $state;
    protected string $createdAt;
    protected int $id = -1;
    protected string $table;
    protected ?array $fillable = [
        'page_id',
        'state',
        'created_at',
    ];


    public function __construct() {
        $this->table = "pagebuilder";
    }
    public static function add(PageBuilderMemento $memento) {
        $data = [
            "page_id" => $memento->getPageId(),
            "state" => $memento->getState(),
            "created_at" => $memento->getCreatedAt()
        ];
        static::save($data);
    }

    public static function get(int $index): PageBuilderManager|null {
        return static::findBy('id', $index);
    }


    public static function getLast(int $page_id): array {
        $dbConnector = DBConnector::getInstance();
        $pdo = $dbConnector->getPDO();
    
        $instance = new static();
        $queryPrepared = $pdo->prepare("SELECT * FROM " . $instance->table . " WHERE page_id = :page_id ORDER BY created_at DESC LIMIT 1");
        $queryPrepared->bindValue(":page_id", $page_id);
        $queryPrepared->execute();
    
        $results = $queryPrepared->fetchAll();
        
        return array_map(function ($result) {
            return static::hydrate($result);
        }, $results);
    }
    public static function getAll(int $page_id): array {
        $dbConnector = DBConnector::getInstance();
        $pdo = $dbConnector->getPDO();
    
        $instance = new static();
        $queryPrepared = $pdo->prepare("SELECT * FROM " . $instance->table . " WHERE page_id = :page_id ORDER BY created_at DESC");
        $queryPrepared->bindValue(":page_id", $page_id);
        $queryPrepared->execute();
    
        $results = $queryPrepared->fetchAll();
        
        return array_map(function ($result) {
            return static::hydrate($result);
        }, $results);
    }
    
}
