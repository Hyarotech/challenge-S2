<div class = "card w-full h-full bg-base-100 shadow-xl">
    <div class = "card-body">
        <h1 class = "text-2xl font-bold w-auto h-auto">Liste des catégories</h1>
        <p class = "w-auto h-auto flex-grow-0">Dans cette section se trouve la liste des catégories, on peut ajouter, supprimer ou modifier une catégorie</p>
        <div class="w-full p-2">
            <a href="<?= \Core\Router::generateRoute("admin.categories.create") ?>" class="btn btn-sm btn-primary">Ajouter une categorie</a>
        </div>

        <div class="overflow-auto daisy-table">
            <table class="table w-full relative" id="categories-table">
                <thead>
                <tr>
                    <th class="sticky top-0 z-[2] text-center">ID</th>
                    <th class="sticky top-0 z-[2] text-center">Nom</th>
                    <th class="sticky top-0 z-[2] text-center"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($categories as $category): ?>
                    <tr class="category-row" data-id="<?= $category->getId(); ?>">
                        <td>
                            <div class = "w-full h-full flex justify-center">
                                <?= $category->getId(); ?>
                                <div>
                        </td>
                        <td>
                            <div class = "w-full h-full flex justify-center">
                                <?= $category->getName(); ?>
                            </div>
                        </td>
                        <td>
                            <div class = "w-full h-full flex justify-center">
                                <div class="dropdown dropdown-end">
                                    <label tabindex="0" class="btn btn-sm m-1">Action</label>
                                    <ul tabindex="0" class="dropdown-content z-[1] menu shadow bg-base-100 rounded-box">
                                        <li><a href="<?= \Core\Router::generateDynamicRoute('admin.categories.update',['id'=> $category->getId()]) ?>"><i class="fa-solid fa-pen-to-square text-secondary"></i> Editer</a></li>
                                        <li class="delete-category"><a class="text-red-500"><i class="fa-solid fa-trash text-error"></i>Supprimer</a></li>
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