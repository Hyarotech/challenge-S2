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

        $this->table = env("DB_SCHEMA", "public") . "." . $this->table;
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

    public static function save(Model|array $data = []): bool
    {
        $pdo = self::getPdo();

        $fillable = new static();
        $fillable = $fillable->fillable;
        if ($fillable && is_array($data)) {
            $instance = new static();
            $data = array_intersect_key($data, array_flip($fillable));
        }
        else if ($data instanceof Model) {
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
        $columns = array_keys($data);

        $queryPrepared = $pdo->prepare("INSERT INTO " . $instance->table . " (" . implode(",", $columns) . ") 
                            VALUES (:" . implode(",:", $columns) . ")");
        return  $queryPrepared->execute($data);
    }

    public static function update(string $id, array $data): void
    {
        $pdo = self::getPdo();

        $instance = new static();
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
        $queryPrepared = $pdo->prepare("UPDATE " . $instance->table . " SET " . implode(",", $columns) . " WHERE id=:id");
        $queryPrepared->execute($data);
    }

    public static function findBy(string $column, string $value): ?Model
    {

        $pdo = self::getPdo();

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
        $pdo = self::getPdo();
        $instance= new static();
        $results = $pdo->query("SELECT * FROM " . $instance->table)->fetchAll();
        return array_map(function ($result) {
            return static::hydrate($result);
        }, $results);
    }

    private static function getPdo(): \PDO
    {
        $dbConnector = DBConnector::getInstance();
        return $dbConnector->getPDO();
    }

    public static function findOne(int $id): ?Model
    {
        $pdo = self::getPdo();
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

    /**
     * @throws \ReflectionException
     */
    public function __get(string $name)
    {
        //get type of property
        $reflection = new \ReflectionClass($this);
        $property = $reflection->getProperty($name);
        $propertyUnionType = $property->getType();
        $propertyType = null;
        if ($propertyUnionType instanceof ReflectionNamedType) {
            $propertyType = $propertyUnionType->getName();
        } else {
            $propertyType = $propertyUnionType->getTypes()[0]->getName();
        }
        //get value of property
        $value = $this->$name;
        if ($value === null) {
            return null;
        }
        //value is ID of another model so i have to find it
        if (is_numeric($value) && $propertyType !== "int") {
            $model = $propertyType::findOne($value);
            if ($model) {
                $this->$name = $model;
                return $model;
            }
        }
        return $value;
    }
}
