<?php
    session_start();
    if(isset($_SESSION['Email'])){
             $user=$_SESSION['Email']['Celular'];
             $Name=$_SESSION['Email']['Nombre'];
             $Lastname=$_SESSION['Email']['Apellido'];
             $celphone=$_SESSION['Email']['Celular'];
             ?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
if (isset($_GET['mes'])) { 
$mes=$_GET['mes'];
    ?>
      <script type="text/javascript">
            window.onload = function () {
                var dataLength = 0;
                var data = [];
                $.getJSON("data.php?mes=<?php echo $mes; ?>", function (result) {
                    dataLength = result.length;
                    for (var i = 0; i < dataLength; i++) {
                        data.push({
                            x: parseInt(result[i].valorx),
                            y: parseInt(result[i].valory)
                        });
                    }
                    ;
                    chart.render();
                });
                var chart = new CanvasJS.Chart("chart", {
                    title: {
                        text: "Compras diarias"
                    },
                    axisX: {
                        title: "Día",
                    },
                    axisY: {
                        title: "Venta",
                    },
                    data: [{type: "line", dataPoints: data}],
                });
            }
        </script>
        <script type="text/javascript" src="assets/script/canvasjs.min.js"></script>
        <script type="text/javascript" src="assets/script/jquery-2.2.3.min.js"></script>
    </head>
    <body>
        <div id="chart">
        </div>
    </body>

<?php
}else{
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">

    </head>

 <body style="padding-top: 70px;">
    <?php 
    include('menu.php');
    ?>
    <h4>Estadísticas tienda</h4>
    <div class="form-group">
    <label for="email">Seleccionar mes:</label>
    <form method="GET" action="estadisticas.php">
  <select name="mes" class="custom-select">
    <option value="01">Enero</option>
    <option value="02">Febrero</option>
    <option value="03">Marzo</option>
    <option value="04">Abril</option>
    <option value="05">Mayo</option>
    <option value="06">Junio</option>
    <option value="07">Julio</option>
    <option value="08">Agosto</option>
    <option value="09">Septiembre</option>
    <option value="10">Octubre</option>
    <option value="11">Noviembre</option>
    <option value="12">Diciembre</option>
  </select><hr>
    <button class="btn btn-block btn-success btn-sm ">Consultar</button>

</form>
  </div>
    

 </body>     
      <?php 
}
      ?>
</html>
<?php 
}else{
header('Location:iniciar_sesion.php');

}
?>