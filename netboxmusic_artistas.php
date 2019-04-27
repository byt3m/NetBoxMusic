<?php
/**********************************************************************************
Nombre del fichero: netboxmusic_artistas.php
Descripción: muestra los artistas recogidos en la base de datos MySQL.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la conexión con la BDD.
include_once 'netboxmusic_control.php'; 
include_once 'config.php';
?>

<!-- Título -->
<h1 style="font-size: 25px; margin-top: 60px;"> Artistas</h1>

<?php
//Creamos la consulta SQL.
$sqlArtistas = "select id, rutaimagen, nombre from artistas order by nombre";
$resultadoArtistas = mysqli_query($conn, $sqlArtistas);
/*Recorremos los resultados obtenidos (si los hay) y 
mostramos dichos resultados, cada uno en un div distinto*/
if (mysqli_num_rows($resultadoArtistas) > 0) {
	mysqli_data_seek($resultadoArtistas, 0);
	while($fila = mysqli_fetch_assoc($resultadoArtistas)) {
		echo '
			<div id="a'.$fila["id"].'" onclick="seleccionar('.$fila["id"].');" style="display: inline-block; margin: 10px; border-radius: 20px; cursor: pointer;">
				<img src="music/artist/'.$fila["rutaimagen"].'" alt="'.$fila["nombre"].'" width="220px" height="150px"/>
				<p>'.$fila["nombre"].' </p>
			</div>
			';
	}
}
?>

<!-- ACCEDER A CADA ARTISTA -->
<script type="text/javascript">
//<![CDATA['
/*Función JS para acceder a cada artista enviando mediante POST y Jquery el id
del artista seleccionado mostrando así sus canciones en el fichero 
netboxmusic_artista_seleccionado.php*/
function seleccionar(idartista) {
	$.post("netboxmusic_artistas_post.php", { id: idartista } );
	setTimeout(function(){
		$.post("netboxmusic_artista_seleccionado.php", function(data){$("#contenido").html(data);});		
	}, 500);	
}
//]]>
</script>


