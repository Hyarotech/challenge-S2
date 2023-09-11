<div class="flex items-center justify-center h-full">
    <div class="grid grid-cols-12  gap-10">

        <div class="col-span-full">
            <span class="bg-base-200 p-4">Email:</span>
            <span class="bg-base-300 p-4"><?= $user->getEmail() ?></span>
        </div>
        <div class="col-span-full">
            <span class="bg-base-200 p-4">Prénom:</span>
            <span class="bg-base-300 p-4"><?= $user->getFirstName() ?></span>
        </div>
        <div class="col-span-full">
            <span class="bg-base-200 p-4">Nom:</span>
            <span class="bg-base-300 p-4"><?= $user->getLastName() ?></span>
        </div>
        <div class="col-span-full">
            <span class="bg-base-200 p-4">role:</span>
            <span class="bg-base-300 p-4"><?= $user->getRole() ?></span>
        </div>

    </div>
</div>