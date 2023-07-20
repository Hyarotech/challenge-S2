<?php

namespace Core;

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
}