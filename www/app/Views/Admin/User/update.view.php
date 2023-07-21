<div class="w-full h-full flex justify-center items-center bg-blue animate__animated animate__fadeIn ">
    <div class="card h-auto bg-base-200 shadow-xl">

        <form action="<?= \Core\Router::generateRoute("user.updateHandle") ?>" method="post" class="card-body">

            <h1 class="text-3xl">Ajouter un utilisateur</h1>
            <hr/>
            <p class="text-sm mt-2 text-red-500 text-center"><?= \Core\Session::getError("global") ?></p>

            <div class="grid grid-cols-6 gap-6">
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Nom de l'utilisateur</span>
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
                        <span class="label-text">Prenom de l'utilisateur</span>
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
                        <span class="label-text">Mot de passe</span>
                    </label>
                    <input type="password" name="password"
                           class="input input-bordered w-full"/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                            <?= \Core\Session::getError("password") ?>
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Confirmer le mot de passe</span>
                    </label>
                    <input type="password" name="confirmPassword"
                           class="input input-bordered w-full"/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                            <?= \Core\Session::getError("confirmPassword") ?>
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Conditions d'utilisation</span>
                    </label>
                    <input type="checkbox" name="policy"
                           class="input input-bordered w-full"/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                            <?= \Core\Session::getError("policy") ?>
                        </span>
                    </label>
                </div>
            </div>

            <div class="flex w-full flex-wrap">
                <div class="flex w-full justify-center mt-6">
                    <input type="submit" value="Valider" class="btn btn-primary">
                </div>
            </div>

        </form>

    </div>
</div>