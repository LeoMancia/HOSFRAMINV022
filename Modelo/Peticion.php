<?php
// Include config file
include_once 'Conexion.php';

class Peticion{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function Crear($fecha,$area,$idpeticiones,$nombre,$descripcion,$cant_solici,$cod_producto,$idunicopeticion){
        $sql = "INSERT INTO vale_salida(codigo_vle,codigo_ism,nom_prod,area_peticion,cant_solicitada,fecha_peticion,id_usr)
        VALUES(:idpeticion,:idinsumo,:nom_prod,:area,:cant_solicitada,:fecha,:iduser)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':idpeticion'=>$idpeticiones,':idinsumo'=>$cod_producto,':nom_prod'=>$nombre,':area'=>$area,':cant_solicitada'=>$cant_solici,':fecha'=>$fecha,':iduser'=>$idunicopeticion));
          
    }

     //mostrar el id de la peticion
   
     function ultima_peticion($idunicopeticion){
        $sql = "SELECT MAX(codigo_vle) as ultima_peticion FROM vale_salida WHERE id_usr = :iduser";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':iduser'=>$idunicopeticion));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function actualizar_stock($cant_solici,$id){
        $sql = "UPDATE insumos SET existencia = existencia - :cantidad WHERE codigo_ism =:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':cantidad'=>$cant_solici));
        
    }
    

}