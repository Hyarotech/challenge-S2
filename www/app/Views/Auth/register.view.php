<div class="relative flex flex-col items-center justify-center h-screen overflow-hidden">
    <div class="w-full p-6 bg-base-300  border-t-4 border-primary rounded-md shadow-md border-top lg:max-w-lg">
        <h1 class="text-3xl font-semibold text-center">S'inscrire</h1>
        <form class="space-y-4" action="<?= $router->generateURL("security.register.handle") ?>" method="post">
            <div class="flex gap-4">
                <div>
                    <label class="label" for="firstname">
                        <span class="text-base label-text">Firstname</span>
                    </label>
                    <input id="firstname" name="firstname" type="text" placeholder="John" class="w-full input input-bordered" />
                    <p class="text-xs text-error mt-2"><?=\Core\Session::getError("firstname")?></p>
                </div>

                <div>
                    <label class="label" for="lastname">
                        <span class="text-base label-text">Lastname</span>
                    </label>
                    <input id="lastname" name="lastname" type="text" placeholder="Doe" class="w-full input input-bordered" />
                    <p class="text-xs text-error mt-2"><?=\Core\Session::getError("lastname")?></p>
                </div>
            </div>
            <div>
                <label class="label" for="email">
                    <span class="text-base label-text">Email</span>
                </label>
                <input id="email" name="email" type="email" placeholder="xyz@example.com" class="w-full input input-bordered" />
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
            <div>
                <label class="label" for="confirm_password">
                    <span class="text-base label-text">Confirmer le Mot de passe</span>
                </label>
                <input id="confirm_password" name="confirm_password" type="password" placeholder="**********"
                       class="w-full input input-bordered" />
                <p class="text-xs text-error mt-2"><?=\Core\Session::getError("confirm_password")?></p>
            </div>
            <div class="form-control">
                <label class="cursor-pointer label">
                    <input type="checkbox" id="policy" name="policy"  class="checkbox checkbox-success" />
                    <span class="label-text">
                        J'accepte les <a href="#" class="text-xs hover:text-primary">conditions d'utilisation</a>
                    </span>
                </label>
                <p class="text-xs text-error mt-2"><?=\Core\Session::getError("policy")?></p>
            </div>
            <div>
                <button class="btn btn-block btn-primary">S'inscrire</button>
            </div>
        </form>
        <div class="divider">
            Vous avez déja un compte?
        </div>
        <div>
            <a href="<?= $router->generateURL("security.login")?>" class="btn btn-block btn-accent">Se connecter</a>
        </div>
    </div>
</div>