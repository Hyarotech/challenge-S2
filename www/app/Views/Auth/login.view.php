<div class="relative flex flex-col items-center justify-center h-screen overflow-hidden">
    <div class="w-full p-6 bg-base-300  border-t-4 border-primary rounded-md shadow-md border-top lg:max-w-lg">
        <h1 class="text-3xl font-semibold text-center">Se connecter</h1>
        <form class="space-y-4" action="<?= \Core\Router::generateURl("security.login.handle") ?>" method="post">
            <div>
                <label class="label" for="email">
                    <span class="text-base label-text">Email</span>
                </label>
                <input id="email" name="email" type="text" placeholder="xyz@example.com" class="w-full input input-bordered" />
            </div>
            <div>
                <label class="label" for="password">
                    <span class="text-base label-text">Mot de passe</span>
                </label>
                <input id="password" name="password" type="password" placeholder="**********"
                       class="w-full input input-bordered" />
            </div>
            <a href="#" class="text-xs hover:text-primary">mot de passe oublié?</a>
            <div>
                <button class="btn btn-block btn-primary">Se connecter</button>
            </div>
        </form>
    </div>
</div>