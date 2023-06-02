<div class="relative flex flex-col items-center justify-center h-screen overflow-hidden">
    <div class="w-full p-6 bg-base-300  border-t-4 border-primary rounded-md shadow-md border-top lg:max-w-lg">
        <h1 class="text-3xl font-semibold text-center">Se connecter</h1>
        <p class="text-xs text-error mt-2"><?=\Core\Session::getError("global")?></p>
        <form class="space-y-4" action="<?=\Core\Router::generateRoute("security.login.handle")?>" method="post">
            <div>
                <label class="label" for="email">
                    <span class="text-base label-text">Email</span>
                </label>
                <input id="email" name="email" type="text" placeholder="xyz@example.com" class="w-full input input-bordered" />
                <p class="text-xs text-error mt-2"><?=\Core\Session::getError("email")?></p>
            </div>
            <div>
                <label class="label" for="password">
                    <span class="text-base label-text">Mot de passe</span>
                </label>
                <input id="password" name="password" type="password" placeholder="**********"
                       class="w-full input input-bordered" />
                <p class="text-xs text-error mt-2"><?=\Core\Session::getError("password")?></p>
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
        <div class="divider">
            Vous n'avez pas de compte?
        </div>
        <div>
            <a href="<?= \Core\Router::generateRoute("security.register")?>" class="btn btn-accent btn-block">S'inscrire</a>
        </div>
    </div>
</div>
