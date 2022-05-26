<?php
include_once '../Modelo/Usuario.php';
$usuario = new Usuario();
session_start();

//TESTEO 
//Metodo GET FUNCIONAL AL 100%
if ($_POST['funcion']=='rellenar_usuario') {
    $usuario->rellenar_usuarios();
    $json = array();
    foreach ($usuario->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->iduser,
            'nombre'=>$objeto->nombre_us,
            'apellido'=>$objeto->apellido_us,
            'username'=>$objeto->username,
            'password'=>$objeto->pasword,
            'area'=>$objeto->area,
            'tipo'=>$objeto->tipo_usr,
            'areaID'=>$objeto->us_crg,
            'tipoID'=>$objeto->us_tipo
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

//Metodo de crear usuario FUNCIONANDO AL 100%
if ($_POST['funcion']=='crear_usuario') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $area = $_POST['area'];
    $tipouser = $_POST['tipo'];
    
    $usuario->crear($nombre,$apellido,$username,$password,$area,$tipouser);
    
}

//Workinprogress editar usuarios
if ($_POST['funcion']=='editar_usuario') {
   
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $area = $_POST['area'];
    $tipouser = $_POST['tipo'];
    $id_editado = $_POST['id_editado'];
    $usuario->editar($nombre,$apellido,$username,$password,$area,$tipouser,$id_editado);
    
}

//TESTEO DE METODO DELETE
//FUNCIONAL AL 0%
if ($_POST['funcion']=='eliminar_usuario') {
    $id=$_POST['id'];
    $usuario->eliminar_usuario($id);
       
}
?>