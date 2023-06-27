<?php
namespace App\Controllers;

use App\Models\Page;
use App\Requests\PageCreateRequest;
use Core\Resource;

class PageController 
{
    public function page()
    {
        $page = new Page();
        
        $view = new Resource("Page/index", "front");
        return $view;    
    }
    public function handleCreate(PageCreateRequest $request)
    {
        
    }

 

    /*
    public function list()
    {
        // Logique pour récupérer la liste des pages
        $pages = Page::findAll();

        // Exemple de rendu de la liste des pages
        View::render('page.list', ['pages' => $pages]);
    }

    public function edit($params)
    {
        $id = $params['id'];
        // Logique pour récupérer et afficher la page à éditer
        // ...

        // Exemple de rendu du formulaire d'édition de la page
        View::render('page.edit', ['id' => $id]);
    }

    public function create()
    {
        // Afficher le formulaire de création de page
        View::render('page.create');
    }

    public function delete($params)
    {
        $id = $params['id'];
        // Logique pour supprimer la page correspondant à l'ID
        // ...

        // Redirection vers la liste des pages après la suppression
        $this->redirect('/dashboard/page');
    }

    public function handleCreate()
    {
        // Récupérer les données du formulaire de création de page
        $data = $_POST;

        // Créer une nouvelle instance de la classe Page
        $page = new Page();
        $page->setTitle($data['title']);
        $page->setContent($data['content']);
        // ... Définir les autres propriétés de la page

        // Enregistrer la page dans la base de données
        $page->save();

        // Redirection vers la liste des pages après la création
        $this->redirect('/dashboard/page');
    }

    public function handleEdit($params)
    {
        $id = $params['id'];

        // Récupérer les données du formulaire d'édition de page
        $data = $_POST;

        // Récupérer la page correspondant à l'ID
        $page = Page::findOne($id);
        if ($page) {
            // Mettre à jour les propriétés de la page
            $page->setTitle($data['title']);
            $page->setContent($data['content']);
            // ... Mettre à jour les autres propriétés de la page

            // Enregistrer les modifications dans la base de données
            $page->update();
        }

        // Redirection vers la liste des pages après l'édition
        $this->redirect('/dashboard/page');
    }*/
}
