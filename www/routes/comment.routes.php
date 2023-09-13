<?php



use App\Middlewares\AuthMiddleware;
use App\Controllers\Comment\CommentControllerApi;
use Core\Router;

$router = Router::getInstance();

$router->post("/api/comment/create", [CommentControllerApi::class, "create"])
       ->setName("api.comment.create");

/*$router->post("/api/comment/update", [CommentControllerApi::class, "update"])
       ->setName("api.comment.update");
*/
$router->post("/api/comment/delete", [CommentControllerApi::class, "delete"])
       ->setName("api.comment.delete");
