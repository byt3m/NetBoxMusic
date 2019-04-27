 <?php
/**********************************************************************************
Nombre del fichero: netboxmusic_artistas_post.php
Descripción: recibe el id del artista al que se quiere acceder
  y lo escribe en una variable de sesión de forma que pueda ser
  recogido/usado fácil y cómodamente. Esto se hace de esta forma
  para evitar que la página se recargue y así no perder la reproducción
  de la música. Este método también se usa para navegar en toda
  el área de clientes.
**********************************************************************************/

//Iniciamos la sesión para poder trabajar con variables de sesión.
session_start();
//Metemos el id del artista seleccionado en una variable de sesión.
$_SESSION["IdArtista"] = $_POST["id"];
?>