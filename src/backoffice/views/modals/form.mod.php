<?php $config = $form->getForm(); ?>
<form method="<?php $this->echoHtml($config["struct"]["method"]);?>"
      action="<?php $this->echoHtml($config["struct"]["action"]);?>"
    <?php if(in_array("enctype", $config["struct"])) :?>
        enctype="<?php $this->echoHtml($config["struct"]["enctype"]);?>"
    <?php endif;?>
      >

    <?php foreach ( $form->getErrors() as $error ):?>
        <p style="color: red;"><?php $this->echoHtml($error);?></p>
    <?php endforeach; ?>

    <?php foreach ($config["data"] as $name => $attributs):?>
    <div class="field <?php $this->echoHtml(isset($attributs["wysiwyg"]) && $attributs["wysiwyg"]?'has-wysiwyg':'');?>">
        <?php if(in_array($attributs["type"], ["email", "text", "password", "date"])) :?>

            <div class="label">
                <label for="<?php $this->echoHtml($name);?>"><?php $this->echoHtml($attributs["label"]);?></label>
            </div>

            <div class="input">
                <input type="<?php $this->echoHtml($attributs["type"]);?>"
                       name="<?php $this->echoHtml($name);?>"
                       placeholder="<?php $this->echoHtml($attributs["placeholder"]);?>"
                    <?php $this->echoHtml($attributs["required"]?"required='required'":"");?>
                >
            </div>

        <?php endif;?>

        <?php if(in_array($attributs["type"], ["textarea"])) :?>

            <div class="label">
                <label for="<?php $this->echoHtml($name);?>"><?php $this->echoHtml($attributs["label"]);?></label>
            </div>

            <div class="input">
                <textarea name="<?php $this->echoHtml($name);?>"
                    <?php $this->echoHtml($attributs["required"]?"required='required'":"");?>
                    <?php $this->echoHtml(isset($attributs["wysiwyg"]) && $attributs["wysiwyg"]?'class=wysiwyg':"");?>
                ></textarea>
            </div>

        <?php endif;?>


        <?php if(in_array($attributs["type"], ["file"])) :?>

            <div class="label">
                <label for="<?php $this->echoHtml($name);?>"><?php $this->echoHtml($attributs["label"]);?></label>
            </div>

            <div class="input">
                <input type="<?php $this->echoHtml($attributs["type"]);?>"
                       name="<?php $this->echoHtml($name);?>"
                       placeholder="<?php $this->echoHtml($attributs["placeholder"]);?>"
                    <?php $this->echoHtml($attributs["required"]?"required='required'":"");?>
                >
            </div>

        <?php endif;?>

    </div>
    <?php endforeach; ?>

    <?php if(isset($config["struct"]["capcha"]) && $config["struct"]["capcha"] === true) :?>
        <img src="<?php echo URL_WEBSITE_API ?>images/capcha" alt="capcha">
        <input type="text" value="" name="capcha">
    <?php endif;?>



    <input type="hidden" name="token_<?php $this->echoHtml($form->getFormName()) ?>" value="<?php $this->echoHtml($form->generateNewToken()); ?>">
    <input type="submit" value="<?php $this->echoHtml($config["struct"]["submit"]);?>" >

</form>

