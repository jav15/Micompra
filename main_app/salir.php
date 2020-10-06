<?php
session_start();

if(isset($_SESSION['Email'])){
		session_destroy();
        header('Location:../iniciar_sesion.php');
}
    if(isset($_SESSION['idp'])){
			session_destroy();
			header('Location:../iniciar_sesion_independiente.php');
    	}
?>