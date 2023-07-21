<div class="flex items-center justify-center h-full">
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr >
                <th>id</th>
                <th>name</th>
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            <!-- row 1 -->
            <?php foreach($users as $user) : ?>
                <tr>
                    <th><?=$user->id?></th>
                    <th><?=$user->name?></th>
                    <th>
                        <a class="btn btn-primary"   href="<?= \Core\Router::generateRoute("user.update") ?>"">Editer</a>
                        <a class="btn btn-error" href="<?= \Core\Router::generateRoute("user.delete") ?>"">Supprimer</a>
                    </th>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
