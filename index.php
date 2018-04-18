<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Отправка СМС</title>
  <link rel="stylesheet" media="screen" href="style.css">
</head>
<body>
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      require_once("transport.php");
      $api = new Transport();

    ?>
    <div class="Send">
    <h1>Отправка СМС</h1>
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <form action="send.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="filename" accept="text/xml"/>
      <input name="MySend" type="submit" value="Отправить" />
    </form>
    </div>
    <div class="table">
    <table class="table_blur">
    <caption>Последние отправленные СМС</caption>
    <tr>
    <th>№</th>
    <th>ID</th>
    <th>Логин отправителя</th></th>
    <th>Телефон получателя</th>
    <th>Текст СМС</th>
    <th>Статус</th>
    <th>Дата и время отправки</th>
    </tr>
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
        echo '<td>' . date("d-m-Y H:i:s", $dateX) . '</td>';
        echo '</tr>';
        $nom = $nom + 1;
        if ($nom >= 13) {break;};
      }
      $object->closeConnection(); 
    ?>
    </table>
    </div>
</body>
</html>