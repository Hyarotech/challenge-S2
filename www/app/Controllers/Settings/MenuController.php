<?php
namespace App\Controllers\Settings;

use Core\Resource;
use Core\Request;
use Core\Router;
use App\Models\Page;
class MenuController 
{

    public function edit()
    {
        
        $view = new Resource("Settings/Menu/menuEditor","back");
        $listPage = Page::findAll();
    
        foreach($listPage as $key => $page)
            $listPage[$key] = $page->toArray();
        $view->assign("pageListJson",json_encode($listPage,JSON_UNESCAPED_UNICODE));
        return $view;
    }

}
