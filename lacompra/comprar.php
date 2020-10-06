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
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162788570-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-162788570-1');
</script>

	<title>La compra</title>
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

 <link rel="stylesheet" href="css/grid/baguettebox.css">
    <link rel="stylesheet" href="css/grid/gallery-grid.css">

<style type="text/css">
	body{
margin-top: 50px;

	}

</style>
</head>
<body class="bg-gradient-primary-to-secondary">
<!-- A grey horizontal navbar that becomes vertical on small screens -->

<?php 
include('menu.php');
 ?>
 <div style="max-width: 600px; margin-left: auto; margin-right: auto;">
<img src="img/lacompra2.png" class="img-fluid">
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
 ?>
<?php 
include('main_app/conexion.php');

//BUSCAR POR CATEGORIAS
//BUSCAR POR CATEGORIAS
//BUSCAR POR CATEGORIAS 
if (isset($_GET['categoria'])) {
	$var=$_GET['categoria'];
?>
<div class="container">
  <div class="row">
<?php
$conn = $mysqli;
$registros = 10;
 
$contador = 1;
if (isset($_GET['pagina'])) {
    $pagina=$_GET['pagina'];
    $inicio = ($pagina - 1) * $registros;
} else {
$inicio = 0;
    $pagina = 1;
}
?>
  
            <?php
            $resultados = mysqli_query($conn,"SELECT * FROM productos WHERE Categoria='$var'");
 
       
            $total_registros = mysqli_num_rows($resultados);
 
           
            $resultados = mysqli_query($conn,"SELECT * FROM productos WHERE Categoria='$var' ORDER BY id ASC LIMIT $inicio, $registros");
 
           
            $total_paginas = ceil($total_registros / $registros);
 
            if ($total_registros) {
              
                ?>
<div class="row_producto tz-gallery">
<?php 
  while ($f_lista = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
?>
                   <div class="col producto shadow " style=" text-align: center;">
 <a class="lightbox" href="<?php echo $f_lista['Imagen']; ?>">
                    <img class="img_producto" src="<?php echo $f_lista['Imagen']; ?>" >
                </a>

  	<h6 style="font-size: 14px;"><?php echo $f_lista['Nombre']; ?></h6>
  	<p class="text-success">$<?php  
  	$verificar= strlen($f_lista['Precio']); 
switch ($verificar) {
	case '4':
		$n_precio = number_format($f_lista['Precio']);
  		$nn2= str_replace ( ",", ".", $n_precio);

  		echo $nn2;
		break;
	
	default:
		$n_precio = number_format($f_lista['Precio']);
  		$nn2= str_replace ( ",", ".", $n_precio);

  		echo $nn2;
		break;
}
  	?></p>
  	<iframe scrolling="no" frameborder="0" src="btn_comprar.php?bt=<?php echo $f_lista['Nombre']; ?>&user=<?php echo $user; ?>&valor=<?php echo  $f_lista['Precio']; ?>" style="border: 0px solid black; " width="80" height="76" id="iframemain" name="iframemain" src="/home">Su navegador no permite iframes</iframe>
  	
  </div>


                    <?php
              
                   $contador++;
                } ?>
</div>
                <?php
             } else {
              echo "<font color='darkgray'>(sin resultados)</font>";
            }
 
            mysqli_free_result($resultados);
            ?>
  
 
    <div>
        <ul  class="pagination pagination-sm">
   
 
        <?php
        if ($total_registros) {
        
            if (($pagina - 1) > 0) {
                echo "<li class='page-item'><a class='page-link' href='comprar.php?categoria=$var&pagina=".($pagina-1)."'>Anterior</a></li>";
            } else {
            }
 
            for ($i = 1; $i <= $total_paginas; $i++) {
                if ($pagina == $i) {
                    echo " <li class='page-item'><a class='page-link' href='#'>". $pagina ."</a></li>";
                } else {
                    echo " <li class='page-item'><a class='page-link' href='comprar.php?categoria=$var&pagina=$i'>$i</a></li>";
                }
            }
 
        
            if (($pagina + 1)<=$total_paginas) {
                echo " <li class='page-item'><a class='page-link' href='comprar.php?categoria=$var&pagina=".($pagina+1)."'>Siguiente </a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='#'>Siguiente</a></li>";
            }
        }
        ?>
    </ul>
    </div>
 

<?php
//FIN BUSCAR POR CATEGORIAS 
//FIN BUSCAR POR CATEGORIAS 
//FIN BUSCAR POR CATEGORIAS 


//BUSCAR POR NOMBRE
//BUSCAR POR NOMBRE 
//BUSCAR POR NOMBRE 
}elseif (isset($_GET['nombreproducto'])) {
	$var=$_GET['nombreproducto'];


$lista="SELECT * FROM productos WHERE Nombre like '%$var%' ";
$r_lista = mysqli_query($mysqli, $lista);

?>
<div class="row_producto tz-gallery">
<?php  
  
while ( $f_lista = mysqli_fetch_array($r_lista)) {
	# code...
?>


  <div class="col producto shadow " style=" text-align: center;">
 <a class="lightbox" href="<?php echo $f_lista['Imagen']; ?>">
                    <img class="img_producto" src="<?php echo $f_lista['Imagen']; ?>" >
                </a>

  	<h6 style="font-size: 14px;"><?php echo $f_lista['Nombre']; ?></h6>
  	<p class="text-success">$<?php  
  	$verificar= strlen($f_lista['Precio']); 
switch ($verificar) {
	case '4':
		$n_precio = number_format($f_lista['Precio']);
  		$nn2= str_replace ( ",", ".", $n_precio);

  		echo $nn2;
		break;
	
	default:
		$n_precio = number_format($f_lista['Precio']);
  		$nn2= str_replace ( ",", ".", $n_precio);

  		echo $nn2;
		break;
}
  	?></p>
  	<iframe scrolling="no" frameborder="0" src="btn_comprar.php?bt=<?php echo $f_lista['Nombre']; ?>&user=<?php echo $user; ?>&valor=<?php echo  $f_lista['Precio']; ?>" style="border: 0px solid black; " width="80" height="76" id="iframemain" name="iframemain" src="/home">Su navegador no permite iframes</iframe>


  </div>

<?php
//FIN BUSCAR POR NOMBRE 
//FIN BUSCAR POR NOMBRE 
//FIN BUSCAR POR NOMBRE 
}
}else{ //SIN BUSCAR
//SIN BUSCAR
//SIN BUSCAR ?>

<div class="container">
  <div class="row">
<?php
$conn = $mysqli;
$registros = 10;
 
$contador = 1;
if (isset($_GET['pagina'])) {
    $pagina=$_GET['pagina'];
    $inicio = ($pagina - 1) * $registros;
} else {
$inicio = 0;
    $pagina = 1;
}
?>
  
            <?php
            $resultados = mysqli_query($conn,"SELECT * FROM productos ORDER BY Precio ASC");
 
       
            $total_registros = mysqli_num_rows($resultados);
 
           
            $resultados = mysqli_query($conn,"SELECT * FROM productos ORDER BY Precio ASC LIMIT $inicio, $registros");
 
           
            $total_paginas = ceil($total_registros / $registros);
 
            if ($total_registros) {
              
                ?>
<div class="row_producto tz-gallery">
<?php 
  while ($f_lista = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
?>
                   <div class="col producto shadow " style=" text-align: center;">
 <a class="lightbox" href="<?php echo $f_lista['Imagen']; ?>">
                    <img class="img_producto" src="<?php echo $f_lista['Imagen']; ?>" >
                </a>

  	<h6 style="font-size: 14px;"><?php echo $f_lista['Nombre']; ?></h6>
  	<p class="text-success">$<?php  
  	$verificar= strlen($f_lista['Precio']); 
switch ($verificar) {
	case '4':
		$n_precio = number_format($f_lista['Precio']);
 		$nn2= str_replace ( ",", ".", $n_precio);

  		echo $nn2;
		break;
	
	default:
	$n_precio = number_format($f_lista['Precio']);
  		$nn2= str_replace ( ",", ".", $n_precio);

  		echo $nn2;
		
		break;
}
  	?></p>
  	<iframe scrolling="no" frameborder="0" src="btn_comprar.php?bt=<?php echo $f_lista['Nombre']; ?>&user=<?php echo $user; ?>&valor=<?php echo  $f_lista['Precio']; ?>" style="border: 0px solid black; " width="80" height="76" id="iframemain" name="iframemain" src="/home">Su navegador no permite iframes</iframe>

  </div>
                    <?php
              
                   $contador++;
                } ?>
</div>

                <?php
             } else {
              echo "<font color='darkgray'>(sin resultados)</font>";
            }
 
            mysqli_free_result($resultados);
            ?>
  
 
    <div>
        <ul  class="pagination pagination-sm">
   
 
        <?php
        if ($total_registros) {
        
            if (($pagina - 1) > 0) {
                echo "<li class='page-item'><a class='page-link' href='comprar.php?pagina=".($pagina-1)."'>Anterior</a></li>";
            } else {
            }
 
            for ($i = 1; $i <= $total_paginas; $i++) {
                if ($pagina == $i) {
                    echo " <li class='page-item'><a class='page-link' href='#'>". $pagina ."</a></li>";
                } else {
                    echo " <li class='page-item'><a class='page-link' href='comprar.php?pagina=$i'>$i</a></li>";
                }
            }
 
        
            if (($pagina + 1)<=$total_paginas) {
                echo " <li class='page-item'><a class='page-link' href='comprar.php?pagina=".($pagina+1)."'>Siguiente </a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='#'>Siguiente</a></li>";
            }
        }
        ?>
    </ul>
    </div>
 


 <?php
}
  ?>
  	</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>
</html>
<?php 
}else{
header('Location:iniciar_sesion.php');

}
?>