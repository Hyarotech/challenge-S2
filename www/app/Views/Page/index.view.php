<input type="hidden" id="GES_PAGE_TITLE" value="<?= $title ?>">
<input type="hidden" id="GES_PAGE_CREATED_AT" value="<?= $createdAt ?>">
<script src="https://cdn.tailwindcss.com/3.3.3"></script>

<style>
<?= $content->computedCSS ?>
</style>

<?= $content->computedHTML ?>

<script defer>
<?= $content->computedJs ?>
</script>