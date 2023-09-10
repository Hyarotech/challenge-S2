<?php

namespace App\Requests\Categories;

use App\Forms\Categories\CreateCategoryForm;
use App\Forms\Categories\UpdateCategoryForm;
use Attribute;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;

#[Attribute]
class UpdateCategoryRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $form = new UpdateCategoryForm();
        $errors = Verificator::form($form->getConfig(), $this->getData());
        Session::set("errors", $errors);
        if (!empty($errors)) {
            Session::set("old", $this->getData());
            Router::redirectTo("admin.categories.create");
        }
    }
}