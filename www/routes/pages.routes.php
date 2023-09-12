<?php
/* - Route of page system -
PS: Pour l'instant toutes les pages iront dans la route /page/:slug,*
si le temps se présente on pourra faire un système de catégorie de page.
*/

use App\Controllers\page\PageController;
use App\Controllers\page\PageControllerApi;
use App\Controllers\PageBuilder\PageBuilderController;
use App\Controllers\PageBuilder\PageBuilderControllerApi;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\PageExistAndVisibleMiddleWare;
use Core\Router;

$router = Router::getInstance();


//Affichage d'une page sur le site 
$router->get("/page/:slug", [PageController::class, "page"])
       ->setName("page")
       ->setMiddlewares([PageExistAndVisibleMiddleWare::class]);
$router->get("/blog/:cat_type",[PageController::class,"blogListArticle"])->setName("blog.article.list");

$router->post("/api/admin/page/edit_categories", [PageControllerApi::class, "editCategories"])
       ->setName("api.admin.page.editCategories")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);
 
// Afficher la liste des pages
$router->get("/admin/page/:page_type", [PageController::class, "list"])
       ->setName("admin.page.list")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);
// Afficher la page à éditer
$router->get("/admin/page/edit/:id", [PageController::class, "edit"])
       ->setName("admin.page.edit")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);
        
// Afficher formulaire de création de page
$router->get('/admin/page/create', [PageController::class, 'create'])
       ->setName('admin.page.create')
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);

//Delete une page
$router->post("/api/admin/page/delete", [PageControllerApi::class, "delete"])
       ->setName("api.admin.page.delete")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);

// Créer une page
$router->post("/admin/page/create", [PageControllerApi::class, "create"])
       ->setName("admin.page.create.handle")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);

// Editer une page
$router->post("/admin/page/edit", [PageControllerApi::class, "update"])
       ->setName("admin.page.edit.handle")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);


// Afficher page builder
$router->get("/admin/page/builder/edit/:id", [PageBuilderController::class, "edit"])
       ->setName("admin.page.builder.edit")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);

// Build une page
$router->post("/api/admin/page/builder/create", [PageBuilderControllerApi::class, "create"])
       ->setName("api.admin.page.builder.create.handle")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);

// Historique des pages
$router->get("/api/admin/page/builder/history/:page_id", [PageBuilderControllerApi::class, "readAll"])
       ->setName("api.admin.page.builder.history.all")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);


// Build une page
$router->post("/api/admin/page/builder/delete", [PageBuilderControllerApi::class, "delete"])
       ->setName("api.admin.page.builder.delete.handle")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);

// Récupérer données d'un memento
$router->get("/api/admin/page/builder/get/:id", [PageBuilderControllerApi::class, "readOne"])
       ->setName("api.admin.page.builder.get.handle")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);


// Récupérer dernier memento à partir de page_id
$router->get("/api/admin/page/builder/history/last/:page_id", [PageBuilderControllerApi::class, "readLast"])
       ->setName("api.admin.page.builder.history.last")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);

