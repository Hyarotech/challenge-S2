<?php

namespace App\Requests\Setting;

use App\Forms\Setting\MenuSaveForm;
use Core\FlashNotifier;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;

#[\Attribute] class MenuSaveRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $menuForm = new MenuSaveForm();
        $errors = Verificator::form($menuForm->getConfig(), $this->getData());
        if(!empty($errors)) {
            FlashNotifier::error("Le format JSON est invalide");
            Router::redirectTo("admin.settings.menu");
        }
    }

}
