<!DOCTYPE html>
<html data-theme="dark" lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css"/>
    <script defer
            src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
            crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>

    <script type="module" defer src="<?= getJS() ?>"></script>
  <script type="module" defer src="<?= '/assets/js/main.js'?>"></script>

    <title>GES CMS</title>

    <!-- PROD CSS JS 
        <script type="module" crossorigin src="/assets/js/app.js"></script>
    <link rel="stylesheet" href="/assets/css/style.css">

-->

    <!-- DEV CSS JS -->
    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body class="min-h-screen bg-base-100">
<!--    --><?php // include  ROOT . "/app/Views/partials/flash.tpl.php" ?>
<?php component('partials/flash', [], 'tpl'); ?>

<div class="flex flex-col min-h-screen h-auto">
    <?php component('Nav/sidebar'); ?>

    <div class="z-40 w-full md:w-[calc(100%_-_80px)] md:left-[80px] fixed top-0">
        <?php component('Nav/navbar'); ?>
    </div>

    <div id="app" class="w-full mt-[66px] md:w-[calc(100%_-_80px)] relative flex flex-col md:left-[80px]">
        <?php include $this->view; ?>
    </div>
</div>


</body>

</html>