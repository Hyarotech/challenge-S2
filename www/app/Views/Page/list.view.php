<div class = "card w-full h-full bg-base-100 shadow-xl">
    <div class = "card-body">
         <h1 class = "text-2xl font-bold w-auto h-auto">Liste des <?= $pageTypeName ?></h1>
         <p class = "w-auto h-auto flex-grow-0">Dans cette section se trouve la liste des pages, on peut ajouter, supprimer ou modifier une page</p>
         <div class="w-full p-2" target="_blank">
          <a href="<?= \Core\Router::generateRoute("admin.page.create") ?>" class="btn btn-sm btn-primary">Ajouter une page</a>
         </div>
         
<div class="overflow-auto daisy-table">
  <table class="table w-full relative" id="page-table">
    <thead>
      <tr>
        <th class="sticky top-0 z-[2] text-center">ID</th>   
        <th class="sticky top-0 z-[2] text-center">Type</th>         
        <th class="sticky top-0 z-[2] text-center">Nom</th>
        <th class="sticky top-0 z-[2] text-center">Slug</th>
        <th class="sticky top-0 z-[2] text-center">Crée le</th>
        <th class="sticky top-0 z-[2] text-center">Modifiée le</th>
        <th class="sticky top-0 z-[2] text-center">Auteur</th>
        <th class="sticky top-0 z-[2] text-center">Indexé ?</th>
        <th class="sticky top-0 z-[2] text-center">Visibilité</th>
        <th class="sticky top-0 z-[2] text-center"></th>
      </tr>
    </thead>
    <tbody>

      <?php foreach($pages as $page): ?>
        <tr class="page-row" data-id="<?= $page->getId(); ?>">
          <td>
            <div class = "w-full h-full flex justify-center">
              <?= $page->getId(); ?>
            <div>
          </td>
          <td>
            <div class = "w-full h-full flex justify-center">
              <?= array_search($page->getPageType(),App\Configs\PageConfig::TYPE) ?>
            <div>
          </td>
          <td>
            <div class = "w-full h-full flex justify-center">
              <?= $page->getTitle(); ?>
            </div>
          </td>
          <td>
            <div class = "w-full h-full flex justify-center">
            <?= $page->getSlug(); ?>

            </div>
          </td>
          <td>
            <div class = "w-full h-full flex justify-center">
            <?= $page->getCreatedAt(); ?>

            </div>
          </td>
          <td>
            <div class = "w-full h-full flex justify-center">
            <?= $page->getUpdatedAt(); ?>

            </div>
          </td>
          <td>
            <div class = "w-full h-full flex justify-center">
              <?php
                $user = \App\Models\User::findBy('id',$page->getUserId());
                echo $user->getFirstName() . " " . $user->getLastName();
               ?>
            </div>
          </td>
          <td>
            <div class = "w-full h-full flex justify-center">
           
              <?= 
                    $page->getIsNoFollow() ?  '<span class="badge badge-error badge-md">Non</span>'
                                        : '<span class="badge badge-success badge-md">Oui</span>'
                ?>
            </div>
          </td>
          <td>
            <div class = "w-full h-full flex justify-center">
            <?= 
                $page->getVisibility() === \App\Configs\PageConfig::VISIBILITY['private']
                ?  '<span class="badge badge-warning badge-md">Privée</span>'
                : '<span class="badge badge-success badge-md">Publique</span>'
              ?>
            </div>
          </td>
          <td>
            <div class = "w-full h-full flex justify-center">         
              <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-sm m-1">Action</label>
                <ul tabindex="0" class="dropdown-content z-[1] menu shadow bg-base-100 rounded-box">
                  <li><a href="<?= \Core\Router::generateDynamicRoute('page',['slug'=> $page->getSlug()]) ?>"><i class="fa-solid fa-eye text-primary"></i> Voir</a></li>
                  <li><a href="<?= \Core\Router::generateDynamicRoute('admin.page.edit',['id'=> $page->getId()]) ?>"><i class="fa-solid fa-pen-to-square text-secondary"></i> Editer</a></li>
                  <li class="delete-page"><a class="text-red-500"><i class="fa-solid fa-trash text-error"></i>Supprimer</a></li>
                </ul>
              </div>

            </div>
          </td>
        </tr>
    <?php endforeach; ?>
    </tbody>    
  </table>
</div>


    </div>
</div>