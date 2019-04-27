<?php
/**********************************************************************************
Nombre del fichero: adm_eliminar_artistas_post.php
Descripción: recoge la información necesaria para eliminar los artistas según 
  el formulario del fichero adm_eliminar_artistas.php.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
//Incluimos las funciones necesarias.
include_once("PHPFunciones/OperacionesConFicheros.php");

if(isset($_POST["EliminarArtistas"])){
	echo '<pre>'; print_r($_POST);
	$raiz="C:/www/proyecto/music/artist/";
	$artistas = $_POST["EliminarArtistas"];
	$n = count($artistas);
	for ($i=0; $i<$n; $i++){
		$sql = "SELECT * from artistas where id=".$artistas[$i];
		$resultado = mysqli_query($conn, $sql);
		if (mysqli_num_rows($resultado)==1) {
			mysqli_data_seek($resultado, 0);
			if($fila = mysqli_fetch_assoc($resultado)) {
				/*echo "dentro \n";
				print_r($artistas);*/
				//Borramos los registros de la BDD
				$SQLborrar="delete from canciones where idartista=".$artistas[$i];
				$resultadoBorrar = mysqli_query($conn, $SQLborrar);
				$SQLborrar="delete from artistas where id=".$artistas[$i];
				$resultadoBorrar = mysqli_query($conn, $SQLborrar);
				//Borramos el directorio del artista.
				$NombreDirectorioArray=explode("/", $fila["rutaimagen"]);
				$NombreDirectorio=$NombreDirectorioArray[0];
				$directorio=$raiz.$NombreDirectorio;
				BorrarDirectorio($directorio);
			}
		}
	}
	header("Location: index.php?p=12");
}

?>