<?php
/**********************************************************************************
Nombre del fichero: login_post.php
Descripción: recoge los parámetros enviados por el formulario
  del fichero "login.php" mediante POST y consulta la BDD con el 
  objetivo de comprobar que la información proporcionada existe
  en dicha base de datos.
**********************************************************************************/

//Añadimos el fichero que contiene la configuración necesaria para acceder a la BDD.
include 'config.php';
//Iniciamos la sesión para acceder a las variables de sesión necesarias (si existen).
session_start();

//Si no hay una sesión iniciada, se consulta a la BDD.
if(!isset($_SESSION['informacionusuario'])) {
	if (isset($_POST['login'])){
		//Sentencia SQL para comprobar si el nombre de usuario escrito existe.
		$sqlUsuario = "select * from usuarios where nombreusuario='".$_POST['user']."' and passwordusuario=password('".$_POST['password']."')";
		//Sentencia SQL para comprobar si el email escrito existe.
		$sqlEmail = "select * from usuarios where emailusuario='".$_POST['user']."' and passwordusuario=password('".$_POST['password']."')";
		//Guardamos los resultados de ambas sentencias SQL en estas variables
		$resultadoUsuario = mysqli_query($conn, $sqlUsuario);
		$resultadoEmail = mysqli_query($conn, $sqlEmail);
		
		/*Nota: El usuario puede inciar sesión o bien con su nombre de usuario
		o bien con su dirección de correo electrónico, para ello hemos
		programado dos condicionales que controlan las dos opciones.*/
		
		//Comprobamos que el nombre de usuario/contraseña existe.
		if (mysqli_num_rows($resultadoUsuario) == 1){
			while ($fila = mysqli_fetch_assoc($resultadoUsuario)){
				$_SESSION['informacionusuario'] = array (
					"id" => $fila['id'], 
					"nombre" => $fila['nombreusuario'], 
					"email" => $fila['emailusuario'], 
					"privilegios" => $fila['privilegios']
				);
				/*Si el usuario es administrador, inicializamos las variables de sesión
				utilizadas en la parte de administración*/
				if ($fila['privilegios']==1){
					$_SESSION["OperacionCrearCorrecta"] = "";
					$_SESSION["OperacionCrearIncorrecta"] = "";
					$_SESSION["OperacionSubirCorrecta"] = Array();
					$_SESSION["OperacionSubirIncorrecta"] = Array();
					$_SESSION["OperacionModificarCorrecta"] = "";
					$_SESSION["OperacionModificarIncorrecta"] = "";
					$_SESSION["OperacionEliminarCorrecta"] = "";
					$_SESSION["OperacionEliminarIncorrecta"] = "";
					$_SESSION["Accion"] = "";
					$_SESSION["Objeto"] = "";
					$_SESSION["Resultado"] = "";
					$_SESSION["ArtistaSeleccionado"]="";
					$_SESSION["Artista"] = "";
				}
				//Estas variables de sesión se usan en el buscador de la zona de clientes.
				$_SESSION["fallo_busqueda"] = "";
				$_SESSION["resultadoBusqueda"] = array();
				$_SESSION["cantidadresultados"] = "";
				//Si "todo va bien" se inicia sesión y se envía al usuario al servicio directamente.
				header("location:index.php?n"); 
			}
		}
		//Comprobamos que el email/contraseña existe.
		else if (mysqli_num_rows($resultadoEmail) == 1){
			while ($fila = mysqli_fetch_assoc($resultadoEmail)){
				$_SESSION['informacionusuario'] = array (
					"id" => $fila['id'], 
					"nombre" => $fila['nombreusuario'], 
					"email" => $fila['emailusuario'], 
					"privilegios" => $fila['privilegios']
				);
				/*Si el usuario es administrador, inicializamos las variables de sesión
				utilizadas en la parte de administración*/
				if ($fila['privilegios']==1){
					$_SESSION["OperacionCrearCorrecta"] = "";
					$_SESSION["OperacionCrearIncorrecta"] = "";
					$_SESSION["OperacionSubirCorrecta"] = Array();
					$_SESSION["OperacionSubirIncorrecta"] = Array();
					$_SESSION["OperacionModificarCorrecta"] = "";
					$_SESSION["OperacionModificarIncorrecta"] = "";
					$_SESSION["OperacionEliminarCorrecta"] = "";
					$_SESSION["OperacionEliminarIncorrecta"] = "";
					$_SESSION["Accion"] = "";
					$_SESSION["Objeto"] = "";
					$_SESSION["Resultado"] = "";
					$_SESSION["ArtistaSeleccionado"]="";
					$_SESSION["Artista"] = "";
				}
				//Estas variables de sesión se usan en el buscador de la zona de clientes.
				$_SESSION["fallo_busqueda"] = "";
				$_SESSION["resultadoBusqueda"] = array();
				$_SESSION["cantidadresultados"] = "";
				//Si "todo va bien" se inicia sesión y se envía al usuario al servicio directamente.
				header("location:index.php?n"); 
			}
		}
		/*Si el usuario o email ya existen en la base de datos, se redirecciona la usuario al inicio
		mostrando un mensaje de error.*/
		else
			header('location: index.php?error=2');
		
	}
}
/*Si la sesión ya ha sido iniciada, redireccionamos al usuario al inicio con un mensaje de error,
de esta forma evitamos que se envíe y trate información innecesaria*/
else 
	header('location: index.php?error=3');
?>