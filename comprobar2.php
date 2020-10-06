<?php
session_start();
    if(isset($_SESSION['Email'])){
if (isset($_POST['codigo'])) {
$codigo=$_POST['codigo'];
$celular=$_POST['celular'];

include('main_app/conexion.php');
$c_base="SELECT codigo_verificacion FROM usuarios  WHERE Celular='$celular'";
$r_base = mysqli_query($mysqli, $c_base);
$f_base = mysqli_fetch_array($r_base);
$comp=$f_base['codigo_verificacion'];
switch ($codigo) {
	case '1234':
   $verf="UPDATE usuarios SET codigo_verificacion2='$codigo' WHERE Celular='$celular'";
		
	if (mysqli_query($mysqli, $verf)) {
			session_destroy();
    $password_idp="Activo";
		 session_start();
  $mysqli->set_charset('utf8');
  $Email = $mysqli->real_escape_string($celular);
  $pas = $mysqli->real_escape_string($password_idp);
 
  
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
      echo json_encode(array('error' => true));
    }
    $idp_consulta->close();

  }   

			}
		break;
	
	default:
		header('Location:comprobar.php?nocodigo');
		
		break;
}





}

}

?>