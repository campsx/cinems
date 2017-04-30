<?php $config = $form->getFrom(); ?>
<form method="<?php echo $config["struct"]["method"];?>"
      action="<?php echo $config["struct"]["action"];?>">

    <?php foreach ( $form->getErrors() as $error ):?>
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

    <img src="http://localhost:8080/cinems/api/images/capcha" alt="capcha">

    <input type="text" value="" name="capcha">

    <input type="hidden" name="token_<?php echo $form->getFormName() ?>" value="<?php echo $form->getRequest()->session()->getToken($form->getFormName()); ?>">
    <input type="submit" value="<?php echo $config["struct"]["submit"];?>" >

</form>

