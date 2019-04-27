<?php
/**********************************************************************************
Nombre del fichero: netboxmusic_cambiarpass_post.php
Descripción: controla el cambio de contraseña. Cuando esta cambia
  se notifica al usuario mediante un correo electrónico.
**********************************************************************************/

//Incluimos la configuración de la conexión con la BDD.
include_once 'config.php'; 
//Incluimos el fichero que contiene la función de enviar Emails.
include 'PHPFunciones/enviaremail.php';
//Iniciamos la sesión para trabajar con variables de sesión.
session_start();

//Si hay información del usuario continuamos.
if(isset($_SESSION['informacionusuario'])) {
	//Si se detecta este parámetro POST continuamos.
	if (isset($_POST["perfil"])){ 	
		$contrasenaAntigua = $_POST['contrasenaAnterior'];
		$contrasenaNueva1 = $_POST['contrasenaNueva'];
		$contrasenaNueva2 = $_POST['confirmarcontrasenaNueva'];
		//Controlamos que la contraseña nueva escrita en los dos campos sean iguales.
		if($contrasenaNueva1==$contrasenaNueva2){
			//Creamos la sentencia SQL para comprobar que la información es correcta.
			$sql = 'SELECT * from usuarios where passwordusuario=password("'.$contrasenaAntigua.'") and id='.$_SESSION['informacionusuario']["id"].';';
			$resultado = mysqli_query($conn, $sql);
			//Si se obtiene un resultado, escribimos los cambios de la BDD.
			if (mysqli_num_rows($resultado) == 1){
				$sql = "update usuarios set passwordusuario=password('".$contrasenaNueva1."') where id=".$_SESSION['informacionusuario']["id"].";";
				if (mysqli_query($conn, $sql)){
					//Enviamos un email para notificar al usuario de que su contraseña ha cambiado.
					EnviarEmail($_SESSION['informacionusuario']["email"], SujetosCorreo("CambiarContrasena"), MensajesCorreo("CambiarContrasena", ""));
					/*Si todo va bien, se redirige al usuario al inicio 
					mostrando un mensaje avisando sobre la modificación realizada.*/
					header("location:index.php?n=1&a=0");
				}
			}
			/*Si algo va mal, se redirige al usuario al inicio mostrando un mensaje de error
			Error: Contraseña incorrecta.*/
			else header("location:index.php?n&a=1");
		}
		/*Si algo va mal, se redirige al usuario al inicio mostrando un mensaje de error
			Error: Las contraseñas no coinciden.*/
		else header("location:index.php?n&a=2");
	}
}
?>