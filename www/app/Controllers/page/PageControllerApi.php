<?php

namespace App\Controllers\Page;

use App\Models\Page;
use App\Models\User;
use App\Requests\PageCreateRequest;
use Core\IControllerApi;
use Core\Request;
use Core\Session;

class PageControllerApi implements IControllerApi
{

    public function readOne(Request $request)
    {

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

        $dateUpdated = new \DateTime();
        $dateUpdated = $dateUpdated->format('Y-m-d H:i:s');
        $page->setDateUpdated($dateUpdated);
        if(Page::findBy('slug', $page->getSlug())){
            Session::set("errors", ["slug" => "Votre slug existe déjà"]);
            return false;
        }
        
        if(!User::findBy('id', $page->getUserId())){
            Session::set("errors", ["user_id" => "L'utilisateur n'existe pas"]);
            return false;
        }
    
        return Page::save($page);

    }

    public function update(Request $request)
    {
        // TODO: Implement update() method.
    }

    public function delete(Request $request)
    {
        // TODO: Implement delete() method.
    }
}