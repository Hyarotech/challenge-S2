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

$router->get("/blog/:cat_type",[PageController::class,"blogListArticle"])->setName("blog.article.list");

$router->post("/api/admin/page/edit_categories", [PageControllerApi::class, "editCategories"])->setName("api.admin.page.editCategories");

// Afficher la liste des pages
$router->get("/admin/page/:page_type", [PageController::class, "list"])->setName("admin.page.list");

// Afficher la page à éditer
$router->get("/admin/page/edit/:id", [PageController::class, "edit"])->setName("admin.page.edit");

// Afficher formulaire de création de page
$router->get('/admin/page/create', [PageController::class, 'create'])->setName('admin.page.create');

//Delete une page
$router->post("/api/admin/page/delete", [PageControllerApi::class, "delete"])->setName("api.admin.page.delete");

// Créer une page
$router->post("/admin/page/create", [PageControllerApi::class, "create"])->setName("admin.page.create.handle");

// Editer une page
$router->post("/admin/page/edit", [PageControllerApi::class, "update"])->setName("admin.page.edit.handle");


// Afficher page builder
$router->get("/admin/page/builder/edit/:id", [PageBuilderController::class, "edit"])->setName("admin.page.builder.edit");

// Build une page
$router->post("/api/admin/page/builder/create", [PageBuilderControllerApi::class, "create"])->setName("api.admin.page.builder.create.handle");

// Historique des pages
$router->get("/api/admin/page/builder/history/:page_id", [PageBuilderControllerApi::class, "readAll"])->setName("api.admin.page.builder.history.all");

// Build une page
$router->post("/api/admin/page/builder/delete", [PageBuilderControllerApi::class, "delete"])->setName("api.admin.page.builder.delete.handle");

// Récupérer données d'un memento
$router->get("/api/admin/page/builder/get/:id", [PageBuilderControllerApi::class, "readOne"])->setName("api.admin.page.builder.get.handle");

// Récupérer dernier memento à partir de page_id
$router->get("/api/admin/page/builder/history/last/:page_id", [PageBuilderControllerApi::class, "readLast"])->setName("api.admin.page.builder.history.last");
