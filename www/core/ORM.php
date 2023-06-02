<?php

namespace Core;

abstract class ORM
{

    protected $pdo;
    protected $table;

    public function __construct()
    {
        //Mettre en place un SINGLETON
        try {
            $this->pdo = new \PDO("pgsql:host=" . env("DB_HOST") . ";port=" . env("DB_PORT") . ";dbname=" . env("DB_DATABASE"), env("DB_USERNAME"), env("DB_PASSWORD"));
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);
        $this->table = env("DB_SCHEMA", "public") . "." . $this->table;
    }

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
        if (is_numeric($this->getId()) && $this->getId() > 0) {
            $columnsUpdate = [];
            foreach ($columns as $key => $value) {
                $columnsUpdate[] = $key . "=:" . $key;
            }
            $queryPrepared = $this->pdo->prepare("UPDATE " . $this->table . " SET " . implode(",", $columnsUpdate) . " WHERE id=" . $this->getId());

        } else {
            $queryPrepared = $this->pdo->prepare("INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ") 
                            VALUES (:" . implode(",:", array_keys($columns)) . ")");
        }
        $queryPrepared->execute($columns);
    }
}