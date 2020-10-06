<?php
  session_start();
    if(isset($_SESSION['Email'])){
             $user=$_SESSION['Email']['Celular'];
require('fpdf.php');
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/lacompra.png',10,8,33);
    $this->Cell(90,10, '',0,1,'C',0);
    // Arial bold 15
    $this->SetFont('Arial','B',28);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(70,10,'Factura La Compra',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->Cell(90,90, '',0,1,'C',0);
    $this->SetFont('Arial','B',18);
    $this->Cell(90,10, 'Nombre',1,0,'C',0);
    $this->Cell(50,10, 'Cantidad',1,0,'C',0);
    $this->Cell(50,10, 'Precio',1,1,'C',0);

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'main_app/conexion.php';
$consulta2="SELECT Codigo FROM  compra_base WHERE Celular = ' $user' AND Estado='Pedido'";
$r_c2 = mysqli_query($mysqli, $consulta2);
   $row_cnt = mysqli_num_rows($r_c2);
switch ($row_cnt) {
	case '0':
		break;
	
	default:
	$f_f = mysqli_fetch_array($r_c2);
	$codigo=$f_f['Codigo'];
		$consulta="SELECT * FROM  factura WHERE Codigo = '$codigo'";
$r_c = mysqli_query($mysqli, $consulta);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);
$pdf->Image('img/productos/x9aj7676vozq1c7u8producto.jpg',60,30,90,0,'jpg');
$total=0;
 while ($row_com = $r_c->fetch_assoc()) {
   	$pdf->Cell(90, 10,$row_com['Nombre'],1,0,'C',0);
   	$pdf->Cell(50, 10,$row_com['Cantidad'],1,0,'C',0);
   	$pdf->Cell(50, 10,$row_com['Precio'],1,1,'C',0);
$total=$total + $row_com['Precio'];
   }  ;
   	$pdf->Cell(140, 10,'total',1,0,'C',0);
   	$pdf->Cell(50, 10,$total,1,1,'C',0);

		break;
}






$pdf->Output();
}
?>
