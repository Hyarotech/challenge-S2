<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Requests\Categories\CreateCategoryRequest;
use App\Requests\Categories\UpdateCategoryRequest;
use Core\FlashNotifier;
use Core\Request;
use Core\ResourceView;
use Core\Router;

class CategoryController
{

    public function index(): ResourceView
    {
        $categories = Category::findAll();
        $resource = new ResourceView("admin/categories/index", 'back');
        $resource->assign("categories", $categories);
        return $resource;
    }

    public function list(): ResourceView
    {
        $categories = Category::findAll();
        $view = new ResourceView("Categories/list",'front');

        $view->assign('categories',$categories);

        return $view;
    }

    public function create(): ResourceView
    {
        return new ResourceView("admin/categories/create", "back");
    }


    #[CreateCategoryRequest]
    public function handleCreate(Request $request): void
    {
        $data = [
            "name" => Category::formatName($request->get("name")),
        ];
        //check if category already exist
        $category = Category::findBy("name",$data["name"]);
        if($category){
            FlashNotifier::error("Cette catégorie existe déjà");
            Router::redirectTo("admin.categories.create");
        }
        $created = Category::save($data);
        if (!$created) {
            FlashNotifier::error("Création non prise en compte réessayez");
            Router::redirectTo("admin.categories.create");
        }
        FlashNotifier::success("Création effectué");
        Router::redirectTo("admin.categories.index");
    }



    public function viewOne(): ResourceView
    {
        $actualRoute = Router::getActualRoute();
        $params = $actualRoute->getParams();
        $id = $params["id"];
        if (!isset($id)) {
            FlashNotifier::error("Catégorie invalide");
            Router::redirectTo("admin.categories.index");
        }
        $category = Category::findOne($id);
        if (!$category) {
            FlashNotifier::error("Catégorie inexistante");
            Router::redirectTo("admin.categories.index");
        }
        $view = new ResourceView("admin/categories/viewOne", "back");
        $view->assign("category", $category);
        return $view;
    }

    public function update(): ResourceView
    {
        $actualRoute = Router::getActualRoute();
        $params = $actualRoute->getParams();
        $id = $params["id"];
        if (!isset($id)) {
            FlashNotifier::error("Catégorie invalide");
            Router::redirectTo("admin.categories.index");
        }
        $category = Category::findOne($id);
        if (!$category) {
            FlashNotifier::error("Catégorie inexistante");
            Router::redirectTo("admin.categories.index");
        }
        $view = new ResourceView("admin/categories/update", "back");
        $view->assign("category", $category);
        return $view;
    }

    #[UpdateCategoryRequest]
    public function handleUpdate(Request $request): void
    {
        $actualRoute = Router::getActualRoute();
        $params = $actualRoute->getParams();
        $id = $params["id"];
        if (!isset($id)) {
            FlashNotifier::error("Catégorie invalide");
            Router::redirectTo("admin.categories.index");
        }
        $category = Category::findOne($id);
        if (!$category) {
            FlashNotifier::error("Catégorie inexistante");
            Router::redirectTo("admin.categories.index");
        }
        $data = [
            "name" => Category::formatName($request->get("name")),
        ];
        $category = Category::findBy("name",$data["name"]);
        if($category){
            FlashNotifier::error("Cette catégorie existe déjà");
            Router::redirectDynamicTo("admin.categories.update",["id" => $id]);
        }
        $updated = Category::update($id, $data);
        if (!$updated) {
            FlashNotifier::error("Mise à jour non prise en compte réessayez");
            Router::redirectDynamicTo("admin.categories.update", ["id" => $id]);
        }
        FlashNotifier::success("Mise à jour effectué");
        Router::redirectTo("admin.categories.index");
    }

    public function delete(Request $request): void
    {
        $result = Category::delete('id',(int)$request->get('id'));
        $response = array();
        $response['success'] = $result;
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}