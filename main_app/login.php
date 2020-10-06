<?php

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
  require('conexion.php');
  sleep(2);
  session_start();
  $mysqli->set_charset('utf8');
  $Email = $mysqli->real_escape_string($_POST['usuariolg']);
 
  
   if($nueva_consulta = $mysqli->prepare("SELECT * From usuarios Where Email = ?"))
   {
    $nueva_consulta->bind_param('ss',$Email);
    $nueva_consulta->execute();
    $resultado = $nueva_consulta->get_result();
    if($resultado->num_rows == 1){
        $datos = $resultado->fetch_assoc();
        $_SESSION['Email'] = $datos;
        
        echo json_encode(array('error' => false,'tipo' => $datos['rol']));
    }else{
      echo json_encode(array('error' => true));
    }
    $nueva_consulta->close();

  }
}


$mysqli->close();
 ?>
