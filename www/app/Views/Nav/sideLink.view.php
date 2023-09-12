<?php

$actualRoute = \Core\Router::getActualRoute();
?>
<div class="tooltip tooltip-right" data-tip="<?=$title ?>">
    <a href="<?= \Core\Router::generateRoute($routeName) ?>" class="btn <?= $actualRoute->getName() === $routeName ? 'btn-primary' : '' ?>">
        <i class="<?=$icon?>" ></i>
    </a>
</div>