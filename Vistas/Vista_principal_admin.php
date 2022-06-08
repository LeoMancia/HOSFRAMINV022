<?php
session_start();
if (!empty($_SESSION['us_tipo'])) {
    include_once 'layout/header.php';   
?>
    <title>Pantalla Principal</title>
<?php 
    include_once 'layout/navbar.php';
?>

<section>
</section>
<input type="hidden" id="vist" value="vpi">
<!--Formulario de creacion de Tipos-->
<div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Gestión de Insumos</h2>
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
                                    <th>Código Prod</th>
                                    <th>Nombre Prod</th>
                                    <th>Descripción</th>
                                    <th>Eliminar</th>                  
                                </tr>
                            </thead>
                        <tbody id="lista">
                        
                        </tbody>
                        </table>
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                            <a href="#" id="procesarPedido" class="btn btn-primary btn-block">Crear Pedido</a>
                            </div>
                            <div class="col-md-3"></div>
                            <div class=" col-md-5">
                            <a href="#" id="vaciar-carrito" class="btn btn-danger btn-block">Eliminar Insumos</a>
                            </div>
                        </div>
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
                <!--Cuadro de Busqueda-->
                <div class="card card-success">
                <div class="card-header Titulo">
                    <h3 class="card-title">Buscar Insumos</h3>
                    <div class="input-group">
                        <input type="text" id="buscar-insumo" class="form-control float-left" placeholder="Ingresar código del insumo a buscar">
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
                <div class="col-md-12">
                    <div class="table-responsive-sm">
                            <table class="insumo table table-hover text-nowrap" id="Table">
                                 <thead class='table-success'>
                                        <tr>
                                        <th scope="col">Código de Insumo</th>                                       
                                        <th scope="col">Nombre Insumo</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Existencia</th>                                       
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