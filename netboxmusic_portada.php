<?php
/************************************************************************************
Nombre del fichero: netboxmusic_portada.php
Descripción: portada del servicio, muestra las canciones mas escuchadas de la semana.
  en la cabecera de la aplicación web.
*************************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'netboxmusic_control.php';
include_once 'config.php';
?>

<!-- Título -->
<h1 style="font-size: 25px; margin-top: 60px;"> Canciones m&aacute;s escuchadas esta semana</h1>

<?php
//Creamos la sentencia SQL para mostrar las canciones más escuchadas de esta semana.
$sqlCanciones = "SELECT c.contador_semanal, c.id, c.titulo, a.nombre, a.rutaimagen 
					From canciones c join artistas a on c.idartista=a.id order by c.contador_semanal DESC;";
$resultadoCanciones = mysqli_query($conn, $sqlCanciones);
	
if (mysqli_num_rows($resultadoCanciones) > 0) {
	mysqli_data_seek($resultadoCanciones, 0);
	while($fila = mysqli_fetch_assoc($resultadoCanciones)) {
		echo '
			<div id="cancion'.$fila["id"].'" onclick="reproducir'.$fila["id"].'();" style="display: inline-block; margin: 10px; border-radius: 20px; cursor: pointer;">
				<img src="music/artist/'.$fila["rutaimagen"].'" alt="'.$fila["titulo"].'" width="220px" height="150px" />
				<p style="width:220px;">'.$fila["titulo"].' </p>
				<p style="width:220px; font-weight: bold;">'.$fila["nombre"].'</p>
			</div>
			';
	}
}
?>


	