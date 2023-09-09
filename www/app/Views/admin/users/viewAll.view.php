<div class = "card w-full h-full bg-base-100 shadow-xl">
    <div class = "card-body">
        <h1 class = "text-2xl font-bold w-auto h-auto">Liste des pages</h1>
        <p class = "w-auto h-auto flex-grow-0">Dans cette section se trouve la liste des pages, on peut ajouter, supprimer ou modifier une page</p>
        <div class="w-full p-2">
            <a  target="_blank" href="<?= \Core\Router::generateRoute("page.create") ?>" class="btn btn-sm btn-primary">Ajouter une page</a>
        </div>

        <div class="overflow-auto daisy-table">
            <table class="table w-full relative" id="users-table">
                <thead>
                <tr>
                    <th class="sticky top-0 z-[2] text-center">ID</th>
                    <th class="sticky top-0 z-[2] text-center">Prénom</th>
                    <th class="sticky top-0 z-[2] text-center">Nom</th>
                    <th class="sticky top-0 z-[2] text-center">Email</th>
                    <th class="sticky top-0 z-[2] text-center">Verified</th>
                    <th class="sticky top-0 z-[2] text-center">Role</th>
                    <th class="sticky top-0 z-[2] text-center"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                    <tr class="user-row" data-id="<?= $user->getId(); ?>">
                        <td>
                            <div class = "w-full h-full flex justify-center">
                                <?= $user->getId(); ?>
                                <div>
                        </td>
                        <td>
                            <div class = "w-full h-full flex justify-center">
                                <?= $user->getFirstName(); ?>
                            </div>
                        </td>
                        <td>
                            <div class = "w-full h-full flex justify-center">
                                <?= $user->getLastName(); ?>
                            </div>
                        </td>
                        <td>
                            <div class = "w-full h-full flex justify-center">
                                <?= $user->getEmail(); ?>
                            </div>
                        </td>
                        <td>
                            <div class = "w-full h-full flex justify-center">
                                <?php $verif = $user->isVerified(); ?>
                                <?php if($verif): ?>
                                    <span class="badge badge-success">Oui</span>
                                <?php else: ?>
                                    <span class="badge badge-error">Non</span>
                                <?php endif; ?>

                            </div>
                        </td>
                        <td>
                            <div class = "w-full h-full flex justify-center">

                            </div>
                        </td>
                        <td>
                            <div class = "w-full h-full flex justify-center">
                                <div class="dropdown dropdown-end">
                                    <label tabindex="0" class="btn btn-sm m-1">Action</label>
                                    <ul tabindex="0" class="dropdown-content z-[1] menu shadow bg-base-100 rounded-box">
                                        <li><a href="<?= \Core\Router::generateDynamicRoute('admin.users.viewOne',['id'=> $user->getId()]) ?>"><i class="fa-solid fa-eye text-primary"></i> Voir</a></li>
                                        <li><a href="<?= \Core\Router::generateDynamicRoute('admin.users.update',['id'=> $user->getId()]) ?>"><i class="fa-solid fa-pen-to-square text-secondary"></i> Editer</a></li>
                                        <li class="delete-user"><a class="text-red-500"><i class="fa-solid fa-trash text-error"></i>Supprimer</a></li>
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