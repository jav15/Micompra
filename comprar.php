<?php
    session_start();
    if(isset($_SESSION['Email'])){
        if($_SESSION['Email']['codigo_verificacion2'] == "0"){
        header('Location:comprobar.php');


        }else{

             $user=$_SESSION['Email']['Celular'];
             $Name=$_SESSION['Email']['Nombre'];
             $Lastname=$_SESSION['Email']['Apellido'];
             $celphone=$_SESSION['Email']['Celular'];
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

	<title>La Compra</title>
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
<link type="text/css" href="zoomy.css" rel="stylesheet">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.js"></script>
<script type="text/javascript" src="zoomy.min.js"></script>
<script type="text/javascript">
$(function () {
    $('.zoom').zoomy();
});
</script>
<style type="text/css">
	body{
margin-top: 50px;

	}
 .carousel-inner img {
      width: 100%;
      height: 100%;
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
 
           
            $resultados = mysqli_query($conn,"SELECT * FROM productos WHERE Categoria='$var' ORDER BY Precio ASC LIMIT $inicio, $registros");
 
           
            $total_paginas = ceil($total_registros / $registros);
 
            if ($total_registros) {
              
                ?>
<div class="row_producto tz-gallery">
<?php 
  while ($f_lista = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
?>
                   <div class="col producto shadow " style=" text-align: center;">
 <a  class="lightbox" data-toggle="modal" data-target="#myModal"  href="<?php echo $f_lista['Imagen']; ?>">
                    <img   class="img_producto" src="<?php echo $f_lista['Imagen']; ?>" >
                </a>
  <div style=" height: 60px;">
    <h6  data-toggle="modal" data-target="#myModal" style="font-size: 14px;"><?php echo $f_lista['Nombre']; ?></h6>
    </div>
    <p class="text-success" style="margin-bottom: 5px;">$<?php  
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
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title"><i class="fas fa-list"></i> Especificaciones</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
       <a href="<?php echo $f_lista['Imagen']; ?>" class="zoom"><img src="<?php echo $f_lista['Imagen']; ?>" width="320px" height="240px" /></a>
    </div>
    <div class="carousel-item">
      <a href="https://dqzrr9k4bjpzk.cloudfront.net/images/14129030/1079586225.jpg" class="zoom"><img src="https://dqzrr9k4bjpzk.cloudfront.net/images/14129030/1079586225.jpg" width="320px" height="240px" /></a>
    </div>
    <div class="carousel-item">
      <a href="https://exitocol.vtexassets.com/arquivos/ids/1204646-800-auto?width=800&height=auto&aspect=true" class="zoom"><img src="https://exitocol.vtexassets.com/arquivos/ids/1204646-800-auto?width=800&height=auto&aspect=true" width="320px" height="240px" /></a>
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<div style="text-align: left!important;">
  <div class="jumbotron" style="margin-bottom: -5px;">
    <h3><?php echo $f_lista['Nombre']; ?></h3>      
    <p>El aerosol antitranspirante Old Spice brinda 48 hrs de protección poderosa contra el sudor y el mal olor.</p>
    <small>
° Protección poderosa contra el mal olor y la sudoración<br>
° 48 de protección poderosa<br>
° Protección poderosa con fragancias duraderas</small>
  </div>

</div>
<div class="alert alert-primary">
      <h4>20% de descuento</h4>

  <small style="text-decoration: line-through;">Antes <?php 

    $opera=$f_lista['Precio'] * 1.2;
    $n_precio2 = number_format($opera);

    echo $n_precio2;

     ?></small>
    <h5 class="text-success" style="margin-bottom: 5px;">$<?php  
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
    ?></h5>
</div>
<div style="text-align: center;">

    <iframe scrolling="no" frameborder="0" src="btn_comprar.php?bt=<?php echo $f_lista['Nombre']; ?>&user=<?php echo $user; ?>&valor=<?php echo  $f_lista['Precio']; ?>" style="border: 0px solid black; " width="140" height="76" id="iframemain" name="iframemain" src="/home">Su navegador no permite iframes</iframe>
</div>
        </div>
        <script type="text/javascript">
          $('.carousel').carousel({
  interval: 25000
})

        </script>
        <!-- Modal footer -->
       
        
      </div>
    </div>
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


$lista="SELECT * FROM productos WHERE Nombre like '%$var%' ORDER BY Precio ASC ";
$r_lista = mysqli_query($mysqli, $lista);

?>
<div class="row_producto tz-gallery">
<?php  
  
while ( $f_lista = mysqli_fetch_array($r_lista)) {
	# code...
?>


  <div class="col producto shadow " style=" text-align: center;">
 <a data-toggle="modal" data-target="#myModal" class="lightbox" href="<?php echo $f_lista['Imagen']; ?>">
                    <img class="img_producto" src="<?php echo $f_lista['Imagen']; ?>" >
                </a>
<div style=" height: 60px;">
    <h6 data-toggle="modal" data-target="#myModal" style="font-size: 14px;"><?php echo $f_lista['Nombre']; ?></h6>
    </div>
    <p class="text-success" style="margin-bottom: 5px;">$<?php  
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
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title"><i class="fas fa-list"></i> Especificaciones</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
       <a href="<?php echo $f_lista['Imagen']; ?>" class="zoom"><img src="<?php echo $f_lista['Imagen']; ?>" width="320px" height="240px" /></a>
    </div>
    <div class="carousel-item">
      <a href="https://dqzrr9k4bjpzk.cloudfront.net/images/14129030/1079586225.jpg" class="zoom"><img src="https://dqzrr9k4bjpzk.cloudfront.net/images/14129030/1079586225.jpg" width="320px" height="240px" /></a>
    </div>
    <div class="carousel-item">
      <a href="https://exitocol.vtexassets.com/arquivos/ids/1204646-800-auto?width=800&height=auto&aspect=true" class="zoom"><img src="https://exitocol.vtexassets.com/arquivos/ids/1204646-800-auto?width=800&height=auto&aspect=true" width="320px" height="240px" /></a>
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<div style="text-align: left!important;">
  <div class="jumbotron" style="margin-bottom: -5px;">
    <h3><?php echo $f_lista['Nombre']; ?></h3>      
    <p>El aerosol antitranspirante Old Spice brinda 48 hrs de protección poderosa contra el sudor y el mal olor.</p>
    <small>
° Protección poderosa contra el mal olor y la sudoración<br>
° 48 de protección poderosa<br>
° Protección poderosa con fragancias duraderas</small>
  </div>

</div>
<div class="alert alert-primary">
      <h4>20% de descuento</h4>

  <small style="text-decoration: line-through;">Antes <?php 

    $opera=$f_lista['Precio'] * 1.2;
    $n_precio2 = number_format($opera);

    echo $n_precio2;

     ?></small>
    <h5 class="text-success" style="margin-bottom: 5px;">$<?php  
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
    ?></h5>
</div>
<div style="text-align: center;">

    <iframe scrolling="no" frameborder="0" src="btn_comprar.php?bt=<?php echo $f_lista['Nombre']; ?>&user=<?php echo $user; ?>&valor=<?php echo  $f_lista['Precio']; ?>" style="border: 0px solid black; " width="140" height="76" id="iframemain" name="iframemain" src="/home">Su navegador no permite iframes</iframe>
</div>
        </div>
        <script type="text/javascript">
          $('.carousel').carousel({
  interval: 25000
})

        </script>
        <!-- Modal footer -->
       
        
      </div>
    </div>
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
            $resultados = mysqli_query($conn,"SELECT * FROM productos ORDER BY RAND()");
 
       
            $total_registros = mysqli_num_rows($resultados);
 
           
            $resultados = mysqli_query($conn,"SELECT * FROM productos ORDER BY RAND() LIMIT $inicio, $registros");
 
           
            $total_paginas = ceil($total_registros / $registros);
 
            if ($total_registros) {
              
                ?>
<div class="row_producto tz-gallery">
<?php 
  while ($f_lista = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
?>
                   <div class="col producto shadow " style=" text-align: center;">
 <a class="lightbox" data-toggle="modal" data-target="#myModal">
                    <img class="img_producto" src="<?php echo $f_lista['Imagen']; ?>" >
                </a>

  	 <div style=" height: 60px;">
    <h6 data-toggle="modal" data-target="#myModal" style="font-size: 14px;"><?php echo $f_lista['Nombre']; ?></h6>
    </div>
    <small style="text-decoration: line-through;">Antes <?php 

    $opera=$f_lista['Precio'] * 1.2;
    $n_precio2 = number_format($opera);

    echo $n_precio2;

     ?></small>
  	<p class="text-success" style="margin-bottom: 5px;">$<?php  
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
<!-- The Modal -->
  
  </div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title"><i class="fas fa-list"></i> Especificaciones</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
       <a href="<?php echo $f_lista['Imagen']; ?>" class="zoom"><img src="<?php echo $f_lista['Imagen']; ?>" width="320px" height="240px" /></a>
    </div>
    <div class="carousel-item">
      <a href="https://dqzrr9k4bjpzk.cloudfront.net/images/14129030/1079586225.jpg" class="zoom"><img src="https://dqzrr9k4bjpzk.cloudfront.net/images/14129030/1079586225.jpg" width="320px" height="240px" /></a>
    </div>
    <div class="carousel-item">
      <a href="https://exitocol.vtexassets.com/arquivos/ids/1204646-800-auto?width=800&height=auto&aspect=true" class="zoom"><img src="https://exitocol.vtexassets.com/arquivos/ids/1204646-800-auto?width=800&height=auto&aspect=true" width="320px" height="240px" /></a>
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<div style="text-align: left!important;">
  <div class="jumbotron" style="margin-bottom: -5px;">
    <h3><?php echo $f_lista['Nombre']; ?></h3>      
    <p>El aerosol antitranspirante Old Spice brinda 48 hrs de protección poderosa contra el sudor y el mal olor.</p>
    <small>
° Protección poderosa contra el mal olor y la sudoración<br>
° 48 de protección poderosa<br>
° Protección poderosa con fragancias duraderas</small>
  </div>

</div>
<div class="alert alert-primary">
      <h4>20% de descuento</h4>

  <small style="text-decoration: line-through;">Antes <?php 

    $opera=$f_lista['Precio'] * 1.2;
    $n_precio2 = number_format($opera);

    echo $n_precio2;

     ?></small>
    <h5 class="text-success" style="margin-bottom: 5px;">$<?php  
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
    ?></h5>
</div>
<div style="text-align: center;">

    <iframe scrolling="no" frameborder="0" src="btn_comprar.php?bt=<?php echo $f_lista['Nombre']; ?>&user=<?php echo $user; ?>&valor=<?php echo  $f_lista['Precio']; ?>" style="border: 0px solid black; " width="140" height="76" id="iframemain" name="iframemain" src="/home">Su navegador no permite iframes</iframe>
</div>
        </div>
        <script type="text/javascript">
          $('.carousel').carousel({
  interval: 25000
})

        </script>
        <!-- Modal footer -->
       
        
      </div>
    </div>
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
            $seis='6';
            for ($i = 1; $i <= $seis; $i++) {
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
  	<div style="text-align: center;">
  <img src="img/icon.png">
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>
</html>
<?php 
}
}else{
header('Location:iniciar_sesion.php');

}
?>