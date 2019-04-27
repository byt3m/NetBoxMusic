<?php
/************************************************************************************
Nombre del fichero: adm_portada.php
Descripción: portada del servicio administración, muestra las canciones más 
  escuchadas de la semana con detalles.
*************************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
?>

<!-- Título -->
<h1 style="font-size: 25px; margin-top: 95px;"> Contador/Canciones m&aacute;s escuchadas </h1>

<?php
//Creamos la sentencia SQL para mostrar las canciones más escuchadas de esta semana.
$sqlCanciones = "SELECT c.contador_semanal, c.contador_total, c.id, c.titulo, a.nombre, a.rutaimagen, g.nombre as 'nombregenero'
					From canciones c join artistas a on c.idartista=a.id 
					join generos g  on g.id=a.idgenero 
					order by c.contador_semanal DESC;";
$resultadoCanciones = mysqli_query($conn, $sqlCanciones);
	
if (mysqli_num_rows($resultadoCanciones) > 0) {
	mysqli_data_seek($resultadoCanciones, 0);
	while($fila = mysqli_fetch_assoc($resultadoCanciones)) {
		echo '
			<div id="cancion'.$fila["id"].'" 
			class="info" 
			style="display: inline-block; margin: 10px; border-radius: 20px; cursor: default;"
			title="'.$fila["contador_semanal"].' reproducciones esta semana - '.$fila["contador_total"].' reproducciones totales.">
				<img src="../music/artist/'.$fila["rutaimagen"].'" alt="'.$fila["nombre"].'" width="220px" height="150px" />
					<p style="width:220px;">T&iacute;tulo: '.$fila["titulo"].' </p>
					<p style="width:220px;">Artista: '.$fila["nombre"].'</p>
					<p style="width:220px;">G&eacute;nero: '.$fila["nombregenero"].'</p>
			</div>

			';
	}
}
?>


	