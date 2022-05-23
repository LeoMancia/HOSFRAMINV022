<?php
include_once '../Modelo/Usuario.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
$usuario = new Usuario();
#Verifica si hay alguna session en curso
if (!empty($_SESSION['us_tipo'])) {
    
    switch ($_SESSION['us_tipo']) {
        case 1:
            header('Location: ../Vistas/Vista_principal_admin.php');
            break;
        case 2:
            header('Location: ../Vistas/Vista_principal_admin.php');
            break;
        case 3:
            header('Location: ../Vistas/Vista_principal_admin.php');
            break;
       
     }
}
else {
   #Variable de session para enrutar los diferentes tipos de usuario
   $usuario->Loguearse($user, $pass);
if(!empty($usuario->objetos)){
    
    foreach($usuario->objetos as $objeto){
        $_SESSION['usuario']=$objeto->iduser;
        $_SESSION['us_tipo']=$objeto->us_tipo;        
        $_SESSION['nombre']=$objeto->nombre_us; 
        $_SESSION['area']=$objeto->area; 
    }
    
    switch ($_SESSION['us_tipo']) {
        case 1:
            header('Location: ../Vistas/Vista_principal_admin.php');
            break;
        case 2:
            header('Location: ../Vistas/Vista_principal_admin.php');
            break;
        case 3:
            header('Location: ../Vistas/Vista_principal_admin.php');
            break;
        default:
            
            break;
    }
}
else{
    header('Location: ../index.php');
}
}
?>