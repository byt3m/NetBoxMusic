<?php
/**********************************************************************************
Nombre del fichero: registro_post.php
Descripción: comprueba la calidad de la información recibida
  y escribe dicha información en la base de datos. Dicha
  información es recibida desde el formulario de registro.php.
**********************************************************************************/

//Incluimos los ficheros necesarios.
include 'config.php';
include 'PHPFunciones/GenerarContrasena.php';
include 'PHPFunciones/EnviarEmail.php';

//Iniciamos la sesión para acceder a las variables de sesión necesarias
session_start();
//Si no hay información del usuario continuamos.
if(!isset($_SESSION['informacionusuario'])) {
	//Si se detecta el $_POST registro.
	if (isset($_POST["registro"])){
		$usu_nombre = $_POST['usuario'];
		/*Generamos la contraseña del usuario que será enviada
		por email directamente a su bandeja de entrada. De esta
		forma verificamos su cuenta/email matando dos pájaros de un tiro.*/
		$usu_contrasena = generarContrasena();
		$usu_email = $_POST['email'];
		$noticias = $_POST['noticias'];
		
		//Comprobamos que el nombre de usuario o email no existe en la base de datos.
		$sqlComprobacion = 'SELECT * from usuarios where emailusuario="'.$usu_email.'" OR nombreusuario="'.$usu_nombre.'";';
		$resultado = mysqli_query($conn, $sqlComprobacion);
		if (mysqli_num_rows($resultado) == 1)
			/*En caso afirmativo, se devuelve al usuario 
		    al formulario de registro con un mensaje de error.*/
			header("location:index.php?error=1"); 
			//Si no hay problemas, insertamos los datos en la BDD.
			else {
				/*Este condicional controla si el usuario a chequeado
				la casilla de recibir noticias, un simple detalle
				que se controla en este fichero.*/
				if ($noticias == 1){
					$sqlInsertar = "insert into usuarios (nombreusuario, passwordusuario, emailusuario, desearecibirnoticias)
						values ('".$usu_nombre."',password('".$usu_contrasena."'),'".$usu_email."',".$noticias.");";
					mysqli_query($conn, $sqlInsertar);
				}
				else {
					$sqlInsertar = "insert into usuarios (nombreusuario, passwordusuario, emailusuario)
						values ('".$usu_nombre."',password('".$usu_contrasena."'),'".$usu_email."');";
					mysqli_query($conn, $sqlInsertar);
				}
				/*Enviamos el Email con la contraseña generada y 
				redirigimos al usuario a la ventana de login
				posicionando o enfocando el cursor en el input de usuario.*/
				EnviarEmail($usu_email, SujetosCorreo("Registro"), MensajesCorreo("Registro", $usu_contrasena));
				header("location:index.php?m=2");
			}
	}
}
?>