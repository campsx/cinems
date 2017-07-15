<h1> Liste de toutes les pages </h1>

<div>
    <div><a href="<?php echo URL_WEBSITE_ADMIN;?>pages/create">Ajouter nouvelle page</a></div>
    <table border="1">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Ecrit par</th>
            <th>Updated</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        <?php foreach ( $list as $pageModel ):?>
            <tr>
                <td>
                    <?php $this->echoHtml($pageModel->getId());?>
                </td>
                <td>
                    <?php $this->echoHtml($pageModel->getTitle());?>
                </td>
                <td>
                    <?php $this->echoHtml($pageModel->getSlug());?>
                </td>
                <td>
                    <?php $this->echoHtml($pageModel->getWinter()->getEmail());?>
                </td>
                <td>
                    <?php $this->echoHtml($pageModel->getCreated());?>
                </td>
                <td>
                    <?php $this->echoHtml($pageModel->getUpdated());?>
                </td>
                <td>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>pages/edit/<?php $this->echoHtml($pageModel->getId())?>">Modifier</a>
                    <a class="remove" href="<?php echo URL_WEBSITE_ADMIN;?>pages/remove/<?php $this->echoHtml($pageModel->getId())?>">Supprimer</a>
                    <a target="_blank" href="<?php echo URL_WEBSITE;?>page/view/<?php $this->echoHtml($pageModel->getSlug())?>">Voir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if ($page > 1): ?>
    <a href="<?php echo URL_WEBSITE_ADMIN;?>pages/list/<?php echo $page - 1; ?>">Page précédente</a> —
<?php endif; ?>


<?php for ($i = 1; $i <= $nbPage; $i++): ?>
    <a href="<?php echo URL_WEBSITE_ADMIN;?>pages/list/<?php echo $i; ?>"><?php echo $i; ?></a>
<?php endfor; ?>


<?php if ($page < $nbPage): ?>
    — <a href="<?php echo URL_WEBSITE_ADMIN;?>pages/list/<?php echo $page + 1; ?>">Page suivante</a>
<?php endif; ?>
