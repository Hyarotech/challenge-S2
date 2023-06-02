<?php

namespace App\Controllers;

use Core\View;

class ErrorsController
{
    public function notFound(): View
    {
        http_response_code(404);
        return new View("Errors/404","front");
    }

}