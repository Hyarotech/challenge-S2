<?php

namespace Core;

use PDO;

abstract class ORM
{

    protected PDO $pdo;
    protected string $table;

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

    abstract public static function hydrate(array $data): mixed;

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToDeleted = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDeleted);
        unset($columns["id"]);
        foreach ($columns as $key => $value) {
            if (is_bool($value)) {
                $columns[$key] = $value ? "true" : "false";
            }
        }
        $queryPrepared = $this->pdo->prepare("INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ") 
                            VALUES (:" . implode(",:", array_keys($columns)) . ")");
        $queryPrepared->execute($columns);
    }

    public function update(): void
    {
        $columns = get_object_vars($this);
        $columnsToDeleted = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDeleted);
        $id = $columns["id"];
        unset($columns["id"]);
        foreach ($columns as $key => $value) {
            if (is_bool($value)) {
                $columns[$key] = $value ? "true" : "false";
            }
        }
        $columnsUpdate = [];
        foreach ($columns as $key => $value) {
            $columnsUpdate[] = $key . "=:" . $key;
        }
        $queryPrepared = $this->pdo->prepare("UPDATE " . $this->table . " SET " . implode(",", $columnsUpdate) . " WHERE id=:id");
        $queryPrepared->bindValue(":id", $id);
        $columns["id"] = $id;
        $queryPrepared->execute($columns);
    }

    public function findBy(string $column, string $value)
    {
        $queryPrepared = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE " . $column . " = :value");
        $queryPrepared->bindValue(":value", $value);
        $queryPrepared->execute();
        return $queryPrepared->fetch();
    }

    public function findAll(): array
    {
        return $this->pdo->query("SELECT * FROM " . $this->table)->fetchAll();
    }

    public function findOne(int $id){
        $queryPrepared = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $queryPrepared->bindValue(":id", $id);
        $queryPrepared->execute();
        return $queryPrepared->fetch();
    }
}