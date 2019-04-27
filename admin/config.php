 <?php
/***************************************************************************************
Nombre del fichero: config.php
Descripción: contiene la configuración necesaria para la conexión con la base de datos.
***************************************************************************************/

//Host del servidor MySQL
$servername = "localhost";
//Usuario de la Base de Datos (BDD).
$username = "";
//Contraseña de la BDD.
$password = "";

//Nombre de la BDD a usar.
$dbname = "netboxmusic";
//Función que conecta PHP con la BDD usando los parámetros anteriores
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Si la conexión falla se "imprime" el siguiente mensaje de error
if (!$conn)
	//La función mysqli_connect_error() contiene la información relativa al error de conexión.
	die("Conexión a la base de datos fallida: ".mysqli_connect_error().");");

//Colocamos el charset en UTF8 para evitar problemas de acentos a la hora de administrar la BDD mediante PHP
mysqli_set_charset($conn, "utf8");
?>