<!DOCTYPE html>
<html data-theme="night" lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma super page</title>
    <link rel="stylesheet" href="<?= \Core\Resource::asset("/css/style.css")?>">
    <script src="https://kit.fontawesome.com/df71b75165.js" crossorigin="anonymous"></script>
</head>
<body class="container">
    <?php include "partials/flash.tpl.php"; ?>
    <?php include $this->view; ?>
</body>
</html>