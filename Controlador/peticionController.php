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
//    print_r ($insumos);
    date_default_timezone_set('America/El_Salvador');
    $fecha = date('Y-m-d H:i:s');

    $fecha1 = new DateTime();
    $estampadetiempo = $fecha1->getTimestamp();
    $idunicopeticion = $iduser + $estampadetiempo;
    $peticion->Crear($fecha,$area,$idpeticiones,$nombre,$descripcion,$cant_solici,$cod_producto,$idunicopeticion);

   
    //Prueba de disminucion de stock o existencia
    $peticion->ultima_peticion($idunicopeticion);
    foreach ($peticion->objetos as $objeto) {
        $id_peticion = $objeto->ultima_peticion;
        echo $id_peticion;
    }

    $peticion->actualizar_stock($cant_solici,$id);
//HASTA AQUI funciona
/*
    try {
        $db= new Conexion();
        $conexion = $db->pdo;
        $conexion->beginTransaction();
        foreach ($insumos as $prod) {
            $cantidad = $prod->cantidad;
            //echo $cantidad;
            while ($cantidad !=0) {
                $sql = "SELECT * FROM insumos WHERE id_insumo=:id";
                $query = $conexion->prepare($sql);
                $query->execute(array(':id'=>$prod->codigo_prod));
                $ismpeticion= $query->fetchall();
                print_r ($ismpeticion);
                foreach ($ismpeticion as $peticiones) {
                   echo ("contando");
                }
            }
        }
    } catch (Exception $error) {
        $conexion->rollBack();
        //echo $error->getMessage();
    }
    */
} 


?>