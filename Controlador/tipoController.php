<?php
include_once '../Modelo/Tipo.php';
$tipo_us = new Tipo();
session_start();

//Metodo crear tipo de usuario
if ($_POST['funcion']=='crear_tipo') {
    $tipo = $_POST['tipo'];
    $tipo_us->crear($tipo);
}


//TESTEO 
//Metodo GET FUNCIONAL AL 100%
if ($_POST['funcion']=='rellenar_tipos') {
    $tipo_us->rellenar_tipos();
    $json = array();
    foreach ($tipo_us->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->codigo_tipo,
            'tipo'=>$objeto->tipo_usr
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

//TESTEO DE METODO DELETE
//FUNCIONAL AL 0%
if ($_POST['funcion']=='eliminar_tipo') {
    $id=$_POST['id'];
    $tipo_us->eliminar_tipo($id);
       
}
/*Notas:
- $tipo_us = new Tipo(); = Es la instancia del modelo Tipo.php donde se hace la peticion INSERT en la BD
- $_POST['funcion']=='crear_tipo' = Se obtiene mediante el archivo Gestion_Tipo.js donde se obtienen los atributos de la funcion y que tipo de funcion será "CRUD"
obtenido el tipo de funcion y los 'crear_tipo' y el valor enviado $tipo, estos se envian al modelo para hacer el insert a la bd
*/
?>
