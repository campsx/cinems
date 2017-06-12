<h1> Liste de tous les users </h1>

<div>
    <div><a href="<?php echo URL_WEBSITE_ADMIN;?>users/create">Ajouter nouvelle user</a></div>
    <table border="1">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Updated</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        <?php foreach ( $list as $user ):?>
            <tr>
                <td>
                    <?php $this->echoHtml($user->getId());?>
                </td>
                <td>
                    <?php $this->echoHtml($user->getEmail());?>
                </td>
                <td>
                    <?php $this->echoHtml($user->getFirstname());?>
                </td>
                <td>
                    <?php $this->echoHtml($user->getLastname());?>
                </td>
                <td>
                    <?php $this->echoHtml($user->getCreated());?>
                </td>
                <td>
                    <?php $this->echoHtml($user->getUpdated());?>
                </td>
                <td>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>users/edit/<?php $this->echoHtml($user->getId())?>">Modifier</a>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>users/remove/<?php $this->echoHtml($user->getId())?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
