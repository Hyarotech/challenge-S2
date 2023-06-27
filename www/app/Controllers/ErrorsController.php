<?php

namespace App\Controllers;

use Core\Resource;

class ErrorsController
{
    public function notFound(): Resource
    {
        http_response_code(404);
        return new Resource("Errors/404","front");
    }

}