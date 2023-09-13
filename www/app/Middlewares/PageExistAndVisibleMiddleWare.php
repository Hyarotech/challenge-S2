<?php

namespace App\Middlewares;

use App\Configs\PageConfig;
use App\Models\Page;
use App\Models\User;
use Core\Middleware;
use Core\Request;
use Core\Role;
use Core\Router;
use Core\Session;
use Exception;

class PageExistAndVisibleMiddleWare extends Middleware
{

    public function handle(Request $request): void
    {
        
      if (Session::has("user")) {
        $user = User::findOne(Session::get("user")['id']);
        $userRole = $user->getRole();
    } else {
        $user = null; // Ou toute autre valeur par défaut appropriée
        $userRole = Role::USER;
    }
        
       
        $route = Router::getActualRoute();
        $page = Page::findBy('slug',$route->getParam('slug'));
        
        if(!$page)
            Router::redirectTo("errors.404");

        if($page->getVisibility() === PageConfig::VISIBILITY['private'] && $userRole !== Role::ADMIN)
            Router::redirectTo("errors.404");
        
    }
}