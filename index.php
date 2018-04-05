<html>
  <head>
  </head>
  <body>
    <?php
      require_once("transport.php");
      $api = new Transport();

    ?>
    <h1>Отправка СМС</h1>
    <input type="hidden" name="MAX_FILE_SIZE" value="30000">
    <form action="send.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="filename"/>
      <input name="MySend" type="submit" label="Отправить" />
    </form>
  </body>
</html>
