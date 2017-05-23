<section class="content">
    <h1>Change password</h1>

    <?php if (isset($expirate)):?>
        <?php if ( $expirate === true ):?>
            <p style="color: red;">Token expiré</p>
            <a href="<?php echo URL_WEBSITE ?>user/forget">Demander un nouveau mail</a>
        <?php endif; ?>
    <?php endif; ?>

    <?php $this->includeModal("form", $form); ?>
</section>