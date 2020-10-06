<?php 
    session_start();
    if(isset($_SESSION['Email'])){
//EDITAR PRECIO O NOMBRE DE PRODUCTO
if (isset($_POST['edit_pro'])) {
	$edit_pro=$_POST['edit_pro'];
	$new_name=$_POST['new_name'];
	$new_valor=$_POST['new_valor'];
 include 'main_app/conexion.php';
 $actualizar="UPDATE productos SET Nombre='$new_name', Precio='$new_valor'  WHERE Nombre='$edit_pro'";

if (mysqli_query($mysqli, $actualizar)) {
header("Location:edit_product.php?editado&nombreproducto=".urlencode($edit_pro));
}else{
	echo "Ocurrio un error,no se pudo actualizar";
}
}// FIN EDITAR PRECIO O NOMBRE DE PRODUCTO



if (isset($_POST['edit_pro_img'])) {

	$edit_pro_img=$_POST['edit_pro_img'];
$carpetaDestino="img/productos/";
 
$codigo="";
$max_chars = round(rand(15,18));  // tendrá entre 7 y 10 caracteres
$chars = array();
for ($i="a"; $i<"z"; $i++) $chars[] = $i; 
$chars[] = "z";
for ($i=0; $i<$max_chars; $i++) {
  $letra = round(rand(0, 1)); 
  if ($letra) // es letra
    $codigo .= $chars[round(rand(0, count($chars)-1))];
  else // es numero
    $codigo .= round(rand(0, 9));
}
     if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"][0])
    {
 
        # recorremos todos los arhivos que se han subido
     
 
            # si es un formato de imagen
            if($_FILES["archivo"]["type"]=="image/jpeg" || $_FILES["archivo"]["type"]=="image/pjpeg" || $_FILES["archivo"]["type"]=="image/gif" || $_FILES["archivo"]["type"]=="image/png")
            {
 
                # si existe la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {
                    $origen=$_FILES["archivo"]["tmp_name"];
                    $destino=$carpetaDestino.$codigo.$_FILES["archivo"]["name"];


  include 'main_app/conexion.php';
 $actualizar_img="UPDATE productos SET Imagen='$destino' WHERE Nombre='$edit_pro_img'";
if (mysqli_query($mysqli, $actualizar_img)) {
header("Location:edit_product.php?editado&nombreproducto=".urlencode($edit_pro_img));
}else{

	echo "Ocurrio un error,no se podido pedir";
}
                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {
                        echo "<br>".$_FILES["archivo"]["name"]." movido correctamente";
                    }else{
                        echo "<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"];
                    }
                }else{
                    echo "<br>No se ha podido crear la carpeta: ".$carpetaDestino;
                }
            }else{
                echo "<br>".$_FILES["archivo"]["name"]." - NO es imagen jpg, png o gif";
            }

}

}



//ELIMINAR PRODUCTO
if (isset($_POST['edit_pro_del'])) {
  $edit_pro_del=$_POST['edit_pro_del'];
  include('main_app/conexion.php');
  $borrar=mysqli_query($mysqli, "DELETE FROM productos WHERE Nombre ='$edit_pro_del'");

  if ($borrar) {
    header("Location:edit_product.php?delete");
}else{
  echo "Error, no borrado";
}
}



}else{
header('Location:iniciar_sesion.php');
}
?>
?>