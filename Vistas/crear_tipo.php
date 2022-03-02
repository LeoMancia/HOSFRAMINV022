
<?php
    include_once 'layout/header.php';   
?>
    <title>Crear tipo de usuario</title>
<?php 
    include_once 'layout/navbar.php';
?>
<section>
</br>
</br>
</section>
<div class="wrapper mt-5">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Agregar Empleado</h2>
                    </div>
                    <p>Favor diligenciar el siguiente formulario, para agregar el empleado.</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" value="">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <textarea name="address" class="form-control"></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Sueldo</label>
                            <input type="text" name="salary" class="form-control" value="">
                            <span class="help-block"></span>
                        </div>
                        <input type="submit" class="btn btn-primary mt-1" value="Submit">
                        <a href="../Vistas/index_tipo_usr.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>


<?php
include_once 'layout/footer.php';
?>