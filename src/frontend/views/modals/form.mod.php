<form method="<?php echo $config["struct"]["method"];?>"
      action="<?php echo $config["struct"]["action"];?>">

    <?php foreach ($config["data"] as $name => $attributs):?>

        <?php if(in_array($attributs["type"], ["email","text"])) :?>

            <input type="<?php echo $attributs["type"];?>"
                   name="<?php echo $name;?>"
                   placeholder="<?php echo $attributs["placeholder"];?>"
                   <?php echo $attributs["required"]?"required='required'":"" ?>
            ><br>

        <?endif;?>

    <?php endforeach; ?>
    <input type="submit" value="<?php echo $config["struct"]["submit"];?>" >

</form>

