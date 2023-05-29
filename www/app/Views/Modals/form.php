<form
        method="<?= $config["config"]["method"]??"GET" ?>"
        action="<?= $config["config"]["action"] ?>">

    <div class="flex flex-col">
        <?php foreach ($config["inputs"] as $name=>$input):?>

            <?php if($input["type"] == "select"):?>
                <select class="select w-full max-w-xs" name="<?= $name;?>">
                    <option disabled selected>
                        <?= $input["placeholder"]?>
                    </option>
                    <?php foreach ($input["options"] as $option):?>
                        <option><?= $option;?></option>
                    <?php endforeach;?>
                </select>
            <?php else: ?>
                <input
                    name="<?= $name;?>"
                    type="<?= $input["type"]?>"
                    placeholder=" <?= $input["placeholder"]?>"
                    class="input input-bordered w-full max-w-xs "
                >
            <?php endif;?>

        <?php endforeach; ?>
    </div>



    <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
    <input type="reset" value="<?= $config["config"]["cancel"] ?>">
</form>