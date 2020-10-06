<?php
//GUARDAR NUEVA COMPRA
if (isset($_POST['compra'])) {
	$nombre2=$_POST['compra'];
	$user_cel=$_POST['user_cel'];
	$valor=$_POST['valor'];
	$cantidad=$_POST['cantidad'];
  	$verificar= strlen($valor); 

$valor_f=$cantidad * $valor;

$servername = "localhost";
$database = "lacompra";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
//VERIFICAR SI YA ESTA COMPRANDO
$comprobar="SELECT Estado,Codigo FROM compra_base WHERE Celular='$user_cel' AND Estado='Comprando' LIMIT 1";
$r_comprob = mysqli_query($conn, $comprobar);
$row_com = mysqli_num_rows($r_comprob);
switch ($row_com) {
	case '1':
  $f_comprobar = mysqli_fetch_array($r_comprob);
  $codigo_2=$f_comprobar['Codigo'];
		$sql2 = "INSERT INTO factura (Codigo, Nombre, Cantidad, Celular, Precio) VALUES ('$codigo_2','$nombre2', '$cantidad','$user_cel', '$valor_f')";
if (mysqli_query($conn, $sql2)) {
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<div style="text-align: center;">
<a href="mifactura.php" target="_parent"><button class="btn btn-sm btn-success" style="font-size: 12px!important;">Ver factura</button></a>
</div>
<?php
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//ACTUALIZAR VALOR 
$c_v="SELECT Valor FROM compra_base WHERE Estado='Comprando' LIMIT 1";
$r_v = mysqli_query($conn, $c_v);
 $f_v = mysqli_fetch_array($r_v);
 $valor_t=$f_v['Valor'] + $valor_f;
 $act="UPDATE compra_base SET Valor='$valor_t' WHERE Celular='$user_cel'";
 
if (mysqli_query($conn, $act)) {
}
mysqli_close($conn);
		break;
	
	default:
    $codigo="";
$max_chars = round(rand(15,19));  // tendrá entre 7 y 10 caracteres
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
    $direccion="No";
    $barrio="No";
		 $estado="Comprando";
$sql = "INSERT INTO compra_base (Celular, Estado,Direccion, Barrio, Codigo, Valor, Fecha) VALUES ('$user_cel', '$estado','$direccion','$barrio','$codigo', '$valor_f', now())";
$sql2 = "INSERT INTO factura (Codigo, Nombre, Cantidad, Celular, Precio) VALUES ('$codigo','$nombre2', '$cantidad','$user_cel', '$valor_f')";
if (mysqli_query($conn, $sql2)) {
}
 
if (mysqli_query($conn, $sql)) {
	?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <div style="text-align: center;">
<a href="mifactura.php" target="_parent"><button class="btn btn-sm btn-success" style="font-size: 12px!important;">Ver factura</button></a>
</div>

<?php
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
		break;
}


}


//INGRESAR NUEVO PRODUCTO
//INGRESAR NUEVO PRODUCTO
//INGRESAR NUEVO PRODUCTO
 if (isset($_POST['nombre'])) {
            $nombre=$_POST['nombre'];
            $precio=$_POST['precio'];
            $categoria=$_POST['categoria'];

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

$servername = "localhost";
$database = "lacompra";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 $estado="Disponible";

$sql = "INSERT INTO productos (Nombre, Categoria, Estado, Precio, Fecha_ingreso, Imagen) VALUES ('$nombre', '$categoria','$estado', '$precio', now(), '$destino')";
 
if (mysqli_query($conn, $sql)) {
     
      header('Location: ingresar_producto.php?$success');

} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);



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



//ELIMIAR PRODUCTO DE FACTURA
//ELIMIAR PRODUCTO DE FACTURA
//ELIMIAR PRODUCTO DE FACTURA


if (isset($_POST['eliminar'])) {
  $producto=$_POST['eliminar'];
  $user=$_POST['eliminar_user'];
  $cantidad=$_POST['cantidad_elim'];
  include('main_app/conexion.php');

  $borrar=mysqli_query($mysqli, "DELETE FROM factura WHERE Nombre ='$producto' AND Cantidad ='$cantidad' AND Celular='$user'");

  if ($borrar) {
    header('Location:mifactura.php');
}else{
  echo "no borrado";
}
}





?>