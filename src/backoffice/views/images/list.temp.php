<h1> Liste de tous les images </h1>

<div>
    <div><a href="<?php echo URL_WEBSITE_ADMIN;?>images/create">Ajouter nouvelle image</a></div>
    <table border="1">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Visuel</th>
            <th>URL</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        <?php foreach ( $list as $image ):?>
            <tr>
                <td>
                    <?php $this->echoHtml($image->getId());?>
                </td>
                <td>
                    <?php $this->echoHtml($image->getTitle());?>
                </td>
                <td class="image-in-list">
                    <img src="<?php echo PATH_MEDIAS_UPLOAD.$image->getUrl()?>" alt="image">
                </td>
                <td>
                    <?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$image->getUrl());?>
                </td>
                <td>
                    <?php $this->echoHtml($image->getCreated());?>
                </td>
                <td>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>images/remove/<?php $this->echoHtml($image->getId())?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php if ($page > 1): ?>
    <a href="<?php echo URL_WEBSITE_ADMIN;?>images/list/<?php echo $page - 1; ?>">Page précédente</a> —
<?php endif; ?>


<?php for ($i = 1; $i <= $nbPage; $i++): ?>
    <a href="<?php echo URL_WEBSITE_ADMIN;?>images/list/<?php echo $i; ?>"><?php echo $i; ?></a>
<?php endfor; ?>


<?php if ($page < $nbPage): ?>
    — <a href="<?php echo URL_WEBSITE_ADMIN;?>images/list/<?php echo $page + 1; ?>">Page suivante</a>
<?php endif; ?>