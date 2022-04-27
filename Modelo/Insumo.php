<?php
// Include config file
include_once 'Conexion.php';

class Insumo{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    //crear un nuevo usuario mediante modal
    function crear($codigo,$nominsumo,$desinsumo,$precio,$cantidad,$estado,$fecha){
        $sql = "INSERT INTO insumos(nombre_ism,descripcion,precio,existencia,fecha,estado,id_insumo) VALUES(:nominsumo,:desinsumo,:precio,:cantidad,:fecha,:estado,:codigo)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nominsumo'=>$nominsumo,':desinsumo'=>$desinsumo,':precio'=>$precio,':cantidad'=>$cantidad,':fecha'=>$fecha,':estado'=>$estado,':codigo'=>$codigo));
        echo 'add';
    }

    //TESTEO//
    //Obtener datos de la base de datos funcionando al 100%

    function rellenar_insumos(){
       if (!empty($_POST['consulta'])) {
        $consulta = $_POST['consulta'];
        $sql = "SELECT * FROM insumos WHERE id_insumo LIKE :consulta OR nombre_ism LIKE :consulta ORDER BY id_insumo ASC LIMIT 50";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':consulta'=>"%$consulta%"));
        $this->objetos = $query->fetchall();
        return $this->objetos;

       } else {
        $sql = "SELECT * FROM insumos ORDER BY id_insumo ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
       }
       

    }

    //TESTEO DE METODO ELIMINAR funcionando a 100%

    function eliminar_insumo($id){
        $sql = "DELETE FROM insumos WHERE codigo_ism=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if (!empty($query->execute(array(':id'=>$id)))) {
            echo 'borrado';
        }else {
            echo 'noborrado';
        }
    }

    // TESTEO DE METODO UPDATE funcionando al 100%
    function editar($codigo,$nominsumo,$desinsumo,$precio,$cantidad,$estado,$fecha,$id_editado){
        $sql = "UPDATE insumos SET nombre_ism=:nominsumo,descripcion=:desinsumo,precio=:precio,existencia=:cantidad,fecha=:fecha,estado=:estado,id_insumo=:codigo WHERE codigo_ism=:id_editado";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nominsumo'=>$nominsumo,':desinsumo'=>$desinsumo,':precio'=>$precio,':cantidad'=>$cantidad,':fecha'=>$fecha,':estado'=>$estado,':codigo'=>$codigo, ':id_editado'=>$id_editado));
        echo 'editado';
    }

    function obtener_stock($id){
        $sql = "SELECT SUM(existencia) as total FROM insumos WHERE codigo_ism=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
?>