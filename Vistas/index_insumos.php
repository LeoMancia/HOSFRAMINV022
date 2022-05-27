<?php
session_start();
if (!empty($_SESSION['us_tipo']) && $_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3) {
    include_once 'layout/header.php';   
?>
    <title>Insumos</title>
<?php 
    include_once 'layout/navbar.php';
?>

<section>
</br>

</section>

<!--Modal de creacion de nuevo insumo-->
 <!-- Modal -->
 <div class="modal fade" id="crearinsumos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Creacion de Insumos</h5>
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
                    <span><i class="fas fa-times m-1"></i>¡Error!, ¡Ya existe un insumo con el mismo codigo!</span>
              </div>    
                 <div class="text-center">
                    <img src="../Img/logo.png" class="rounded-circle" alt="Cinque Terre" width="204" height="136">
              </div>
              <form id="form-crear">
                    <div class="form-group">
                        <label for="codigo">Codigo de Insumo</label>
                        <input id="codigo" type="text" class="form-control" placeholder="123456789" required>  
                                        
                    </div>
                    <div class="form-group">
                        <label for="nominsumo">Nombre de Insumo</label>
                        <input id="nominsumo" type="text" class="form-control"  required>  
                                       
                    </div>
                    <div class="form-group">
                        <label for="desinsumo">Descripción</label>
                        <input id="desinsumo" type="text" class="form-control"  required>  
                                          
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input id="precio" type="text" class="form-control"  required>  
                                         
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" type="text" class="form-control"  required>  
                        <input type="hidden"    id="id_insumo">     
                    </div>
                    
                   
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-outline-success float-right m-1">Guardar</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
            </form>
      </div>
    </div>
  </div>
</div>
<!--Fin Modal-->

<!--Formulario de creacion de Tipos-->

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Gestion de Insumos</h2>
                    </div>
                </div>
                <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearinsumos" onClick="limpiarforms()">  Ingresar nuevo insumo </button>                
                </div>
            </div>     
            <div class="row">
                <!--Cuadro de Busqueda-->
                <div class="card card-success">
                <div class="card-header Titulo">
                    <h3 class="card-title">Buscar Insumos</h3>
                    <div class="input-group">
                        <input type="text" id="buscar-insumo" class="form-control float-left" placeholder="Ingresar codigo del insumo a buscar">
                        <div class="input-group-append">
                            <button class="btn btn btn-success"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div id="insumos" class="row d-flex aling-items-strech"></div>
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
                            <table class="insumo table table-hover text-nowrap display" id="Table">
                                 <thead class='table-success'>
                                        <tr>
                                        <th scope="col">Codigo de Insumo</th>                                       
                                        <th scope="col">Nombre Insumo</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Precio</th>                                       
                                        <th scope="col">Existencia</th>
                                        <th scope="col">Estado</th>                                       
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
   
    function limpiarforms(){
      $('#codigo').val('');
      $('#nominsumo').val('');
      $('#desinsumo').val('');
      $('#precio').val('');
      $('#cantidad').val('');
    }
</script>
<script src="../Js/Gestion_Insumo.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>