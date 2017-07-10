<div>
    Step 1
</div>
<div>
    <?php if (isset($error)):?>
        <p style="color: red;"><?php echo $error ?></p>
    <?php endif; ?>

    <form action="<?php echo URL_WEBSITE ?>installer/step2" method="post">

        <h2>Address Gmail pour le service de mail</h2>
        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" />
        </div>
        <div>
            <label for="pwd">Mots de pass :</label>
            <input type="text" id="pwd" name="pwd" />
        </div>

        <div class="button">
            <button type="submit">Valider</button>
        </div>

    </form>
</div>
