<?php 
if (isset($_POST['celular'])) {
 
require('main_app/conexion.php');
  
  session_start();
  $mysqli->set_charset('utf8');
  $Email = $mysqli->real_escape_string($_POST['celular']);
  $pas = $mysqli->real_escape_string($_POST['activo']);
 
  
   if($idp_consulta = $mysqli->prepare("SELECT * From usuarios Where Celular = ? AND Password = ?"))
   {
    $idp_consulta->bind_param('ss',$Email,$pas);
    $idp_consulta->execute();
    $resultado_idp = $idp_consulta->get_result();
    if($resultado_idp->num_rows == 1){
        $datos_idp = $resultado_idp->fetch_assoc();
        $_SESSION['Email'] = $datos_idp;
        
       header('Location:comprar.php');

    }else{
        
$servername = "localhost";
$database = "lacompra";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
  
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());}
    $celular=$Email;
    $nombre_idp="Usuario";
    $apellido_idp="invitado";
    $ciudad_idp="No establecida";
    $password_idp="Activo";
        $codigov="1234";
        $foto="Sin foto";
if ($resultado = $conn->query("SELECT * FROM usuarios WHERE Celular='$celular' ")) {
    $row_cnt = $resultado->num_rows;
    if ($row_cnt=='0') {
      
$sql = "INSERT INTO usuarios (Nombre,Apellido,Celular,codigo_verificacion,codigo_verificacion2,Password,Ciudad,Fecha) VALUES ('$nombre_idp', '$apellido_idp', '$celular','$codigov','0', '$password_idp', '$ciudad_idp', now())";
if (mysqli_query($conn, $sql)) {
  session_start();
  $conn->set_charset('utf8');
  $Email = $conn->real_escape_string($celular);
  $pas = $conn->real_escape_string($password_idp);
 
  
   if($idp_consulta = $conn->prepare("SELECT * From usuarios Where Celular = ? AND Password = ?"))
   {
    $idp_consulta->bind_param('ss',$Email,$pas);
    $idp_consulta->execute();
    $resultado_idp = $idp_consulta->get_result();
    if($resultado_idp->num_rows == 1){
        $datos_idp = $resultado_idp->fetch_assoc();
        $_SESSION['Email'] = $datos_idp;
        
       header('Location:comprar.php');

    }else{
      echo json_encode(array('error' => true));
    }
    $idp_consulta->close();

  }      
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
 

        


    }else{
      $variablereturn=$_POST['celular2'];
      header('location: iniciar_sesion.php?variablereturn='.urlencode($variablereturn));
    
}
    /* cerrar el resultset */
    $resultado->close();
}

    }
    $idp_consulta->close();

  }
}


//REGISTRO INDEPENDIENTE

elseif (isset ($_POST['celular2'])){
       
$servername = "localhost";
$database = "lacompra";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
  
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());}
		$celular=$_POST['celular2'];
		$nombre_idp=$_POST['nombre_idp'];
		$apellido_idp=$_POST['apellido_idp'];
		$ciudad_idp=$_POST['ciudad'];
		$password_idp=$_POST['activo2'];
        
        $foto="Sin foto";
if ($resultado = $conn->query("SELECT * FROM usuarios WHERE Celular='$celular' ")) {
    $row_cnt = $resultado->num_rows;
    if ($row_cnt=='0') {
      
$sql = "INSERT INTO usuarios (Nombre,Apellido,Celular,Password,Ciudad,Fecha) VALUES ('$nombre_idp', '$apellido_idp', '$celular', '$password_idp', '$ciudad_idp', now())";
if (mysqli_query($conn, $sql)) {
  session_start();
  $conn->set_charset('utf8');
  $Email = $conn->real_escape_string($celular);
  $pas = $conn->real_escape_string($password_idp);
 
  
   if($idp_consulta = $conn->prepare("SELECT * From usuarios Where Celular = ? AND Password = ?"))
   {
    $idp_consulta->bind_param('ss',$Email,$pas);
    $idp_consulta->execute();
    $resultado_idp = $idp_consulta->get_result();
    if($resultado_idp->num_rows == 1){
        $datos_idp = $resultado_idp->fetch_assoc();
        $_SESSION['Email'] = $datos_idp;
        
       header('Location:comprar.php');

    }else{
      echo json_encode(array('error' => true));
    }
    $idp_consulta->close();

  }      
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
 

        


    }else{
      $variablereturn=$_POST['celular2'];
      header('location: iniciar_sesion.php?variablereturn='.urlencode($variablereturn));
    
}
    /* cerrar el resultset */
    $resultado->close();
}

}else{
              header('Location:comprar.php');

}
 ?>

