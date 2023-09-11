<div class="w-full h-full flex justify-center items-center bg-blue animate__animated animate__fadeIn ">
    <div class="card h-auto bg-base-200 shadow-xl">
        <form action="<?= \Core\Router::generateDynamicRoute("admin.users.update.handle", ["id" => $user->getId()]) ?>"
              method="post" class="card-body">
            <?php csrf() ?>
            <h1 class="text-3xl">Modifier l'utilisateur <?= $user->getEmail() ?></h1>
            <p class="text-sm mt-2 text-red-500 text-center"><?= \Core\Session::getError("global") ?></p>

            <div class="grid grid-cols-6 gap-6">
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" value="<?= $user->getEmail() ?>"
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
                    <input type="text" name="lastname" value="<?= $user->getLastName() ?>"
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
                    <input type="text" name="firstname" value="<?= $user->getFirstName() ?>"
                           class="input input-bordered w-full"/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                        <?= \Core\Session::getError("firstname") ?>
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Verified</span>
                    </label>
                    <input name="verified" type="checkbox" class="toggle toggle-success" <?php if ($user->isVerified()):  ?> checked <?php endif; ?> />
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                        <?= \Core\Session::getError("verified") ?>
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select name="role" class="select w-full max-w-xs">
                        <?php foreach (\Core\Role::getRoles() as $role) : ?>
                            <option <?php if ($user->getRole() === $role): ?> selected <?php endif; ?> value="<?= $role ?>"><?= \Core\Role::getRoleName($role) ?></option>
                        <?php endforeach; ?>
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
                    <button type="submit" class="btn btn-small btn-info">Modifier</button>
                </div>
            </div>

        </form>

    </div>
</div>