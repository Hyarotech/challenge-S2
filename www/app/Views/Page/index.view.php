<h1 class="text-4xl font-bold text-center w-full p-5"><?= $title ?></h1>
<p class="p-5 "><?= "Créée le ". $createdAt ?></p>
<script src="https://cdn.tailwindcss.com/3.3.3"></script>

<style>
<?= $content->computedCSS ?>
</style>

<?= $content->computedHTML ?>

<script>
<?= $content->computedJs ?>
</script>