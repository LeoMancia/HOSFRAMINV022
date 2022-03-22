<?php
// Include config file
include_once 'Conexion.php';

class Area{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    //crear un nuevo usuario mediante modal
    function crear($area){
        $sql = "INSERT INTO cargo(area) VALUES(:area)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':area'=>$area));
        echo 'add';
    }

//TESTEO//
    //Obtener datos de la base de datos funcionando al 50%

    function rellenar_areas(){
        $sql = "SELECT * FROM cargo ORDER BY area ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;

    }

    //TESTEO DE METODO ELIMINAR funcionando a 100%

    function eliminar_area($id){
        $sql = "DELETE FROM cargo WHERE codigo_crg=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if (!empty($query->execute(array(':id'=>$id)))) {
            echo 'borrado';
        }else {
            echo 'noborrado';
        }
    }

    // TESTEO DE METODO UPDATE
    function editar($area, $id_editado){
        $sql = "UPDATE cargo SET area=:area WHERE codigo_crg=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado, ':area'=>$area));
        echo 'editado';
    }
}
?>