
<?php
require('fpdf/fpdf.php');
//Definicion de conexiones a base de datos
include_once '../Modelo/Conexion.php';
session_start();
$area = $_SESSION['area'];
$iduser = $_SESSION['usuario'];

if(isset($_POST['btnPDF'])) //Check if user clicked the button
{
    $_SESSION["Id"]=$_POST['Id'];
}else {
    $Id=$_SESSION["Id"];
    unset($_SESSION["Id"]);
    
$db= new Conexion();
$conexion = $db->pdo;
$conexion->beginTransaction();
$sql = "SELECT * FROM vale_salida WHERE codigo_vle = :Id";
    $query = $conexion->prepare($sql);
    $query->execute(array(':Id'=>$Id));
    $ismpeticion= $query->fetchall();
    foreach ($ismpeticion as $peticiones) {
        $area = $peticiones->area_peticion;
        $fecha = $peticiones->fecha_peticion;
     }
// Fin de conexion

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    //$this->Cell(1);
    // Título
    $this->Cell(0,20,$this->Image('../Img/logo1.jpeg',85,8,44),1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',8);
    // Número de página
    $this->Cell(0,10,'HOSFRAM 2022',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',7);

$pdf->MultiCell(0, 5, utf8_decode("CENTRO DE DISTRIBUCION DE SUMINISTROS \n VALE DE SOLICITUD DE INSUMOS"), 1, 'C');
$pdf->Cell(140,10,'NOMBRE DE LA UNIDAD SOLICITANTE: '." ".utf8_decode($area),1,0,'L');
$pdf->Cell(0,10,'FECHA: '." ".$fecha,1,1,'L');
$pdf->Cell(45,10,'CODIGO DEL PRODUCTO',1,0,'C');
$pdf->Cell(50,10,'DESCRIPCION ',1,0,'C');
$pdf->Cell(45,10,'CANTIDAD SOLICITADA',1,0,'C');
$pdf->Cell(0,10,'CANTIDAD DESPACHADA ',1,1,'C');
foreach ($ismpeticion as $peticiones) {
    $pdf->Cell(45,10,$peticiones->codigo_ism, 1, 0, 'C', 0);
    $pdf->Cell(50,10,$peticiones->nom_prod, 1, 0, 'C', 0);
    $pdf->Cell(45,10,$peticiones->cant_solicitada, 1, 0, 'C', 0);
    $pdf->Cell(0,10,'', 1, 1, 'C', 0);
 }
$pdf->Cell(95,30,'FIRMA Y SELLO DEL SOLICTANTE: ',1,0,'L');
$pdf->MultiCell(0,30,utf8_decode("NOMBRE DE QUIEN DESPACHA"),1,'L');
$pdf->Output('Insumos.pdf','I');
}

?>
