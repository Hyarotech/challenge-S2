<div class="w-full h-full flex justify-center items-center bg-blue animate__animated animate__fadeIn ">

    <div class="card flex-row w-11/12 max-w-[600px] sm:flex sm:w-11/12 h-auto bg-base-200 shadow-xl">

        <div class="card-body">
            <h1 class="text-3xl">Réinitialiser le mot de passe</h1>
            <hr>
            <div class="grid grid-cols-6 gap-6">
                <div class=" col-span-6">
                    <form action="<?= \Core\Router::generateRoute("security.forgotPassword.handle") ?>" method="post">
                        <label class="label" for="email">
                            <span class="label-text">E-mail</span>
                        </label>
                        <input name="email" id="email" type="email" placeholder="XxSasukexX@wanadoo.fr"
                               class="input input-bordered w-full"/>
                        <p class="text-error text-xs"><?= \Core\Session::getError("email") ?></p>

                        <div class="flex w-full flex-wrap">
                            <div class="flex w-full justify-center mt-6">
                                <input type="submit" value="Réinitaliser le mot de passe" class="btn btn-primary">
                            </div>
                            <p class="text-center mt-6">Vous avez un compte ? <a class="link link-primary">Se connecter</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
