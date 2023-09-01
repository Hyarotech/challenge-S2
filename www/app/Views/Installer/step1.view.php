<div class="w-full h-full flex justify-center items-center bg-blue animate__animated animate__fadeIn ">
    <div class="card h-auto bg-base-200 shadow-xl">
        <form onsubmit="installDb(e)" method="post" class="card-body">
            <h1 class="text-3xl">Installation de la base de données</h1>
            <hr/>
            <p class="text-sm mt-2 text-red-500 text-center"></p>
            <div class="grid grid-cols-12">
                <div class=" col-span-6">
                    <label class="label" for="bddName">
                        <span class="label-text">Nom de la base de données</span>
                    </label>
                    <input id="bddName" type="text" name="bddName"
                           class="input input-bordered w-full" value=""/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                            erreur ici
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label" for="bddHost">
                        <span class="label-text">Host de la base de données</span>
                    </label>
                    <input id="bddHost" type="text" name="bddHost"
                           class="input input-bordered w-full" value=""/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                            erreur ici
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label" for="bddPort">
                        <span class="label-text">Port de la base de données</span>
                    </label>
                    <input id="bddPort" type="text" name="bddPort"
                           class="input input-bordered w-full" value=""/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                            erreur ici
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label" for="bddUser">
                        <span class="label-text">User admin de la base de données</span>
                    </label>
                    <input id="bddUser" type="text" name="bddUser"
                           class="input input-bordered w-full" value=""/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                            erreur ici
                        </span>
                    </label>
                </div>
                <div class=" col-span-6">
                    <label class="label" for="bddPwd">
                        <span class="label-text">Password de la base de données</span>
                    </label>
                    <input id="bddPwd" type="text" name="bddPwd"
                           class="input input-bordered w-full" value=""/>
                    <label class="label">
                        <span class="label-text-alt text-red-500">
                            erreur ici
                        </span>
                    </label>
                </div>
            </div>
            <div class="flex w-full flex-wrap">
                <div class="flex w-full justify-center mt-6">
                    <input type="submit" value="Ajouter" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <script>
        function installDb(e) {
            e.preventDefault();
            console.log("installDb");
        }
    </script>
</div>