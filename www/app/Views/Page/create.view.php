<?php

use App\Configs\PageConfig;
?>


<div class = "p-5">
<h1 class="text-4xl font-bold mb-5">Créer une page</h1>

<form method="POST" action="<?= \Core\Router::generateRoute("page.create.handle") ?>" class="card bg-base-300 p-5 gap-4">
  <p class="text-accent font-bold">Page Information</p>
  <button type="submit" class="flex self-end btn btn-sm btn-secondary">Constructeur de page</button>

    <div class="grid grid-cols-6 gap-3 w-full">
      <input name="title" type="text" placeholder="Titre" class="col-span-6 input input-bordered" />
      <input name="slug" readonly="text" placeholder="Slug" class="col-span-6 input input-bordered" />
      <textarea name="description" class="min-h-[200px] col-span-6 textarea textarea-bordered" placeholder="Description"></textarea>

      <select name="visibility" class="col-span-6 select select-bordered">
        <option selected disabled>Visibilité</option>
        <option value="<?= App\Configs\PageConfig::VISIBILITY['public']?>">Publique</option>
        <option value="<?= App\Configs\PageConfig::VISIBILITY['private']?>">Privée</option>
      </select>

      <input type="text" placeholder="Auteur" name="user_id" class="col-span-6 input input-bordered" />
      <div class="col-span-6 flex items-center">
      <div class="form-control">
    <label class="label cursor-pointer">
      <span class="label-text"> Oui</span> 
      <input type="radio" name="is_no_follow" class="radio checked:bg-accent" checked />
    </label>
  </div>
  <div class="form-control">
    <label class="label cursor-pointaaer">
      <span class="label-text"> Non</span> 
      <input type="radio" name="is_no_follow" class="radio checked:bg-accent" checked />
    </label>
  </div>

    </div>
  </div>
  
  <button type="submit" class="flex self-end btn btn-primary">Enregistrer la page</button>
</form>


</div>
