<?php

namespace Core;

use Exception;
use ReflectionNamedType;

abstract class Model
{
    protected string $table;
    protected ?array $fillable = null;

    public function __construct()
    {

        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);

        $this->table = env("DB_SCHEMA", "esgi") . "." . $this->table;
    }

    public static function hydrate(array $data = []): static
    {
        $instance = new static();
        $reflection = new \ReflectionClass($instance);
        foreach ($data as $key => $value) {
            $property = toCamelCase($key);
            if ($reflection->hasProperty($property)) {
                $property = $reflection->getProperty($property);
                $propertyType = $property->getType();
                $property = $property->getName();
                if ($propertyType instanceof ReflectionNamedType && $propertyType->getName() === "DateTime") {
                    try {
                        $instance->$property = new \DateTime($value);
                    } catch (\Exception $e) {
                        $instance->$property = null;
                    }
                } else {
                    $instance->$property = $value;
                }
            }
        }
        $result = clone $instance;
        $toRemove = get_class_vars(get_class());
        foreach ($toRemove as $key => $value) {
            if ($key !== "singleton") {
                unset($result->$key);
            }
        }
        return $result;
    }

    public function load(string $relations)
    {
        $relations = explode(",", $relations);
        foreach ($relations as $relation) {
            $relation = trim($relation);
            if (method_exists($this, $relation)) {
                $this->$relation();
            }
        }
    }

    public function belongsTo(string $model, string $foreignKey, string $localKey = "id"): Model|null
    {
        throw new Exception("Not implemented");
        $model = new $model();
        return $model::findBy($localKey, $this->$foreignKey);
    }

    public function hasMany(string $model, string $foreignKey, string $localKey = "id"): array
    {

        throw new Exception("Not implemented");
        $model = new $model();
        $result = $model::findAllBy($foreignKey, $this->$localKey);
        $this->$foreignKey = $result;
        return $result;
    }

    public function hasOne(string $model, string $foreignKey, string $localKey = "id"): Model|null
    {

        throw new Exception("Not implemented");
        $model = new $model();
        $result = $model::findBy($foreignKey, $this->$localKey);
        $this->$foreignKey = $result;
        return $result;
    }

    public static function save(Model|array $data = []): bool
    {
        $dbConnector = DBConnector::getInstance();
        $pdo = $dbConnector->getPDO();

        $fillable = new static();

        $fillable = $fillable->fillable;
        if ($fillable && is_array($data)) {
            $instance = new static();
            $data = array_intersect_key($data, array_flip($fillable));
        } elseif ($data instanceof Model) {
            foreach ($fillable as $value) {
                $valueCamel = toCamelCase($value);
                // Vérifier si la méthode getValeurFilled existe
                $getterMethod = 'get' . ucfirst($valueCamel);

                if (method_exists($data, $getterMethod))
                    $listData[$value] = $data->{$getterMethod}();
            }
            $instance = $data;
            $data = $listData;
        }

        foreach ($data as $key => $value) {
            if (is_bool($value))
                $data[$key] = (int)$value;
        }
        $columns = array_keys($data);
        $queryPrepared = $pdo->prepare("INSERT INTO " . $instance->table . " (" . implode(",", $columns) . ") 
                            VALUES (:" . implode(",:", $columns) . ")");
        return $queryPrepared->execute($data);
    }

    public static function update(string $id, array $data): bool
    {
        $dbConnector = DBConnector::getInstance();
        $pdo = $dbConnector->getPDO();

        $instance = new static();
        if ($instance->fillable) {
            $data = array_intersect_key($data, array_flip($instance->fillable));
        }
        $columns = [];
        foreach ($data as $key => $value) {
            if (is_bool($value))
                $data[$key] = (int)$value;
            $columns[] = $key . "=:" . $key;
        }
        $data["id"] = $id;
        $queryPrepared = $pdo->prepare("UPDATE " . $instance->table . " SET " . implode(",", $columns) . " WHERE id=:id");
        return $queryPrepared->execute($data);
    }

    public static function findBy(string $column, string $value): ?Model
    {

        $dbConnector = DBConnector::getInstance();
        $pdo = $dbConnector->getPDO();
        $instance = new static();

        $queryPrepared = $pdo->prepare("SELECT * FROM " . $instance->table . " WHERE " . $column . " = :value");
        $queryPrepared->bindValue(":value", $value);


        $queryPrepared->execute();

        $result = $queryPrepared->fetch();


        if ($result) {
            return static::hydrate($result);
        }
        return null;
    }

    public static function findAll(): array
    {
        $dbConnector = DBConnector::getInstance();
        $pdo = $dbConnector->getPDO();

        $instance = new static();
        $results = $pdo->query("SELECT * FROM " . $instance->table)->fetchAll();

        return array_map(function ($result) {
            return static::hydrate($result);
        }, $results);
    }

    public static function findOne(int $id): ?Model
    {
        $dbConnector = DBConnector::getInstance();
        $pdo = $dbConnector->getPDO();

        $instance = new static();
        $queryPrepared = $pdo->prepare("SELECT * FROM " . $instance->table . " WHERE id = :id");
        $queryPrepared->bindValue(":id", $id);
        $queryPrepared->execute();
        $result = $queryPrepared->fetch();
        if ($result) {
            return static::hydrate($result);
        }
        return null;
    }

    public static function delete(string $attribute, mixed $value): bool
    {
        $dbConnector = DBConnector::getInstance();
        $pdo = $dbConnector->getPDO();

        $instance = new static();
        $queryPrepared = $pdo->prepare("DELETE FROM " . $instance->table . " WHERE " . $attribute . " = " . ":" . $attribute);
        $queryPrepared->bindValue($attribute, $value);
        $queryPrepared->execute();

        return ($queryPrepared->rowCount() > 0);
    }


    public function toArray(): array
    {
        $result = [];
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $property = $property->getName();
            if ($property !== "table" && $property !== "fillable")
                $result[$property] = $this->$property;

        }
        return $result;
    }

}
