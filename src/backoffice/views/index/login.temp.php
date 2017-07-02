<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <title>Login page</title>
    <meta name="description" content="login page">
    <link rel="stylesheet" href="<?php echo PATH_MEDIAS_CSS ?>backoffice.css">
 </head>
 <body>
  <div class="page close">
    <section class="content">
        <h1>login page</h1>

        <?php foreach ( $errors as $error ):?>
            <p style="color: red;"><?php $this->echoHtml($error);?></p>
        <?php endforeach; ?>

        <form method="POST" action="<?php echo URL_WEBSITE_ADMIN ?>index/login">

            <input name="email" placeholder="test@gmail.com" required="required" type="email"><br>

            <input name="password" placeholder="" required="required" type="password"><br>

            <input value="Se connecter" type="submit">

        </form>
    </section>
  </div>
 </body>
</html>
