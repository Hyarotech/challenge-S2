<?php

namespace Core;

use PDO;
use ReflectionNamedType;

abstract class Model
{

    protected PDO $pdo;
    protected string $table;
    protected ?array $fillable = null;
    protected static $singleton;

    public function __construct()
    {
        //Mettre en place un SINGLETON
        try {
            $this->pdo = new PDO("pgsql:host=" . env("DB_HOST") . ";port=" . env("DB_PORT") . ";dbname=" . env("DB_DATABASE"), env("DB_USERNAME"), env("DB_PASSWORD"));
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);
        $this->table = env("DB_SCHEMA", "public") . "." . $this->table;
    }

    public static function getInstance(): static
    {
        if (!self::$singleton) {
            self::$singleton = new static();
        }
        return self::$singleton;
    }

    public static function hydrate(array $data): Model
    {
        $instance = self::getInstance();
        $reflection = new \ReflectionClass($instance);
        foreach($data as $key => $value){
            $property = toCamelCase($key);
            if($reflection->hasProperty($property)){
                $property = $reflection->getProperty($property);
                $propertyType = $property->getType();
                $property = $property->getName();
                if($propertyType instanceof ReflectionNamedType && $propertyType->getName() === "DateTime"){
                    try {
                        $instance->$property = new \DateTime($value);
                    } catch (\Exception $e) {
                        $instance->$property = null;
                    }
                } else{
                    $instance->$property = $value;
                }
            }
        }
        $result = clone $instance;
        $toRemove = get_class_vars(get_class());
        foreach ($toRemove as $key=> $value){
            if($key !== "singleton"){
                unset($result->$key);
            }
        }
        return $result;
    }

    public static function save(array $data): void
    {
        $instance = self::getInstance();
        if ($instance->fillable) {
            $data = array_intersect_key($data, array_flip($instance->fillable));
        }
        $columns = array_keys($data);
        $queryPrepared = $instance->pdo->prepare("INSERT INTO " . $instance->table . " (" . implode(",", $columns) . ") 
                            VALUES (:" . implode(",:", $columns) . ")");
        $queryPrepared->execute($data);
    }

    public static function update(string $id, array $data): void
    {
        $instance = self::getInstance();
        if ($instance->fillable) {
            $data = array_intersect_key($data, array_flip($instance->fillable));
        }
        $columns = [];
        foreach ($data as $key => $value) {
            if (is_bool($value)) {
                $data[$key] = $value ? "true" : "false";
            }
            $columns[] = $key . "=:" . $key;
        }
        $data["id"] = $id;
        $queryPrepared = $instance->pdo->prepare("UPDATE " . $instance->table . " SET " . implode(",", $columns) . " WHERE id=:id");
        $queryPrepared->execute($data);
    }
    public static function findBy(string $column, string $value): ?Model
    {
        $instance = self::getInstance();
        $queryPrepared = $instance->pdo->prepare("SELECT * FROM " . $instance->table . " WHERE " . $column . " = :value");
        $queryPrepared->bindValue(":value", $value);
        $queryPrepared->execute();
        $result =  $queryPrepared->fetch();
        if($result){
            return self::hydrate($result);
        }
        return null;
    }

    public static function findAll(): array
    {
        $instance = self::getInstance();
        $results =  $instance->pdo->query("SELECT * FROM " . $instance->table)->fetchAll();
        return array_map(function ($result) {
            return self::hydrate($result);
        }, $results);
    }

    public static function findOne(int $id): ?Model
    {
        $instance = self::getInstance();
        $queryPrepared = $instance->pdo->prepare("SELECT * FROM " . $instance->table . " WHERE id = :id");
        $queryPrepared->bindValue(":id", $id);
        $queryPrepared->execute();
        $result =  $queryPrepared->fetch();
        if($result){
            return self::hydrate($result);
        }
        return null;
    }
}