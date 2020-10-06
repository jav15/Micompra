<?php
    session_start();
    if(isset($_SESSION['Email'])){
              header('Location:comprar.php');
            }else{

            ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
        <title>Iniciar sesión - La Compra</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />
<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/metropolis" type="text/css"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">
   
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
     @import url('https://fonts.googleapis.com/css?family=Montserrat&display=swap');
            body{
       
    background:#007bff;
        }
        a{
         text-decoration:none !important;
         }
         h1,h2,h3{
         font-family: 'Montserrat', sans-serif;
         }
@font-face{
  font-family:RussoOne;
  src: url('fonts/RussoOne-Regular.ttf') format('truetype');
  }
         h4{
          font-family:'RussoOne';
         
         }
          .myform{
    position: relative;
    display: -ms-flexbox;
    display: flex;
    padding: 1rem;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 1.1rem;
    outline: 0;
    max-width: 500px;
    margin-right: auto;
    margin-left: auto;
     }
         .tx-tfm{
         text-transform:uppercase;
         }
         .mybtn{
         border-radius:50px;
         }
        
         .login-or {
         position: relative;
         color: #aaa;
         margin-top: 10px;
         margin-bottom: 10px;
         padding-top: 10px;
         padding-bottom: 10px;
         }
         .span-or {
         display: block;
         position: absolute;
         left: 50%;
         top: -2px;
         margin-left: -25px;
         background-color: #fff;
         width: 50px;
         text-align: center;
         }
         .hr-or {
         height: 1px;
         margin-top: 0px !important;
         margin-bottom: 0px !important;
         }
         .google {
         color:#666;
         width:100%;
         height:40px;
         text-align:center;
         outline:none;
         border: 1px solid lightgrey;
         }
          form .error {
         color: #ff0000;
         }
         #second{display:none;}    </style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
        });
    </script>
</head>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<body>

  <?php
if(isset($_POST['registrarmee'])){
  ?>
   <div class="alert alert-info small alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Info!</strong> Por favor registrate para poder continuar :D
  </div>
<?php
}
 if(isset ($_GET['variablereturn'])) {
            
?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
     Tu celular ya se encuentra <strong>registrado</strong>.<p>
      <a href="https://api.whatsapp.com/send?phone=573217187495&text=Quiero%20recuperar%20mi%20contrase%C3%B1a">¿Olvidaste tu contraseña?</a>
    </p>
  </div>

<?php
}
?>
  <?php
 if(isset ($_GET['variablereturn2'])) {
            
?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
     <strong>Datos incorrectos</strong>
       <a href="https://api.whatsapp.com/send?phone=573217187495&text=Quiero%20recuperar%20mi%20contrase%C3%B1a">¿Olvidaste tu contraseña?</a>
  </div>

<?php
}
?>

    <div class="container">
        <div class="row">
      <div class="" style="position: relative;  width: 100%">
      <div id="first">
        <div class="myform form ">
<div>
     </div>     
           <div class="logo mb-3">
             <div class="col-md-12 text-center">
                 <a href="index.php">
              <img src="img/lacompra.png" style="width:70px; height: 70px; "></a>
              <h4 style="color: #007bff; font-family: 'Roboto Slab', serif; "><a href="index.php">La Compra</a></h4>
             </div>
          </div>
                   <form action="save_registrarse.php" method="post" name="login">
                           <div class="form-group" style="margin-bottom: 4px;">

                              <label style="margin-bottom: 0px;">Número de celular</label>
                              <input type="number" name="celular" autocomplete="on"  class="form-control" value="
 <?php
 if(isset ($_GET['variablereturn2'])) {
  echo $_GET['variablereturn2'];
  }else{
echo"";
  }           
?>


                              " id="celular" aria-describedby="emailHelp">
                           </div>
                           <input type="hidden" value="Activo" name="activo">
                           
                           <div class="col-md-12 text-center ">
                              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Iniciar Sesión</button>
                           </div>
                           <div class="col-md-12 ">
                              <div class="login-or">
                                 <hr class="hr-or">
                                 <span class="span-or"></span>
                              </div>
                           </div>
                          
                           <div class="form-group">
                              <p class="text-center">¿No tienes cuenta? <br><strong class="text-primary">Solo ingresa con tu número celular</strong></p>
                           </div>
                        </form>
                 
        </div>
      </div>
        <div id="second">
            <div class="myform form ">
         <a href="#" id="signin"><i class="fas fa-chevron-left"></i> Atrás</a>

                        <div class="logo mb-3">
                           <div class="col-md-12 text-center">
                               <img src="img/lacompra.png" style="width:70px; height: 70px; "><br>
                             <h4 style="font-family: 'MetropolisRegular';">Crear cuenta</h4>
                           </div>
                        </div>
                        <form action="save_registrarse.php" name="registration" method="POST">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Nombre</label>
                              <input type="text"  name="nombre_idp" class="form-control" id="firstname" aria-describedby="emailHelp" >
                           </div>
                           <div class="form-group">
                              <label for="exampleInputEmail1">Apellido</label>
                              <input type="text"  name="apellido_idp" class="form-control" id="lastname" aria-describedby="emailHelp">
                           </div>
                           <div class="form-group">
                            <label for="exampleInputEmail1">Ciudad</label>
                            <select class="form-control" id="ciudad" name="ciudad" aria-describedby="emailHelp">
                              <option value=""></option>
                              <option>  Barranquilla  </option>
                              
                              <option>  Soledad </option>
                            </select>
                          </div>
                           <div class="form-group">
                              <label for="exampleInputEmail1">Celular</label>
                              <input type="number"  name="celular2" class="form-control" id="celular" aria-describedby="emailHelp">
                           </div>
                           <input type="hidden" value="Activo" name="activo2">

                           <div class="col-md-12 text-center mb-3">
                              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Registrarme</button>
                           </div>
                           <div class="col-md-12 ">
                              <div class="form-group">
                                 <p class="text-center"><a href="#" id="signin"><strong>¿Ya tienes una cuenta?</strong></a></p>
                              </div>
                           </div>
                            </div>
                        </form>
                     </div>
      </div>
    </div>
      </div>   <hr>
<script type="text/javascript">
  $("#signup").click(function() {
$("#first").fadeOut("fast", function() {
$("#second").fadeIn("fast");
});
});

$("#signin").click(function() {
$("#second").fadeOut("fast", function() {
$("#first").fadeIn("fast");
});
});


  
         $(function() {
           $("form[name='login']").validate({
             rules: {
               
               celular: {
                 required: true,
                minlength: 10,
                 maxlength:10
               },
               password: {
                 required: true,
                 
               }
             },
              messages: {
               celular:{
                required:"Por favor escribe tu # celular",
               minlength: "Tu # celular es muy corto",
               maxlength: "Tu # celular es muy largo"   },
               password: {
                 required: "Por favor escribe tu contraseña",
                
               }
               
             },
             submitHandler: function(form) {
               form.submit();
             }
           });
         });
         


$(function() {
  
  $("form[name='registration']").validate({
    rules: {
      nombre_idp: "required",
      apellido_idp: "required",
      ciudad:"required",
      celular2: {
        required: true,
        minlength: 10,
        maxlength:10
      },
      password_idp: {
        required: true,
        minlength: 5
      }
    },
    
    messages: {
      nombre_idp: "Por favor escribe tu nombre",
      apellido_idp: "Por favor escribe tus apellidos",
      ciudad:"Por favor escoge tu ciudad",
      celular2:  {
      required: "Por favor escribe tu # celular",
      minlength: "Tu # celular es muy corto",
      maxlength: "Tu # celular es muy largo"              
      },
      password_idp: {
        required: "Por favor escribe tu contraseña",
        minlength: "Tu contraseña es muy corta"
      },
    },
  
    submitHandler: function(form) {
      form.submit();
    }
  });
});
  </script>

</body>
</html>
<?php 
}
?>