<?php

namespace App\Controllers;

use App\Models\User;
use App\Requests\User\AddUserRequest;
use App\Requests\User\UpdateUserRequest;
use Core\FlashNotifier;
use Core\Request;
use Core\Resource;
use Core\Router;
use Core\Session;

class UserController
{

    public function viewAll(): Resource
    {
        $users = User::findAll();
        $view = new Resource("Admin/User/viewAll","back");
        $view->assign("users",$users);
        return $view;
    }

    public function viewOne()
    {
        $actualRoute = Router::getActualRoute();
        $id = $actualRoute->getParams()["id"];
        $user = User::findOne($id);
        $view = new Resource("Admin/User/viewOne", "back");
        $view->assign("user", $user);
        return $view;
    }

    public function create(): Resource
    {
        return new Resource("Admin/User/create", "back");
    }

    #[AddUserRequest]
    public function createHandle(AddUserRequest $addUser)
    {
        if(User::findBy("email", $addUser->get("email"))) {
            Session::set("errors", ["email" => "This email already exist"]);
            Router::redirectTo("user.add");
        }
        $data = [
            "email" => $addUser->get("email"),
        ];
        $created = User::save($data);
        if(!$created) {
            FlashNotifier::error("Une erreur est survenue à la création de l'utilisateur");
            Router::redirectTo("user.add");
        }
        FlashNotifier::success("L'utilisateur a bien été crée !");

        Router::redirectTo("user.viewAll");
    }

    public function update()
    {
        return new Resource("Admin/User/update","back");
    }

    #[UpdateUserRequest]
    public function updateHandle(UpdateUserRequest $updateUser)
    {
        if(!User::findBy("email", $updateUser->get("email"))) {
            Session::set("errors", ["email" => "This email does not exist"]);
            Router::redirectTo("user.update");
        }
        $data = [
            "email" => $updateUser->get("email"),
        ];
        $updated = User::save($data);
        if(!$updated) {
            FlashNotifier::error("Une erreur est survenue lors de la mise à jour de l'utilisateur");
            Router::redirectTo("user.update");
        }
        FlashNotifier::success("L'utilisateur a bien été mis à jour !");

        Router::redirectTo("user.viewAll");
    }

    public function delete(Request $deleteUser)
    {
        User::delete($deleteUser->get("id"));

        FlashNotifier::success("L'utilisateur a bien été supprimé !");

        Router::redirectTo("user.viewAll");
    }

}