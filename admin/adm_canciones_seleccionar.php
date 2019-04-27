<?php
/**********************************************************************************
Nombre del fichero: adm_canciones_seleccionar.php
Descripción: fichero usado para escoger el artista en el formulario de añadir
  canciones.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title> Artistas </title>
	<!-- Incluimos los stilos CSS y librerías Javascript/Jquery. -->
	<link rel="stylesheet" type="text/css" href="css/adm_formularios.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="css/adm_general.css" media="screen"/>
	<script type="text/javascript" src="js/lib/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/lib/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/lib/jquery-ui.min.js"></script>
</head>

<body>
<div id="contenido2">
<div id="buscador">
	<label for="busqueda_texto"> Buscar artista: </label>
	<input type="text" id="busqueda_texto" value="" placeholder="Buscar" maxlength="30" size="30" />
	<button type="button" onclick="buscar()">Buscar</button>
	<?php //Mostramos las variables de sesión correspondientes.
	echo '<p style="color: red; font-weight: bold;">'.$_SESSION["fallo_busqueda"].'</p>';
	echo '<p style="font-weight: bold;">'.$_SESSION["cantidadresultados"].'</p>';
	?>
</div>

<br/>
<!-- REALIZAR BUSQUEDA -->
<script type="text/javascript">
//<![CDATA['
function buscar() {
	var texto = document.getElementById("busqueda_texto").value;
	$.post("adm_canciones_seleccionar_post.php", { busqueda: texto } );
	setTimeout(function(){
		$.post("adm_canciones_seleccionar.php", function(data){$("#contenido2").html(data);});		
	}, 500);	
}
$("#busqueda_texto").on('keyup', function (e) {
    if (e.keyCode == 13) {
        buscar();
    }
});
//]]>
</script>

<?php

if ($_SESSION["resultadoBusqueda"]==Array()){
//Si no hay busqueda, mostramos todos los artistas por defecto.
$sql = "SELECT * from artistas;";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
	mysqli_data_seek($resultado, 0);
	$i=0;
	while($fila = mysqli_fetch_assoc($resultado)) {
		echo '
			<div id="artista'.$fila["id"].'" onclick="seleccionar'.$i.'('.$fila["id"].')" style="display: inline-block; margin: 10px; border-radius: 20px; cursor: pointer;">
				<img src="../music/artist/'.$fila["rutaimagen"].'" alt="'.$fila["nombre"].'" width="110px" height="75px" />
				<p>'.$fila["nombre"].'</p>
			</div>
		';
		echo '
		<script type="text/javascript">
		function seleccionar'.$i.'(id) {
			$.post("adm_canciones_seleccionar_post.php", { seleccionado: id } );
			setTimeout(function(){
				window.opener.location.reload(true);
				window.close();
			}, 500);	
			}
		</script>
		';
		$i++;
	}
}
}
else {
//MOSTRAMOS LOS RESULTADOS DE LA BUSQUEDA (array)
	$n=count($_SESSION["resultadoBusqueda"]);
	for($i=0; $i<$n; $i++){
		echo $_SESSION["resultadoBusqueda"][$i];
		echo '
		<script type="text/javascript">
		function seleccionar'.$i.'(id) {
			$.post("adm_canciones_seleccionar_post.php", { seleccionado: id } );
			setTimeout(function(){
				window.opener.location.reload(true);
				window.close();
			}, 500);	
			}
		</script>
		';
	}
}
//Restablecemos los valores de las variables de sesión para evitar que se muestre información incorrecta/inservible.
$_SESSION["fallo_busqueda"]=""; $_SESSION["resultadoBusqueda"]=array(); $_SESSION["cantidadresultados"]=""; 
?>

</div>
</body>
</html>