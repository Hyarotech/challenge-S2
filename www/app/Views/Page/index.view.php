<input type="hidden" id="GES_PAGE_TITLE" value="<?= $title ?>">
<input type="hidden" id="GES_PAGE_CREATED_AT" value="<?= $createdAt ?>">
<script src="https://cdn.tailwindcss.com/3.3.3"></script>

    <?php if($pageType == \App\Configs\PageConfig::TYPE['article']): ?>
        <div class="flex flex-col items-center my-8 gap-2">
            <h1 class="text-4xl font-bold"><?= $title ?></h1>
            <p>Par <span class="text-accent font-bold" ><?= $author ?></span> le <?= str_replace('-','/',$createdAt) ?></p>
        </div>
    <?php endif; ?>

    <style>
    <?= $content->computedCSS ?>
    </style>

    <?= $content->computedHTML ?>

    <script defer>
    <?= $content->computedJs ?>
    </script>
