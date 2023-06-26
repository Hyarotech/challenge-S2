<div class="w-full h-full flex justify-center items-center bg-blue animate__animated animate__fadeIn ">

    <div class="card flex-row w-11/12 max-w-[832px] sm:flex sm:w-11/12 h-auto bg-base-200 shadow-xl">
        <div class="hidden sm:flex w-2/4">
            <img class="h-full w-full object-cover"
                src="https://daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg" alt="Movie" />

        </div>
        <form class="card-body" action="<?= \Core\Router::generateRoute("security.register.handle") ?>" method="post">
            <h1 class="text-3xl">S'inscrire</h1>
            <hr />

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-3 sm:col-span-3">
                    <label class="label">
                        <span class="label-text">Nom</span>
                    </label>
                    <input type="text" placeholder="Uchihua" name="firstname" class="input input-bordered w-full" />
                    <label class="label">
                        <span class="label-text-alt text-error  ">
                            <?= \Core\Session::getError("firstname") ?>
                        </span>
                    </label>

                </div>

                <div class="col-span-3 sm:col-span-3">
                    <label class="label">
                        <span class="label-text">Prénom</span>
                    </label>
                    <input type="text" laceholder="Madara" name="lastname" class="input input-bordered w-full" />
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
                        href="<?= \Core\Router::generateRoute("security.login") ?>" class="link link-primary">Se
                        connecter</a></p>

            </div>

        </form>

    </div>
