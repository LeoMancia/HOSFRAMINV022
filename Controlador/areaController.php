<?php
include_once '../Modelo/Area.php';
$area_us = new Area();
session_start();

//Metodo crear tipo de usuario al 100%
if ($_POST['funcion']=='crear_area') {
    $area = $_POST['area'];
    $area_us->crear($area);
}


//TESTEO 
//Metodo GET FUNCIONAL AL 100%
if ($_POST['funcion']=='rellenar_areas') {
    $area_us->rellenar_areas();
    $json = array();
    foreach ($area_us->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->codigo_crg,
            'area'=>$objeto->area,
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

//TESTEO DE METODO DELETE
//FUNCIONAL AL 100%
if ($_POST['funcion']=='eliminar_area') {
    $id=$_POST['id'];
    $area_us->eliminar_area($id);
       
}


//TESTEO
//Metodo editar tipo de usuario al 100%
if ($_POST['funcion']=='editar_area') {
    $id_editado = $_POST['id_editado'];
    $area = $_POST['area'];
     
    $area_us->editar($area, $id_editado);
}

/*Notas:
- $tipo_us = new Tipo(); = Es la instancia del modelo Tipo.php donde se hace la peticion INSERT en la BD
- $_POST['funcion']=='crear_tipo' = Se obtiene mediante el archivo Gestion_Tipo.js donde se obtienen los atributos de la funcion y que tipo de funcion será "CRUD"
obtenido el tipo de funcion y los 'crear_tipo' y el valor enviado $tipo, estos se envian al modelo para hacer el insert a la bd
*/
?>
