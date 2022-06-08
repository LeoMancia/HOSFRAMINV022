<?php
session_start();
if (!empty($_SESSION['us_tipo']) && $_SESSION['us_tipo']==1) {
   
include('backupbd.php');

$arrayDbConf['host'] = 'localhost';
$arrayDbConf['user'] = 'root';
$arrayDbConf['pass'] = '';
$arrayDbConf['name'] = 'dbhna';

?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
try {

    $bck = new MySqlBackupLite($arrayDbConf);
    $bck->backUp();
    $bck->downloadFile();
  
  }
  catch(Exception $e) {
    echo $error->getMessage();
  }

}
else {
    header('Location: ../index.php');
}
  
  ?>