<!DOCTYPE html>
<html>
<head>
	<title>Ingresar Producto</title>
<link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</head>
<body>
	<?php

if (isset($_GET['$success'])) { ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Exito!</strong> El producto fue registrado.
  </div>
<?php
}

	 ?>
<div style="width: 90%; max-width: 600px; margin-left: auto; margin-right: auto;">
<form action="procesos_productos.php" method="post"  enctype="multipart/form-data" name="inscripcion">
<h3>Ingresar Nuevo Producto</h3>
   <div class="form-group">
  <strong>Nombre</strong>
       <input type="text"  name="nombre" class="form-control" id="nombre" required>
</div>
   <div class="form-group">
   <strong>Precio</strong>
      <input type="text"  name="precio" class="form-control number" id="precio"  autocomplete="no" required>
</div>

   <strong>Categoria</strong>

<select name="categoria" required class="custom-select">
    <option value="">Custom Select Menu</option>
    <option value="Despensa">Despensa</option>
    <option value="Frutas y Verduras">Frutas y Verduras</option>
    <option value="Carne, Pollo, Pescado">Carne, Pollo, Pescado</option>
    <option value="Lácteos">Lácteos</option>

    <option value="Limpieza">Limpieza</option>
    <option value="A Granel">A Granel</option>
    <option value="Medicamentos">Medicamentos</option>
    <option value="Bebidas">Bebidas</option>
    

  </select>
   <strong>Imagen</strong>
<div class="custom-file">
	<input type="file"  name="archivo" accept="image/*" id="customFile" class="custom-file-input" required >
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
                        

                           <div style="margin-top: 30px;" class="col-md-12 text-center mb-3">
                              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Guardar producto</button>
                           </div>
                           </div>
                          </form>

</div>
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
</body>
</html>