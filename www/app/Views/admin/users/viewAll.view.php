<div class="flex items-center justify-center h-full">
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr >
                <th>id</th>
                <th>email</th>
                <th>nom</th>
                <th>prénom</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <!-- row 1 -->
            <?php foreach($users as $user) : ?>
                <tr>
                    <th><?=$user->id?></th>
                    <th><?=$user->email?></th>
                    <th><?=$user->lastname?></th>
                    <th><?=$user->firstname?></th>
                    <th>
                        <a class="btn btn-primary"   href="<?= \Core\Router::generateDynamicRoute("admin.users.viewOne",["id"=>$user->id]) ?>"">Voir</a>
                        <a class="btn btn-secondary"   href="<?= \Core\Router::generateDynamicRoute("admin.users.update",["id"=>$user->id]) ?>"">Editer</a>
                        <a class="btn btn-error"   href="<?= \Core\Router::generateDynamicRoute("admin.users.delete",["id"=>$user->id]) ?>"">Supprimer</a>
                    </th>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>