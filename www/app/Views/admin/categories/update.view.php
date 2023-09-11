<div class="w-full h-full flex justify-center items-center bg-blue animate__animated animate__fadeIn ">
    <div class="card h-auto bg-base-200 shadow-xl">
        <form action="<?= \Core\Router::generateDynamicRoute("admin.categories.update.handle",['id'=>$category->getId()]) ?>"
              method="post" class="card-body">
            <?php csrf() ?>
            <h1 class="text-3xl">Editer la catégorie <?= $category->getName(); ?></h1>
            <p class="text-sm mt-2 text-red-500 text-center"><?= \Core\Session::getError("global") ?></p>

            <div class="grid grid-cols-6 gap-6">
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Category name</span>
                    </label>
                    <input type="text" name="name" value="<?= $category->getName(); ?>"
                           class="input input-bordered w-full"/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                        <?= \Core\Session::getError("name") ?>
                        </span>
                    </label>
                </div>
            </div>
            <div class="flex w-full flex-wrap">
                <div class="flex w-full justify-center mt-6">
                    <button type="submit" class="btn btn-small btn-info">Editer</button>
                </div>
            </div>

        </form>

    </div>
</div>