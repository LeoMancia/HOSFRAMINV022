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
        //obtiene el tipo de usuario del usuario loggeado para mostrar todos los insumos (A $ I)
        //A = activos
        //I = Inactivos
       if ($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3) {
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
       } else {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM insumos WHERE id_insumo LIKE :consulta OR nombre_ism LIKE :consulta ORDER BY id_insumo ASC LIMIT 50";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
    
           } else {
            $sql = "SELECT * FROM insumos WHERE estado = 1 ORDER BY id_insumo ASC";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
           }
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

    //Metodo que obtiene la cantidad en existencia de un insumo en concreto
    function obtener_existencia($id_editado){
        $sql = "SELECT SUM(existencia) as total FROM insumos WHERE codigo_ism=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado));
        $this->objetos = $query->fetchall();
    }

     //Bloque de codigo que actualiza la cantidad en existencia
     function actualizar_estado($id_editado){
        $sql = "UPDATE insumos SET estado = 1 WHERE codigo_ism =:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado));  
    }

    function obtener_stock($id){

        //Sentencia que verifica el total del insumo
        /*
        $sql = "SELECT SUM(existencia) as total, nombre_ism as Nombre FROM insumos WHERE codigo_ism=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
        */

        //nueva sentencia para obtener el nombre y total de la existencia
        $sql = "SELECT SUM(existencia) as total, (SELECT nombre_ism from insumos WHERE codigo_ism=:id) as nombre FROM insumos WHERE codigo_ism=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
        
    }

    
}
?>