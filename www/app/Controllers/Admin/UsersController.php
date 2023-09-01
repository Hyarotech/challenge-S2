<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Requests\Users\UpdateUserRequest;
use Core\FlashNotifier;
use Core\Request;
use Core\ResourceView;
use Core\Route;
use Core\Router;

class UsersController
{
    public function viewAll(): ResourceView
    {
        $users = User::findAll();
        $resource = new ResourceView("admin/users/viewAll", 'back');
        $resource->assign("users", $users);
        return $resource;
    }

    public function viewOne()
    {
        $actualRoute = Router::getActualRoute();
        $params = $actualRoute->getParams();
        $id = $params["id"];
        if (!isset($id)) {
            FlashNotifier::error("Utilisateur invalide");
            Router::redirectTo("admin.users.viewAll");
        }
        $user = User::findOne($id);
        if (!$user) {
            FlashNotifier::error("Utilisateur inexistant");
            Router::redirectTo("admin.users.viewAll");
        }
        $view = new ResourceView("admin/users/viewOne", "back");
        $view->assign("user", $user);
        return $view;
    }

    public function update()
    {
        $actualRoute = Router::getActualRoute();
        $params = $actualRoute->getParams();
        $id = $params["id"];
        if (!isset($id)) {
            FlashNotifier::error("Utilisateur invalide");
            Router::redirectTo("admin.users.viewAll");
        }
        $user = User::findOne($id);
        if (!$user) {
            FlashNotifier::error("Utilisateur inexistant");
            Router::redirectTo("admin.users.viewAll");
        }
        $view = new ResourceView("admin/users/update", "back");
        $view->assign("user", $user);
        return $view;
    }

    #[UpdateUserRequest]
    public function updateHandle(Request $request)
    {
        $actualRoute = Router::getActualRoute();
        $params = $actualRoute->getParams();
        $id = $params["id"];
        if (!isset($id)) {
            FlashNotifier::error("Utilisateur invalide");
            Router::redirectTo("admin.users.viewAll");
        }
        $user = User::findOne($id);
        if (!$user) {
            FlashNotifier::error("Utilisateur inexistant");
            Router::redirectTo("admin.users.viewAll");
        }
        $data = [
            "email" => $request->get("email"),
            "firstname" => $request->get("firstname"),
            "lastname" => $request->get("lastname")
        ];
        $updated = User::update($id, $data);
        if (!$updated) {
            FlashNotifier::error("Mise à jour non prise en compte réessayez");
            Router::redirectDynamicTo("admin.users.update.handle", ["id" => $id]);
        }
        FlashNotifier::success("Mise à jour effectué");
        Router::redirectTo("admin.users.viewAll");
    }

    public function delete(): void
    {
        $actualRoute = Router::getActualRoute();
        $params = $actualRoute->getParams();
        $id = $params["id"];
        if (!isset($id)) {
            FlashNotifier::error("Utilisateur invalide");
            Router::redirectTo("admin.users.viewAll");
        }
        $user = User::findOne($id);
        if (!$user) {
            FlashNotifier::error("Utilisateur inexistant");
            Router::redirectTo("admin.users.viewAll");
        }
        User::delete($id);
        FlashNotifier::success("Suppression terminé");
        Router::redirectTo("admin.users.viewAll");
    }

}