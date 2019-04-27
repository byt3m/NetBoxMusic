<?php 
/**********************************************************************************
Nombre del fichero: index.php
Descripci�n: fichero que controla el contenido de la p�gina mediante m�todos get, 
  incluyendo �nicamente contenidos dentro del cuerpo (<body>) aprovechando que la 
  cabeza y el pie son siempre los mismos en este apartado. De esta forma, podemos 
  usar este fichero como contenedor de las "cabeceras", que son en general, las 
  inclusiones de los scripts de javascript/jquery y estilos css.
**********************************************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <title> NetBoxMusic </title>
  <!-- Incluimos los stilos CSS y librer�as Javascript/Jquery requeridas. -->
  <link rel="stylesheet" type="text/css" href="css/portada.css" media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/general.css" media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/formularios.css" media="screen"/>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
  <script type="text/javascript" src="js/portada.js"></script>
  <script type="text/javascript" src="js/control_formularios/registro.js"></script>
  <script type="text/javascript" src="js/control_formularios/permitidos.js"></script>
  <script type="text/javascript" src="js/lib/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/lib/jquery-ui.min.js"></script>
</head>

<body>

<?php 
/* Mediante el metodo GET, controlamos la respuesta de la p�gina
seg�n el evento ocurrido. Por ejemplo, si un usuario intenta acceder
al servicio sin haber iniciado sesion, este ser� devuelto a esta p�gina
controlando asi las consecuencias de este par�metro, establecidas en el 
GET["error"] mas abajo.*/

/*GET["n"]: establece el acceso al servicio protegiendo nombres de ficheros.
Es decir, si "n" es enviado por "GET" se incluye el fichero index de netboxmusic dentro del body.*/
if (isset($_GET["n"]))
	include_once 'netboxmusic_index.php';
else 
	include_once 'portada.php';

/*GET["error"]: controla las consecuencias seg�n el error. Por ejemplo, un mensaje
que dice que el usuario no existe cuando los datos de inicio de sesion son incorrectos
o cuando el usuario trata de acceder donde no debe acceder.*/
if (isset($_GET["error"])){
	switch ($_GET["error"]) {
		case 1:
			echo "<script type='text/javascript'> window.onload = function() { comportamiento('mostrarregistro'); alert('ERROR: El usuario o email introducidos ya existen.'); document.getElementById('usuario').focus();} </script>";
			break;
		case 2:
			echo "<script type='text/javascript'> window.onload = function() { comportamiento('mostrarlogin'); alert('ERROR: El usuario/email o contrase�a es incorrecto.'); document.getElementById('nombreusuario').focus();} </script>";
			break;
		case 3:
			echo "<script type='text/javascript'> window.onload = function() { alert('ERROR: Solo se puede iniciar sesion una vez.'); } </script>";
			break;
		default:
			echo "<script type='text/javascript'> window.onload = function() { comportamiento('mostrarlogin'); } </script>";
	}
}

/*GET["m"]: controla los mensajes de notificaci�n. Por ejemplo: cuando nos 
registramos muestra un mensaje que pide al usuario chequear el email utilizado
en el registro, pues la contrase�a de inicio de sesi�n se env�a por email. De
esta forma controlamos la confirmaci�n de la cuenta registrada sin necesidad 
de enviar uno de esos aparatosos enlaces que el usuario debe acceder
para realizar dicha confirmaci�n.*/
if (isset($_GET["m"]))
	echo "<script type='text/javascript'> window.onload = function() { comportamiento('mostrarlogin'); alert('Usuario creado con exito. Por favor, compruebe su bandeja de entrada para obtener el codigo de inicio de sesion.'); document.getElementById('nombreusuario').focus();} </script>";
?>

</body>
</html>