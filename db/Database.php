<?php
    class Database {
        private $host = "localhost";
        private $user = "root";
        private $pass = "123";
        private $db = "sms";
        private $link;
        private $tabname = "sms";
        
        function connectToDb (){
            $this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
            if (!$this->link) {
                echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
                echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
        }
        
        function closeConnection(){
            mysqli_close($this->link);
        }
        
        function Get13Data() {
            $query = "SELECT ID, FIO, TEL, TEXT, STATUS, DATA
            FROM $this->tabname ORDER BY Data desc limit 13";
            mysqli_query($this->link, "SET NAMES utf8");
            if ($sql = mysqli_query($this->link, $query)){
            }
            return $sql;
        }
    }
?> 