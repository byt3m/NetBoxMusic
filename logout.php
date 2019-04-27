 <?php
/**********************************************************************************
Nombre del fichero: logout.php
Descripción: cierra la sesión iniciada por el usuario y elimina al mismo tiempo las variables de sesión correspondientes.
**********************************************************************************/

//Se inicia la sesión para acceder a las variables.
session_start();
//Se destruyen las variables y la misma sesión al mismo tiempo.
session_destroy();
//Redireccionamos al usuario al inicio.
header("location:index.php"); 
?> 