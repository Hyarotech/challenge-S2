<div class="relative flex flex-col items-center justify-center h-screen overflow-hidden">
    <div class="w-full p-6 bg-base-300  border-t-4 border-primary rounded-md shadow-md border-top lg:max-w-lg">
        <h1 class="text-3xl font-semibold text-center">S'inscrire</h1>
        <form class="space-y-4" action="<?= \Core\Router::generateRoute("security.register.handle") ?>" method="post">
            <div class="flex gap-4">
                <div>
                    <label class="label" for="firstname">
                        <span class="text-base label-text">Firstname</span>
                    </label>

                </div>

                <div class="col-span-3 sm:col-span-3">
                    <label class="label">
                        <span class="label-text">Prénom</span>
                    </label>
                    <input type="text" placeholder="Madara" name="lastname" class="input input-bordered w-full" />
                    <label class="label">
                        <span class="label-text-alt text-error  ">
                            <?= \Core\Session::getError("lastname") ?>
                        </span>
                    </label>

                </div>

                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">E-mail</span>
                    </label>
                    <input type="email" placeholder="XxSasukexX@wanadoo.fr" name="email"
                        class="input input-bordered w-full" />
                    <label class="label">
                        <span class="label-text-alt text-error  ">
                            <?= \Core\Session::getError("email") ?>
                        </span>
                    </label>

                </div>


                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Mot de passe</span>
                    </label>
                    <input type="password" placeholder="***********" name="password"
                        class="input input-bordered w-full" />
                    <label class="label">
                        <span class="label-text-alt text-error  ">
                            <?= \Core\Session::getError("password") ?>
                        </span>
                    </label>

                </div>

                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">Confirmer le mot de passe</span>
                    </label>
                    <input type="password" placeholder="***********" name="confirm_password"
                        class="input input-bordered w-full" />
                    <label class="label">
                        <span class="label-text-alt text-error  ">
                            <?= \Core\Session::getError("confirm_password") ?>
                        </span>
                    </label>

                </div>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <input type="checkbox" id="policy" name="policy" class="checkbox checkbox-success" />
                    <span class="label-text">
                        J'accepte les <a href="#" class="text-xs hover:text-primary">conditions d'utilisation</a>
                    </span>
                </label>
                <p class="text-xs text-error mt-2">
                    <?= \Core\Session::getError("policy") ?>
                </p>
            </div>

            <div class="flex w-full flex-wrap">
                <div class="flex w-full justify-end">
                    <input type="submit" value="S'inscrire" class="btn btn-primary">
                </div>

                <p class="text-center mt-6">Déjà un compte ? <a
                        href="<?= \Core\Router::generateURl("security.login") ?>" class="link link-primary">Se
                        connecter</a></p>

            </div>

        </form>
        <div class="divider">
            Vous avez déja un compte?
        </div>
        <div>
            <a href="<?= \Core\Router::generateRoute("security.login")?>" class="btn btn-block btn-accent">Se connecter</a>
        </div>
    </div>
</div>
