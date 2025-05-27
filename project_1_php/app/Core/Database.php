<?php 

namespace App\Core;

use Exception;
use PDO;
use PDOException;


class Database{
    private static $pdo;

    private function __construct(){} 

    public  static function init(array $config){
        if(self::$pdo == null){
            try{
                $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4";
                self::$pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            }catch(PDOException $e){
                die("Database connection failed:" . $e->getMessage());
            }
        }
    }

    public static function getConnection():PDO 
    {
        if(self::$pdo == null){
            throw new Exception("Database not initialized .");
        }

        return self::$pdo;
    }
}