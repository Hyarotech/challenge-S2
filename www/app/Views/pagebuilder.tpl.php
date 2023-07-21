<!DOCTYPE html>
<html data-theme="light" lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <link rel="stylesheet" href="/assets/css/pagebuilder.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script 
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-tailwind"></script>
   
    <script type="module" defer src="<?= getJS() ?>"></script>

    <title>GES CMS</title>


</head>

<body class="min-h-screen bg-base-100">
            <?php include $this->view; ?>
</body>

</html>