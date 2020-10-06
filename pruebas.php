<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
	<meta name="viewport" content="width=device-width, initial-scale=1">

<body>




<?php
$contraseña="javier";
$pass= password_hash($contraseña, PASSWORD_DEFAULT);
echo $pass;
//Incluimos la conexión a la base de datos.
$DBHOST = 'localhost';
$DBUSER = 'root';
$DBPASS = '';
$DBNAME = 'lacompra';
 
//Conectar al Servidor
$conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);
 
//Verificarndo Conexion
if (mysqli_connect_errno()) {
    exit('Fallo Conexion: '. mysqli_connect_error());
}
 
//$registros nos entrega la cantidad de registros a mostrar.
$registros = 10;
 
//$contador como su nombre lo indica el contador.
$contador = 1;
 
/**
 * Se inicia la paginación, si el valor de $pagina es 0 le asigna el valor 1 e $inicio entra con valor 0.
 * si no es la pagina 1 entonces $inicio sera igual al numero de pagina menos 1 multiplicado por la cantidad de registro
 */
if (isset($_GET['pagina'])) {
    $pagina=$_GET['pagina'];
    $inicio = ($pagina - 1) * $registros;
} else {
$inicio = 0;
    $pagina = 1;
}
?>
    <!-- Se crea la tabla que mostrara los datos tabulados -->
    <table>
        <caption>Registros</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Pais</th>
                <th>Continente</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /**
             * Se inicia la consulta donde seleccionamos todos los campos de la tabla personas, pero donde isActive = 1, esto lo hacemos para el manejo
             * de registros si estan activos o no.
             */
            $resultados = mysqli_query($conn,"SELECT * FROM productos");
 
            //Contamos la cantidad de filas entregadas por la consulta, de esta forma sabemos cuantos registros fueron retornados por la consulta.
            $total_registros = mysqli_num_rows($resultados);
 
            //Generamos otra consulta la cual creara en si la paginacion, ordenando y crendo un limite en las consultas.
            $resultados = mysqli_query($conn,"SELECT * FROM productos ORDER BY id ASC LIMIT $inicio, $registros");
 
            //Con ceil redondearemos el resultado total de las paginas 4.53213 = 5
            $total_paginas = ceil($total_registros / $registros);
 
            // Si tenemos un retorno en la varibale $total_registro iniciamos el ciclo para mostrar los datos.
            if ($total_registros) {
                while ($personas = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
                ?>
                    <!-- Muestra de Datos usando el comodin <?=$variable; ?> es lo mismo que <?php echo $variable; ?> -->
                    <tr>
                        <td><?=$contador;?></td>
                        <td><?=$personas["Nombre"];?></td>
                        <td><?=$personas["Categoria"];?></td>
                        <td><?=$personas["Precio"];?></td>
                        <td><?=$personas["Nombre"];?></td>
                    </tr>
 
                    <?php
                    /**
                     * La variable $contador es la misma que iniciamos arriba con valor 1, en cada ciclo sumara 1 a este valor.
                     * $contador sirve para mostrar cuantos registros tenemos, es mas que nada una guia.
                     */
                   $contador++;
                }
             } else {
              echo "<font color='darkgray'>(sin resultados)</font>";
            }
 
            mysqli_free_result($resultados);
            ?>
        </tbody>
    </table>
 
    <div>
        <?php
        if ($total_registros) {
            /**
             * Aca activamos o desactivamos la opción "< Anterior", si estamos en la pagina 1 nos dará como resultado 0 por ende NO
             * activaremos el primer if y pasaremos al else en donde se desactiva la opción anterior. Pero si el resultado es mayor
             * a 0 se activara el href del link para poder retroceder.
             */
            if (($pagina - 1) > 0) {
                echo "<a href='pruebas.php?pagina=".($pagina-1)."'>< Anterior</a>";
            } else {
                echo "<a href='#'>< Anterior</a>";
            }
 
            // Generamos el ciclo para mostrar la cantidad de paginas que tenemos.
            for ($i = 1; $i <= $total_paginas; $i++) {
                if ($pagina == $i) {
                    echo "<a href='#'>". $pagina ."</a>";
                } else {
                    echo "<a href='pruebas.php?pagina=$i'>$i</a> ";
                }
            }
 
            /**
             * Igual que la opcion primera de "< Anterior", pero aca para la opcion "Siguiente >", si estamos en la ultima pagina no podremos
             * utilizar esta opcion.
             */
            if (($pagina + 1)<=$total_paginas) {
                echo "<a href='pruebas.php?pagina=".($pagina+1)."'>Siguiente ></a>";
            } else {
                echo "<a href='#'>Siguiente ></a>";
            }
        }
        ?>
    </div>
 
    <?php
        // Cerramos conexion con MYSQLI.
        mysqli_close($conn);
    ?>
</body>
</html>