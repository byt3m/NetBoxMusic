<?php
/**********************************************************************************
Nombre del fichero: netboxmusic_genero_seleccionado.php
Descripción: muestra las canciones de un determinado género.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'netboxmusic_control.php';
include_once 'config.php';

//Recogemos el ID del género al que se desea acceder.
$IdGenero = $_SESSION["IdGenero"];

//Realizamos la consulta a la BDD.
$sqlGenero = "SELECT c.id, c.titulo, a.nombre, a.rutaimagen, g.nombre as 'nombregenero'
				From canciones c join artistas a on c.idartista=a.id 
				join generos g on a.idgenero=g.id 
				where g.id=".$IdGenero." order by c.titulo DESC";
$resultadoGenero = mysqli_query($conn, $sqlGenero);
	
//Mostramos los resultados (si los hay).
if (mysqli_num_rows($resultadoGenero) > 0) {
	mysqli_data_seek($resultadoGenero, 0);
	$i=0;
	while($fila = mysqli_fetch_assoc($resultadoGenero)) {
		if ($i==0) echo '<h1 style="font-size: 20px; margin-top: 60px;">'.$fila["nombregenero"].'</h1>';
		$i++;
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