<div data-id="<?= $id ?>" class="ges-commentaire-box flex items-start space-x-4">
    <div class="avatar">
    <div class="w-12 rounded-full">
        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
        </div>
    </div>
    <div class="flex-grow">
        <div class="flex items-center justify-between">
            <div class="font-bold text-white"><?= $author ?></div>
            <div class="text-sm text-white"><?= $createdAt ?></div>
        </div>
        <div class="text-base text-white">
            <?= $message ?>
        </div>
        <div class="flex items-center space-x-2 mt-2">

            <div class="flex justify-end w-full space-x-1 ml-auto">
                <div class="dropdown dropdown-bottom dropdown-end">
                    <label tabindex="0" class="fa-light pointer text-2xl fa-circle-ellipsis-vertical"></label>
                     <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li data-action="delete"><a><i class="fa-solid fa-trash text-error"></i> Supprimer</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>