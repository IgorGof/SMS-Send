<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  require_once("transport.php");
  $api = new Transport();
  $stroka = $_FILES['filename']['tmp_name']."/".$_FILES['filename']['name'];
  print($stroka);
  print("<br/>");
  $uploaddir = '/var/www/smsprofi/';
  $uploadfile = $uploaddir . basename($_FILES['filename']['name']);
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
  
      include "db/Database.php";
      $object = new Database();
      $object->connectToDb();
        $query = "SELECT ID, FIO, TEL, TEXT, STATUS, DATA
            FROM $this->tabname ORDER BY Data desc limit 13";
            mysqli_query($this->link, "SET NAMES utf8");          
  
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

  
  if (file_exists($uploadfile)) {
    $xml = simplexml_load_file($uploadfile);
    print_r($xml);
  } else {
    exit('Не удалось открыть файл test.xml.');
  }
  echo '<br>';
  $txt = $xml->text;
  $phon = $xml->phone;
  print_r (curl_version());
  if (isset($_POST['MySend'])) 
  {
    $params = array("text" => $txt, "source" => "УТСЗН",);
    $phones = array($phon);
    $send = $api->send($params, $phones);
  }
?>
