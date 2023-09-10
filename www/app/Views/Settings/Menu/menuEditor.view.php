<div class="p-5">
    <h1 class="text-4xl text-center font-bold mb-5">Editeur de menu</h1>
    
        <div class="hidden" id="GES_PAGE_LIST"><?= $pageListJson; ?></div>

        <form method="POST" id="formMenu" action="<?= \Core\Router::generateRoute("dashboard.settings.menu.save") ?>" class = "w-full flex justify-center p-4 gap-2 ">
            <button type="submit" class="btn flex flex-self relative bottom-0 btn-sm btn-primary ">Enregistrer le menu</button>
            <input type="hidden" name="menu_json" value="<?= \Core\Session::get('menu_json') ?>" />
            <button type="button" data-selector="addItem" class="btn btn-secondary btn-sm ">Ajouter</button>
        </form>
        <div class="card md:w-3/6 m-auto flex justify-center bg-base-200 p-5 gap-4" id="flex-form">
            


            <div id="menuList" class="max-h-[65vh] overflow-y-auto relative ">

                
            </div>
        </div>
        <div>
        </div>

    
  

</div>
