<?php
/**********************************************************************************
Nombre del fichero: adm_eliminar_canciones_post.php
Descripción: recoge la información necesaria para eliminar las canciones según 
  el formulario del fichero adm_eliminar_canciones.php.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';

if(isset($_POST["EliminarCanciones"])){
	echo '<pre>'; print_r($_POST);
	$raiz="C:/www/proyecto/music/artist/";
	$canciones = $_POST["EliminarCanciones"];
	$n = count($canciones);
	for ($i=0; $i<$n; $i++){
		$sql = "SELECT * from canciones where id=".$canciones[$i];
		$resultado = mysqli_query($conn, $sql);
		if (mysqli_num_rows($resultado)==1) {
			mysqli_data_seek($resultado, 0);
			if($fila = mysqli_fetch_assoc($resultado)) {
				//Borramos los registros de la BDD
				$SQLborrar="delete from canciones where id=".$canciones[$i];
				$resultadoBorrar = mysqli_query($conn, $SQLborrar);
				//Borramos el fichero de audio
				$fichero=$raiz.$fila["ruta"];
				unlink($fichero);
			}
		}
	}
	header("Location: index.php?p=22");
}

?>