<?php
    class Select extends Database {
        private $tabname;
        function __construct($tablename){
            $this->connectToDb();
            $this->tabname = $tablename;
        }
        
        function getRecordById($id){
            $query = "SELECT * FROM $this->tabname WHERE id=$id";
            mysql_query("SET NAMES utf8");
            if ($sql = mysql_query($query)){
                $data = mysql_fetch_array($sql);
            }
            return $data;
        }
        
        function GetAllData(){
            $query = "SELECT * FROM $this->tabname";
            mysql_query("SET NAMES utf8");
            if ($sql = mysql_query($query)){
                $data = mysql_fetch_array($sql);
            }
            return $data;
        }
        
        function Get13Data() {
            $query = "SELECT ID, FIO, TEL, TEXT, STATUS
            FROM $this->tabname WHERE Sostoyan = '1' ORDER BY Data desc limit 13";
            mysql_query("SET NAMES utf8");
            if ($sql = mysql_query($query)){
            }
            return $sql;
        }
    }
?>