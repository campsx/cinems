<h1> Liste de tous les emails </h1>

<div>
    <table border="1">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Send</th>
            <th>Subject</th>
            <th>User email</th>
            <th>Updated</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        <?php foreach ( $list as $email ):?>
            <tr>
                <td>
                    <?php $this->echoHtml($email->getId());?>
                </td>
                <td>
                    <?php $this->echoHtml($email->getSend());?>
                </td>
                <td>
                    <?php $this->echoHtml($email->getSubject());?>
                </td>
                <td>
                    <?php $this->echoHtml($email->getUser()->getEmail());?>
                </td>
                <td>
                    <?php $this->echoHtml($email->getUpdated());?>
                </td>
                <td>
                    <?php $this->echoHtml($email->getCreated());?>
                </td>
                <td>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>emails/edit/<?php $this->echoHtml($email->getId())?>">Modifier</a>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>emails/send/<?php $this->echoHtml($email->getId())?>">Send</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if ($page > 1): ?>
    <a href="<?php echo URL_WEBSITE_ADMIN;?>emails/list/<?php echo $page - 1; ?>">Page précédente</a> —
<?php endif; ?>


<?php for ($i = 1; $i <= $nbPage; $i++): ?>
    <a href="<?php echo URL_WEBSITE_ADMIN;?>emails/list/<?php echo $i; ?>"><?php echo $i; ?></a>
<?php endfor; ?>


<?php if ($page < $nbPage): ?>
    — <a href="<?php echo URL_WEBSITE_ADMIN;?>emails/list/<?php echo $page + 1; ?>">Page suivante</a>
<?php endif; ?>