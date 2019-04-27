<?php
/**********************************************************************************
Nombre del fichero: adm_canciones_seleccionar_post.php
Descripción: trata la información recibida desde adm_canciones_seleccionar.php
  para realizar la búsqueda de artistas deseada por el administrador.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';

//Recogemos los parámetros enviados desde adm_canciones_seleccionar.php en $_POST.
$busqueda = $_POST["busqueda"];
//Creamos la consulta SQL
$sqlBuscar = "SELECT * from artistas where nombre LIKE '%".$busqueda."%' order by nombre;";
//Enviamos la consulta y guardamos el resultado en una variable.
$resultadoBuscar = mysqli_query($conn, $sqlBuscar);

//Comprobamos que hay resultados.
if (mysqli_num_rows($resultadoBuscar) > 0) {
	mysqli_data_seek($resultadoBuscar, 0);
	$i=0;
	$_SESSION["fallo_busqueda"]="";
	while($fila = mysqli_fetch_assoc($resultadoBuscar)) {
		$_SESSION["resultadoBusqueda"][$i] = '
			<div id="artista'.$fila["id"].'" onclick="seleccionar'.$i.'('.$fila["id"].')" style="display: inline-block; margin: 10px; border-radius: 20px; cursor: pointer;">
				<img src="../music/artist/'.$fila["rutaimagen"].'" alt="'.$fila["nombre"].'" width="110px" height="75px" />
				<p>'.$fila["nombre"].'</p>
			</div>
		';
		$i++;
	}
	$_SESSION["cantidadresultados"] = count($_SESSION["resultadoBusqueda"])." resultados";
	}
else {
	$_SESSION["fallo_busqueda"]="No se han encontrado resultados.";
	$_SESSION["cantidadresultados"] = "0 resultados";
}

$_SESSION["ArtistaSeleccionado"] = $_POST["seleccionado"];
?>
