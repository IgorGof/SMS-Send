<?php
    class Select extends Database {
        private $tabname;
        function __construct($tablename){
            $this->connectToDb();
            $this->tabname = $tablename;
        }
        
        function getRecordById($id){
            $query = "SELECT * FROM $this->tabname WHERE id=$id";
            mysqil_query("SET NAMES utf8");
            if ($sql = mysqli_query($query)){
                $data = mysqli_fetch_array($sql);
            }
            return $data;
        }
        
        function GetAllData(){
            $query = "SELECT * FROM $this->tabname";
            mysqli_query("SET NAMES utf8");
            if ($sql = mysqli_query($query)){
                $data = mysqli_fetch_array($sql);
            }
            return $data;
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