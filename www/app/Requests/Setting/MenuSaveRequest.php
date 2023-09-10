<?php

namespace App\Requests;

use App\Forms\Setting\MenuSaveForm;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;

class MenuSaveRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $menuForm = new MenuSaveForm();
        $errors = Verificator::form($menuForm->getConfig(), $this->getData());
        if(!empty($errors)) {
            FlashNotifier::error("Le format JSON est invalide");
            Router::redirectTo("dashboard.settings.menu");
        }
    }

}
