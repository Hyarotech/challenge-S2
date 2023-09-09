<div class="w-full h-full flex justify-center items-center bg-blue animate__animated animate__fadeIn ">
    <div class="card h-auto bg-base-200 shadow-xl">
        <form action="<?= \Core\Router::generateRoute("admin.users.create.handle") ?>"
              method="post" class="card-body">
            <h1 class="text-3xl">Créer un utilisateur</h1>
            <p class="text-sm mt-2 text-red-500 text-center"><?= \Core\Session::getError("global") ?></p>

            <div class="grid grid-cols-6 gap-6">
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email"
                           class="input input-bordered w-full"/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                        <?= \Core\Session::getError("email") ?>
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Nom</span>
                    </label>
                    <input type="text" name="lastname"
                           class="input input-bordered w-full"/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                        <?= \Core\Session::getError("lastname") ?>
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Prénom</span>
                    </label>
                    <input type="text" name="firstname"
                           class="input input-bordered w-full"/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                        <?= \Core\Session::getError("firstname") ?>
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select name="role" class="select w-full max-w-xs">
                        <option disabled selected>Pick a role</option>
                        <option>ADMIN</option>
                        <option>USER</option>
                    </select>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                        <?= \Core\Session::getError("firstname") ?>
                        </span>
                    </label>
                </div>
            </div>
            <div class="flex w-full flex-wrap">
                <div class="flex w-full justify-center mt-6">
                    <button type="submit" class="btn btn-small btn-info">Créer</button>
                </div>
            </div>

        </form>

    </div>
</div>