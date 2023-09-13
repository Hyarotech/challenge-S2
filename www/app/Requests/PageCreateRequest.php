<?php
namespace App\Requests;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;
use App\Forms\Page\CreateForm;
#[\Attribute] class PageCreateRequest extends Request
{
    public function __construct()
    {
        
        parent::__construct();
        $this->setMethod("POST");
        $form = new CreateForm();
        
        $errors = Verificator::form($form->getConfig(), $this->getData());
        
        if(!empty($errors)) {
            Session::set("errors", $errors);
            Router::redirectTo("admin.page.create");
        }
    }

}