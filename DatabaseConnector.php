<?php
class DatabaseConnector
{
    public function __construct($host,$user_name,$pass,$db)
    {
        $this->host_address = $host;
        $this->username = $user_name;
        $this->password = $pass;
        $this->database = $db;
    }   

    public function mysqli_connector()
    {
        $con = new mysqli($this->host_address,$this->username,$this->password,$this->database);
        return $con;
    }
}