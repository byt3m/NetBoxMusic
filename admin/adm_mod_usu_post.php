<?php
/**********************************************************************************
Nombre del fichero: adm_mod_usu_post.php
Descripción: recoge y trata la informacion de adm_mod_usu.php
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';

//Si se recibe el formulario...
if (isset($_POST['modificar'])) {	
	$Antiguoregistro = $_SESSION["registro"];
	$a = $_SESSION["cuantos"];
	
	$id = $_POST["id"];
	$nombreusuario = $_POST["nombreusuario"];
	$emailusuario = $_POST["emailusuario"];
	$privilegios = $_POST["privilegios"];
	
	//Comprobamos los cambios realizados y los enviamos a la BDD.
	for ($i=0; $i<$a; $i++){
		$NuevoRegistro[$i] = array($id[$i], $nombreusuario[$i], $emailusuario[$i], $privilegios[$i]);
		if ($NuevoRegistro[$i] != $Antiguoregistro[$i]){	
			$SqlModUsu = 'UPDATE usuarios set nombreusuario="'.$nombreusuario[$i].'", emailusuario="'.$emailusuario[$i].'", privilegios='.$privilegios[$i].' where id='.$id[$i];
			if (mysqli_query($conn, $SqlModUsu))
				$_SESSION["OperacionModificarCorrecta"] = '<p style="color: green;"> Los registros se han modificado correctamente. </p>';
			else
				$_SESSION["OperacionModificarIncorrecta"] = '<p style="color: red; font-weight: bold;"> ERROR. Ha ocurrido un problema tratando de modificar los registros:</p>'.mysqli_error($conn);
		}
	}
	
	//Comprobamos los usuarios a eliminar (si los hay) y se realiza la operación.
	if (isset($_POST['AGD'])){
		$AGD = $_POST["AGD"];
		foreach($AGD as $x => $x_value) {
			$SqlEliminar = 'DELETE from usuarios WHERE id='. $x_value;
			if (mysqli_query($conn, $SqlEliminar))
				$_SESSION["OperacionEliminarCorrecta"] = '<p style="color: green;"> Los registros se han eliminado correctamente. </p>';
			else
				$_SESSION["OperacionEliminarIncorrecta"] = '<p style="color: red; font-weight: bold;"> ERROR. Ha ocurrido un problema tratando de eliminar los registros: </p>'.mysqli_error($conn);
		}
	}
	header("location:index.php?p=31"); 
}
?>