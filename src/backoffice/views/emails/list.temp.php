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
                    <?php $this->echoHtml($email->getCreated());?>
                </td>
                <td>
                    <?php $this->echoHtml($email->getUpdated());?>
                </td>
                <td>
                    <a href="<?php echo URL_WEBSITE_ADMIN;?>emails/edit/<?php $this->echoHtml($email->getId())?>">Modifier</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
