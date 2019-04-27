<?php
/**********************************************************************************
Nombre del fichero: adm_generos_post.php
Descripción: fichero usado para añadir géneros.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';


if(isset($_POST['nombregenero']) && $_POST['nombregenero']!=NULL){
	$sqlComprobar = "select nombre from generos where nombre='".$_POST["nombregenero"]."'";
	$resultadoComprobar = mysqli_query($conn, $sqlComprobar);
	if (mysqli_num_rows($resultadoComprobar) > 0){
		$_SESSION["OperacionCrearIncorrecta"] = "<p style='font-weight: bold; color: red'> El g&eacute;nero ya existe </p>";
	}
	else {
			//BDD
			$nombregenero=$_POST["nombregenero"];
			$sqlInsertar = "insert into generos (nombre) values
							('".$nombregenero."');";
			mysqli_query($conn, $sqlInsertar);
			$_SESSION["OperacionCrearCorrecta"] = "<p style='font-weight: bold; color: green'>El g&eacute;nero se ha a&ntilde;adido correctamente.</p>";
		}
	header("location: index.php?p=01");
}
else{
	$_SESSION["OperacionCrearIncorrecta"] = "<p style='font-weight: bold; color: red'>Error: debe rellenar todos los campos.</p>";
	header("location: index.php?p=01");
}
?>