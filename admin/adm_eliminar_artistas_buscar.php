<?php
/**********************************************************************************
Nombre del fichero: adm_eliminar_artistas_buscar.php
Descripción: realiza las búsquedas del apartado eliminar artistas.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';

$busqueda = $_POST["busqueda"];
$tipo_busqueda = $_POST["tipo_busqueda"];

//Determinamos el resultado según el tipo de búsqueda realizada.
//1. Si el usuario quiere realizar la busqueda por el nombre del artista
if($tipo_busqueda=="nombre"){
	$sqlBuscar = "select a.id, a.nombre, a.nacionalidad, g.nombre as 'genero', a.fecha_adicion 
					from artistas a join generos g on a.idgenero=g.id where a.nombre LIKE '%".$busqueda."%' order by a.id;";
}
//2. Si el usuario quiere realizar la busqueda por la nacionalidad del artista
else if($tipo_busqueda=="nacionalidad"){
	$sqlBuscar = "select a.id, a.nombre, a.nacionalidad, g.nombre as 'genero', a.fecha_adicion 
					from artistas a join generos g on a.idgenero=g.id where a.nacionalidad LIKE '%".$busqueda."%' order by a.id;";
}
//3. Si el usuario quiere realizar la busqueda por el genero del artista
else if($tipo_busqueda=="genero"){
	$sqlBuscar = "select a.id, a.nombre, a.nacionalidad, g.nombre as 'genero', a.fecha_adicion 
					from artistas a join generos g on a.idgenero=g.id where g.nombre LIKE '%".$busqueda."%' order by a.id;";
}
else {
	$_SESSION["fallo_busqueda"]="No se han encontrado resultados.";
	$_SESSION["cantidadresultados"] = "0 resultados";
}

$resultadoBuscar = mysqli_query($conn, $sqlBuscar);
if (mysqli_num_rows($resultadoBuscar) > 0) {
	mysqli_data_seek($resultadoBuscar, 0);
	$i=0;
	$estilo="";
	$_SESSION["fallo_busqueda"]="";
	while($fila = mysqli_fetch_assoc($resultadoBuscar)) {
		if ($i%2==0){$estilo="style='background-color: #F6E3CE;'";}else{$estilo="style='background-color: #A9BCF5;'";}
		$_SESSION["resultadoBusqueda"][$i] = '
		<tr id="artista'.$fila["id"].'" '.$estilo.'>
			<td>'.$fila["id"].' </td>
			<td>'.$fila["nombre"].' </td>
			<td>'.$fila["nacionalidad"].'</td>
			<td>'.$fila["genero"].'</td>
			<td>'.$fila["fecha_adicion"].'</td>
			<td><input type="checkbox" name="EliminarArtistas[]" value="'.$fila["id"].'" /></td>
		</tr>
			';
		$i++;
	}
	$_SESSION["cantidadresultados"] = count($_SESSION["resultadoBusqueda"])." resultados";
}
//Si no hay resultados, se establece el mensaje de "error" mediante una variable de sesión
else {
	$_SESSION["fallo_busqueda"]="No se han encontrado resultados.";
	$_SESSION["cantidadresultados"] = "0 resultados";
}
?>