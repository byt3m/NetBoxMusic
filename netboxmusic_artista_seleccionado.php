<?php
/**********************************************************************************
Nombre del fichero: netboxmusic_artista_seleccionado.php
Descripción: muestra las canciones de un determinado artista.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'netboxmusic_control.php';
include_once 'config.php';

//Recogemos el ID del artista al que se desea acceder.
$IdArtista = $_SESSION["IdArtista"];

//Realizamos la consulta a la BDD.
$sqlArtista = "SELECT c.id, c.titulo, a.nombre, a.rutaimagen 
				From canciones c join artistas a on c.idartista=a.id 
				where a.id=".$IdArtista." order by c.titulo DESC";
$resultadoArtista = mysqli_query($conn, $sqlArtista);
	
//Mostramos los resultados (si los hay).
if (mysqli_num_rows($resultadoArtista) > 0) {
	mysqli_data_seek($resultadoArtista, 0);
	$i=0;
	while($fila = mysqli_fetch_assoc($resultadoArtista)) {
		if($i==0) echo '<h1 style="font-size: 20px; margin-top: 60px;">'.$fila["nombre"].'</h1>';
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

