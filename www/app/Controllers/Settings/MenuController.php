<?php
namespace App\Controllers\Settings;

use Core\Resource;
use Core\Request;
use Core\Router;
class MenuController 
{

    public function edit()
    {
        $view = new Resource("Settings/Menu/menuEditor","back");
        return $view;
    }

}
