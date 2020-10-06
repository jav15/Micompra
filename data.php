<?php
header('Content-Type: application/json');
include('main_app/conexion.php');
if (isset($_GET['mes'])) {
$mes=$_GET['mes'];
   
    $data_points = array();
    $result = mysqli_query($mysqli, "SELECT * FROM compra_base WHERE Estado='Entregado' ORDER BY Fecha ASC"); 
    while ($row = mysqli_fetch_array($result)) {
    	$fecha = $row['Fecha'];
    	$fechaComoEntero = strtotime($fecha);
    	$anio=date("Y",strtotime($fecha));
        $dea=date("d",strtotime($fecha));
        $fecha2=$anio."-".$mes."-".$dea;
   		 $dia = date("d", $fechaComoEntero);
    	$result2 = mysqli_query($mysqli, "SELECT Valor FROM compra_base WHERE Fecha BETWEEN '$fecha2 00:00:00' AND '$fecha2 23:59:59' AND Estado='Entregado'"); 
    		$suma2=0;
    	while ($row2 = mysqli_fetch_array($result2)) {
    		$suma2= $suma2 + $row2['Valor'];
		}
$point = array("valorx" => $dia, "valory" => $suma2);
        array_push($data_points, $point);

   
   
 	
    }
    echo json_encode($data_points);
}

?>