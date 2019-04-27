<?php 
/**********************************************************************************
Nombre del fichero: index.php
Descripción: fichero que controla el contenido de la página
  mediante métodos get. Además, se gestionan las cabeceras 
  (estilos CSS y scripts) que afectan a la página.
**********************************************************************************/

include_once ("adm_control.php"); include("config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <title> NetBoxMusic - Administrador </title>
  <!-- Incluimos los stilos CSS y librerías Javascript/Jquery. -->
<link rel="stylesheet" type="text/css" href="css/adm_menu.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/adm_formularios.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/adm_general.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/adm_ayuda.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/adm_calendario.css" media="screen"/>
<script type="text/javascript" src="js/adm_control_formularios/permitidos.js"></script>
<script type="text/javascript" src="js/adm_control_formularios/calendario.js"></script>
<script type="text/javascript" src="js/adm_control_formularios/validacion.js"></script>
<script type="text/javascript" src="js/lib/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-3.1.1.js"></script>
<script type="text/javascript" src="js/lib/jquery-ui.min.js"></script>
</head>

<body>

<!-- Controlamos el acceso e incluimos el menu -->
<?php include_once 'adm_menu.php'; ?>

<div id="ADM">
	<center><div id="contenido">	
<?php 
/*Al igual que vimos anteriormente en el index.php principal
y en el de netboxmusic, controlamos la respuesta de la página 
según determinados eventos mediante el método get, en este 
caso lo usamos para controlar el contenido que ve el usuario.*/

/*GET["p"]: estable el contenido de la página según su valor.*/
if (isset($_GET["p"])){
	switch ($_GET["p"]) {
		case 01:
			include_once 'adm_generos.php';
			break;
		case 02:
			include_once 'adm_mod_generos.php';
			break;
		case 11:
			include_once 'adm_artistas.php';
			break;
		case 12:
			include_once 'adm_eliminar_artistas.php';
			break;
		case 21:
			include_once 'adm_canciones.php';
			break;
		case 22:
			include_once 'adm_eliminar_canciones.php';
			break;
		case 31:
			include_once 'adm_mod_usu.php';
			break;
		case 32:
			include_once 'adm_crear_usu.php';
			break;
		case 4:
			include_once 'adm_buscar.php';
			break;
		default:
			include_once 'adm_portada.php';
	}
}
/*Si el valor de p no se encuentra o bien p no existe entonces se imprime
la portada. Con esto evitamos que el usuario acceda a partes que no deba acceder.*/
else include_once 'adm_portada.php';
?>
	</div></center>
</div>

</body>
</html>