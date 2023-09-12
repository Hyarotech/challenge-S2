
<section class="flex font-medium items-center justify-center h-screen shadow-xl shadow-base-100">

    <section class="w-64 mx-auto rounded-2xl px-8 py-6 shadow-lg">
        <div class="flex items-center justify-between">
            <span class=" text-sm"><?=\Carbon\Carbon::createFromDate($user->getDateInserted())->diffForHumans()?></span>
        </div>
        <div class="mt-6 w-fit mx-auto">
            <div class="grid w-32 h-32 place-items-center indicator">
                <span class="indicator-item badge badge-success"></span>
                <img src="https://source.unsplash.com/100x100/?portrait" class="rounded-full w-28 " alt="profile picture" srcset="">
            </div>
        </div>


        <div class="mt-8 ">
            <h2 class=" font-bold text-2xl tracking-wide"><?=$user->getFirstName()?> <br/> <?=$user->getLastName()?></h2>
        </div>
        <div class="mt-3  text-sm">
            <span class=" font-semibold">Email:</span>
            <span><?=$user->getEmail()?></span>
        </div>

    </section>


</section>