<?php
include_once '../Modelo/Insumo.php';
$insumo = new Insumo();
session_start();

//Metodo crear Insumo de usuario al 100
if ($_POST['funcion']=='crear_insumo') {
    $codigo = $_POST['codigo'];
    $nominsumo = $_POST['nominsumo'];
    $desinsumo = $_POST['desinsumo'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];
    $insumo->crear($codigo,$nominsumo,$desinsumo,$precio,$cantidad,$estado,$fecha);
}


//TESTEO 
//Metodo GET FUNCIONAL AL 100%
if ($_POST['funcion']=='rellenar_insumo') {
    $insumo->rellenar_insumos();
    $json = array();
    foreach ($insumo->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->codigo_ism,
            'nombre_insumo'=>$objeto->nombre_ism,
            'descripcion'=>$objeto->descripcion,
            'precio'=>$objeto->precio,
            'existencia'=>$objeto->existencia,
            'Fecha'=>$objeto->fecha,
            'estado'=>$objeto->estado,
            'id_insumo'=>$objeto->id_insumo 
                      
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

//TESTEO DE METODO DELETE
//FUNCIONAL AL 0%
if ($_POST['funcion']=='eliminar_insumo') {
    $id=$_POST['id'];
    $insumo->eliminar_insumo($id);
       
}


//TESTEO
//Metodo editar insumos, al 100%
if ($_POST['funcion']=='editar_insumo') {
    $id_editado = $_POST['id_editado'];
    $codigo = $_POST['codigo'];
    $nominsumo = $_POST['nominsumo'];
    $desinsumo = $_POST['desinsumo'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];
    $insumo->editar($codigo,$nominsumo,$desinsumo,$precio,$cantidad,$estado,$fecha,$id_editado);

}

if ($_POST['funcion']=='verificar_stock') {
   $error=0;
   $insumos= json_decode($_POST['insumos']);
   foreach ($insumos as $objeto) {
      $insumo->obtener_stock($objeto->id);      
      foreach ($insumo->objetos as $obj) {
          $total=$obj->total;
      }
      if ($total>=$objeto->cantidad && $objeto->cantidad>0) {
          $error=$error+0;
      } else {
        $error=$error+1;
      }
      
   }
   echo $error;
}


/*Notas:
- $tipo_us = new Tipo(); = Es la instancia del modelo Tipo.php donde se hace la peticion INSERT en la BD
- $_POST['funcion']=='crear_tipo' = Se obtiene mediante el archivo Gestion_Tipo.js donde se obtienen los atributos de la funcion y que tipo de funcion será "CRUD"
obtenido el tipo de funcion y los 'crear_tipo' y el valor enviado $tipo, estos se envian al modelo para hacer el insert a la bd
*/
?>
