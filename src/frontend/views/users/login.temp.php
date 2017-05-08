<section class="content">
    <h1>login page</h1>

    <?php if (isset($userActivate)):?>
        <?php if ( $userActivate === true ):?>
            <p style="color: green;">Compte activer</p>
        <?php endif; ?>
        <?php if ( $userActivate === false ):?>
            <p style="color: red;">Probleme d'activation de compte</p>
        <?php endif; ?>
    <?php endif; ?>


    <?php if (isset($errors)):?>
        <?php foreach ( $errors as $error ):?>
            <p style="color: red;"><?php $this->echoHtml($error);?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form method="POST" action="<?php echo URL_WEBSITE ?>user/login">

        <input name="email" placeholder="test@gmail.com" required="required" type="email"><br>

        <input name="password" placeholder="" required="required" type="password"><br>

        <input value="S'inscrire" type="submit">

    </form>
</section>