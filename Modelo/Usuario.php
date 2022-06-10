<?php
include_once 'Conexion.php';
class Usuario{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function Loguearse($user, $pass){
        $sql="SELECT * FROM usuario inner join tipo_user on us_tipo=codigo_tipo inner join cargo ON us_crg = codigo_crg where username=:user and pasword=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':user'=>$user, ':pass'=>$pass));
        $this->objetos = $query->fetchall();
        return $this->objetos;
        
    }
    
    function rellenar_usuarios(){
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM usuario JOIN cargo ON us_crg = codigo_crg JOIN tipo_user ON us_tipo = codigo_tipo WHERE nombre_us NOT LIKE '' AND username LIKE :consulta OR nombre_us LIKE :consulta ORDER BY iduser LIMIT 10";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM usuario JOIN cargo ON us_crg = codigo_crg JOIN tipo_user ON us_tipo = codigo_tipo WHERE nombre_us NOT LIKE '' ORDER BY iduser LIMIT 10";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        
    }

    
    function editar($nombre,$apellido,$username,$password,$area,$tipouser,$id_editado){
        $sql="UPDATE usuario SET nombre_us=:nombre, apellido_us=:apellido, username=:username, pasword=:password, us_crg=:area, us_tipo=:tipouser WHERE iduser=:id_editado";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_editado'=>$id_editado,':nombre'=>$nombre,':apellido'=>$apellido,':username'=>$username,':password'=>$password,':area'=>$area,':tipouser'=>$tipouser));
        echo 'editado';
    }
   
    //crear un nuevo usuario mediante modal
    function crear($nombre,$apellido,$username,$contrasena,$area,$tipouser){
        //Select para verificar si existe un usuario con el mismo dui
        $sql = "SELECT iduser FROM usuario WHERE username=:username";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':username'=>$username));
        $this->objetos=$query->fetchall();
        if (!empty($this->objetos)) {
            echo 'noadd';
        }
        else{
            $sql = "INSERT INTO usuario(nombre_us,apellido_us,username,pasword,us_crg,us_tipo) VALUES(:nombre,:apellido,:username,:contrasena,:area,:tipouser)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':username'=>$username,':contrasena'=>$contrasena,':area'=>$area,':tipouser'=>$tipouser));
            echo 'add';
        }
    }

   
function eliminar_usuario($id){
    $sql = "DELETE FROM usuario WHERE iduser=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    if (!empty($query->execute(array(':id'=>$id)))) {
        echo 'borrado';
    }else {
        echo 'noborrado';
    }
}
    
}

?>