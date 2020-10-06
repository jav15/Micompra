<?php
session_start();
if(isset($_SESSION['usuario'])){
  if($_SESSION['usuario']['rol'] != "2" ){
header("Location: ../Admin/");

  }
}else{
  header('Location: ../../');
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ESTUDIANTE</title>
  </head>
  <body>
    <h1>Welome ESTUDIANTE <?php echo $_SESSION['usuario']['Nombre']   ?></h1>
    <label class="checkbox-inline">
      <input type="checkbox" id="inlineCheckbox1" value="option1"> 1
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" id="inlineCheckbox2" value="option2"> 2
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" id="inlineCheckbox3" value="option3"> 3
    </label>
    <a href="../salir.php">Cerrar Sesión</a>
  </body>
</html>
