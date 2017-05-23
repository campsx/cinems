<?php $config = $form->getForm(); ?>
<form method="<?php $this->echoHtml($config["struct"]["method"]);?>"
      action="<?php $this->echoHtml($config["struct"]["action"]);?>">

    <?php foreach ( $form->getErrors() as $error ):?>
        <p style="color: red;"><?php $this->echoHtml($error);?></p>
    <?php endforeach; ?>

    <?php foreach ($config["data"] as $name => $attributs):?>

        <?php if(in_array($attributs["type"], ["email", "text", "password", "date"])) :?>

            <label for="<?php $this->echoHtml($name);?>"><?php $this->echoHtml($attributs["label"]);?></label>
            <input type="<?php $this->echoHtml($attributs["type"]);?>"
                   name="<?php $this->echoHtml($name);?>"
                   placeholder="<?php $this->echoHtml($attributs["placeholder"]);?>"
                   <?php $this->echoHtml($attributs["required"]?"required='required'":"");?>
            ><br>

        <?php endif;?>

    <?php endforeach; ?>

    <?php if(isset($config["struct"]["capcha"]) && $config["struct"]["capcha"] === true) :?>
        <img src="<?php echo URL_WEBSITE_API ?>images/capcha" alt="capcha">
        <input type="text" value="" name="capcha">
    <?php endif;?>



    <input type="hidden" name="token_<?php $this->echoHtml($form->getFormName()) ?>" value="<?php $this->echoHtml($form->generateNewToken()); ?>">
    <input type="submit" value="<?php $this->echoHtml($config["struct"]["submit"]);?>" >

</form>