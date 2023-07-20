<?php

namespace App\Controllers;

use Core\ResourceJson;
use Core\Installer;
use Core\ResourceView;
use Core\Router;

class InstallController
{
    public function index(): ResourceView
    {
        return new ResourceView("Installer/installer", "install");
    }

    public function getStateInstall(): ResourceJson
    {
        $installer = Installer::getInstance();
        $res = new ResourceJson();
        $res->assign("dbState", $installer->getDbState());
        $res->assign("settingsState", $installer->getSettingsState());
        $res->assign("envFileContent", $installer->getEnvFileContent());
        return $res;
    }

    public function getVdom()
    {
        $actualRoute = Router::getActualRoute();
        $viewAsked = $actualRoute->getBody()["view"];
        header('Content-Type: text/html; charset=utf-8');
        echo (new ResourceView($viewAsked,"back",true))->getVDom();
        exit();
    }

    public function installDb(): ResourceJson
    {

        $actualRoute = Router::getActualRoute();
        $dbInfos = $actualRoute->getBody();
        $installer = Installer::getInstance();
        $installDb = $installer->installDb($dbInfos);
        if ($installDb) {
            return $response = new ResourceJson();
        } else{
            $response = new ResourceJson();
            $response->addError("global", "Impossible de se connecter à la base de données");
            return $response;
        }
    }
}