<?php
session_start();
if (!empty($_SESSION['us_tipo'])) {
    include_once 'layout/header.php';   
?>
    <title>Tipos</title>
<?php 
    include_once 'layout/navbar.php';
?>

<section>
</section>

<!--Modal de creacion de nuevo insumo-->
 <!-- Modal -->
 <div class="modal fade" id="crearpeticion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Creacion de Peticion de Insumos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>        
      </div>
      <!--Apartado para ingresar los datos de un nuevo tipo de usuario-->
      <div class="modal-body">
            <!--Mensaje de Alerta success-->
            <div class="alert alert-success text-center" id="add" style='display:none;'>
                  <span><i class="fas fa-check m-1"></i>Se creó exitosamente!</span>
              </div>              
              <!--Mensaje de Alerta error-->
              <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                    <span><i class="fas fa-times m-1"></i>¡Error!, ¡No se pudo completar la peticion!</span>
              </div>    
                 <div class="text-center">
                    <img src="../Img/logo.png" class="rounded-circle" alt="Cinque Terre" width="204" height="136">
              </div>
              <form id="form-crear">
                    <input type="hidden"    id="vist" value="vpi">            
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuario</label>
                        <input id="tipo" type="text" class="form-control" placeholder="Ingresar tipo de usuario" required>  
                        <input type="hidden"    id="id_editar_tipo">                      
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuario</label>
                        <input id="tipo" type="text" class="form-control" placeholder="Ingresar tipo de usuario" required>  
                        <input type="hidden"    id="id_editar_tipo">                      
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuario</label>
                        <input id="tipo" type="text" class="form-control" placeholder="Ingresar tipo de usuario" required>  
                        <input type="hidden"    id="id_editar_tipo">                      
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuario</label>
                        <input id="tipo" type="text" class="form-control" placeholder="Ingresar tipo de usuario" required>  
                        <input type="hidden"    id="id_editar_tipo">                      
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuario</label>
                        <input id="tipo" type="text" class="form-control" placeholder="Ingresar tipo de usuario" required>  
                        <input type="hidden"    id="id_editar_tipo">                      
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuario</label>
                        <input id="tipo" type="text" class="form-control" placeholder="Ingresar tipo de usuario" required>  
                        <input type="hidden"    id="id_editar_tipo">                      
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
<div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Gestion de Insumos</h2>
                    </div>
                </div>    
                <div class="col-md-6 mt-3" >
                <img  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </img>                
                    <img src="../Img/gestion.png" width="80" height="55" title="Ver peticiones de insumos" class="imagen-carrito nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="contador" class="contador badge badge-danger"></span>
                    </img>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <table class="carro table table-hover text-nowrap">
                          <thead class="table-success">
                                 <tr>
                                    <th>Codigo Prod</th>
                                    <th>Nombre Prod</th>
                                    <th>Descripción</th>
                                    <th>Eliminar</th>                  
                                </tr>
                            </thead>
                        <tbody id="lista">
                        
                        </tbody>
                        </table>
                        <a href="#" id="procesarPeticion" class="btn btn-primary btn-block">Crear Pedido</a>
                        <a href="#" id="vaciar-carrito" class="btn btn-danger btn-block">Eliminar Insumos</a>
                    </div>
                    <!--Carrito-->
                </div>           
            </div>
    </div>       
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
                                        <th scope="col">Codigo de Insumo</th>                                       
                                        <th scope="col">Nombre Insumo</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Estado</th>                                       
                                        <th scope="col">Crear Petición</th>
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
<script src="../Js/Gestion_Insumo.js"></script>
<script src="../Js/Carrito.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>