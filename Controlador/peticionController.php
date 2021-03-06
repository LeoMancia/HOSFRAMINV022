<?php
include '../Modelo/Peticion.php';
include_once '../Modelo/Conexion.php';
$peticion = new Peticion();
session_start();
$area = $_SESSION['area'];
$iduser = $_SESSION['usuario'];


if ($_POST['funcion']=='registrar_peticion') {
    $idpeticiones = $_POST['idpeticiones'];
    $nombre = $_POST['nombre'];
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $cant_solici = $_POST['cant_solici'];
    $cod_producto = $_POST['cod_producto'];
    $insumos =json_decode($_POST['json']);

    date_default_timezone_set('America/El_Salvador');
    $fecha = date('Y-m-d H:i:s');

    $fecha1 = new DateTime();
    $estampadetiempo = $fecha1->getTimestamp();
    $idunicopeticion = $iduser + $estampadetiempo;
    $peticion->Crear($fecha,$area,$idpeticiones,$nombre,$descripcion,$cant_solici,$cod_producto,$idunicopeticion,$iduser);

   
    //Obtiene el codigo de la ultima peticion hecha
    $peticion->ultima_peticion($idunicopeticion);
    foreach ($peticion->objetos as $objeto) {
        $id_peticion = $objeto->ultima_peticion;
        echo $id_peticion;
    }

    /*obtiene la cantidad del insumo para verificar que sea igual a la existencia en base de datos, posteriormente si son iguales 
    (La cantidad solicitada y la cantidad en existencia) al hacerse la resta se quedaria a cero, por lo cual se actualiza el estado del 
    insumo a inactivo y se actualiza el stock 
    */

    $peticion->obtener_existencia($id);
    foreach ($peticion->objetos as $obj ) {
        $total=$obj->total;
        if ($cant_solici == $total) {
            $peticion->actualizar_estado($id);
        }
    }
     //Prueba de disminucion de stock o existencia
     $peticion->actualizar_stock($cant_solici,$id);
  
} 

//Metodo get para obtener las peticiones de la base de datos
if ($_POST['funcion']=='obtener_peticiones') {
    $peticion->obtener_peticiones($iduser);
    $json = array();
    foreach ($peticion->objetos as $objeto ) {
        $json[]=array(
            'CodigoPeticion'=>$objeto->codigo_vle,
            'CodigoInsumo'=>$objeto->codigo_ism,
            'NombreProd'=>$objeto->nom_prod,
            'AreaPeticion'=>$objeto->area_peticion,
            'cantSolicitada'=>$objeto->cant_solicitada,
            'Fecha'=>$objeto->fecha_peticion,
            'IDPeticion'=>$objeto->id_usr
        );
    }
    $jsonstring = json_encode($json);
    echo ($jsonstring);
}

//Recibe los datos de la peticion a cambiar su estado
if ($_POST['funcion']=='cambiar_estado') {
    $id_editado = $_POST['Id'];
    $peticion->cambiar_estado($id_editado);    
}

?>