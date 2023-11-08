<?php
class ConfiguracionModel implements IModel{
    private $table;
    private $entity;
    private $conexion;

    public function __construct(){
        $this->table = 'config';
        $this->entity = 'Config';
        $this->conexion = SPDO::singleton();
    }

    public function insert($obj)
    {

    }
    
    public function get()
    {
        try {
            $sql = "SELECT * FROM {$this->table}";
            $query = $this->conexion->prepare($sql);
            $query->execute();

            return $query->fetch(PDO::FETCH_OBJ);            
        } catch(PDOExeption $e){
            exit($e->getMessage());
        }
    }
    
    public function update($obj)
    {

    }
    
    public function delete()
    {

    }
}