<form method="<?php echo $config["struct"]["method"];?>"
      action="<?php echo $config["struct"]["action"];?>">

    <?php foreach ( $this->data['errors'] as $error):?>
        <p style="color: red;"><?php echo $error;?></p>
    <?php endforeach; ?>

    <?php foreach ($config["data"] as $name => $attributs):?>

        <?php if(in_array($attributs["type"], ["email", "text", "password", "date"])) :?>

            <label for="<?php echo $name;?>"><?php echo $attributs["label"];?></label>
            <input type="<?php echo $attributs["type"];?>"
                   name="<?php echo $name;?>"
                   placeholder="<?php echo $attributs["placeholder"];?>"
                   <?php echo $attributs["required"]?"required='required'":"";?>
            ><br>

        <?php endif;?>

    <?php endforeach; ?>
    <input type="hidden" name="token" value="<?php echo $this->data['request']->session()->getToken(); ?>">
    <input type="submit" value="<?php echo $config["struct"]["submit"];?>" >

</form>

