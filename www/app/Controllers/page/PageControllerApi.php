<?php

namespace App\Controllers\page;

use Core\Request;
use App\Models\Page;
use App\Requests\PageCreateRequest;
use Core\Session;
use Core\IControllerApi;

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
        $page->setNoFollow($request->get('is_no_follow'));
        $page->setVisibility($request->get('visibility'));
        
        if(Page::findBy('slug', $page->getSlug())){
            Session::set("errors", ["slug" => "Votre slug existe déjà"]);
            return false;
        }
        
        if(!User::findBy('id', $page->getUserId())){
            Session::set("errors", ["user_id" => "L'utilisateur n'existe pas"]);
            return false;
        }
    
        return $page::save();

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