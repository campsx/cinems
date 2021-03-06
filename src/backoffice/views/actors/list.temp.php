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
            <th>View</th>
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
                        <?php $this->echoHtml($actor->getUpdated());?>
                    </td>
                    <td>
                        <?php $this->echoHtml($actor->getCreated());?>
                    </td>
                    <td>
                        <?php $this->echoHtml($actor->getView());?>
                    </td>
                    <td>
                        <a href="<?php echo URL_WEBSITE_ADMIN;?>actors/edit/<?php $this->echoHtml($actor->getId())?>">Modifier</a>
                        <a class="remove" href="<?php echo URL_WEBSITE_ADMIN;?>actors/remove/<?php $this->echoHtml($actor->getId())?>">Supprimer</a>
                        <a target="_blank" href="<?php echo URL_WEBSITE;?>actor/view/<?php $this->echoHtml($actor->getSlug())?>">Voir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($page > 1): ?>
        <a href="<?php echo URL_WEBSITE_ADMIN;?>actors/list/<?php echo $page - 1; ?>">Page précédente</a> —
    <?php endif; ?>


    <?php for ($i = 1; $i <= $nbPage; $i++): ?>
        <a href="<?php echo URL_WEBSITE_ADMIN;?>actors/list/<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>


    <?php if ($page < $nbPage): ?>
        — <a href="<?php echo URL_WEBSITE_ADMIN;?>actors/list/<?php echo $page + 1; ?>">Page suivante</a>
    <?php endif; ?>

</div>