<div class="w-full h-full flex justify-center items-center bg-blue animate__animated animate__fadeIn ">

    <div class="card flex-row w-11/12 max-w-[600px] sm:flex sm:w-11/12 h-auto bg-base-200 shadow-xl">

        <div class="card-body">
            <h1 class="text-3xl">Réinitialiser le mot de passe</h1>
            <hr>
            <div class="grid grid-cols-6 gap-6">
                <div class=" col-span-6">
                    <form action="<?= \Core\Router::generateRoute("security.resetPassword.handle") ?>" method="post">
                        <div>
                            <label class="label" for="password">
                                <span class="label-text">Password</span>
                            </label>
                            <input name="email" id="password" type="password" placeholder="****************"
                                   class="input input-bordered w-full"/>
                            <p class="text-error text-xs"><?= \Core\Session::getError("password") ?></p>
                        </div>
                        <div>
                            <label class="label" for="password">
                                <span class="label-text">Confirm password</span>
                            </label>
                            <input name="email" id="password" type="password" placeholder="****************"
                                   class="input input-bordered w-full"/>
                            <p class="text-error text-xs"><?= \Core\Session::getError("confirm_password") ?></p>
                        </div>

                        <div class="flex w-full flex-wrap">
                            <div class="flex w-full justify-center mt-6">
                                <input type="submit" value="Soumettre" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
