<?php
include_once 'Conexion.php';
class Usuario{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function Loguearse($user, $pass){
        $sql="SELECT * FROM usuario inner join tipo_user on iduser=us_tipo where username=:user and pasword=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':user'=>$user, ':pass'=>$pass));
        $this->objetos = $query->fetchall();
        return $this->objetos;
        
    }
    /*
    function obtener_datos($id){
        $sql="SELECT * FROM usuario JOIN tipo_us on us_tipo=id_tipo_us AND id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional){
        $sql="UPDATE usuario SET telefono_us=:telefono, residencia_us=:residencia, correo_us=:correo, sexo_us=:sexo, adicional_us=:adicional WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':telefono'=>$telefono,':residencia'=>$residencia,':correo'=>$correo,':sexo'=>$sexo,':adicional'=>$adicional));
    }

    function cambiar_contra($id_usuario,$oldpass,$newpass){
        $sql="SELECT * FROM usuario WHERE id_usuario=:id AND contrasena_us=:oldpass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            $sql="UPDATE usuario SET contrasena_us =:newpass WHERE id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':newpass'=>$newpass));
            echo 'update';
        } else {
            echo 'noupdate';
        }
    }

    function cambiar_foto($id_usuario,$nombre){
        $sql="SELECT foto FROM usuario WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,));
        $this->objetos = $query->fetchall();
        
            $sql="UPDATE usuario SET foto =:nombre WHERE id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));
        return $this->objetos;
    }

    function buscar(){
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM usuario JOIN tipo_us ON us_tipo = id_tipo_us WHERE nombre_us LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        } else {
            
            $sql = "SELECT * FROM usuario JOIN tipo_us ON us_tipo = id_tipo_us WHERE nombre_us NOT LIKE '' ORDER BY id_usuario LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        
    }
    //crear un nuevo usuario mediante modal
    function crear($nombre,$apellido,$edad,$dui,$pass,$tipo,$foto){
        //Select para verificar si existe un usuario con el mismo dui
        $sql = "SELECT id_usuario FROM  usuario WHERE dui_us=:dui";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dui'=>$dui));
        $this->objetos=$query->fetchall();
        if (!empty($this->objetos)) {
            echo 'noadd';
        }
        else{
            $sql = "INSERT INTO usuario(nombre_us,apellido_us,edad_us,dui_us,contrasena_us,foto,us_tipo) VALUES(:nombre,:apellido,:edad,:dui,:pass,:foto,:tipo)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':edad'=>$edad,':dui'=>$dui,':pass'=>$pass,':tipo'=>$tipo,':foto'=>$foto));
            echo 'add';
        }
    }

    //funcion ascender y descender
    function ascender($pass,$id_ascendido, $id_usuario){
        $sql = "SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND contrasena_us=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchall();
        if (!empty($this->objetos)) {
            $tipo=1;
            $sql = "UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));
            echo 'ascendido';
        }else {
            echo 'No ascendido';
        }
    }

    function descender($pass,$id_descendido, $id_usuario){
        $sql = "SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND contrasena_us=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchall();
        if (!empty($this->objetos)) {
            $tipo=2;
            $sql = "UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
            echo 'descendido';
        }else {
            echo 'No descendido';
        }
    }

    function eliminar($pass,$id_eliminado, $id_usuario){
        $sql = "SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND contrasena_us=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchall();
        if (!empty($this->objetos)) {
            $sql = "DELETE FROM usuario WHERE id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_eliminado));
            echo 'eliminado';
        }else {
            echo 'No eliminado';
        }
    }
    */
}

?>