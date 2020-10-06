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
	<title>Editar producto</title>
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
    .div_edit{ width: 90%;
padding: 10px; max-width: 600px; margin-left: auto; margin-right: auto; margin-bottom: 5px; background-color: #fff; border-radius: 5px;

    }
</style>
</head>
<body class="bg-gradient-primary-to-secondary">
<?php  
include('menu.php');
?>


 <form method="GET" action="edit_product.php" >
<div class="input-group mb-3"  style="padding: 0px 10px;">
<?php 
if (isset($_GET['nombreproducto'])) {
$nomb2=$_GET['nombreproducto'];
?>
  <input type="text" class="form-control" placeholder="Buscar" name="nombreproducto" value="<?php echo $nomb2; ?>">
  <?php 
}else{
  ?>
  <input type="text" class="form-control" placeholder="Buscar" name="nombreproducto">
  <?php 

}
  ?>
  <div class="input-group-append">
    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
  </div>
</div>
</form>
<?php 
if (isset($_GET['delete'])) {
	?>
	
<div class="content alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Eliminado</strong> El producto fue eliminado con exito.
  </div>
	<?php 
}

if (isset($_GET['editado'])) {
	?>
	<div class=" content alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Producto actualizado</strong> con exito.
  </div>
	
<?php 
}
 ?>
<h3>Editar producto</h3>
<?php 

if (isset($_GET['nombreproducto'])) {
	include('main_app/conexion.php');
$nomb=$_GET['nombreproducto'];
$caracteres=strlen($nomb);
if ($nomb=="" OR $caracteres < 3) {
	echo "Escribir nombre de producto";
}else{
$lista="SELECT Nombre,Precio,Imagen FROM productos WHERE Nombre like '%$nomb%' ORDER BY Precio ASC ";
$r_lista = mysqli_query($mysqli, $lista);
//INICIO WHILE EDITAR
while ( $f_lista = mysqli_fetch_array($r_lista)) { 
	?>
<div class="div_edit">
	 <form method="POST" action="edit_process.php" onsubmit="return confirmationc()" >
  <div class="form-group">
  <strong>Nombre</strong>
       <input required class="form-control" type="text" name="new_name" value="<?php echo $f_lista['Nombre'];  ?>">
</div>
   <div class="form-group">
   <strong>Precio</strong>
     <input required class="form-control" type="text" name="new_valor" value="<?php echo $f_lista['Precio'];  ?>">
</div>
	<input type="hidden" value="<?php echo $f_lista['Nombre'];  ?>" name="edit_pro">
<button type="submit" class="btn-primary btn btn-block btn-sm"><i class="fas fa-save"></i> Guardar</button>

</form><hr>
<div class="text-center">
<img width="100px" height="100px" class="img-fluid" src="<?php echo $f_lista['Imagen']; ?>"></div><br>
<form method="POST" action="edit_process.php" enctype="multipart/form-data"  onsubmit="return confirmationimg()">
  <div class="custom-file" style="margin-bottom: 5px;">
  		<input type="hidden" value="<?php echo $f_lista['Nombre'];  ?>" name="edit_pro_img">
    <input type="file" required  name="archivo" accept="image/*" id="customFile"  class="custom-file-input">
    <label class="custom-file-label" for="customFile">Seleccionar</label>
  </div>
  <button class="btn btn-success btn-block btn-sm">Actualizar Imagen</button>
</form>
<hr>
<form method="POST" action="edit_process.php"  onsubmit="return confirmationd()">
	<input type="hidden" name="edit_pro_del" value="<?php echo $f_lista['Nombre'];  ?>">
<button class="btn btn-sm btn-danger btn-block">Eliminar este producto</button>
</form>

</div>
<div style="text-align: center;">
  <img src="img/icon.png">
</div>
<?php 
}//FIN WHILE EDITAR
?>
<script type="text/javascript">
     function confirmationc() 
     {
        if(confirm("¿Confirmar que desea actualizar producto?"))
  {
     return true;
  }
  else
  {
     return false;
  }
     }
 function confirmationd() 
     {
        if(confirm("¿Confirmar que desea elminar producto?"))
  {
     return true;
  }
  else
  {
     return false;
  }
     }
     function confirmationimg() 
     {
        if(confirm("¿Actualizar imagen de este producto?"))
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
	}
}
?>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<script type="text/javascript">
      $(window).load(function(){

 $(function() {
  $('#file-input').change(function(e) {
      addImage(e); 
     });

     function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;
    
      if (!file.type.match(imageType))
       return;
  
      var reader = new FileReader();
      reader.onload = fileOnload;
      reader.readAsDataURL(file);
     }
  
     function fileOnload(e) {
      var result=e.target.result;
      $('#imgSalida').attr("src","img/check.png");
     }
    });
  });

    </script>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".content").fadeOut(1500);
    },500);
 
    setTimeout(function() {
        $(".content2").fadeIn(1500);
    },6000);
});
</script>

</body>
</html>
<?php 
}else{
header('Location:iniciar_sesion.php');

}
?>