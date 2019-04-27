<?php
/***************************************************************************************
Nombre del fichero: netboxmusic_soporte_post2.php
Descripción: envía el segundo email.
***************************************************************************************/

//Incluimos la configuración de la BDD y la función necesaria para enviar emails.
include_once 'config.php';
//Incluimos las funciones necesarias.
include 'PHPFunciones/EnviarEmail.php';
//Iniciamos la sesión para acceder a las variables necesarias.
session_start();

//Enviamos el email.
$emailCliente = $_SESSION['informacionusuario']['email'];
EnviarEmail($emailCliente, SujetosCorreo("Soporte"), MensajesCorreo("Soporte", ""));

//Redireccionamos al usuario a la página de inicio.
header("location:index.php?n&a=3");
?>