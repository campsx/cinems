<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Titre de mon site</title>
      <link rel="stylesheet" href="<?php echo PATH_MEDIAS_CSS ?>frontend.css">
    <meta name="description" content="description de mon site">
  </head>
  <body>
    <?php include "src/frontend/views/layouts/header.temp.php" ?>
    <?php include $this->view; ?>
    <?php include "src/frontend/views/layouts/footer.temp.php" ?>
  </body>
</html>
