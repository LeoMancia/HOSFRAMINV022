<?php
session_start();
if (!empty($_SESSION['us_tipo'])) {
    include_once 'layout/header.php';   
?>
    <title>Tipos</title>
<?php 
    include_once 'layout/navbar.php';
?>
<!-- Boton y text-box para  probar el generador
<button id="btnSerial">Generar codigo</button>
<label>Codigo:</label>
<input id="txtSerial" type="text" />
-->

<link rel="stylesheet" href="../Css/pedidos.css">
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <input type="hidden"    id="unidad_actual">
                <div class="card card-success">
                    <div class="card-header">
                    </div>
                    <div class="card-body p-0">
                        <header>
                            <div class="logo_cp">
                                <img src="../img/logo.png" width="100" height="100">
                            </div>
                            <h1 class="titulo_cp">SOLICITUD DE INSUMOS</h1>
                            <div class="datos_cp">
                                <div class="form-group row">
                                    <span>Unidad Solicitante: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" class="form-control" id="unidad" placeholder="Ingresa la unidad que solicita">
                                    </div>
                                </div>
                            </div>
                        </header>
                        
                        <div id="cp"class="card-body p-0">
                            <table class="compra table table-hover text-nowrap">
                                <thead class='table-success'>
                                    <tr>
                                        <th scope="col">Codigo de Insumo</th>
                                        <th scope="col">Nombre Insumo</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Fecha de peticion</th>
                                        <th scope="col">Cantidad Solicitada</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-compra" class='table-active'>
                                    
                                </tbody>
                            </table>
                           
                        <div class="row justify-content-between">
                            <div class="col-md-4 mb-2">
                                <a href="../Vistas/Vista_principal_admin.php" class="añadir btn btn-primary btn-block">Añadir mas insumos</a>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <a href="#" class="btn btn-success btn-block" id="procesar-compra">Realizar petición</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
var usuario = "<?php echo $_SESSION['area']; ?>";
$(document).ready(function(){
$('#unidad_actual').val(usuario);
$('#unidad').val(usuario);
let date = new Date();
let fecha = date.toISOString().split('T')[0];
$('#fechapeticion').val(fecha);

})
</script>
<?php
include_once 'layout/footer.php';
}
else {
    header('Location: ../index.php');
}
?>
<!--<script src="../Js/Gestion_Insumo.js"></script>-->
<script src="../Js/Carrito.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>