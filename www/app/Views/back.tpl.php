<!DOCTYPE html>
<html data-theme="night"  lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma super page</title>
    <meta name="description" content="Ceci est ma super page">
    <link rel="stylesheet" href="<?= \Core\Resource::asset("/css/style.css")?>">
</head>
<body>
    <?php include "partials/flash.tpl.php"; ?>
    <?php include $this->view; ?>

</body>
</html>