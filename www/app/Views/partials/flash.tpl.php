<?php
$error = Core\FlashNotifier::get("error");
if ($error):?>
    <div class="absolute top-10 right-10">
        <div class="alert alert-error">
            <div class="flex items-center">
                <span class="select-none"><?= $error ?></span>
                <button class="ml-2 cursor-pointer" onclick="this.parentElement.parentElement.remove()"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
$success = Core\FlashNotifier::get("success");
if($success):?>
    <div class="absolute top-10 right-10">
        <div class="alert alert-success">
            <div class="flex items-center">
                <span class="select-none"><?= $success ?></span>
                <button class="ml-2" onclick="this.parentElement.parentElement.remove()"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php
$warning = Core\FlashNotifier::get("warning");
if($warning):?>
    <div class="absolute top-10 right-10">
        <div class="alert alert-warning">
            <div class="flex items-center">
                <span class="select-none"><?= $warning ?></span>
                <button class="ml-2" onclick="this.parentElement.parentElement.remove()"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php
$info = Core\FlashNotifier::get("info");
if($info):?>
    <div class="absolute top-10 right-10">
        <div class="alert alert-info">
            <div class="flex items-center">
                <span class="select-none"><?= $info?></span>
                <button class="ml-2" onclick="this.parentElement.parentElement.remove()"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
        </div>
    </div>
<?php endif; ?>

