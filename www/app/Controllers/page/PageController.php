<?php
namespace App\Controllers\Page;

use Core\Resource;
use App\Controllers\page\PageControllerApi;
use App\Models\Page;
use Core\Request;
use Core\Router;
use App\Models\PageBuilderManager;
use App\Configs\PageConfig;
use App\Models\Category;
use Core\Session;

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
        $author = \App\Models\User::findBy('id',$pageDataResponse['userId']);
        
        
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
        $view->assign('pageType',$pageDataResponse['pageType']);
        $view->assign('author', strip_tags($author->getFirstName() . " " . $author->getLastName()));
        $view->assign('content',json_decode($pageLastState['state']));
        
        return $view;    
    }
    public function create()
    {
        
        $view = new Resource("Page/pageSetting","back");
        $formAction = Router::generateRoute("admin.page.create.handle");
        $view->assign('formAction',$formAction);
        $view->assign('pageType','');
        $view->assign('selectedUser',Session::get('user')['id']);

        
        return $view;
    }

    public function list(){
        $route = Router::getActualRoute();
        $pageType = (int)$route->getParam('page_type');
        if(!in_array($pageType,PageConfig::TYPE))
            $pages = Page::findAll();
        else
            $pages = Page::findAllBy('page_type',$pageType);
        
        $pageTypeName = array_search($pageType,PageConfig::TYPE);
        $view = new Resource("Page/list","back");
        $view->assign('categoryList',Category::findAll());
        $view->assign('pageTypeName',$pageTypeName ? $pageTypeName : " pages");
        $view->assign('pages',$pages);
        return $view;
    }
 
    public function blogListArticle(){
        $route = Router::getActualRoute();
        $categoryName = Category::formatName($route->getParam('cat_type'));
        $category = Category::findBy('name',$categoryName);
        if(!$category)
           Router::redirectTo('errors.404'); 
        
        $listArticle = \App\Models\Article::findAllByCategory($category->getId());

        $view = new Resource('Page/blogListArticle','front');
        $view->assign('listArticle',$listArticle);
        $view->assign('categoryName',$categoryName);

        return $view;
    }
    public function edit()
    {
        
        $route = Router::getActualRoute();
        
        $page = Page::findBy('id', (int)$route->getParam('id'));
        
        if(!$page)
            Router::redirectTo("errors.404");        
        $view = new Resource("Page/pageSetting","back");
        $formAction = Router::generateRoute("admin.page.edit.handle");
        $view->assign('formAction',$formAction);
        $view->assign('pageId',$route->getParam('id'));
        $view->assign('title',$page->getTitle());
        $view->assign('slug',$page->getSlug());
        $view->assign('userId',$page->getUserId());
        $view->assign('createdAt',$page->getCreatedAt());
        $view->assign('description',$page->getDescription());
        $view->assign('isNoFollow',$page->getisNoFollow());
        $view->assign('visibility',$page->getVisibility());
        $view->assign('pageType',$page->getPageType());
        $view->assign('selectedUser',$page->getUserId());
        return $view;
    }
}
