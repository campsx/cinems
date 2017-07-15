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
                    <a class="remove" href="<?php echo URL_WEBSITE_ADMIN;?>directors/remove/<?php $this->echoHtml($director->getId())?>">Supprimer</a>
                    <a target="_blank" href="<?php echo URL_WEBSITE;?>director/view/<?php $this->echoHtml($director->getSlug())?>">Voir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if ($page > 1): ?>
    <a href="<?php echo URL_WEBSITE_ADMIN;?>directors/list/<?php echo $page - 1; ?>">Page précédente</a> —
<?php endif; ?>


<?php for ($i = 1; $i <= $nbPage; $i++): ?>
    <a href="<?php echo URL_WEBSITE_ADMIN;?>directors/list/<?php echo $i; ?>"><?php echo $i; ?></a>
<?php endfor; ?>


<?php if ($page < $nbPage): ?>
    — <a href="<?php echo URL_WEBSITE_ADMIN;?>directors/list/<?php echo $page + 1; ?>">Page suivante</a>
<?php endif; ?>
