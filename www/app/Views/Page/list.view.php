<div class = "card w-full h-full bg-base-100 shadow-xl">
    <div class = "card-body">
         <h1 class = "text-2xl font-bold w-auto h-auto">Liste des pages</h1>
         <p class = "w-auto h-auto flex-grow-0">Dans cette section se trouve la liste des pages, on peut ajouter, supprimer ou modifier un utilisateur</p>
         <div class="w-full p-2" target="_blank">
          <a href="<?= \Core\Router::generateRoute("page.create") ?>" class="btn btn-sm btn-primary">Ajouter une page</a>
         </div>
         <div class="overflow-x-auto">
  <table class="table w-full">
    <!-- head -->
    <thead>
      <tr>
        <th class="text-center">ID</th>      
        <th class="text-center">Nom</th>
        <th class="text-center">Slug</th>
        <th class="text-center">Auteur</th>
        <th class="text-center">Indexé ?</th>
        <th class="text-center">Visibilité</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
      <tr class="page-row" data-id="">
        <td>
          <div class = "w-full h-full flex justify-center">
            1
          <div>
        </td>
        <td>
          <div class = "w-full h-full flex justify-center">
            Ma page
          </div>
        </td>
        <td>
          <div class = "w-full h-full flex justify-center">
            Ma-page
          </div>
        </td>
        <td>
          <div class = "w-full h-full flex justify-center">
            Auteur de la page
          </div>
        </td>
        <td>
          <div class = "w-full h-full flex justify-center">
            <span class="badge badge-success badge-md">Oui</span>
          </div>
        </td>
        <td>
          <div class = "w-full h-full flex justify-center">
            <span class="badge badge-primary badge-md">Publique</span>
          </div>
        </td>
        <td>
          <div class = "w-full h-full flex justify-center">         
            <div class = "flex flex-row gap-2">
              <button class="btn btn-error btn-sm">Supprimer</button>
              <button class="btn btn-primary btn-sm">Voir</button>
            </div>
          </div>
        </td>
      </tr>
    
    </tbody>    
  </table>
</div>


    </div>
</div>