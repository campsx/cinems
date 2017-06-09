<h1> Liste de tous les actors </h1>

<div>
    <div><a href="<?php echo URL_WEBSITE_ADMIN;?>actors/create">Ajouter nouvelle acteur</a></div>
    <table border="1">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Updated</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
            <?php foreach ( $list as $actor ):?>
                <tr>
                    <td>
                        <?php $this->echoHtml($actor->getId());?>
                    </td>
                    <td>
                        <?php $this->echoHtml($actor->getFirstname());?>
                    </td>
                    <td>
                        <?php $this->echoHtml($actor->getLastname());?>
                    </td>
                    <td>
                        <?php $this->echoHtml($actor->getCreated());?>
                    </td>
                    <td>
                        <?php $this->echoHtml($actor->getUpdated());?>
                    </td>
                    <td>
                        <a href="<?php echo URL_WEBSITE_ADMIN;?>actors/edit/<?php $this->echoHtml($actor->getId())?>">Modifier</a>
                        <a href="<?php echo URL_WEBSITE_ADMIN;?>actors/remove/<?php $this->echoHtml($actor->getId())?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>