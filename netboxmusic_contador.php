<?php
/*********************************************************************************
Nombre del fichero: netboxmusic_contador.php
Descripción: se encarga de actualizar el contador_semanal de la BDD
  cuando se hace click en cada canción, de esta manera llevamos un registro
  sobre las canciones más escuchadas por los usuarios.
*********************************************************************************/

//Incluimos la configuración de la conexión con la BDD.
include_once 'config.php'; 
//Creamos la sentencia SQL necesaria.
$sql = "update canciones set contador_semanal=contador_semanal+1 where id=".$_POST["id"];
//Ejecutamos la sentencia en MySQL.
if (mysqli_query($conn, $sql))
?>