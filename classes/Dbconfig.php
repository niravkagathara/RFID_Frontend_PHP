<?php
class Dbconfig {
    private $server='localhost';
    private $username='root';
    private $password='';
    private $database='rfid';
    public $con;
     function __construct(){
        try{
           $this->con = new mysqli($this->server,$this->username,$this->password,$this->database);
           if ($this->con->connect_error) {
               die("Connection failed: " . $this->con->connect_error);
           }
        }catch(Exception $e){
            echo "Connection failed:" . $e->getMessage();
        }
    }

    function prepare($query) {
        return $this->con->prepare($query);
    }

    function close() {
        return $this->con->close();
    }
}

?>