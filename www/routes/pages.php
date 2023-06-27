<?php
/* - Route of page system -
PS: Pour l'instant toutes les pages iront dans la route /page/:slug,*
si le temps se présente on pourra faire un système de catégorie de page.
*/

//Affichage d'une page sur le site 
$router->get("/page/:slug", [\App\Controllers\PageController::class, "page"])->setName("page");

// Afficher la liste des pages
$router->get("/dashboard/page", [\App\Controllers\PageController::class, "list"])->setName("page.list");

// Afficher la page à éditer
$router->get("/dashboard/page/edit/:id", [\App\Controllers\PageController::class, "edit"])->setName("page.edit");

// Afficher formulaire de création de page
$router->get('/dashboard/page/create', [\App\Controllers\PageController::class, 'create'])->setName('page.create');

// Afficher page builder
$router->get("/dashboard/page/builder/:id", [\App\Controllers\PageController::class, "builder"])->setName("page.builder");

// Afficher page builder
$router->get("/dashboard/page/delete/:id", [\App\Controllers\PageController::class, "delete"])->setName("page.delete");

// Créer une page
$router->post("/dashboard/page/create", [\App\Controllers\PageController::class, "handleCreate"])->setName("page.create.handle");

// Editer une page
$router->post("/dashboard/page/edit/:id", [\App\Controllers\PageController::class, "handleEdit"])->setName("page.edit.handle");

// Build une page
$router->post("/dashboard/page/builder/:id", [\App\Controllers\PageController::class, "handleBuild"])->setName("page.builder.handle");

