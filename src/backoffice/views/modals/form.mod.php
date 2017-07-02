<?php $config = $form->getForm();?>
<form method="<?php $this->echoHtml($config["struct"]["method"]);?>"
      action="<?php $this->echoHtml($config["struct"]["action"]);?>"
    <?php if(isset($config["struct"]["enctype"])) :?>
        enctype="<?php $this->echoHtml($config["struct"]["enctype"]);?>"
    <?php endif;?>
      >

    <?php foreach ( $form->getErrors() as $error ):?>
        <p style="color: red;"><?php $this->echoHtml($error);?></p>
    <?php endforeach; ?>

    <?php foreach ($config["data"] as $name => $attributs):?>
    <div class="field <?php $this->echoHtml(isset($attributs["wysiwyg"]) && $attributs["wysiwyg"]?'has-wysiwyg':'');?>">
        <?php if(in_array($attributs["type"], ["email", "text", "password", "number"])) :?>

            <div class="label">
                <label for="<?php $this->echoHtml($name);?>"><?php $this->echoHtml($attributs["label"]);?></label>
            </div>

            <div class="input">
                <input type="<?php $this->echoHtml($attributs["type"]);?>"
                       name="<?php $this->echoHtml($name);?>"
                       placeholder="<?php $this->echoHtml($attributs["placeholder"]);?>"
                       value="<?php $this->echoHtml($form->getObject()->{"get".ucfirst($name)}())?>"
                    <?php $this->echoHtml($attributs["required"]?"required='required'":"");?>
                >
            </div>

        <?php endif;?>

        <?php if(in_array($attributs["type"], ["multiple"])) :?>

            <div class="label">
                <label for="<?php $this->echoHtml($name);?>"><?php $this->echoHtml($attributs["label"]);?></label>
            </div>

            <div class="input">
                <select name="<?php $this->echoHtml($name);?>[]" multiple="multiple">
                    <?php foreach ($attributs["choice"] as $value):?>
                        <option value="<?php $this->echoHtml($value);?>"
                            <?php $this->echoHtml(in_array($value, $form->getObject()->{"get".ucfirst($name)}())? "selected" : '')?>
                        >
                            <?php $this->echoHtml($value);?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>

        <?php endif;?>

        <?php if(in_array($attributs["type"], ["entity"])) :?>

            <div class="label">
                <label for="<?php $this->echoHtml($name);?>"><?php $this->echoHtml($attributs["label"]);?></label>
            </div>

            <div class="input">
                <select name="<?php $this->echoHtml($name . ($attributs["multiple"] ? '[]' : ''));?>"
                    <?php echo ($attributs["multiple"] ? 'multiple="multiple"' : '');?>
                        data-multiple="<?php echo $attributs["multiple"]?'true':'false';?>"
                >
                    <?php foreach ($form->getSelectList($name) as $value):?>
                        <option value="<?php $this->echoHtml($value['id']);?>"
                            <?php echo ($value['active']? "selected" : '')?>
                        >
                            <?php $this->echoHtml($value['label']);?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>

        <?php endif;?>

        <?php if(in_array($attributs["type"], ["radioTrueFalse"])) :?>

            <div class="label">
                <label for="<?php $this->echoHtml($name);?>"><?php $this->echoHtml($attributs["label"]);?></label>
            </div>

            <div class="input">
                <input type="radio" name="<?php $this->echoHtml($name);?>" value="1"
                    <?php $this->echoHtml($form->getObject()->{"get".ucfirst($name)}() == 1 ? 'checked': '')?>> True
                <input type="radio" name="<?php $this->echoHtml($name);?>" value="0"
                    <?php $this->echoHtml($form->getObject()->{"get".ucfirst($name)}() == 0 ? 'checked': '')?>> False
            </div>

        <?php endif;?>

        <?php if(in_array($attributs["type"], ["date"])) :?>

            <div class="label">
                <label for="<?php $this->echoHtml($name);?>"><?php $this->echoHtml($attributs["label"]);?></label>
            </div>

            <div class="input">
                <input type="<?php $this->echoHtml($attributs["type"]);?>"
                       name="<?php $this->echoHtml($name);?>"
                       placeholder="<?php $this->echoHtml($attributs["placeholder"]);?>"
                       value="<?php $this->echoHtml($form->getObject()->{"get".ucfirst($name)}()->format('Y-m-d'))?>"
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
                ><?php $this->echoHtml($form->getObject()->{"get".ucfirst($name)}())?></textarea>
            </div>

        <?php endif;?>


        <?php if(in_array($attributs["type"], ["file"])) :?>

            <?php if(!$form->getObject() instanceof Image && $form->getObject()->{"get".ucfirst($name)}() != null): ?>
                <div class="upload-img">
                    <img src="<?php echo PATH_MEDIAS_UPLOAD.$form->getObject()->{"get".ucfirst($name)}()->getUrl()?>" alt="image">
                </div>
            <?php endif;?>

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

