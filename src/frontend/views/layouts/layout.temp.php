<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CineMS</title>
      <link rel="stylesheet" href="<?php echo PATH_MEDIAS_CSS ?>frontend.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet">
    <meta name="description" content="CineMS est un CMS sur le cinema">
  </head>
  <body>
  <div id="main">
      <div class="container">
        <?php include ROOT_DIR."src/frontend/views/layouts/header.temp.php" ?>
        <div class="content">
            <?php include $this->view; ?>
        </div>
        <?php include ROOT_DIR."src/frontend/views/layouts/footer.temp.php" ?>
      </div>
  </div>

    <!-- jquery-2.2.4 -->
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="<?php echo PATH_MEDIAS_JS ?>frontend.js"></script>
  </body>
</html>
