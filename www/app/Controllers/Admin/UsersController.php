<?php

namespace App\Controllers\Admin;

use App\Models\Page;
use App\Models\User;
use App\Requests\Users\UpdateUserRequest;
use App\Requests\Users\CreateUserRequest;
use Core\FlashNotifier;
use Core\Request;
use Core\ResourceView;
use Core\Route;
use Core\Router;
use Core\Session;

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

    public function create(): ResourceView
    {
        return new ResourceView("admin/users/create", "back");

    }

    #[CreateUserRequest]
    public function createHandle(Request $request)
    {
        $data = [
            "email" => $request->get("email"),
            "firstname" => $request->get("firstname"),
            "lastname" => $request->get("lastname"),
            "password" => password_hash("password", PASSWORD_DEFAULT),
            "role" => $request->get("role")
        ];
        $created = User::save($data);
        if (!$created) {
            FlashNotifier::error("Création non prise en compte réessayez");

            Router::redirectTo("admin.users.create");
        }
        FlashNotifier::success("Création effectué");
        Router::redirectTo("admin.users.viewAll");
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
            "lastname" => $request->get("lastname"),
            "verified" => $request->get('verified') === "on",
            "role" => $request->get("role")
        ];
        $updated = User::update($id, $data);
        if (!$updated) {
            FlashNotifier::error("Mise à jour non prise en compte réessayez");
            Router::redirectDynamicTo("admin.users.update.handle", ["id" => $id]);
        }
        FlashNotifier::success("Mise à jour effectué");
        Router::redirectTo("admin.users.viewAll");
    }

    public function delete(Request $request): void
    {
        $userSession = Session::get("user");
        $user = User::findBy('email', $userSession['email']);
        if ($user->getId() === (int)$request->get('id')) {
            $response = array();
            $response['success'] = false;
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $result = User::delete('id', (int)$request->get('id'));
            $response = array();
            $response['success'] = $result;
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

}