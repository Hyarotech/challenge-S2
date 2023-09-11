<?php
/* - Route of page system -
PS: Pour l'instant toutes les pages iront dans la route /page/:slug,*
si le temps se présente on pourra faire un système de catégorie de page.
*/

use App\Controllers\page\PageController;
use App\Controllers\page\PageControllerApi;
use App\Controllers\PageBuilder\PageBuilderController;
use App\Controllers\PageBuilder\PageBuilderControllerApi;

use Core\Router;

$router = Router::getInstance();


//Affichage d'une page sur le site 
$router->get("/page/:slug", [PageController::class, "page"])->setName("page");

// Afficher la liste des pages
$router->get("/admin/page", [PageController::class, "list"])->setName("page.list");

// Afficher la page à éditer
$router->get("/admin/page/edit/:id", [PageController::class, "edit"])->setName("page.edit");

// Afficher formulaire de création de page
$router->get('/admin/page/create', [PageController::class, 'create'])->setName('page.create');

//Delete une page
$router->post("/admin/page/delete", [PageControllerApi::class, "delete"])->setName("page.delete");

// Créer une page
$router->post("/admin/page/create", [PageControllerApi::class, "create"])->setName("page.create.handle");

// Editer une page
$router->post("/admin/page/edit", [PageControllerApi::class, "update"])->setName("page.edit.handle");


// Afficher page builder
$router->get("/admin/page/builder/edit/:id", [PageBuilderController::class, "edit"])->setName("page.builder.edit");

// Build une page
$router->post("/admin/page/builder/create", [PageBuilderControllerApi::class, "create"])->setName("page.builder.create.handle");

// Historique des pages
$router->get("/admin/page/builder/history/:page_id", [PageBuilderControllerApi::class, "readAll"])->setName("page.builder.history.all");

// Build une page
$router->post("/admin/page/builder/delete", [PageBuilderControllerApi::class, "delete"])->setName("page.builder.delete.handle");

// Récupérer données d'un memento
$router->get("/admin/page/builder/get/:id", [PageBuilderControllerApi::class, "readOne"])->setName("page.builder.get.handle");

// Récupérer dernier memento à partir de page_id
$router->get("/admin/page/builder/history/last/:page_id", [PageBuilderControllerApi::class, "readLast"])->setName("page.builder.history.last");
