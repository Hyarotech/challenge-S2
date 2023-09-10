<?php
namespace App\Controllers\Settings;

use Core\Resource;
use Core\Request;
use Core\Router;
use App\Models\Page;
use App\Models\Setting;
use App\Configs\SettingConfig;
use App\Requests\MenuSaveRequest;
use Core\FlashNotifier;
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

    #[MenuSaveRequest]
    public function save(Request $request){
        $data = $request->getData();
        FlashNotifier :: success("Le menu a bien été sauvegardé");
        Router::redirectTo("dashboard.settings.menu");
    }

}
