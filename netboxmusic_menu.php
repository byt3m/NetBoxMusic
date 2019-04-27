<?php
/************************************************************************************
Nombre del fichero: netboxmusic_menu.php
Descripción: este fichero contiene el menú principal que aparece
  en la cabecera de la aplicación web.
************************************************************************************/
?>

<!-- MENU -->
<div id='menuprincipal'>
  <ul>
	<!-- Inicio -->
	<li class='activo'><a href='#' onclick="recargar('netboxmusic_portada.php');">Inicio</a></li>
	<!-- Géneros -->
	<li><a href='#' onclick="recargar('netboxmusic_generos.php')"> G&eacute;neros </a></li>
	<!-- Artistas -->
    <li><a href='#' onclick="recargar('netboxmusic_artistas.php');"> Artistas </a></li>
	<!-- Buscar -->
	<li><a href='#' onclick="recargar('netboxmusic_buscar.php');"> Buscar </a></li>
	<!-- Usuario -->
	<li class='submenu'><a href='#'> Usuario  </a>
		<ul>
			<!-- Acceso Administrador -->
			<!-- Si el usuario que ha iniciado sesión es administrador, se muestra un enlace que permite
			a dicho usuario entrar en el panel de administrador.-->
			<?php if($_SESSION['informacionusuario']["privilegios"] == 1) echo "<li><a href='admin/index.php'>Acceso administrador</a></li>"; ?>
			<!-- Cambiar contraseña -->
			<li><a href='#' onclick="recargar('netboxmusic_cambiarpass.php');"> Cambiar contrase&ntilde;a</a></li>
			<!-- Soporte -->
			<li><a href='#' onclick="recargar('netboxmusic_soporte.php');"> Soporte </a></li>
			<!-- Cerrar sesión -->
			<li><a href="logout.php">Cerrar sesi&oacute;n</a></li>
		</ul>
	</li>
  </ul>
</div>
