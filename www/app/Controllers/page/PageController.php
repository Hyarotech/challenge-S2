<?php
namespace App\Controllers\Page;

use Core\Resource;
use App\Controllers\page\PageControllerApi;
use App\Models\Page;
use Core\Request;
use Core\Router;
use App\Models\PageBuilderManager;
use App\Configs\PageConfig;
class PageController 
{
    public function page()
    {
        $page = new PageControllerApi();
        $pageDataResponse = $page->readOne(new Request())->getData();
        
        if($pageDataResponse['success'] === false)
            Router::redirectTo("errors.404");

        $pageDataResponse = $pageDataResponse['data']['page'];

        if($pageDataResponse['visibility'] === PageConfig::VISIBILITY['private'])
            Router::redirectTo("errors.404");
        
        $pageLastState = PageBuilderManager::getLast($pageDataResponse['id']);

        /*
         Si j'ai le temps : mettre une page d'erreur avec un modal au milieu qui dit que la page n'a pas de contenu
        */
        if(count($pageLastState) === 0)
            Router::redirectTo("errors.404");

        $pageLastState = $pageLastState[0]->toArray();
        $view = new Resource("Page/index","front");
        $view->assign('isNoFollow',$pageDataResponse['isNoFollow']);
        $view->assign('title',$pageDataResponse['title']);
        $view->assign('description',$pageDataResponse['description']);
        $view->assign('createdAt',$pageDataResponse['createdAt']);
        $view->assign('content',json_decode($pageLastState['state']));
        
        return $view;    
    }
    public function create()
    {
        $view = new Resource("Page/pageSetting","back");
        $formAction = Router::generateRoute("page.create.handle");
        $view->assign('formAction',$formAction);

        
        return $view;
    }

 

    public function edit()
    {
        
        $route = Router::getActualRoute();
        $page = Page::findBy('id', $route->getParam('id'));

        if(!$page)
            Router::redirectTo("errors.404");        
        
        $view = new Resource("Page/pageSetting","back");
        $formAction = Router::generateRoute("page.edit.handle");
        $view->assign('formAction',$formAction);
        $view->assign('pageId',$route->getParam('id'));
        $view->assign('title',$page->getTitle());
        $view->assign('slug',$page->getSlug());
        $view->assign('userId',$page->getUserId());
        $view->assign('createdAt',$page->getCreatedAt());
        $view->assign('description',$page->getDescription());
        $view->assign('isNoFollow',$page->getisNoFollow());
        $view->assign('visibility',$page->getVisibility());

        return $view;
    }
}
