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

class CommentMiddleware extends Middleware
{

    public function handle(Request $request): void
    {
        $user = User::findBy('id',Session::get('user')['id']);
        if($user->getRole() !== Role::ADMIN){
            
            if($request->get('page_id')){
                $page = Page::findBy('id',$request->get('page_id'));
                if(!$page)
                    Router::redirectTo('errors.404');
                if(!$page->getIsCommentEnabled())
                    Router::redirectTo('errors.404');
                if($page->getVisibility() === PageConfig::VISIBILITY['private'])
                    Router::redirectTo('errors.404');
                
                
                
            }
        }
        
    }
}