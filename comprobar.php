<?php
    session_start();
    if(isset($_SESSION['Email'])){
        if($_SESSION['Email']['codigo_verificacion2'] == "0"){ 
             $user=$_SESSION['Email']['Celular'];

        	?>
<!DOCTYPE html>
<html>
<head>
	<title>Verificar número celular</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/styles.css">
<style type="text/css">

	body{

margin-top: 70px;



	}



</style>
</head>
<body class="bg-gradient-primary-to-secondary">
<nav class="navbar navbar-expand-sm bg-primary fixed-top" style="padding: 1px 10px;">

<a class="navbar-brand" href="#">

    <img src="img/lacompra.png" alt="Lacompra" style="width:40px; height: 40px;"> <span style="font-family: 'Roboto Slab', serif; color: #fff;   ">La Compra</span>

  </a>

  <a href="main_app/salir.php">

<button style="border-color: #fff; background-color: #fff; color:#007bff; font-weight: 600;" class="btn btn-sm btn-primary">Cerrar sesión</button></a>

</nav>
<?php 
if (isset($_GET['nocodigo'])) { ?>

<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡Error!</strong> El código ingresado es incorrecto.
  </div>

<?php 
}

 ?>

<div class="container">
  <div class="jumbotron" style="background-color: #fff;">
  	<div class="logo mb-3">
             <div class="col-md-12 text-center">
                 <a href="index.php">
              <img src="img/lacompra.png" style="width:70px; height: 70px; "></a>
              <h4 style="color: #007bff; font-family: 'Roboto Slab', serif; "><a href="index.php">La Compra</a></h4>
            <hr>
    <h4>Confirmar celular</h4>      
    <small>Se ha enviado código de seguridad,<br> <strong>Por favor revisar tu buzon de mensajes.</strong> </small>
<form action="comprobar2.php" method="POST">
  <div class="form-group">
    <label for="codigo">Código de seguridad</label>
    <input type="hidden" name="celular" value="<?php echo $user; ?>">
    <input type="codigo" name="codigo" class="form-control" placeholder="Escribir código" required id="codigo">

</div>
<button class="btn btn-primary btn-block btn-sm">Confirmar</button></form>

     </div>
          </div>
  </div>
      
</div>
</body>
</html>
<?php 
}
}else{
header('Location:iniciar_sesion.php');

}
?>