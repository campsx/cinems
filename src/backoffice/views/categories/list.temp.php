<h1> Liste de tous les categories </h1>

<div>
    <div><a href="<?php echo URL_WEBSITE_ADMIN;?>categories/create">Ajouter nouvelle categorie</a></div>
    <table border="1">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Updated</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        <?php foreach ( $list as $category ):?>
            <tr>
                <td>
                    <?php $this->echoHtml($category->getId());?>
                </td>
                <td>
                    <?php $this->echoHtml($category->getTitle());?>
                </td>
                <td>
                    <?php $this->echoHtml($category->getUpdated());?>
                </td>
                <td>
                    <?php $this->echoHtml($category->getCreated());?>
                </td>
                <td>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>categories/edit/<?php $this->echoHtml($category->getId())?>">Modifier</a>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>categories/remove/<?php $this->echoHtml($category->getId())?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($page > 1): ?>
        <a href="<?php echo URL_WEBSITE_ADMIN;?>categories/list/<?php echo $page - 1; ?>">Page précédente</a> —
    <?php endif; ?>


    <?php for ($i = 1; $i <= $nbPage; $i++): ?>
        <a href="<?php echo URL_WEBSITE_ADMIN;?>categories/list/<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>


    <?php if ($page < $nbPage): ?>
        — <a href="<?php echo URL_WEBSITE_ADMIN;?>categories/list/<?php echo $page + 1; ?>">Page suivante</a>
    <?php endif; ?>

</div>