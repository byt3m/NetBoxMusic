<?php
/**********************************************************************************
Nombre del fichero: adm_control.php
Descripción: este fichero es usado para controlar los accesos
  al servicio netboxmusic administración, por ejemplo: si no 
  se ha iniciado sesión no se puede acceder al servicio.
**********************************************************************************/

//Iniciamos la sesión para acceder a las variables.
session_start();

// Si no se ha iniciado sesión no se puede acceder al servicio.
if(!isset($_SESSION['informacionusuario']))
	header("Location: ../index.php?error=3");
// Si la variable de privilegios no existe no se puede acceder al apartado administración.
else if (!isset($_SESSION['informacionusuario']["privilegios"]))
	header("Location: ../index.php?n=1");
/*Si la variable de privilegios no establece que el usuario
es administrador, no se puede acceder al apartado administración.*/
else if ($_SESSION['informacionusuario']["privilegios"]!=1)
	header("Location: ../index.php?n=1");
?>