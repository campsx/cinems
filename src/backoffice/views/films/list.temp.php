<h1> Liste de tous les films </h1>


<div>
    <div><a href="<?php echo URL_WEBSITE_ADMIN;?>films/create">Ajouter un nouveau film</a></div>
    <table border="1">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date de sortie</th>
            <th>Intergrateur</th>
            <th>Updated</th>
            <th>Created</th>
            <th>View</th>
            <th>Action</th>
        </tr>
        <?php foreach ( $list as $film ):?>
            <tr>
                <td>
                    <?php $this->echoHtml($film->getId());?>
                </td>
                <td>
                    <?php $this->echoHtml($film->getTitle());?>
                </td>
                <td>
                    <?php $this->echoHtml($film->getReleaseDate()->format('Y-m-d'));?>
                </td>
                <td>
                    <?php $this->echoHtml($film->getUser()->getEmail());?>
                </td>
                <td>
                    <?php $this->echoHtml($film->getCreated());?>
                </td>
                <td>
                    <?php $this->echoHtml($film->getUpdated());?>
                </td>
                <td>
                    <?php $this->echoHtml($film->getView());?>
                </td>
                <td>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>films/edit/<?php $this->echoHtml($film->getId())?>">Modifier</a>
                    <a class="remove" href="<?php echo URL_WEBSITE_ADMIN;?>films/remove/<?php $this->echoHtml($film->getId())?>">Supprimer</a>
                    <a target="_blank" href="<?php echo URL_WEBSITE;?>film/view/<?php $this->echoHtml($film->getSlug())?>">Voir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($page > 1): ?>
        <a href="<?php echo URL_WEBSITE_ADMIN;?>films/list/<?php echo $page - 1; ?>">Page précédente</a> —
    <?php endif; ?>


    <?php for ($i = 1; $i <= $nbPage; $i++): ?>
        <a href="<?php echo URL_WEBSITE_ADMIN;?>films/list/<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>


    <?php if ($page < $nbPage): ?>
        — <a href="<?php echo URL_WEBSITE_ADMIN;?>films/list/<?php echo $page + 1; ?>">Page suivante</a>
    <?php endif; ?>

</div>