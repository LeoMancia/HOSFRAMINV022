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


    //TESTEO DE METODO ELIMINAR

    function eliminar($id_eliminado){
        $sql = "SELECT codigo_tipo FROM tipo_user WHERE codigo_tipo=:id_eliminado";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_eliminado'=>$id_eliminado));
        $this->objetos=$query->fetchall();
        if (!empty($this->objetos)) {
            $sql = "DELETE FROM tipo_user WHERE codigo_tipo=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_eliminado));
            echo 'eliminado';
        }else {
            echo 'No eliminado';
        }
    }
}
?>