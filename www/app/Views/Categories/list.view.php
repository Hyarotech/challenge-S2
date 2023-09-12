<div class="p-5">
    <div class="flex w-full flex-col items-center">
        <h1 class="text-4xl text-center font-bold mb-5">Liste des catégories</h1>
    </div>
    <div class="mt-10 md:w-3/4 flex mx-auto flex-row flex-wrap justify-center gap-5 ">
        <?php foreach($categories as $category): ?>
            <a href="<?= \Core\Router::generateDynamicRoute('blog.article.list',['cat_type' => $category->getName()]) ?>" class="btn hover:opacity-80 transition-all btn-info">
                <?= $category->getName(); ?>
            </a>
            
        <?php endforeach; ?>
    </div>
</div>