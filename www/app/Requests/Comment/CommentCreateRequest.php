<?php

namespace App\Requests\Comment;

use Core\FlashNotifier;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;

#[\Attribute] class CommentCreateRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $commentForm = new \App\Forms\Comment\CommentCreateForm();
        $errors = Verificator::form($commentForm->getConfig(), $this->getData());
        if(!empty($errors)) {
            FlashNotifier::error("Le format JSON est invalide");
            Router::redirectToUrl($this->get('redirection'));
        }
    }

}
