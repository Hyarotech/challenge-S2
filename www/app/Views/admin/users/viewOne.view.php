<div class="flex items-center justify-center h-full">
    <div class="grid grid-cols-12  gap-10">

        <div class="col-span-full">
            <span class="bg-base-200 p-4">Email:</span>
            <span class="bg-base-300 p-4"><?= $user->email ?></span>
        </div>
        <div class="col-span-full">
            <span class="bg-base-200 p-4">Prénom:</span>
            <span class="bg-base-300 p-4"><?= $user->firstname ?></span>
        </div>
        <div class="col-span-full">
            <span class="bg-base-200 p-4">Nom:</span>
            <span class="bg-base-300 p-4"><?= $user->lastname ?></span>
        </div>
        <div class="col-span-full">
            <span class="bg-base-200 p-4">role:</span>
            <span class="bg-base-300 p-4"><?= $user->role ?></span>
        </div>

    </div>
</div>