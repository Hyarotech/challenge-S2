<?php

namespace App\Controllers;

use Core\Resource;

class InstallController
{
    public function index(): Resource
    {
        return new Resource("Installer/installer", "install");
    }
}