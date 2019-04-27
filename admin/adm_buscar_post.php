<?php
/**********************************************************************************
Nombre del fichero: adm_buscar_post.php
Descripción: trata la información recibida desde adm_buscar.php
  para realizar la búsqueda deseada por los usuarios.
**********************************************************************************/

//Incluimos el fichero config para la conexión con la BDD.
include_once 'config.php';
//Iniciamos la sesión para acceder trabajar con variables de sesión.
session_start();

//Recogemos los parámetros enviados desde adm_buscar.php en $_POST.
$busqueda = $_POST["busqueda"];
$tipo_busqueda = $_POST["tipo_busqueda"];
$fecha1 = $_POST["fecha1"];
$fecha2 = $_POST["fecha2"];

//Determinamos la consulta SQL según el tipo de búsqueda que se quiera realizar.
//1. Si el usuario quiere realizar la búsqueda por canciones
if($tipo_busqueda=="cancion"){
	$sqlBuscar = "SELECT c.contador_semanal, c.contador_total, c.id, c.titulo, a.nombre, a.rutaimagen, g.nombre as 'nombregenero'
					From canciones c join artistas a on c.idartista=a.id 
					join generos g  on g.id=a.idgenero
					where c.titulo LIKE '%".$busqueda."%' order by c.titulo;";
}
//3. Si el usuario quiere realizar la busqueda por generos
else if($tipo_busqueda=="genero"){
	$sqlBuscar = "SELECT c.contador_semanal, c.contador_total,  c.id, c.titulo, a.nombre, a.rutaimagen, g.nombre as 'nombregenero'
					From canciones c join artistas a on c.idartista=a.id 
					join generos g  on g.id=a.idgenero
					where g.nombre LIKE '%".$busqueda."%' order by c.titulo;";
}
//3. Si el usuario quiere realizar la busqueda por artistas
else if($tipo_busqueda=="artista"){
	$sqlBuscar = "SELECT c.contador_semanal, c.contador_total, c.id, c.titulo, a.nombre, a.rutaimagen, g.nombre as 'nombregenero'
					From canciones c join artistas a on c.idartista=a.id 
					join generos g  on g.id=a.idgenero
					where a.nombre LIKE '%".$busqueda."%' order by c.titulo;";
}
//4. Si el usuario quiere realizar la busqueda por fecha
else if($tipo_busqueda=="fecha"){
	$sqlBuscar = "SELECT c.contador_semanal, c.contador_total, c.id, c.titulo, a.nombre, a.rutaimagen, g.nombre as 'nombregenero'
					From canciones c join artistas a on c.idartista=a.id 
					join generos g  on g.id=a.idgenero
					where c.fecha>='".$fecha1."' and c.fecha<='".$fecha2."' order by c.fecha;";
}
else {
	$_SESSION["fallo_busqueda"]="No se han encontrado resultados.";
	$_SESSION["cantidadresultados"] = "0 resultados";
}

//Una vez se ha determinado la sentencia SQL. Se realiza la consulta a la BDD.
$resultadoBuscar = mysqli_query($conn, $sqlBuscar);
if (mysqli_num_rows($resultadoBuscar) > 0) {
	mysqli_data_seek($resultadoBuscar, 0);
	$i=0;
	$_SESSION["fallo_busqueda"]="";
	while($fila = mysqli_fetch_assoc($resultadoBuscar)) {
		//Insertamos los resultados en la variable de sesión "resultadoBusqueda".
		$_SESSION["resultadoBusqueda"][$i] = '
		<div id="cancion'.$fila["id"].'" 
		class="info" 
		style="display: inline-block; margin: 10px; border-radius: 20px; cursor: default;"
		title="'.$fila["contador_semanal"].' reproducciones esta semana - '.$fila["contador_total"].' reproducciones totales.">
			<img src="../music/artist/'.$fila["rutaimagen"].'" alt="'.$fila["nombre"].'" width="220px" height="150px" />
				<p style="width:220px;">T&iacute;tulo: '.$fila["titulo"].' </p>
				<p style="width:220px;">Artista: '.$fila["nombre"].'</p>
				<p style="width:220px;">G&eacute;nero: '.$fila["nombregenero"].'</p>
		</div>
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