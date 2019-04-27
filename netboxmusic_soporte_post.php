<?php
/***************************************************************************************
Nombre del fichero: netboxmusic_soporte_post.php
Descripción: recoge los datos del formulario de soporte y los escribe en la base de
  datos mientras se envían dos correos: uno mostrando la petición de soporte a un
  administrador y otro como notificación al usuario (netboxmusic_soporte_post2.php).
***************************************************************************************/

//Incluimos la configuración de la BDD y la función necesaria para enviar emails.
include_once 'config.php';
//Incluimos las funciones necesarias.
include 'PHPFunciones/EnviarEmail.php';
//Iniciamos la sesión para acceder a las variables necesarias.
session_start();

//Comprobamos si el post asunto existe y se ha enviado.
if (isset($_POST["asunto"])){
	/*Como podemos observar, el ID, nombre y email del usuario
	se cogen de un array de sesión generado cuando el usuario 
	inicia sesion. El resto de valores los cogemos del formulario
	y de la base de datos.*/
	//Establecemos los parametros y enviamos el email.
	$usu_ID = $_SESSION['informacionusuario']["id"];
	$usu_nombre = $_SESSION['informacionusuario']["nombre"];
	$usu_email = $_SESSION['informacionusuario']["email"];
	$asunto = $_POST["asunto"];
	$sugerencia = $_POST["sugerencia"];
	
	$email = "netboxmusic@gmail.com";
	$asuntoEmail = 'SOPORTE - '.$asunto;
	$contenidoEmail = '
	<p>'.$sugerencia.'</p> 
	<br/><br/><p>Sugerencia enviada por el usuario <b>'.$usu_nombre.'</b>.</p>
	<ul> 
		<li> ID: <b>'.$usu_ID.'</b></li>
		<li> Correo electr&oacute;nico: <b>'.$usu_email.'</b></li>
	</ul>';
	EnviarEmail($email, $asuntoEmail, $contenidoEmail);
	//Insertamos el ticket en la base de datos
	$sqlInsertar = "insert into soporte (idusuario, asunto, sugerencia) values 
					(".$usu_ID.",'".$asunto."','".$sugerencia."')";
	if (mysqli_query($conn, $sqlInsertar)){
		//Si todo va bien, redirigimos el proceso al fichero que envía el segundo email.
		header("location: netboxmusic_soporte_post2.php");
	}
}
//Si algo va mal, redirigimos al usuario al inicio
else header("location:index.php?n");
?>