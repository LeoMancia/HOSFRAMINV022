<?php
session_start();
if (!empty($_SESSION['us_tipo']) && $_SESSION['us_tipo']==1) {
    include_once 'layout/header.php';   
?>
    <title>Insumos</title>
<?php 
    include_once 'layout/navbar.php';
?>

<section>
</br>
</br>
</br>
</section>


<!--Modal de creacion de nuevo insumo-->
 <!-- Modal -->
 <div class="modal fade" id="crearusuarios" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Creacion de Usuarios</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>        
      </div>
      <!--Apartado para ingresar los datos de un nuevo tipo de usuario-->
      <div class="modal-body">
            <!--Mensaje de Alerta success-->
            <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se creó exitosamente!</span>
              </div>
              <div class="alert alert-success text-center" id="edit-user" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se modificó exitosamente!</span>
              </div>
              <!--Mensaje de Alerta error-->
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                    <span><i class="fas fa-times m-1"></i>¡Error!, ¡Hubo un eror!, Ya existe el Username</span>
              </div> 
             <!--Mensaje de Alerta de error de contraseña-->
             <div class="alert alert-danger text-center" id="nopass" style='display:none;'>
                    <span><i class="fas fa-times m-1"></i>¡Error!, La contraseña debe contener un numero, mayusculas y minusculas</span>
              </div>       
                 <div class="text-center">
                    <img src="../Img/logo.png" class="rounded-circle" alt="Cinque Terre" width="136" height="136">
              </div>
              <form id="form-crear">
                    <div class="form-group">
                        <label for="nombreusuario">Nombres</label>
                        <input id="nombreusuario" type="text" class="form-control" required>  
                        <input type="hidden"    id="id_usuario">                 
                    </div>
                    <div class="form-group">
                        <label for="apellidousuario">Apellidos</label>
                        <input id="apellidousuario" type="text" class="form-control"  required>                                        
                    </div>
                    <div class="form-group">
                        <label for="username">Usuario</label>
                        <input id="username" type="text" class="form-control"  required>                                           
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" type="text" class="form-control"  required>                                           
                    </div>
                    <div class="form-group">
                        <label for="area">Area</label>
                        <select name="area" id="area" class="form-control select2" style="width: 100%;"></select>                        
                    </div>  
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuario</label>
                        <select name="tipo" id="tipouser" class="form-control select2" style="width: 100%;"></select>                        
                    </div>  
                    
                   
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-outline-success float-right m-1" >Guardar</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
            </form>
      </div>
    </div>
  </div>
</div>
<!--Fin Modal-->

<!--Formulario de creacion de Tipos-->
<div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Gestion de Usuarios</h2>
                    </div>
                </div>
                <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearusuarios" onClick="limpiarforms()">  Ingresar nuevo usuario </button>                
                </div>
            </div>     
            <div class="row">
                <!--Cuadro de Busqueda-->
                <div class="card card-success">
                <div class="card-header Titulo">
                    <h3 class="card-title">Buscar Usuarios</h3>
                    <div class="input-group">
                        <input type="text" id="buscar-usuario" class="form-control float-left" placeholder="Ingresar Username del usuario a buscar">
                        <div class="input-group-append">
                            <button class="btn btn btn-success"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div id="usuarios" class="row d-flex aling-items-strech"></div>
                </div>
            </div>
                <!--Fin de cuadro de busqueda-->
            </div>      
        </div>
    </br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive-sm">
                            <table class="insumo table table-hover text-nowrap" id="Table">
                                 <thead class='table-success'>
                                        <tr>
                                        <th scope="col">Nombre</th>                                       
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Area</th>                                       
                                        <th scope="col">Tipo de Usuario</th>
                                        <th scope="col">Actualizar</th>
                                        <th scope="col">Eliminar</th>
                                        </tr>
                                </thead>
                                <tbody id="lista-compra" class='table-active'>
                                    
                                </tbody>
                         </table>
                    </div>
                   
                </div>

            </div>
        </div>
</div>

  



<?php
include_once 'layout/footer.php';
}
else {
    header('Location: ../index.php');
}
?>
<script>
    /*
    function cerrar() {
        $('#crearusuarios').modal('hide');
    }
    */
    function limpiarforms(){
        $('#id_usuario').val('');
      $('#nombreusuario').val('');
      $('#apellidousuario').val('');
      $('#username').val('');
      $('#password').val('');
    }
</script>
<script src="../Js/Gestion_Usuarios.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>