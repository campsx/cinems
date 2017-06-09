<h1> Liste de tous les directors </h1>

<div>
    <div><a href="<?php echo URL_WEBSITE_ADMIN;?>directors/create">Ajouter nouvelle director</a></div>
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
        <?php foreach ( $list as $director ):?>
            <tr>
                <td>
                    <?php $this->echoHtml($director->getId());?>
                </td>
                <td>
                    <?php $this->echoHtml($director->getFirstname());?>
                </td>
                <td>
                    <?php $this->echoHtml($director->getLastname());?>
                </td>
                <td>
                    <?php $this->echoHtml($director->getCreated());?>
                </td>
                <td>
                    <?php $this->echoHtml($director->getUpdated());?>
                </td>
                <td>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>directors/edit/<?php $this->echoHtml($director->getId())?>">Modifier</a>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>directors/remove/<?php $this->echoHtml($director->getId())?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
