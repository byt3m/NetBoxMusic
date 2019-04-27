<?php
/**********************************************************************************
Nombre del fichero: adm_eliminar_canciones_buscar.php
Descripción: realiza las búsquedas del apartado eliminar canciones.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';

$busqueda = $_POST["busqueda"];
$tipo_busqueda = $_POST["tipo_busqueda"];
$fecha1 = $_POST["fecha1"];
$fecha2 = $_POST["fecha2"];

//Determinamos el resultado según el tipo de búsqueda realizada.
//1. Si el usuario quiere realizar la busqueda por canciones
if($tipo_busqueda=="cancion"){
	$sqlBuscar = "SELECT c.id, c.titulo, c.fecha, c.fecha_adicion, a.nombre, g.nombre as 'nombregenero'
					From canciones c join artistas a on c.idartista=a.id 
					join generos g  on g.id=a.idgenero
					where c.titulo LIKE '%".$busqueda."%' order by c.id;";
}
//3. Si el usuario quiere realizar la busqueda por generos
else if($tipo_busqueda=="genero"){
	$sqlBuscar = "SELECT c.id, c.titulo, c.fecha, c.fecha_adicion, a.nombre, g.nombre as 'nombregenero'
					From canciones c join artistas a on c.idartista=a.id 
					join generos g  on g.id=a.idgenero
					where g.nombre LIKE '%".$busqueda."%' order by c.id;";
}
//3. Si el usuario quiere realizar la busqueda por artistas
else if($tipo_busqueda=="artista"){
	$sqlBuscar = "SELECT c.id, c.titulo, c.fecha, c.fecha_adicion, a.nombre, g.nombre as 'nombregenero'
					From canciones c join artistas a on c.idartista=a.id 
					join generos g  on g.id=a.idgenero
					where a.nombre LIKE '%".$busqueda."%' order by c.id;";
}
//4. Si el usuario quiere realizar la busqueda por fecha
else if($tipo_busqueda=="fecha"){
	$sqlBuscar = "SELECT c.id, c.titulo, c.fecha, c.fecha_adicion, a.nombre, g.nombre as 'nombregenero'
					From canciones c join artistas a on c.idartista=a.id 
					join generos g  on g.id=a.idgenero
					where c.fecha>='".$fecha1."' and c.fecha<='".$fecha2."' order by c.id;";
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
		<tr id="cancion'.$fila["id"].'" '.$estilo.'>
			<td>'.$fila["id"].' </td>
			<td>'.$fila["titulo"].' </td>
			<td>'.$fila["nombre"].'</td>
			<td>'.$fila["nombregenero"].'</td>
			<td>'.$fila["fecha"].'</td>
			<td>'.$fila["fecha_adicion"].'</td>
			<td><input type="checkbox" name="EliminarCanciones[]" value="'.$fila["id"].'" /></td>
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