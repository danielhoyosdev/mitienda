<?php
class Settings{
    private $vars;
    private static $instance = false;

    public function __construct(){
        $this->vars = array();
    }

    public function __clone(){
        trigger_error('No esta permitida la clonación de las configuraciones', E_USER_ERROR);
    }

    public function get($key){
        if(isset($this->vars[$key])){
            return $this->vars[$key];
        }
    }

    public function set($key, $value){
        if(!isset($this->vars[$key])){
            $this->vars[$key] = $value;
        }
    }

    public static function singleton(){
        if(!self::$instance){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }
}