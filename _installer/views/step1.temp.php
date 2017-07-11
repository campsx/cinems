<div>
    Step 1
</div>
<div>
    <?php if (isset($error)):?>
        <p style="color: red;"><?php echo $error ?></p>
    <?php endif; ?>

    <form action="<?php echo URL_WEBSITE ?>installer/step1" method="post">

        <h2> Identifiant Data base</h2>
        <div>
            <label for="user">User :</label>
            <input type="text" id="user" name="user" />
        </div>
        <div>
            <label for="pwd">Mots de pass :</label>
            <input type="password" id="pwd" name="pwd" />
        </div>

        <h2> Info Data base</h2>
        <div>
            <label for="dbname">Nom pour la base de donnée :</label>
            <input type="text" id="dbname" name="dbname" />
        </div>

        <div>
            <label for="host">Host :</label>
            <input type="text" id="host" name="host" />
        </div>
        <div>
            <label for="port">Port :</label>
            <input type="text" id="port" name="port" />
        </div>
        <div>
            <label for="type">Type de base de donnée :</label>
            <select id="type" name="type">
                <option value="mysql">mysql</option>
            </select>
        </div>

        <div>
            <label for="full">Créer avec data</label>
            <input checked type="checkbox" id="full" name="full" />
        </div>

        <div class="button">
            <button type="submit">Valider</button>
        </div>

    </form>
</div>
