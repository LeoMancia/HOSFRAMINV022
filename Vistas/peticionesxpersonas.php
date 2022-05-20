<?php
session_start();
if (!empty($_SESSION['us_tipo'])) {
    include_once 'layout/header.php';   
?>
    <title>Tipos</title>
<?php 
    include_once 'layout/navbar.php';
?>

<input type="hidden" id="rol" value="<?php echo $_SESSION['us_tipo']?>">

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
                            
                        </header>                        
                        <div class="card-body p-0">
                            <!--Cuadro de Busqueda-->
                                <div class="card card-success">
                                <div class="card-header Titulo">
                                    <h3 class="card-title">Buscar Petición</h3>
                                    <div class="input-group">
                                        <input type="text" id="buscar-peticion" class="form-control float-left" placeholder="Ingresar codigo de su peticion a buscar">
                                    </div>
                                </div>
                                <div class="card-body">
                                <div id="insumos" class="row d-flex aling-items-strech"></div>
                                </div>
                            </div>
                                <!--Fin de cuadro de busqueda-->
                            <table class="compra table table-hover text-nowrap" id="Table">
                                <thead id="encabezado" class='table-success'>
                                    
                                </thead>
                                <tbody id="lista-compra" class='table-active'>
                                    
                                </tbody>
                            </table>
                           
                        <div class="row justify-content-between">
                            <div class="col-md-4 mb-2">
                                <a href="../Vistas/Vista_principal_admin.php" class="añadir btn btn-primary btn-block">Volver a pantalla de inicio</a>
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
<script src="../Js/Gestion_Peticiones.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>