<?php
    session_start();
    if(isset($_SESSION['Email'])){
             $user=$_SESSION['Email']['Celular'];
             $Name=$_SESSION['Email']['Nombre'];
             $Lastname=$_SESSION['Email']['Apellido'];
             $celphone=$_SESSION['Email']['Celular'];
             ?>
<!DOCTYPE html>
<html>
<head>
	<title>Panel administrador</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/metropolis" type="text/css"/>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">
<style>
    body{
        margin-top:60px;
    }
    
</style>
</head>
<body>
<?php  
include('menu.php');
include('main_app/conexion.php');
$cuser="SELECT Nombre,Apellido,Celular,Ciudad,Fecha FROM usuarios ORDER BY id DESC";
$ruser = mysqli_query($mysqli, $cuser);
?>

<div class="container">
  <h2>Panel</h2>
  <br>
   <a href="ingresar_producto.php">
  <button class="btn btn-sm btn-primary">Ingresar nuevo producto</button>
  </a><a href="edit_product.php">
  <button class="btn btn-sm btn-success">Editar producto</button>
  </a>
  <a href="estadisticas.php">
  <button class="btn btn-sm btn-danger">Estadística</button>
  </a>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Pedidos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Comprando</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Usuarios</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <h3>Pedidos</h3>
    <?php
      $c_base="SELECT Codigo,Estado,Celular,Direccion, Barrio FROM compra_base WHERE Estado ='Pedido'  ORDER BY id DESC";
$r_base = mysqli_query($mysqli, $c_base);
while ( $f_base = mysqli_fetch_array($r_base)) {
$codigo_base=$f_base['Codigo'];
$c_f="SELECT * FROM factura WHERE Codigo='$codigo_base' ORDER BY id ASC";
$r_f = mysqli_query($mysqli, $c_f);
?>
 <table class="table table-sm">
    <thead class="thead-dark">
      <tr>
        <th><?php echo $f_base['Celular']; ?></th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th></th>

      </tr>
    </thead>
    <tbody>
      <?php
        $valort="0";
while ($f_f = mysqli_fetch_array($r_f)) {

      ?>
      <tr>
        <td><?php echo $f_f['Nombre']; ?></td>
        <td><?php echo $f_f['Cantidad']; ?></td>
        <td><?php echo $f_f['Precio']; ?></td>

      </tr>
<?php 
$valort=$valort + $f_f['Precio'];

} ?>

</tbody>
</table>
<table class="table table-sm table-primary  ">
    <thead class="thead">
      <tr>
        <th><?php echo $f_base['Estado']; ?></th>
        <th>-</th>
        <th><i class="fas fa-cash-register"></i></th>

        <th>$<?php 
         $precio_3 = number_format($valort);
 $nn3= str_replace ( ",", ".", $precio_3);

         echo $nn3;?></th>
      </tr>
      <tr>
        <td><?php echo $f_base['Direccion']; ?></td>
        <td>-</td>
        <td><?php echo $f_base['Barrio']; ?></td>

      </tr>
    </thead>
    </table>

<?php 
}
?>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
      <h3>Comprando</h3>
     <?php
     $c_base="SELECT Codigo,Estado,Celular,Direccion, Barrio FROM compra_base WHERE Estado='Comprando'  ORDER BY id DESC";
$r_base = mysqli_query($mysqli, $c_base);
while ( $f_base = mysqli_fetch_array($r_base)) {
$codigo_base=$f_base['Codigo'];
$c_f="SELECT * FROM factura WHERE Codigo='$codigo_base' ORDER BY id ASC";
$r_f = mysqli_query($mysqli, $c_f);
?>
 <table class="table table-sm">
    <thead class="thead-dark">
      <tr>
        <th><?php echo $f_base['Celular']; ?></th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th></th>

      </tr>
    </thead>
    <tbody>
      <?php
        $valort="0";
while ($f_f = mysqli_fetch_array($r_f)) {

      ?>
      <tr>
        <td><?php echo $f_f['Nombre']; ?></td>
        <td><?php echo $f_f['Cantidad']; ?></td>
        <td><?php echo $f_f['Precio']; ?></td>

      </tr>
<?php 
$valort=$valort + $f_f['Precio'];

} ?>

</tbody>
</table>
<table class="table table-sm table-primary  ">
    <thead class="thead">
      <tr>
        <th><?php echo $f_base['Estado']; ?></th>
        <th>-</th>
        <th><i class="fas fa-cash-register"></i></th>

        <th>$<?php 
         $precio_3 = number_format($valort);
 $nn3= str_replace ( ",", ".", $precio_3);

         echo $nn3;?></th>
      </tr>
    </thead>
    </table>

<?php 
}
?>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
       <table class="table table-bordered table-sm">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Celular</th>
        <th>Fecha</th>
        <th>Ciudad</th>
      </tr>
    </thead>
    <tbody>
      <?php 
while ($f_u = mysqli_fetch_array($ruser)) {
?>
      <tr>
        <td><?php echo $f_u['Nombre']." ".$f_u['Apellido']; ?></td>
        <td><?php echo $f_u['Celular']; ?></td>
        <td><?php echo $f_u['Fecha']; ?></td>
      <td><?php echo $f_u['Ciudad']; ?></td>
      </tr>
  <?php  } ?>
    </tbody>
  </table>
    </div>
  </div>
</div>
<div style="text-align: center;">
  <img src="img/icon.png">
</div>
</body>
</html>
<?php 
}else{
header('Location:iniciar_sesion.php');

}
?>