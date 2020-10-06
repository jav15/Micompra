<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<?php 
	$nombre=$_GET['bt'];
	$user=$_GET['user'];
	$valor=$_GET['valor'];

?>

<form method="POST" action="procesos_productos.php" style="text-align: center;">
 <input type="number" style="font-size: 12px; margin-bottom: 10px;" class="form-control " min="1" placeholder="Cantidad" required name="cantidad">
 <input type="hidden" name="compra" value="<?php echo $nombre; ?>">
 <input type="hidden" name="user_cel" value="<?php echo $user; ?>">
 <input type="hidden" name="valor" value="<?php echo $valor; ?>">
<button class="btn btn-block btn-sm btn-danger">Comprar</button>

</form>