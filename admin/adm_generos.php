<?php
/**********************************************************************************
Nombre del fichero: adm_generos.php
Descripción: fichero usado para añadir géneros.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
?>

<div id="creargenero">
	<h1> A&ntilde;adir G&eacute;neros </h1><br/>
	<form enctype="multipart/form-data" action="adm_generos_post.php" method="POST">		
		<div><label for="nombregenero"> Nombre del g&eacute;nero: </label><br/>
			<input type="text" value="" name="nombregenero" maxlength=20 size=20 /></div>

		<?php echo $_SESSION["OperacionCrearIncorrecta"]; echo $_SESSION["OperacionCrearCorrecta"];
		$_SESSION["OperacionCrearIncorrecta"] = ""; $_SESSION["OperacionCrearCorrecta"] = "";?>
		
		<div><input type="submit" value="Guardar" /></div>
	</form>
</div>
