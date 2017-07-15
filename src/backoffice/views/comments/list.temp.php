<h1> Liste de tous les comments </h1>

<div>
    <table border="1">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Valid</th>
            <th>Email User</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
        <?php foreach ( $list as $comment ):?>
            <tr>
                <td>
                    <?php $this->echoHtml($comment->getId());?>
                </td>
                <td>
                    <?php $this->echoHtml($comment->getTitle());?>
                </td>
                <td>
                    <?php $this->echoHtml($comment->getValid());?>
                </td>
                <td>
                    <?php $this->echoHtml($comment->getUser()->getEmail());?>
                </td>
                <td>
                    <?php $this->echoHtml($comment->getCreated());?>
                </td>
                <td>
                    <?php $this->echoHtml($comment->getUpdated());?>
                </td>
                <td>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>comments/edit/<?php $this->echoHtml($comment->getId())?>">Modifier</a>
                    <a class="remove" href="<?php echo URL_WEBSITE_ADMIN;?>comments/remove/<?php $this->echoHtml($comment->getId())?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($page > 1): ?>
        <a href="<?php echo URL_WEBSITE_ADMIN;?>comments/list/<?php echo $page - 1; ?>">Page précédente</a> —
    <?php endif; ?>


    <?php for ($i = 1; $i <= $nbPage; $i++): ?>
        <a href="<?php echo URL_WEBSITE_ADMIN;?>comments/list/<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>


    <?php if ($page < $nbPage): ?>
        — <a href="<?php echo URL_WEBSITE_ADMIN;?>comments/list/<?php echo $page + 1; ?>">Page suivante</a>
    <?php endif; ?>

</div>
