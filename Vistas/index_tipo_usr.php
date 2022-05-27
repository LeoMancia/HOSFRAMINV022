<?php
session_start();
if (!empty($_SESSION['us_tipo']) && $_SESSION['us_tipo']==1) {
    include_once 'layout/header.php';   
?>
    <title>Tipos</title>
<?php 
    include_once 'layout/navbar.php';
?>
<section>
</br>
</br>
</br>
</section>
<!--Modal de creacion de nuevo usuario-->
 <!-- Modal -->
<div class="modal fade" id="creartipous" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Creacion de tipos de Usuarios</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>        
      </div>
      <!--Apartado para ingresar los datos de un nuevo tipo de usuario-->
      <div class="modal-body">
            <!--Mensaje de Alerta success-->
            <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se creó exitosamente!</span>
              </div>
              <div class="alert alert-success text-center" id="edit-tipo" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se modificó exitosamente!</span>
              </div>
              <!--Mensaje de Alerta error-->
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                    <span><i class="fas fa-times m-1"></i>¡Error!, ¡Hubo un eror!</span>
              </div>    
                 <div class="text-center">
                    <img src="../Img/logo.png" class="rounded-circle" alt="Cinque Terre" width="204" height="136">
              </div>
              <form id="form-crear">
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuario</label>
                        <input id="tipo" type="text" class="form-control" placeholder="Ingresar tipo de usuario" required>  
                        <input type="hidden"    id="id_editar_tipo">                      
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
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Tipos de Usuarios</h2>
                    </div>
                </div>
                <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#creartipous" onClick="limpiarforms()">  Crear Tipo </button>                
                </div>
            </div>        
        </div>
    </br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <table class="compra table table-hover text-nowrap" id="Table">
                                <thead class='table-success'>
                                    <tr>
                                        <th scope="col">Tipos de Usuarios</th>                                       
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
        $('#creartipous').modal('hide');
    }*/
    function limpiarforms(){
        $('#id_editar_tipo').val('');
      $('#tipo').val('');
     
    }
</script>
<script src="../Js/Gestion_Tipo.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
