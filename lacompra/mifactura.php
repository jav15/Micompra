<?php
    session_start();
    if(isset($_SESSION['Email'])){
             $user=$_SESSION['Email']['Celular'];
             $Name=$_SESSION['Email']['Nombre'];
             $Lastname=$_SESSION['Email']['Apellido'];
            ?>  
<!DOCTYPE html>
<html>
<head>
	<title>Mi factura</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Fuente logo -->
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">

<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/metropolis" type="text/css"/>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<style type="text/css">
	body{
margin-top: 50px;

	}

</style>
</head>
<body class="bg-gradient-primary-to-secondary">
<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-md bg-primary fixed-top " style="padding: 1px 10px; ">
  <!-- Brand -->
 <a class="navbar-brand" href="comprar.php">
    <img src="img/lacompra.png" alt="Lacompra" style="width:40px; height: 40px;"> <span style="font-family: 'Roboto Slab', serif; color: #fff; ">Tienda La oficial</span>
  </a>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <i class="fas fa-lg fa-bars"></i>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link text-white" href="#"><i class="far fa-user"></i> <?php echo $Name." ".$Lastname;?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="comprar.php"><i class="fas fa-store"></i> Comprar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="mifactura.php"><i class="fas fa-list"></i> Factura</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white"  href="main_app/salir.php"><i class="fas fa-power-off"></i> Cerrar Sesión</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
  <div class="row ">
<div class="col" style="padding: 0px;">
<h4 style="text-align:center;    font-family: 'MetropolisRegular';
   ">Directa a tu casa</h4>
 <form method="GET" action="comprar.php">
<div class="input-group mb-3"  style="padding: 0px 10px;">
  <input type="text" class="form-control" placeholder="Buscar" name="nombreproducto">
  <div class="input-group-append">
    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
  </div>
</div>
</form>

<?php 
include('categorias.php');

include('main_app/conexion.php');
//CONSULTA LISTA DE FACTURA
//CONSULTA LISTA DE FACTURA
//CONSULTA LISTA DE FACTURA
$c_base="SELECT Codigo,Estado FROM compra_base  WHERE Celular='$user' AND Estado = 'Comprando' OR Estado='Pedido'ORDER BY id DESC";
$r_base = mysqli_query($mysqli, $c_base);
   $row_com = mysqli_num_rows($r_base);
   switch ($row_com) {
     case '0': ?>
       <div class="alert alert-primary">
<h4>No has comprado nada aún</h4>
  <a href="comprar.php">
  <button class="btn btn-primary btn-block">¡Ir a comprar ya!</button>
</a>
</div>


       <?php 
       break;
     
   }
while ( $f_base = mysqli_fetch_array($r_base)) {
$estado_base=$f_base['Estado'];

switch ($estado_base) {
  case 'Comprando':
   


$codigo_base=$f_base['Codigo'];
$c_f="SELECT * FROM factura WHERE Celular='$user' AND Codigo='$codigo_base' ORDER BY id ASC";
$r_f = mysqli_query($mysqli, $c_f);

?>
  <table class="table table-sm">
    <thead class="thead-dark">
      <tr>
        <th>Producto</th>
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
      <tr class="bg-light">
      
        <td><small><?php echo $f_f['Nombre'];  ?></small></td>
        <td class="text-center"><small><?php echo $f_f['Cantidad'];  ?></small></td>
        <td class="text-center"><small><?php 
    $precio_2 = number_format($f_f['Precio']);
 $nn2= str_replace ( ",", ".", $precio_2);


        echo $nn2;  ?></small></td>
        <td>
          <form method="POST" action="procesos_productos.php"  onsubmit="return confirmation()" >
            <input type="hidden" name="eliminar" value="<?php echo $f_f['Nombre'];  ?>">
            <input type="hidden" name="eliminar_user" value="<?php echo $user;  ?>">
            <input type="hidden" name="cantidad_elim" value="<?php echo $f_f['Cantidad'];  ?>">

        <button class="btn btn-sm"><i  class="text-danger far fa-times-circle"></i></button>
          </form>
       
    <script type="text/javascript">
     function confirmation() 
     {
        if(confirm("¿Deseas eliminar <?php echo $f_f['Nombre'];   ?> de la factura?"))
  {
     return true;
  }
  else
  {
     return false;
  }
     }
   </script>

       </td>

      </tr>
<?php  

$valort=$valort + $f_f['Precio'];
}

?>

    </tbody>
  </table>
 <table class="table table-sm table-primary  ">
    <thead class="thead">
      <tr>
        <th>Total</th>
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
    switch ($nn3) {
      case '0':
        ?>
<div>
  <a href="comprar.php">
  <button class="btn btn-primary btn-block">¡Ir a comprar ya!</button>
</a>
</div>

        <?php
        break;
      
      default:
       ?>
<div style="margin-top: -15px; margin-bottom: 10px;">
<a href="comprar.php"> <button class="btn btn-sm btn-success">Seguir comprando <i class="fas fa-shopping-cart"></i></button></a>
</div>
       <details>
  <summary class="btn-primary btn btn-block">Realizar pedido ya!</summary>
  <form method="POST" action="proceso_final.php">
   
    <div class="container" style="margin-top: 10px;">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Tu Dirección" id="direccion" name="direccion" required autocomplete>
  </div>
  <div class="form-group">
    <input type="hidden" class="form-control"  id="barrio" name="barrio" value="Bquilla">
  </div>
  </div>
  <table class="table table-sm table-success" style="margin-bottom: 0px;">
    <thead class="thead">
      <tr>
        <th>Total</th>
        <th>-</th>
        <th><i class="fas fa-cash-register"></i></th>

        <th>$<?php 
         
         $precio_3 = number_format($valort);
        $nn3= str_replace ( ",", ".", $precio_3);
      

         echo $nn3;?></th>
      </tr>
    </thead>
    </table>

   <div style="margin-bottom: 10px;" class="alert-success"><i class="fas fa-lg fa-money-bill-wave"></i> <strong>Pago en efectivo - contra entrega</strong></div>
  <input type="hidden" name="pedido_f" value="<?php echo $codigo_base; ?>">

<button type="submit" class="btn  btn-success btn-block">¡Confirmar compra!</button>
</form>

</details>

    <hr style="margin-top: 50px;">
<form method="POST" action="proceso_final.php" style="margin-bottom: 20px;" onsubmit="return confirmationc()">
  <input type="hidden" name="cancela" value="<?php echo $codigo_base; ?>">
    <button type="submit" class="btn btn-sm btn-danger btn-block"><small>Borrar toda la compra</small></button>
  </form>
   <script type="text/javascript">
     function confirmationc() 
     {
        if(confirm("¿Confirmar borrar toda la factura?"))
  {
     return true;
  }
  else
  {
     return false;
  }
     }
   </script>
       <?php
        break;
    }

     ?>
    
</div>
<?php  
 //FIN ESTADO COMPRANDO
 //FIN ESTADO COMPRANDO
 //FIN ESTADO COMPRANDO 
    break;
  case 'Pedido':

$codigo_base=$f_base['Codigo'];
$c_f="SELECT * FROM factura WHERE Codigo='$codigo_base' AND Celular='$user' ORDER BY id ASC";
$r_f = mysqli_query($mysqli, $c_f);
$row_factu = mysqli_num_rows($r_f);
 switch ($row_factu) {
     case '0': ?>
      <div class="alert alert-primary">
<h4>No has comprado nada aún</h4>
  <a href="comprar.php">
  <button class="btn btn-primary btn-block">¡Ir a comprar ya!</button>
</a>
</div>
      <?php
       break;
       
       default:
?>


<div class=" alert-success " style="margin-bottom: 0px; margin-left: auto; margin-right: auto;"><strong>En proceso</strong><br><small>Debido a la alta demanda su pedido puede tardar más de lo normal, le agradecemos su espera.</small></div>
  <table class="table table-sm">
    <thead class="thead-dark">
      <tr>
        <th>Producto</th>
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
      <tr class="bg-light">
      
        <td><small><?php echo $f_f['Nombre'];  ?></small></td>
        <td class="text-center"><small><?php echo $f_f['Cantidad'];  ?></small></td>
        <td class="text-center"><small><?php 
    $precio_2 = number_format($f_f['Precio']);
 $nn2= str_replace ( ",", ".", $precio_2);


        echo $nn2;  ?></small></td>
        <td>

       </td>

      </tr>
<?php  

$valort=$valort + $f_f['Precio'];
}

?>

    </tbody>
  </table>
 <table class="table table-sm table-primary  ">
    <thead class="thead">
      <tr>
        <th>Total</th>
        <th>-</th>
        <th><i class="fas fa-cash-register"></i></th>

        <th>$<?php 
        
         $precio_3 = number_format($valort);
 $nn3= str_replace ( ",", ".", $precio_3);

         echo $nn3;?></th>
      </tr>
    </thead>
    </table>
    <form method="POST" action="proceso_final.php" onsubmit="return confirmation3()">
<input type="hidden" name="recibido" value="<?php echo $codigo_base; ?>">

<button class="btn btn-block btn-primary">¡Ya recibi mi compra!</button>
</form>
<div  class="small alert"><a href="https://api.whatsapp.com/send?phone=573217187495&text=<?php echo 'Mi codigo: '.$codigo_base.' --';  ?>Hola%20MiCompra%20tengo%20una%20duda%3A">Si tiene alguna duda. Haz click aquí <button class="btn btn-success "><i class="fab fa-whatsapp"></i></button></a></div>
    <script type="text/javascript">
     function confirmation3() 
     {
        if(confirm("¿Confirmar compra recibida? Recuerde revisar factura y pagar exactamente el valor de está"))
  {
     return true;
  }
  else
  {
     return false;
  }
     }
   </script>

    <?php 

    
    switch ($nn3) {
      case '0':
        ?>
<div>
  <a href="comprar.php">
  <button class="btn btn-primary btn-block">¡Ir a comprar ya!</button>
</a>
</div>

<?php
}
 break;
     
 }
    break;
case 'Cancelado':
    break;
  default:
   ?>
<div>
  <div class="alert alert-primary small"><p>Aún no has comprado nada</p>
<a href="comprar.php">
  <button class="btn btn-primary btn-block">Ir a comprar ya!</button>
</a>

  </div>
  
</div>
   <?php
    break;
}//FIN SWICHT //FIN SWICHT //FIN SWICHT


} //FIN WHILE BASE //FIN WHILE BASE //FIN WHILE BASE
?>
<div class="col d-none d-sm-none d-md-block"><img  src="img/lacompra.png"></div>
<hr>
<div class="col-sm-3" style="text-align: center;">
  <img style="width: 40px; height: 40px;" src="img/lacompradirecta.png">
</div>
</body>
</html>
<?php 
}else{
header('Location:iniciar_sesion.php');

}
?>