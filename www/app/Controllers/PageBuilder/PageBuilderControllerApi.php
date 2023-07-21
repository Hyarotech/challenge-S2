<?php
namespace App\Controllers\PageBuilder;

use App\Requests\PageBuilderCreateRequest;
use Core\Request;
use Core\Resource;
use App\Models\PageBuilderManager;
use App\Models\PageBuilder;
use Core\IControllerApi;
use App\Requests\PageBuilderRequest;
use Core\Router;
use App\Models\Page;

class PageBuilderControllerApi implements IControllerApi {
    
    #[PageBuilderRequest]
    public function readOne(Request $request){

        $router = Router::getActualRoute();
        $id = $router->getParam("id");

        $pageBuilder = PageBuilderManager::get($id);
        
        header('Content-Type: application/json');
        if(!$pageBuilder){
            $response = array(
                'status' => "error",
                'message' => "PageBuilder not found"       
            );

            die(json_encode($response,JSON_PRETTY_PRINT));
        }
        echo json_encode($pageBuilder->toArray());
    }

    public function readAll(){

        $route = Router::getActualRoute();
        $pageId = $route->getParam('page_id');
        $list = PageBuilderManager::getAll($pageId);
        
        
        foreach($list as &$item)
            $item = $item->toArray();
        
        header('Content-Type: application/json');
        echo json_encode($list,JSON_PRETTY_PRINT);
        
    }

    public function readLast(){

        $route = Router::getActualRoute();
        $pageId = $route->getParam('page_id');
        $item = PageBuilderManager::getLast($pageId);
        header('Content-Type: application/json');
        echo json_encode($item[0]->toArray(),JSON_PRETTY_PRINT);
        
    }
    #[PageBuilderCreateRequest]
    public function create(Request $request){

         $pageId = $request->get("page_id");
         
         $page = Page::findBy('id',$pageId);
         
         if(!$page){
                $response = array(
                    'status' => "error",
                    'message' => "Page not found"       
                );
    
                echo json_encode($response,JSON_PRETTY_PRINT);

                return false;
         }
         $state = json_encode(json_decode($request->get("state"),   JSON_UNESCAPED_SLASHES), JSON_UNESCAPED_SLASHES);

         $pagebuilder  = new PageBuilder($pageId,$state); // On initialise les données dans l'originator
         $memento = $pagebuilder->createMemento(); // On crée un memento
         PageBuilderManager::add($memento); // On ajoute le memento avec le caretaker dans la base de données
         return true;
    }

    #[PageBuilderRequest]
    public function update(Request $request){}

    #[PageBuilderRequest]
    public function delete(Request $request){
        $id = $request->get("id");
        PageBuilderManager::delete('id',$id);
    }
 

  
}
