<?php


class DB
{
    public $conn;
    private $host;
    private $user;
    private $pass;
    private $db_name;

    public function __construct()
    {
        $this->conn = false;
        $this->user = "root";
        $this->pass = '';
        $this->host = "localhost";
        $this->db_name = "dyamethod";
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function connect()
    {
        if(!$this->conn){
            try{
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name.'', $this->user, $this->pass, [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ]);
            }catch (Exception $e){
                die("Error:". $e->getMessage());
            }
            if(!$this->conn){
                echo "Connection Failed";
                die();
            }
        }
        return $this->conn;
    }

    public function disconnect(){
        if($this->conn){
            $this->conn = null;
        }
    }

}