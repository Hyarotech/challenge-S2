<?php
namespace App\Requests;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;
use App\Forms\PageBuilder\PageBuilderCreateForm;
class PageBuilderCreateRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $form = new PageBuilderCreateForm();

        $errors = Verificator::form($form->getConfig(), $this->getData());
        
        if(!empty($errors)){
            $response = array(
                'status' => "error",
                "errors" => $errors
            );

            header('Content-Type: application/json');
            die(json_encode($response,JSON_PRETTY_PRINT));
        }
    }

}