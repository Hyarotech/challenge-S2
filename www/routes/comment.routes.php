<?php
$router = \Core\Router::getInstance();

$router->get("/comment",[\App\Controllers\Comment\CommentController::class,'showAll'])->setName("comment.showAll");