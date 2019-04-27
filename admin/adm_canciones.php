<?php
/**********************************************************************************
Nombre del fichero: adm_canciones.php
Descripción: fichero usado para añadir canciones a la BDD y subir el fichero
  correspondiente a cada canción.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
?>


<script type="text/javascript">
//<![CDATA['
/*Función NumeroSubidas(): es usada para controlar la cantidad de
canciones que el adminstrador puede subir/crear al mismo tiempo.*/
function NumeroSubidas() {
	//Obtenemos el valor del elemento HTML que recoge el número de canciones.
    var NCanciones = document.getElementById("ncanciones").value;
	//Como el máximo es 10, el valor debe estar entre 1 y 10.
	if(NCanciones>=1 && NCanciones<=10){
		/*La variable c, es usada para insertar comillas en el contenido 
		de la variable contenido siempre que sea necesario*/
		var c="'";
		var contenido="";
		//Según el número de canciones a crear, insertamos el contenido necesario.
		for (var i=0; i<NCanciones; i++){
			contenido += '<div style="border: 1px solid black; magin: 10px; display: inline-block; padding: 10px;" onmouseover="inicializarCalendario('.concat(c)+'fecha'.concat(i).concat(c)+');"><label for="fecha'.concat(i)+'"> Fecha '.concat(i+1)+': </label><br/><input type="text" id="fecha'.concat(i)+'" name="fecha'.concat(i)+'" maxlength=8 size=8/><br/><br/><label for="titulo'.concat(i)+'"> Cancion '.concat(i+1)+': </label><br/><input type="text" value="" name="titulo'.concat(i)+'" maxlength=25 size=25 /><br/><br/>Fichero '.concat(i+1)+' (max 20MB): <input type="file" name="SubirCancion'.concat(i)+'"/><br/><br/></div>';
		}
		//Insertamos el contenido en el HTML.
		var subidas=document.getElementById("subidas");
		subidas.innerHTML = contenido;
	}
}
/*Función SeleccionarArtista(): esta función es usada a la hora de seleccionar el artista 
peteneciente a las canciones que el administrador se dispone a subir. Esta selección se realiza
gracias a esta función que abre una ventana emergente o Pop Up mostrando los artistas disponibles
junto con un buscador por si el administrador necesita buscarlo rápidamente. Dicha ventana emergente 
corresponde al fichero "adm_canciones_seleccionar.php".*/
function SeleccionarArtista(){
	var win = window.open("adm_canciones_seleccionar.php", "NetBoxMusic", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, titlebar=yes, resizable=yes, width=780, height=400, top="+(screen.height-400)+", left="+(screen.width-840));
}
//]]>
</script>
<div id="crearcancion">
<h1> A&ntilde;adir Canciones </h1><br/>
	<?php
	/*Imprimos las variables de resultado.*/
	$n = count($_SESSION["OperacionSubirIncorrecta"]);
	for ($i=0; $i<$n; $i++){
		echo $_SESSION["OperacionSubirIncorrecta"][$i];
	}
	$n = count($_SESSION["OperacionSubirCorrecta"]);
	for ($i=0; $i<$n; $i++){
		echo $_SESSION["OperacionSubirCorrecta"][$i];
	}
	/*Comprobamos la selección del artista.*/
	if($_SESSION["ArtistaSeleccionado"] != ""){
		$IDArtista = $_SESSION["ArtistaSeleccionado"];
		$sql = "select nombre from artistas where id=".$IDArtista;
		$resultado = mysqli_query($conn, $sql);
		if (mysqli_num_rows($resultado) == 1) {
			if($fila = mysqli_fetch_assoc($resultado))  $_SESSION["Artista"] = $fila["nombre"];
		}
	}
	/*El contenido cambia según se ha seleccionado artista o no.*/
	if ($_SESSION["Artista"]=="")
		echo "<div>Artista: <button onclick='SeleccionarArtista();'>Seleccionar artista</button>&nbsp;Ning&uacute;n artista seleccionado.</div><br/>";
	else {
		echo  "<div>Artista: <b>".$_SESSION['Artista']." &nbsp;</b></div><div><button onclick='SeleccionarArtista();'>Seleccionar artista</button></div><br/>";
	}
	?>
	<!-- Formulario -->
	<form enctype="multipart/form-data" action="adm_canciones_post.php" method="POST">	
		<!-- Nº canciones -->
		<label for="ncanciones">  N&#176; canciones a subir (1-10): </label>
			<input type="text" id="ncanciones" name="ncanciones" onkeyup="NumeroSubidas();" value="1" maxlength="2" size="2">
		<div id="subidas">
			<script>NumeroSubidas();</script>
			<!-- Tamaño máximo por canción: 20MB. -->
			<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
		</div>
		<br/>
		<!-- Enviar formulario. -->
		<input type="submit" name="anadirCanciones" value="Guardar" />
	</form>
</div>

<?php 
/*Restablecemos los valores de las variables de sesión para evitar 
que se muestre información incorrecta/inservible al cambiar de una
página a otra.*/
$_SESSION["OperacionSubirIncorrecta"] = array(); $_SESSION["OperacionSubirCorrecta"] = array(); $_SESSION["cantidadresultados"]=""; $_SESSION["resultadoBusqueda"] = array();
?>