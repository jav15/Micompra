<?php
//CANCELAR COMPRA TOTAL
//CANCELAR COMPRA TOTAL
//CANCELAR COMPRA TOTAL
if (isset($_POST['cancela'])) {
    
    
    

$servername = "localhost";
$database = "lacompra";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
  $cel_can=$_POST['cancela'];
   $cancelar="UPDATE compra_base SET Estado='Cancelado' WHERE Codigo='$cel_can'";
 if (mysqli_query($conn, $cancelar)) {
header('Location: comprar.php');
}else{

	echo "no ha recibido";
}
}

//FINALIZAR COMPRA
//FINALIZAR COMPRA
//FINALIZAR COMPRA

if (isset($_POST['pedido_f'])) {
  include 'main_app/conexion.php';
  $codigo=$_POST['pedido_f'];
  $direccion=$_POST['direccion'];
  $barrio=$_POST['barrio'];
   $pedir="UPDATE compra_base SET Estado='Pedido', Direccion='$direccion', Barrio='$barrio' WHERE Codigo='$codigo'";

if (mysqli_query($mysqli, $pedir)) {
header('Location: mifactura.php');
}else{

	echo "Ocurrio un error,no se podido pedir";
}


}




//CONFIRMAR RECIBIDO 
//CONFIRMAR RECIBIDO 
//CONFIRMAR RECIBIDO 
if (isset($_POST['recibido'])) {
  include 'main_app/conexion.php';
	$codigo=$_POST['recibido'];
 $pedir="UPDATE compra_base SET Estado='Entregado' WHERE Codigo='$codigo'";

if (mysqli_query($mysqli, $pedir)) {
header('Location: mifactura.php');
}else{

	echo "Ocurrio un error,no se podido Finalizar";
}

}



?>