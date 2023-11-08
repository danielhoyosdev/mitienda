<?php
// Configuraciones de la base de datos
require_once "data/Database.php";

class SPDO extends PDO{
    private static $instance = false;

    public function __construct(){
        try{
            parent::__construct("mysql:host=".HOST.";dbname=".DBNAME.";charset=".CHARSET, USER, PASSWORD,
                                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES =>FALSE));
        }catch(PDOExeption $e){
            exit("Error: {$e->getMessage()}");
        }
    }

    public static function singleton(){
        if(!self::$instance){
            $class = __CLASS__;
            self::$instance = new $class;
        }

        return self::$instance;
    }

    public function __clone(){
        trigger_error("La clonación no esta permitida.", E_USER_ERROR);
    }
}