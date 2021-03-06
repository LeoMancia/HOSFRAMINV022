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

    //Obtener datos de la base de datos funcionando al 50%

    function rellenar_tipos(){
        $sql = "SELECT * FROM tipo_user ORDER BY tipo_usr ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;

    }


    //TESTEO DE METODO ELIMINAR funcionando a 100%

    function eliminar_tipo($id){
        $sql = "DELETE FROM tipo_user WHERE codigo_tipo=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if (!empty($query->execute(array(':id'=>$id)))) {
            echo 'borrado';
        }else {
            echo 'noborrado';
        }
    }

    // TESTEO DE METODO UPDATE
    function editar($tipo, $id_editado){
        $sql = "UPDATE tipo_user SET tipo_usr=:tipo WHERE codigo_tipo=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado, ':tipo'=>$tipo));
        echo 'editado';
    }
}
?>