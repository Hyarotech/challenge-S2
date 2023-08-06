<?php

namespace App\Controllers\Page;

use App\Models\Page;
use App\Models\User;
use App\Requests\PageCreateRequest;
use App\Requests\PageUpdateRequest;
use Core\FlashNotifier;
use Core\IControllerApi;
use Core\Request;
use Core\Session;
use Core\Router;
use Core\ResourceData;
class PageControllerApi implements IControllerApi
{

    public function readOne(Request $request): ResourceData
    {

        $route = Router::getActualRoute();
        $page = Page::findBy('slug', $route->getParam('slug'));
        $response = new ResourceData();

        if(!$page)
            $response->addError("page", "Page not found");
        else
            $response->assign("page", $page->toArray());

        return $response;
    }

    public function readAll()
    {

    }

    #[PageCreateRequest]
    public function create(Request $request)
    {
        
        $page = new Page();

        $page->setTitle($request->get('title'));
        $page->setSlug($request->get('slug'));
        $page->setUserId($request->get('user_id'));
        $page->setDescription($request->get('description'));
        $page->setIsNoFollow($request->get('is_no_follow'));
        $page->setVisibility($request->get('visibility'));
        $page->setUserId($request->get('user_id'));

        $dateUpdated = new \DateTime();
        $dateUpdated = $dateUpdated->format('Y-m-d H:i:s');
        $page->setUpdatedAt($dateUpdated);
        if(Page::findBy('slug', $page->getSlug())){
            FlashNotifier::error("Le slug existe déjà");
            Router::redirectTo("page.create");
            return false;
        }
        if(!User::findBy('id', $page->getUserId())){
            FlashNotifier::error("L'utilisateur n'existe pas");
            Router::redirectTo("page.create");
            return false;
        }
        FlashNotifier::success("La page a bien été créée");
        Page::save($page);
        Router::redirectTo("page.create");

        

    }

    #[PageUpdateRequest]
    public function update(Request $request)
    {
        $pageId = $request->get('id');
        
        $page = Page::findBy('id',$pageId);
        $response = new ResourceData();
    
        if (!$page) {
            $response->addError("page", "Page not found");
            return $response;
        }
     
        $page->setTitle($request->get('title'));
        $page->setSlug($request->get('slug'));
        $page->setDescription($request->get('description'));
        $page->setIsNoFollow((bool)$request->get('is_no_follow'));
        $page->setVisibility($request->get('visibility'));
        $page->setUserId($request->get('user_id'));
        $dateUpdated = new \DateTime();
        $dateUpdated = $dateUpdated->format('Y-m-d H:i:s');
        $page->setUpdatedAt($dateUpdated);
        $url = Router::generateDynamicRoute("page.edit", ["id" => $pageId]);
        if (!Page::findBy('slug', $page->getSlug())) {
            FlashNotifier::error("Le slug existe déjà");
            Router::redirectToUrl($url);
            return $response;
        }
    
        if (!User::findBy('id', $page->getUserId())) {
            FlashNotifier::error("L'utilisateur n'existe pas");
            Router::redirectToUrl($url);
            return $response;
        }
        
        FlashNotifier::success("La page a bien été mise à jour");
        $data = [
            'title' => $page->getTitle(),
            'slug' => $page->getSlug(),
            'description' =>  $page->getDescription(),
            'is_no_follow' => $page->getIsNoFollow(),
            'visibility' => $page->getVisibility(),
            'updated_at' => frenchDate()->format('Y-m-d'),
            'user_id' => $page->getUserId()
        ];
        Page::update($pageId,$data);
        Router::redirectToUrl($url);
        
        return $response;
    }
    

    public function delete(Request $request)
    {
            Page::delete('id',$request->get('id'));
    }
}