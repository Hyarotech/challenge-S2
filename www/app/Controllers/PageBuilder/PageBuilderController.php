<?php
namespace App\Controllers\PageBuilder;

use Core\Resource;
use Core\Router;
use App\Models\Page;
class PageBuilderController
{
    public function edit()
    {
        
        $route = Router::getActualRoute();
        
        $page = Page::findBy('id',$route->getParam('id'));
         
        if(!$page)
            Router::redirectTo("errors.404");


        $view = new Resource("PageBuilder/editor", "pagebuilder");
        $view->assign("page_id", $route->getParam('id'));
        return $view;    
    }
    
  
}
