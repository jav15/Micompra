<?php
session_start();
if(isset($_SESSION['usuario'])){
  if($_SESSION['usuario']['rol'] != "1" ){
header("Location: ../Estudiante/");

  }
}else{
  header('Location: ../../');
}
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
<h1>Welcome <?php echo $_SESSION['usuario']['Nombre']   ?>
</h1>
     <a href="../salir.php">Cerrar Sesión</a>
   </body>
 </html>
