<?php
namespace App\Requests;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;
use App\Forms\Page\CreateForm;
class PageCreateRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $form = new CreateForm();
        $errors = Verificator::form($form->getConfig(), $this->getData());
        Session::set("errors", $errors);
    
        if(!empty($errors)) {
            var_dump($errors);
            die();
        }
    }

}