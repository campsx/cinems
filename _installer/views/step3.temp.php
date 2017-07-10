<div>
    Step 1
</div>
<div>
    <?php if (isset($error)):?>
        <p style="color: red;"><?php echo $error ?></p>
    <?php endif; ?>

    <form method="POST" action="<?php echo URL_WEBSITE ?>installer/step3">
        <h2>Compte Admin</h2>

        <div>
            <label for="email">Votre email</label>
            <input name="email" placeholder="test@gmail.com" required="required" type="email"><br>
        </div>

        <div>
            <label for="pseudo">Votre Pseudo</label>
            <input name="pseudo" placeholder="jojodu77" required="required" type="text"><br>
        </div>

        <div>
            <label for="password">Votre Password</label>
            <input name="password" placeholder="********" required="required" type="password"><br>
        </div>

        <div>
            <label for="firstname">Votre nom</label>
            <input name="firstname" placeholder="Jean" type="text"><br>
        </div>

        <div>
            <label for="lastname">Votre Prenom</label>
            <input name="lastname" placeholder="Dupont" type="text"><br>
        </div>

        <div>
            <label for="age">Votre age</label>
            <input name="age" placeholder="1990-12-14" type="date"><br>
        </div>

        <input value="Créer compte" type="submit">

    </form>

</div>
