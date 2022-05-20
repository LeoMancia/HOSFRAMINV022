<!doctype html>
<html lang="en">
  
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../Css/nav.css" />.

    <!--Select 2-->
    <link rel="stylesheet" href="../Css/select2.css" />
    <!--Carrito Css-->
    <link rel="stylesheet" href="../Css/main.css" />
    <title>Hello, Admin</title>
  </head>
  <body>


  
 <!--Navbar de opciones-->
<nav class="navbar navbar-light bg-light fixed-top">
   <div class="container-fluid menu_bar">
    <a class="navbar-brand" href="../Vistas/Vista_principal_admin.php">HOSFRAM</a>
    <a class="navbar-brand">Bienvenid@: <?php echo  $_SESSION['nombre']?></a>
    <a class="navbar-brand" href="#"></a>
    <a class="navbar-brand" href="#"></a>
    <a class="navbar-brand" href="#"></a>
    <a class="navbar-brand" href="#"></a>
    <a class="navbar-brand" href="#"></a>
    <a class="navbar-brand" href="#"></a>
    <a class="navbar-brand" href="#"></a>
    <a class="navbar-brand" href="#"></a>
    <!--Dropdown para carrrito-->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
  </div>
    <!--Fin de dropdown para carrrito-->
     
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Administración</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Vistas/index_tipo_usr.php">Crear Tipos de Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Vistas/areas.php">Areas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Vistas/index_insumos.php">Insumos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Vistas/index_usuarios.php">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Vistas/peticionesxpersonas.php">Peticiones de Insumos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Controlador/logout.php">Cerrar Sesion</a>
          </li>
         </li>
        </ul>
      </div>
    </div>
  </div>
</nav>



