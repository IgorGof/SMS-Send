<html>
<?php header('Content-type: text/html; charset=utf-8'); ?>
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
  $stroka = $_FILES['filename']['tmp_name']."/".$_FILES['filename']['name'];
  print($stroka);
  print("<br/>");
  $uploaddir = '/var/www/smsprofi/';
  $uploadfile = $uploaddir . basename($_FILES['filename']['name']) . date("d.m.Y - H:i:s");
  echo '<br>' . $uploadfile. '<br>';
  echo '<pre>';
  if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
  } else {
    echo "Не удалось загрузить файл!\n";
  }
  echo 'Некоторая отладочная информация:';
  print_r($_FILES);
  print "</pre>";
  
  if (file_exists($uploadfile)) {
    $xml = simplexml_load_file($uploadfile);
    print_r($xml);
  } else {
    exit('Не удалось открыть файл test.xml.');
  }
  echo '<br>';
  //print_r($xml->data->tableBand->tableRow->tableCell);
  echo '<br>';
  //var_dump($xml->data->tableBand->tableRow->tableCell);
  echo '<br>';
  //echo $xml->data->tableBand->tableRow->tableCell[0];
    
    
  echo $xml->productName;
  $txt = $xml->data->tableBand->tableRow->tableCell[1];
  echo '<br>';
  echo $phon = $xml->data->tableBand->tableRow->tableCell[0];
  echo '<br>';
      include "db/Database.php";
      $object = new Database();
      $object->connectToDb();
      $query = "INSERT INTO sms (FIO, TEL, TEXT, STATUS, DATA) "."VALUE ('Гоферберг Игорь Андреевич', '" . $phon . "', '" . $txt . "', 'Передано в БД', '01.01.2018')";
      echo '<br>';
      echo $query;
      echo '<br>';
      //print_r($object->GoQuery($query));      

      $object->closeConnection(); 

  if (isset($_POST['MySend'])) 
  {
    $params = array("text" => $txt, "source" => "УТСЗН",);
    $phones = array($phon);
    //$send = $api->send($params, $phones);
  }
?>
</body>
</html>