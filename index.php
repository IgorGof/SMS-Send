<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title></title>
</head>
<body>
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      require_once("transport.php");
      $api = new Transport();

    ?>
    <h1>Отправка СМС</h1>
    <input type="hidden" name="MAX_FILE_SIZE" value="30000">
    <form action="send.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="filename"/>
      <input name="MySend" type="submit" label="Отправить" />
    </form>
    <br />
    <br />
    <br />
    <h1>Последние отправленные СМС</h1>
    <table border="1">
    <?php
      include "db/Database.php";
      //include "db/Select.php";
      $object = new Database();
      $object->connectToDb();
      $data = $object->Get13Data();
      //print_r($data);
      $rows = mysqli_num_rows($data);
      $nom = 1;
      while ($row = mysqli_fetch_array($data)) {
        echo '<tr>';
        echo '<td>' . $nom . '</td>';
        echo '<td>' . $row['ID'] . '</td>';
        echo '<td>' . $row['FIO'] . '</td>';
        echo '<td>' . $row['TEL'] . '</td>';
        echo '<td>' . $row['TEXT'] . '</td>';
        echo '<td>' . $row['STATUS'] . '</td>';
        $dateX = strtotime($row['DATA']);
        echo '<td>' . date("d-m-Y", $dateX) . '</td>';
        echo '</tr>';
        $nom = $nom + 1;
        if ($nom >= 13) {break;};
      }
      $object->closeConnection(); 
    ?>
    </table>
</body>
</html>