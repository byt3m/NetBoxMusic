<?php 
/**********************************************************************************
Nombre del fichero: netboxmusic_index.php
Descripción: fichero en el que se gestionan las cabeceras (estilos CSS y scripts).
  Los contenidos se incluyen dentro del div con "id = contenedor".
**********************************************************************************/
?>

<!-- Incluimos las librerías JS y estilos CSS -->
<script type="text/javascript" src="js/netboxmusic.js"></script>
<script type="text/javascript" src="js/control_formularios/netboxmusic_calendario.js"></script>
<link rel="stylesheet" type="text/css" href="css/netboxmusic_calendario.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/netboxmusic_menu.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/netboxmusic_general.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/netboxmusic_reproductor.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/netboxmusic_formularios.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/netboxmusic_genero.css" media="screen"/>

<!-- Controlamos el acceso e incluimos el menu -->
<?php include_once 'netboxmusic_control.php'; include_once 'netboxmusic_menu.php';?>

<!-- Este div (id=netboxmusic) es usado para aplicar un "estilo general" al contenido -->
<div id="netboxmusic">
	<center><div id="contenido"><?php include_once("netboxmusic_portada.php"); ?></div></center>
	<div id="pie">
		<div class="reproductor">
			<?php include_once("netboxmusic_reproductor.php"); ?>
		</div>
	</div>
</div>

<?php 
/*Al igual que vimos anteriormente en el index.php principal
controlamos la respuesta de la página según determinados
eventos mediante el método get, en este caso solo lo usamos
para notificaciones y mensajes de error.*/

/*GET["a"]: establece un mensaje alert de notificación o bien
de error según el evento, por ejemplo: si el usuario cambia la 
contraseña, se mostrará una ventana alert con el mensaje 
"Se ha modificado la contraseña" siendo a=0, tal y como podemos
ver más abajo.*/
if (isset($_GET["a"])){
switch ($_GET["a"]) {
	case 0:
		echo "<script type='text/javascript'> alert('Se ha modificado la contraseña.'); </script>";
		break;
	case 1:
		echo "<script type='text/javascript'> alert('Contraseña incorrecta.'); </script>";
		break;
	case 2:
		echo "<script type='text/javascript'> alert('Las contraseñas no coinciden.'); </script>";
		break;
	case 3:
		echo "<script type='text/javascript'> alert('Sugerencia enviada correctamente.'); </script>";
		break;
	}
}
?>
