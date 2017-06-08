<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BackOffice</title>
      <meta name="description" content="description de mon site">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- google icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="<?php echo PATH_MEDIAS_CSS ?>backoffice.css">
  </head>
  <body>
    <div class="page close">
      <?php include "src/backoffice/views/layouts/header.temp.php" ?>
      <?php include "src/backoffice/views/layouts/sidebar.temp.php" ?>
      <section class="content">
          <div class="view">
              <?php include $this->view; ?>
          </div>
      </section>
      <?php include "src/backoffice/views/layouts/footer.temp.php" ?>
   </div>

   <!-- jquery-2.2.4 -->
    <script
     src="https://code.jquery.com/jquery-2.2.4.min.js"
     integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
     crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo PATH_MEDIAS_JS ?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo PATH_MEDIAS_JS ?>ckeditor/adapters/jquery.js"></script>
    <script src="<?php echo PATH_MEDIAS_JS ?>backoffice.js"></script>
  </body>
</html>
