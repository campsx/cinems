<section class="one-block vertical-center">
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

        <div>
            <input name="email" placeholder="test@gmail.com" required="required" type="email">
        </div>

        <div>
            <input name="password" placeholder="" required="required" type="password">
        </div>

        <div>
            <input value="Connexion" type="submit">
        </div>

        <div>
            <a href="<?php echo URL_WEBSITE;?>user/forget">
                Mots de pass oublier ?
            </a>
        </div>

    </form>
</section>