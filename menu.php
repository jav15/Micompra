<nav class="navbar navbar-expand-md bg-primary fixed-top " style="padding: 1px 10px; ">
  <!-- Brand -->
 <a class="navbar-brand" href="comprar.php">
    <img src="img/lacompra.png" alt="Lacompra" style="width:40px; height: 40px;"> <span style="font-family: 'Roboto Slab', serif; color: #fff;  ">La Compra</span>
  </a>
  <a class="link_factura" href="mifactura.php">Factura</a>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <i class="fas fa-lg fa-bars"></i>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse"  id="collapsibleNavbar">
    <ul class="navbar-nav" >
        <li class="nav-item">
   <?php
            switch ($celphone) {
	case '3217187495':
	?>
	<a class="nav-link text-white" href="panel_administrador.php"><i class="far fa-user"></i> <?php echo $Name." ".$Lastname;?></a>
	<?php
		break;
	
	default:
	?>
	<a class="nav-link text-white" href="#"><i class="far fa-user"></i> <?php echo $Name." ".$Lastname;?></a>
	<?php
		break;
}
 ?>           
            
        
      </li>
       <li class="nav-item">
        <a class="nav-link text-white" href="comprar.php"><i class="fas fa-store"></i> Comprar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="mifactura.php"><i class="fas fa-list"></i> Factura</a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link text-white"  href="main_app/salir.php"><i class="fas fa-power-off"></i> Cerrar Sesión</a>
      </li>
    </ul>
  </div>
</nav>