<?php

class Database{

    private $host='localhost';
    private $db_name='myblog';
    private $user='root';
    private $password='';
    private $con;

    public function connect(){
        $this->con=null;

        try{
            $this->con=new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->user,$this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           }catch(PDOException $e){
            echo"connection error".$e->getMessage();
           }
           return $this->con;
    }
}