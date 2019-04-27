<?php
/**********************************************************************************
Nombre del fichero: adm_artistas_post.php
Descripción: contiene el código php necesario para crear artistas según los valores
  recibidos desde el fichero adm_artistas.php.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
//Incluimos los ficheros que contienen las funciones necesarias.
include_once("PHPFunciones/OperacionesConFicheros.php");
include_once("PHPFunciones/OperacionesCadenasTexto.php");

/*Comprobamos la existencia de las variables recibidas y de sus valores.*/
if(isset($_POST['nombreartista']) && $_POST['nombreartista']!=NULL && $_POST['nacionalidad']!=NULL && $_POST['IDgeneroartista']!=NULL){
	//Creamos la consulta SQL
	$sqlComprobar = "select nombre from artistas where nombre='".$_POST["nombreartista"]."'";
	//Enviamos la consulta y guardamos el resultado en una variable.
	$resultadoComprobar = mysqli_query($conn, $sqlComprobar);
	//Si los resultados son mayores que cero, es decir, el artista ya existe, se vuelve a la página anterior.
	if (mysqli_num_rows($resultadoComprobar) > 0){
		$_SESSION["OperacionCrearIncorrecta"] = "<p style='font-weight: bold; color: red'> El artista ya existe </p>";
		header("location: index.php?p=11");
	}
	//En caso contrario, continuamos con las operaciones.
	else {
		/*Eliminamos los espacios del nombre del artista recibido para recrear 
		el nombre del directorio de destino. En el que se guardarán las canciones 
		de dicho artista más adelante*/
		$NombreDirectorio = EliminarEspacios($_POST["nombreartista"]);
		$RutaArtistas = "C:/www/proyecto/music/artist/";
		$directorio = $RutaArtistas.$NombreDirectorio;
		
		//COMPROBACIONES
		//Si el directorio existe, el artista ya existe...
		if (file_exists($directorio)) {
			$_SESSION["OperacionCrearIncorrecta"] = "<p style='font-weight: bold; color: red'> El artista ya existe </p>";
			header("location: index.php?p=11");
		}
		//Si la imagen subida supera el tamaño permitido...
		else if($_FILES["imagen_artista"]["size"]>1000000 || $_FILES["imagen_artista"]["error"]==2){
			$_SESSION["OperacionCrearIncorrecta"] = "<p style='font-weight: bold; color: red'> La imagen ocupa m&aacute;s de 1 MB. </p>";
			header("location: index.php?p=11");
		}
		//Si el fichero subido no es una imagen...
		else if(!ValidarImagen($_FILES["imagen_artista"]["type"])){
			$_SESSION["OperacionCrearIncorrecta"] = "<p style='font-weight: bold; color: red'>El fichero no es una imagen.</p>";
			header("location: index.php?p=11");		
		}
		else{
			/*Si se superan las comprobaciones/reglas, creamos el directorio,
			copiamos la imagen en el y añadimos el artista a la BDD.*/
			
			// IMAGEN
			  //Extensión de la imagen subida.
			$imagen = $_FILES['imagen_artista']['name'];
			$extensionFichero = ".".pathinfo($imagen, PATHINFO_EXTENSION);
			  //Crear directorio.
			$destino = $RutaArtistas.$NombreDirectorio.'/';
			mkdir($destino, 0700);
			  //Redimensionar imagen para ahorrar espacio.
			$origenIMG = $_FILES["imagen_artista"]["tmp_name"];
			$destinoIMG = $destino."thumb".$extensionFichero;
			RedimensionarImagen($origenIMG, $destinoIMG, 220, 150);
			//BDD
			  //Nombre del artista.
			$nombreartista=$_POST["nombreartista"];
			  //Nacionalidad.
			$nacionalidad=$_POST["nacionalidad"];
			  //ID del género del artista.
			$IDGeneroArtista=$_POST["IDgeneroartista"];
			  //Ruta de la imagen.
			$rutaimagen=$NombreDirectorio."/thumb".$extensionFichero;
			  //Sentencia SQL para insertar los datos en la BDD.
			$sqlInsertar = "insert into artistas (idgenero, nombre, nacionalidad, rutaimagen) values
							(".$IDGeneroArtista.", '".$nombreartista."', '".$nacionalidad."', '".$rutaimagen."');";
			mysqli_query($conn, $sqlInsertar);
		}
	}
		header("location: index.php?p=11");
}
//Si no se superan las primeras comprobaciones...
else{
	$_SESSION["OperacionCrearIncorrecta"] = "<p style='font-weight: bold; color: red'>Error: debe rellenar todos los campos.</p>";
	header("location: index.php?p=11");
}
?>