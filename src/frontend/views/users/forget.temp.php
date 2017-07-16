<section class="one-block vertical-center">
    <h1>Mots de pass oublier</h1>

    <?php if ( $send === true ):?>
        <p style="color: green;">Le mails a été envoyer.</p>
    <?php endif; ?>

    <?php if ( $error === true ):?>
        <p style="color: red;">Une erreur est survenue pendant l'envoie du mail.</p>
    <?php endif; ?>

    <form method="POST" action="<?php echo URL_WEBSITE ?>user/forget">

        <input name="email" placeholder="test@gmail.com" required="required" type="email"><br>

        <input value="Envoyer" type="submit">

    </form>
</section>