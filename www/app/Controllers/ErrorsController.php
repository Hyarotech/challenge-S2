<?php

namespace App\Controllers;

use Core\ResourceView;

class ErrorsController
{
    public function notFound(): ResourceView
    {
        http_response_code(404);
        return new ResourceView("Errors/404", "front");
    }

}
