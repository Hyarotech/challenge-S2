<?php

namespace Core;

use App\Models\User;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;

class Installer
{
    private static $installer = null;
    private bool $dbState = false;
    private bool $settingsState = false;

    private bool $smtpState = false;

    private bool $adminState = false;
    private array $envFileContent = [];
    private User $user;

    private function __construct()
    {
    }

    public static function getInstance(): Installer
    {
        if (self::$installer === null) {
            $sessionInstaller = Session::get("installer");
            if ($sessionInstaller !== null) {
                self::$installer = $sessionInstaller;
            } else {
                self::$installer = new Installer();
            }
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
            $pdo = new PDO("pgsql:host=" . $dbInfos["bddHost"] . ";port=" . $dbInfos["bddPort"] . ";dbname=" . $dbInfos["bddName"], $dbInfos["bddUser"], $dbInfos["bddPwd"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //check if db empty
            $query = $pdo->query("SELECT * FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' AND schemaname != 'information_schema'");
            $tables = $query->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($tables)) {
                return false;
            }
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

    /**
     * @param bool $settingsState
     */
    public function setSettingsState(bool $settingsState): void
    {
        $this->settingsState = $settingsState;
    }



    /**
     * @param bool $smtpState
     */
    public function setSmtpState(bool $smtpState): void
    {
        $this->smtpState = $smtpState;
    }

    public function smtp($smtpInfos): bool
    {
        $phpMailer = new PHPMailer(true);
        $phpMailer->isSMTP();
        $phpMailer->Host = $smtpInfos["smtpHost"];
        $phpMailer->SMTPAuth = true;
        $phpMailer->Username = $smtpInfos["smtpUser"];
        $phpMailer->Password = $smtpInfos["smtpPassword"];
        $phpMailer->Port = $smtpInfos["smtpPort"];
        if ($smtpInfos["smtpSecureProtocol"] === "ssl") {
            $phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        $phpMailer->CharSet = PHPMailer::CHARSET_UTF8;
        $phpMailer->isHTML();
        try {
            $phpMailer->smtpConnect();
            $this->addEnvFileContent("SMTP_HOST", $smtpInfos["smtpHost"]);
            $this->addEnvFileContent("SMTP_PORT", $smtpInfos["smtpPort"]);
            $this->addEnvFileContent("SMTP_USER", $smtpInfos["smtpUser"]);
            $this->addEnvFileContent("SMTP_PASSWORD", $smtpInfos["smtpPassword"]);
            $this->addEnvFileContent("SMTP_AUTH", "true");
            $this->addEnvFileContent("SMTP_SECURE", "true");
            $this->addEnvFileContent("SMTP_SECURE_PROTOCOL", $smtpInfos["smtpSecureProtocol"]);
            $this->setSmtpState(true);
            return true;
        } catch (\Exception $e) {
            $this->setSmtpState(false);
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isAdminState(): bool
    {
        return $this->adminState;
    }

    /**
     * @param bool $adminState
     */
    public function setAdminState(bool $adminState): void
    {
        $this->adminState = $adminState;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function createEnvFile(): void
    {
        $envFileContent = "";
        foreach ($this->envFileContent as $key => $value) {
            $envFileContent .= $key . "=" . $value . "\n";
        }
        file_put_contents(ROOT . "/.env", $envFileContent);
    }

    public function createDb(): void
    {
        $pdo = new PDO("pgsql:host=" . $this->envFileContent["DB_HOST"] . ";port=" . $this->envFileContent["DB_PORT"] . ";dbname=" . $this->envFileContent["DB_DATABASE"], $this->envFileContent["DB_USERNAME"], $this->envFileContent["DB_PASSWORD"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = file_get_contents(ROOT . "/database/schema.sql");
        $pdo->exec($query);
    }

    public function getSmtpState(): bool
    {
        return $this->smtpState;
    }

    public function getAdminState(): bool
    {
        return $this->adminState;
    }

    public function createAdmin(): void
    {
        $user = $this->getUser();
        $pdo = new PDO("pgsql:host=" . $this->envFileContent["DB_HOST"] . ";port=" . $this->envFileContent["DB_PORT"] . ";dbname=" . $this->envFileContent["DB_DATABASE"], $this->envFileContent["DB_USERNAME"], $this->envFileContent["DB_PASSWORD"]);
	        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $pdo->prepare("INSERT INTO users (firstname,lastname, email, password, role) VALUES (:firstname,:lastname, :email, :password, :role)");
        $query->bindValue(":firstname", $user->getFirstname());
        $query->bindValue(":lastname", $user->getLastname());
        $query->bindValue(":email", $user->getEmail());
        $query->bindValue(":password", password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $query->bindValue(":role", $user->getRole());
        $query->execute();
        $this->setAdminState(true);
    }

    public function __destruct()
    {
        Session::set("installer", Installer::getInstance());
    }
}