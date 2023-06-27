<!DOCTYPE html>
<html data-theme="dark" lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css" />
    <title>GES CMS</title>

    <!-- PROD CSS JS 
        <script type="module" crossorigin src="/assets/js/app.js"></script>
    <link rel="stylesheet" href="/assets/css/style.css">

-->

    <!-- DEV CSS JS -->
    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body class="min-h-screen bg-base-100">
<div class="flex flex-col h-auto">
    <div class="z-40 w-full fixed top-0 ">
        <?php $this->component('Nav/navbar'); ?>
    </div>
        <div class="w-full mt-[66px] relative ">
            <?php include $this->view; ?>
        </div>
    </div>

    <?php $this->component('Nav/footer'); ?>

    <script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
  
  <script type="module" crossorigin src="/assets/js/app.js"></script>
</body>

</html>