<?php

namespace App\Core;

use PDO;
use PDOException;

final class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        try {
            $host = getenv('DB_HOST') ?: 'localhost';   
            $dbname = getenv('DB_NAME') ?: 'cabinet_medical_mvc'; 
            $username = getenv('DB_USER') ?: 'root';     
            $password = getenv('DB_PASSWORD') ?: '';    

            $dsn = "pgsql:host=$host;dbname=$dbname"; 
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new DatabaseException("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
