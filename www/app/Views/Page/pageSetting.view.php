<div class = "w-full h-auto p-5">
<?= component("partials/flash",[],"tpl") ?>
</div>

<div class = "p-5">

<h1 class="text-4xl font-bold mb-5">Créer une page</h1>

<form method="POST" action="<?= $formAction ?>" class="card grid bg-base-300 p-5 gap-4">
  <p class="text-accent font-bold">Page Information</p>

  <div class="w-full flex gap-2">
    <a href="<?= \Core\Router::generateRoute("page.list") ?>" class="btn btn-primary btn-sm">Liste des pages</a>
    <?= isset($pageId)
      ? '<a target="_blank" class="btn btn-secondary btn-sm" href="'.\Core\Router::generateDynamicRoute('page.builder.edit',['id' => $pageId]).'">Constructeur de page</a>'
      : '';
    ?>
   </div>



    <div class="grid grid-cols-6 gap-3 w-full">
      <input name="title" type="text" value="<?= $title ?? '' ?>" placeholder="Titre" class="col-span-6 input input-bordered" />
      <span class="label-text-alt text-red-500 col-span-6">
                            <?= \Core\Session::getError("title") ?>
                        </span>
      <input name="slug" placeholder="Slug" value="<?= $slug ?? '' ?>" class="col-span-6 input input-bordered" />
      <span class="label-text-alt text-red-500 col-span-6">
                            <?= \Core\Session::getError("slug") ?>
                        </span>
      <textarea name="description" class="min-h-[200px] col-span-6 textarea textarea-bordered"><?= $description ?? '' ?></textarea>
      <span class="label-text-alt text-red-500 col-span-6">
                            <?= \Core\Session::getError("description") ?>
                        </span>
    <?= isset($pageId) 
        ? '<input type="hidden" name="id" value="'.$pageId.'"/>'
        : '' 
     ?>

      <select name="visibility" class="col-span-6 select select-bordered">
        <option <?= $visibility ?? 'selected' ?>  disabled>Visibilité</option>
        <option <?= isset($visibility) && $visibility === 1 
                    ? 'selected' : '' ?>
          value="<?= App\Configs\PageConfig::VISIBILITY['public']?>">Publique</option>
        
        <option <?= isset($visibility) && $visibility === 0
                 ? 'selected' : '' ?>
           value="<?= App\Configs\PageConfig::VISIBILITY['private']?>">Privée</option>
      </select>
      <span class="label-text-alt text-red-500 col-span-6">
                            <?= \Core\Session::getError("visibility") ?>
                        </span>
      <input type="text" placeholder="Auteur" name="user_id" value="<?= $userId ?? '' ?>" class="col-span-6 input input-bordered" />
      <span class="label-text-alt text-red-500 col-span-6">
                            <?= \Core\Session::getError("user_id") ?>
                        </span>
      <div class="col-span-6 flex items-center">
      <label class="label font-bold cursor-pointer">Indexé par les moteurs de recherche ?</label>
      
      <div class="form-control">
    <label class="label cursor-pointer">
      <span class="label-text"> Oui</span> 
      <input type="radio" name="is_no_follow" value="1" class="radio checked:bg-accent"
        <?= isset($isNoFollow) && $isNoFollow === true 
                    ? 'checked' : '' ?>    
      />
    </label>
  </div>
  
  <div class="form-control">
    <label class="label cursor-pointaaer">
      <span class="label-text"> Non</span> 
      <input type="radio" name="is_no_follow" value="0" class="radio checked:bg-accent"
        <?= isset($isNoFollow) && $isNoFollow === false 
                    ? 'checked' : '' ?>    
      />
    </label>
  </div>
  <span class="label-text-alt text-red-500 col-span-6">
                            <?= \Core\Session::getError("is_no_follow") ?>
                        </span>
    </div>
  </div>
  
  <button type="submit" class="flex self-end btn btn-primary">Enregistrer la page</button>
</form>


</div>
