<?php
namespace App\Requests;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;
use App\Forms\Page\EditForm;

class PageUpdateRequest extends Request
{
    public function __construct()
    {
        
        parent::__construct();
        $this->setMethod("POST");
        $form = new EditForm();
    
        $errors = Verificator::form($form->getConfig(), $this->getData());
        if(!empty($errors)) {
            Session::set("errors", $errors);
            $url = Router::generateDynamicRoute("page.edit", ["id" => $this->get("id")]);
            Router::redirectToUrl($url);
        }
    }

}