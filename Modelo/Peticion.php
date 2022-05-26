<?php
// Include config file
include_once 'Conexion.php';

class Peticion{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    //crea nuevo vale de salida
    function Crear($fecha,$area,$idpeticiones,$nombre,$descripcion,$cant_solici,$cod_producto,$idunicopeticion,$iduser){
        $sql = "INSERT INTO vale_salida(codigo_vle,codigo_ism,nom_prod,area_peticion,cant_solicitada,fecha_peticion,id_usr,id_ind,estado)
        VALUES(:idpeticion,:idinsumo,:nom_prod,:area,:cant_solicitada,:fecha,:iduser,:id_ind,1)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':idpeticion'=>$idpeticiones,':idinsumo'=>$cod_producto,':nom_prod'=>$nombre,':area'=>$area,':cant_solicitada'=>$cant_solici,':fecha'=>$fecha,':iduser'=>$idunicopeticion,':id_ind'=>$iduser));
          
    }

     //mostrar el id de la peticion
   
     function ultima_peticion($idunicopeticion){
        $sql = "SELECT MAX(codigo_vle) as ultima_peticion FROM vale_salida WHERE id_usr = :iduser";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':iduser'=>$idunicopeticion));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    //nueva sentencia para obtener el total de la existencia
    function obtener_existencia($id){
        $sql = "SELECT SUM(existencia) as total FROM insumos WHERE codigo_ism=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
    }
    
    //Bloque de codigo que actualiza la cantidad en existencia
    function actualizar_stock($cant_solici,$id){
        $sql = "UPDATE insumos SET existencia = existencia - :cantidad WHERE codigo_ism =:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':cantidad'=>$cant_solici));  
    }
    
    //Experimental, metodo que obtiene los datos de la tabla Vale Salida
    function obtener_peticiones($iduser){
       if (!empty($_POST['consulta'])) {
           
        $consulta = $_POST['consulta'];
        $sql = "SELECT * FROM vale_salida WHERE codigo_vle LIKE :consulta AND id_ind = :iduser AND estado = 1 LIMIT 50";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':iduser'=>$iduser,':consulta'=>"%$consulta%"));
        $this->objetos = $query->fetchall();
        return $this->objetos;
        
       } else {
        if ($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3) {
            $sql = "SELECT * FROM vale_salida WHERE estado = 1  ";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM vale_salida WHERE id_ind = :iduser AND estado = 1  ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':iduser'=>$iduser));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
        
       }
       
    }

    //Bloque de codigo que actualiza el estado de la peticion de activo a inactivo
    function cambiar_estado($id_editado){
        $sql = "UPDATE vale_salida SET estado = 0 WHERE id_usr = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado));
        echo 'editado';
    }

    //Bloque de codigo que actualiza la cantidad en existencia
    function actualizar_estado($id){
        $sql = "UPDATE insumos SET estado = 0 WHERE codigo_ism =:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));  
    }
    
}