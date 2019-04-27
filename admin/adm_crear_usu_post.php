<?php
/**********************************************************************************
Nombre del fichero: adm_crear_usu_post.php
Descripción: recoge la información del formulario del fichero adm_crear_usu_post.php
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';

//Si existe el valor del formulario...
if (isset($_POST['crearusuario'])) {
	//Nombre usuario
	$nombre = $_POST["usuario"];
	//Email
	$email = $_POST["email"];
	//Contraseña
	$password = $_POST["password"];
	//Privilegios/Nivel de acceso
	$privilegios = $_POST["privilegios"];
	
	//Sentencia SQL para comprobar que el usuario no existe.
	$sqlComprobar = 'SELECT * from usuarios where nombreusuario="'.$nombre.'"';
	//Resultado de la sentencia.
	$resultadoComprobar = mysqli_query($conn, $sqlComprobar);
	//Si el usuario existe da error, sino lo creamos.
	if (mysqli_num_rows($resultadoComprobar)!= 0)
		$_SESSION["OperacionCrearIncorrecta"] = '<p style="color: red; font-weight: bold;"> El nombre de usuario/email ya existe en la base de datos. </p>';
		else {
			$sqlCrearUsuario = 'INSERT INTO usuarios (nombreusuario, emailusuario, passwordusuario, privilegios) values 
			("'.$nombre.'", "'.$email.'", password("'.$password.'"), '.$privilegios.');';
			if (mysqli_query($conn, $sqlCrearUsuario))
				$_SESSION["OperacionCrearCorrecta"] = '<p style="color: green;"> Usuario creado correctamente. </p>';
		}
	header("location:index.php?p=32"); 
}
?>