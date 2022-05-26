<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel = "preconnect" href = "https://fonts.gstatic.com">
    <link href = "https://fonts.googleapis.com/css2? family = Poppins: wght @ 700 & display = swap" rel = "hoja de estilo">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--<link rel="stylesheet" type="text/css " href="Css/style.css">-->
    <link rel="stylesheet" type="text/css " href="Css/css/all.min.css">
     <!-- Estilo CSS-->
    <link rel="stylesheet" href="./Css/login.css">
</head>

<!--Verifica si hay una sesion activa-->
<?php
session_start();
if (!empty($_SESSION['us_tipo'])) {
    header('Location: Controlador/loginController.php');
}
else {
    #Borrar Sessiones en curso
    session_destroy();
    
?>
<!--Verifica si hay una sesion activa-->
<body>
<!-----------------------------Login nuevo------------------------------------->
<div class="contenido-login">
<div class="row">
        <div class="sidenav">
            <div class="login-main-text">
                <h2>HOSFRAM<br> Inicio de Sesion</h2>
                <p>Ingresa tus credenciales.</p>
                
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-5">
            <br/>
            <br/>
            <div class="main">
                <div class="login-main-text py-10">
                    <center>
                        <form action="Controlador/loginController.php" method="POST">
                        <div class="input-div name">
                            <div class="form-group">
                                <label class="UserName">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre de Usuario" name="user">
                            </div>
                        </div>
                        <div class="input-div pass">

                        </div>              
                            <div class="campo form-group">
                                <label for="password" class="contraseña">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Contraseña" name="pass" id="password">
                                <span>Mostrar</span>
                            </div>
                           <input type="submit" class="btn btn-black" value="iniciar sesion">

                        </form>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<!-----------------------------Login viejo------------------------------------->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    document.querySelector('.campo span').addEventListener('click', e => {
    const passwordInput = document.querySelector('#password');
    if (e.target.classList.contains('show')) {
        e.target.classList.remove('show');
        e.target.textContent = 'Ocultar';
        passwordInput.type = 'text';
    } else {
        e.target.classList.add('show');
        e.target.textContent = 'Mostrar';
        passwordInput.type = 'password';
    }
});
</script>         
<script src="Js/login.js"></script>
</html>
<?php

}
?>