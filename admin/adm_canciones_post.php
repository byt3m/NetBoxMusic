<?php
/**********************************************************************************
Nombre del fichero: adm_canciones_post.php
Descripción: recoge la información enviada desde adm_canciones.php.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
//Incluimos los ficheros que contienen las funciones necesarias.
include_once("PHPFunciones/OperacionesConFicheros.php");
include_once("PHPFunciones/OperacionesCadenasTexto.php");

//ID del artista.
$IDArtista = $_SESSION["ArtistaSeleccionado"];
//Nº de canciones que se han subido.
$n = $_POST["ncanciones"];
//Nombre del directorio del artista.
$NombreDirectorio = EliminarEspacios($_SESSION["Artista"]);
//Ruta del directorio.
$ruta = "C:/www/proyecto/music/artist/".$NombreDirectorio."/";

//Si se ha recibido este valor...
if (isset($_POST["anadirCanciones"])){
	//Realizamos comprobaciones canción por canción subida...
	for($i=0; $i<$n; $i++){
		$titulo[$i] = $_POST["titulo".$i];
		$fecha[$i] = $_POST["fecha".$i];
		if ($IDArtista!="" && $_SESSION["Artista"]!="" && $titulo[$i]!="" && $fecha[$i]!="" && $_FILES["SubirCancion".$i]["error"]!=4){
			$fichero[$i] = $ruta . basename(EliminarEspacios($_FILES["SubirCancion".$i]["name"]));
			$ExtensionFichero[$i] = pathinfo($fichero[$i],PATHINFO_EXTENSION);
			$RutaBDD[$i] = $NombreDirectorio."/".EliminarEspacios($_FILES["SubirCancion".$i]["name"]);
			$sqlComprobar = "select * from canciones where titulo='".$titulo[$i]."' or ruta='".$RutaBDD[$i]."';";
			$resultadoComprobar = mysqli_query($conn, $sqlComprobar);
			if (mysqli_num_rows($resultadoComprobar) > 0) {
				$_SESSION["OperacionSubirIncorrecta"][$i] = "<p style='font-weight: bold; color: red'> La canci&oacute;n ".$titulo[$i]." ya se encuentra en la BDD. </p>";
			}
			else if($_FILES["SubirCancion".$i]["size"]>20000000 || $_FILES["SubirCancion".$i]["error"]==2){
				$_SESSION["OperacionSubirIncorrecta"][$i] = "<p style='font-weight: bold; color: red'> El fichero ".$_FILES["SubirCancion".$i]["name"]."  ha superado el l&iacute;mite de 20MB.</p>";
			}
			else if(!ValidarAudio($_FILES["SubirCancion".$i]["type"])){
				$_SESSION["OperacionSubirIncorrecta"][$i] = "<p style='font-weight: bold; color: red'> El fichero ".$_FILES["SubirCancion".$i]["name"]."  no es audio</p>";
			}
			else if(file_exists($fichero[$i])){
				$_SESSION["OperacionSubirIncorrecta"][$i] = "<p style='font-weight: bold; color: red'> El fichero ".$_FILES["SubirCancion".$i]["name"]."  ya existe. </p>";
			}
			//Si todo va bien, insertamos las canciones en la BDD.
			else if (move_uploaded_file($_FILES["SubirCancion".$i]["tmp_name"], $fichero[$i])){
				$_SESSION["OperacionSubirCorrecta"][$i] = "<p style='font-weight: bold; color: green'> El fichero ".$_FILES["SubirCancion".$i]["name"]."  se ha subido exitosamente.</p>";
				$fecha[$i] = ReverseCampos($fecha[$i], "-", "-");
				$sqlInsertar = "insert into canciones (titulo, ruta, idartista, fecha) values
					('".$titulo[$i]."', '".$RutaBDD[$i]."', ".$IDArtista.", '".$fecha[$i]."');";
				echo $sqlInsertar;
				mysqli_query($conn, $sqlInsertar);
			} else {
				$_SESSION["OperacionSubirIncorrecta"][$i] = "<p style='font-weight: bold; color: red'> Ha ocurrido un problema al subir el fichero ".$_FILES["SubirCancion".$i]["name"]." </p>";
			}
		}
		else {
			$_SESSION["OperacionSubirIncorrecta"][$i] = "<p style='font-weight: bold; color: red'> Por favor, rellene todos los campos. </p>";
		}
	}
	header("Location: index.php?p=21");
}
?>