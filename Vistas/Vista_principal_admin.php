<?php
session_start();
if (!empty($_SESSION['us_tipo'])) {
?>
    <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, Admin</title>
  </head>
  <body>
    <a href="../Controlador/logout.php">Cerrar Session</a>
    <?php 
    include_once 'layout/navbar.php';
    ?>

<?php
include_once 'layout/footer.php';
}
else {
    header('Location: ../index.php');
}
?>