<?php
/**********************************************************************************
Nombre del fichero: adm_artistas.php
Descripción: contiene el código html/php necesario para crear artistas.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
?>

<div id="crearartista">
	<!-- Añadri artista. -->
	<h1> A&ntilde;adir artistas </h1><br/>
	<form enctype="multipart/form-data" action="adm_artistas_post.php" method="POST">
		<!-- Nombre del artista -->
		<div><label for="nombreartista"> Nombre del artista: </label><br/>
			<input type="text" value="" name="nombreartista" maxlength=20 size=20 /></div>
		<!-- Nacionalidad -->
		<div><label for="nacionalidad"> Nacionalidad: </label><br/>
			<input type="text" value="" name="nacionalidad" maxlength=20 size=20 /></div>
		
		<!-- Género (recogidos de la base de datos) -->
		<label for="IDgeneroartista"> G&eacute;nero: </label>
			<select name="IDgeneroartista">
				<option value="" selected>-Seleccionar-</option>
				<?php 
					$sqlGenero = "SELECT id, nombre from generos";
					$resultadoGenero = mysqli_query($conn, $sqlGenero);
					if (mysqli_num_rows($resultadoGenero) > 0) {
						mysqli_data_seek($resultadoGenero, 0);
						while($fila = mysqli_fetch_assoc($resultadoGenero)) {
							echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
						}
					}
				?>
			</select>
		
		<!-- Imágen a subir del artista -->
		<div><label for="imagen_artista">Imagen (m&aacute;ximo 1MB):</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<input type="file" name="imagen_artista"/></div><br/>

		<?php 
		/*Mostramos las variables. Según el resultadod de la operación,
		una variable contendrá un valor u otro.*/
		echo $_SESSION["OperacionCrearIncorrecta"]; $_SESSION["OperacionCrearIncorrecta"] = "";
		?>
		
		<!-- Guardar -->
		<div><input type="submit" value="Guardar" /></div>
	</form>
</div>
