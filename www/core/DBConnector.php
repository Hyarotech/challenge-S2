<?php

namespace Core;

use PDO;

class DBConnector
{
    private static ?DBConnector $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        try {
            $this->pdo = new PDO("pgsql:host=" . env("DB_HOST") . ";port=" . env("DB_PORT") . ";dbname=" . env("DB_DATABASE"), env("DB_USERNAME"), env("DB_PASSWORD"));
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public static function getInstance(): DBConnector
    {
        if (self::$instance === null) {
            self::$instance = new DBConnector();
        }
        return self::$instance;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
