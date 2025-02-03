<?php

final class Database
{
 
    private static $instance=null;
    private $connection;
    private function __construct()
    {
        $this->connection=new pdo("mysql:host=localhost;dbname=cabinet_medical_mvc","root","");

    }
    public static function getInstance()
    {
        if(self::$instace==null)
        {
            self::$instance=new Database();
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this->connection;
    }

    
}






