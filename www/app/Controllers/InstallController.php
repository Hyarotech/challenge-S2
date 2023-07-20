<?php

namespace App\Controllers;

use App\Models\User;
use Core\ResourceJson;
use Core\Installer;
use Core\ResourceView;
use Core\Router;
use Core\Session;

class InstallController
{
    public function index(): ResourceView
    {
        return new ResourceView("Installer/installer", "install");
    }

    public function install(): ResourceJson
    {
        $installer = Installer::getInstance();
        //create file .env
        $installer->createEnvFile();
        //create database and tables
        $installer->createDb();
        //create admin user
        $installer->createAdmin();
        return new ResourceJson();
    }

    public function getStateInstall(): ResourceJson
    {
        $installer = Installer::getInstance();
        $res = new ResourceJson();
        $res->assign("dbState", $installer->getDbState());
        $res->assign("settingsState", $installer->getSettingsState());
        $res->assign("smtpState", $installer->getSmtpState());
        $res->assign("adminState", $installer->getAdminState());
        $res->assign("envFileContent", $installer->getEnvFileContent());
        return $res;
    }


    public function installDb(): ResourceJson
    {
        $actualRoute = Router::getActualRoute();
        $dbInfos = $actualRoute->getBody();
        $installer = Installer::getInstance();
        $installDb = $installer->installDb($dbInfos);
        if ($installDb) {
            return new ResourceJson();
        } else {
            $response = new ResourceJson();
            $response->addError("global", "Impossible de se connecter à la base de données ou alors la base de données n'est pas vide");
            return $response;
        }
    }

    public function installSettings(): ResourceJson
    {
        $actualRoute = Router::getActualRoute();
        $settings = $actualRoute->getBody();
        $installer = Installer::getInstance();
        if (
            empty($settings["appName"]) ||
            empty($settings["appUrl"]) ||
            empty($settings["appFromEmail"])
        ) {
            $response = new ResourceJson();
            $response->addError("global", "Veuillez remplir tous les champs");
            return $response;
        }
        $installer->addEnvFileContent("APP_NAME", $settings["appName"]);
        $installer->addEnvFileContent("APP_URL", $settings["appUrl"]);
        $installer->addEnvFileContent("APP_FROM_EMAIL", $settings["appFromEmail"]);
        $installer->setSettingsState(true);
        return new ResourceJson();
    }

    public function installSmtp(): ResourceJson
    {
        $actualRoute = Router::getActualRoute();
        $settings = $actualRoute->getBody();
        $installer = Installer::getInstance();
        if (
            empty($settings["smtpHost"]) ||
            empty($settings["smtpPort"]) ||
            empty($settings["smtpUser"]) ||
            empty($settings["smtpPassword"]) ||
            empty($settings["smtpSecureProtocol"])
        ) {
            $response = new ResourceJson();
            $response->addError("global", "Veuillez remplir tous les champs");
            return $response;
        }
        $goodSmtp = $installer->smtp($settings);
        if ($goodSmtp) {
            return new ResourceJson();
        } else {
            $response = new ResourceJson();
            $response->addError("global", "Impossible de se connecter au serveur SMTP");
            return $response;
        }
    }

    public function installAdmin(): ResourceJson
    {
        $actualRoute = Router::getActualRoute();
        $settings = $actualRoute->getBody();
        $installer = Installer::getInstance();
        if (
            empty($settings["firstname"]) ||
            empty($settings["lastname"]) ||
            empty($settings["email"]) ||
            empty($settings["password"]) ||
            empty($settings["passwordConfirm"]) ||
            $settings["password"] !== $settings["passwordConfirm"]
        ) {
            $response = new ResourceJson();
            $response->addError("global", "Veuillez remplir tous les champs");
            return $response;
        }
        $installer->setAdminState(true);
        $user = new User();
        $user->setFirstname($settings["firstname"]);
        $user->setLastname($settings["lastname"]);
        $user->setEmail($settings["email"]);
        $user->setPassword($settings["password"]);
        $user->setVerified(true);
        $user->setRole("ADMIN");
        $installer->setUser($user);
        return new ResourceJson();
    }
}