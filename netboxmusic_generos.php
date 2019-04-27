<?php
/**********************************************************************************
Nombre del fichero: netboxmusic_generos.php
Descripción: muestra los géneros recogidos en la base de datos MySQL.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la conexión con la BDD.
include_once 'netboxmusic_control.php'; 
include_once 'config.php';
?>

<!-- Título -->
<h1 style="font-size: 25px; margin-top: 60px;"> G&eacute;neros </h1>

<?php
//Creamos la consulta SQL.
$sqlGeneros = "select * from generos order by nombre";
$resultadoGeneros = mysqli_query($conn, $sqlGeneros);
/*Recorremos los resultados obtenidos (si los hay) y 
mostramos dichos resultados, cada uno en un div distinto*/
if (mysqli_num_rows($resultadoGeneros) > 0) {
	mysqli_data_seek($resultadoGeneros, 0);
	while($fila = mysqli_fetch_assoc($resultadoGeneros)) {
		echo '
			<div id="'.$fila["id"].'" class="genero" onclick="seleccionar('.$fila["id"].');">
				'.$fila["nombre"].'
			</div>
			';
	}
}
?>
<!-- ACCEDER A CADA GÉNERO -->
<script type="text/javascript">
//<![CDATA['
/*Función JS para acceder a cada género enviando mediante POST y Jquery el id
del genero seleccionado mostrando así sus canciones en el fichero 
netboxmusic_genero_seleccionado.php*/
function seleccionar(idgenero) {
	$.post("netboxmusic_generos_post.php", { id: idgenero } );
	setTimeout(function(){
		$.post("netboxmusic_genero_seleccionado.php", function(data){$("#contenido").html(data);});		
	}, 500);	
}
//]]>
</script>



