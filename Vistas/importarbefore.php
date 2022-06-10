<?php

  $dbHost     = 'localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $dbName     = '';
  include('importarbackup.php');
  ?>
  <section>
  </br>
  </section>

  <div class="wrapper">
  <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                      <form action="" method="post" enctype="multipart/form-data">
                      <h2 for="file" class="pull-left">Seleccione la base de datos a restaurar:</h2>
                      </br>
                      <input type="file" name="file" id="file">
                      </br>
                      </br>
                      <input type="submit" class="btn btn-primary" name="submit" value="Importar">
                      </form>
                    </div>
                </div>
                
            </div>        
        </div>
  </div>

 
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php

  if (isset($_FILES["file"]["name"])) {
    $target_file = basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    //echo $FileType;
  }

  if (isset($FileType)) {
  // Allow certain file formats
    if($FileType != "sql" ) {
      //echo "<script>Swal.fire('Error, solo se aceptan archivos con extension .sql');</script>";
      $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
      echo "<script>Swal.fire('Error, no se ha seleccionado ningun archivo con extension .sql.');</script>";
    } else {
      if ( isset($_FILES["file"]["tmp_name"]) ) {
        $filePath = $_FILES["file"]["tmp_name"];
        //echo $filePath;
        try {
        
            restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath);
            echo "<script> 
            setTimeout(function(){
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'La Base de datos: <b>". htmlspecialchars( basename( $_FILES["file"]["name"]))."</b> Ha sido restaruada exitosamente.',
                showConfirmButton: false,
                timer: 1500
              });
           }, 2500);
           setTimeout(function(){
               location.href = '../index.php'
           }, 4500);
            </script>";
            
            
           
        } catch (Exception $error) {
          
            echo $error->getMessage();
            echo "Sorry, there was an error uploading your file.";
        }
      }

    }

  }


?>
