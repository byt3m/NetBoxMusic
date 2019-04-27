<?php
/**********************************************************************************
Nombre del fichero: netboxmusic_control.php
Descripción: este fichero es usado para controlar los accesos
  al servicio netboxmusic, por ejemplo: si no se ha iniciado sesión
  no se puede acceder al servicio.
**********************************************************************************/

//Iniciamos la sesión para trabajar con variables de sesión.
session_start();

/*Si no hay sesión del usuario, se redirige a este
al inicio, es decir, no se puede acceder al servicio
si no se inicia sesión antes.*/
if(!isset($_SESSION['informacionusuario']))
	header("Location: index.php?error"); 
?>