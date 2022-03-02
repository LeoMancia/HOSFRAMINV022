<?php
// Include config file
include_once 'Conexion.php';

class Tipo{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    //crear un nuevo usuario mediante modal
    function crear($tipo){
        $sql = "INSERT INTO tipo_user(tipo_usr) VALUES(:tipo)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tipo'=>$tipo));
        echo 'add';
    }

    //TESTEO//

    //Obtener datos de la base de datos

    function rellenar_tipos(){
        $sql = "SELECT * FROM tipo_user";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;

    }

}
?>