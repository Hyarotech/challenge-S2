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
<body>
<div>
    <?php include $this->view; ?>
</div>
<script type="module" src="/assets/js/app.js"></script>
</body>
</html>