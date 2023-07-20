<?php

namespace Core;

use PDO;

class Installer
{
    private static $installer = null;
    private bool $dbState = false;
    private bool $settingsState = false;
    private array $envFileContent = [];

    private function __construct()
    {
    }

    public static function getInstance(): Installer
    {
        if (self::$installer === null) {
            self::$installer = new Installer();
        }
        return self::$installer;
    }

    public function getDbState(): bool
    {
        return $this->dbState;
    }

    public function getSettingsState(): bool
    {
        return $this->settingsState;
    }

    public function getEnvFileContent(): array
    {
        return $this->envFileContent;
    }

    public function addEnvFileContent(string $key, string $value): void
    {
        $this->envFileContent[$key] = $value;
    }

    public function installDb(array $dbInfos): bool
    {
        try {
            $pdo = new PDO("pgsql:host=" . $dbInfos["bddHost"] . ";port=" . $dbInfos["bddPort"] . ";dbname=" . $dbInfos["bddPort"], $dbInfos["bddUser"], $dbInfos["bddPwd"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setDbState(true);
            $this->addEnvFileContent("DB_USERNAME", $dbInfos["bddUser"]);
            $this->addEnvFileContent("DB_HOST", $dbInfos["bddHost"]);
            $this->addEnvFileContent("DB_PORT", $dbInfos["bddPort"]);
            $this->addEnvFileContent("DB_PASSWORD", $dbInfos["bddPwd"]);
            $this->addEnvFileContent("DB_DATABASE", $dbInfos["bddName"]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param bool $dbState
     */
    public function setDbState(bool $dbState): void
    {
        $this->dbState = $dbState;
    }
}