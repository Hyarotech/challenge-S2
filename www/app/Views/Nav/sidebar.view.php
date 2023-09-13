<zdiv class="w-[100px]  p-4">
    <div class="font-bold  ">WordSGI</div>
    <div class="mt-8 flex flex-col space-y-4">
        <?php component('Nav/sideLink',["title"=>"Dashboard","routeName"=>"admin","icon"=>"fa-solid fa-house"]) ?>
        <?php component('Nav/sideLink',["title"=>"Users","routeName"=>"admin.users.viewAll","icon"=>"fa-solid fa-user"]) ?>
        <?php component('Nav/sideLink',["title"=>"Categories","routeName"=>"admin.categories.index","icon"=>"fa-solid fa-border-all"]) ?>
        <?php component('Nav/sideLink',["title"=>"Pages","routeName"=>"admin.page.list","icon"=>"fa-solid fa-pager"]) ?>
        <?php component('Nav/sideLink',["title"=>"Menu","routeName"=>"admin.settings.menu","icon"=>"fa-solid fa-bars"]) ?>

    </div>
</zdiv>