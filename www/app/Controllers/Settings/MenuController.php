<?php
namespace App\Controllers\Settings;

use Core\Resource;
use Core\Request;
use Core\Router;
use App\Models\Page;
use App\Models\Setting;
use App\Requests\Setting\MenuSaveRequest;
use Core\FlashNotifier;
use Core\Session;
class MenuController 
{

    public function edit(): Resource
    {
        
        $view = new Resource("Settings/Menu/menuEditor","back");
        $listPage = Page::findAll();
    
        foreach($listPage as $key => $page)
            $listPage[$key] = $page->toArray();
        $menuJson = Session::get("menu_json");
        if(!$menuJson)
            $menuJson = Setting::findBy("key","menu_json")->getValue();
        $view->assign("pageListJson",json_encode($listPage,JSON_UNESCAPED_UNICODE));
        $view->assign("menuJson",base64_encode($menuJson));
        Session::remove("menu_json");
        return $view;
    }

    public function getMenu(){
        return Setting::findBy("key","menu_json")->getValue();
    }
    #[MenuSaveRequest]
    public function save(Request $request): void
    {
        $data = $request->getData();
        Setting::delete("key","menu_json");

        $isSaved = Setting::save([
            "key" => "menu_json",
            "value" => $data["menu_json"]
        ]);

        if($isSaved)
            FlashNotifier :: success("Le menu a bien été sauvegardé");
        else
            FlashNotifier :: success("Le menu n'a été sauvegardé");

        Session::set("menu_json",$data["menu_json"]);
        Router::redirectTo("dashboard.settings.menu");
    }

}
