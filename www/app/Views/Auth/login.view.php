<div class="w-full h-full min-h-[100vh] flex justify-center items-center bg-blue animate__animated animate__fadeIn ">

    <div class="card flex-row w-11/12 max-w-[832px] sm:flex sm:w-11/12 h-auto bg-base-200 shadow-xl">
        <div class="hidden sm:flex w-2/4">
            <img class="h-full w-full object-cover"
                src="https://daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg" alt="Movie" />

        </div>
        <form action="<?= \Core\Router::generateURl("security.login.handle") ?>" method="post" class="card-body">
            <h1 class="text-3xl">Se connecter</h1>
            <hr />



            <div class="grid grid-cols-6 gap-6">


                <div class=" col-span-6">
                    <label class="label">
                        <span class="label-text">E-mail</span>
                    </label>
                    <input type="email" placeholder="XxSasukexX@wanadoo.fr" class="input input-bordered w-full" />
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
                    <input type="password" placeholder="***********" class="input input-bordered w-full" />
                    <label class="label">
                        <span class="label-text-alt text-error  ">
                            <?= \Core\Session::getError("password") ?>
                        </span>
                    </label>
                </div>
            </div>


            <div class="flex w-full flex-wrap">
                <div class="flex w-full justify-center mt-6">
                    <input type="submit" value="Connexion" class="btn btn-primary">

                </div>

                <div class="flex flex-row gap-2 w-full items-center">
                    <p class="text-center text-md mt-6">Pas de compte ? <a
                            href="<?= \Core\Router::generateURl("security.register") ?>"
                            class="link link-primary">S'inscrire</a></p>

                    <a href="<?= \Core\Router::generateURl("security.forgotPassword") ?>"
                        class="text-center text-md mt-6">Réinitialiser mot de passe </a>
                </div>
            </div>

        </form>

    </div>