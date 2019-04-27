<?php
/**********************************************************************************
Nombre del fichero: adm_mod_generos_post.php
Descripción: recoge y trata la informacion de adm_mod_generos.php
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';

//Si se recibe el formulario...
if (isset($_POST['modificar'])) {	
	$Antiguoregistro = $_SESSION["registro"];
	$a = $_SESSION["cuantos"];
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	//Comprobamos los cambios realizados y los enviamos a la BDD.
	for ($i=0; $i<$a; $i++){
		$NuevoRegistro[$i] = array($nombre[$i]);
		if ($NuevoRegistro[$i] != $Antiguoregistro[$i]){	
			$SqlModGeneros = 'UPDATE generos set nombre="'.$nombre[$i].'" where id='.$id[$i];
			if (mysqli_query($conn, $SqlModGeneros))
				$_SESSION["OperacionModificarCorrecta"] = '<p style="color: green;"> Los registros se han modificado correctamente. </p>';
			else
				$_SESSION["OperacionModificarIncorrecta"] = '<p style="color: red; font-weight: bold;"> ERROR. Ha ocurrido un problema tratando de modificar los registros:</p>'.mysqli_error($conn);
		}
	}
	header("location:index.php?p=02"); 
}
?>