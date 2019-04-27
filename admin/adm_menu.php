<?php
/************************************************************************************
Nombre del fichero: adm_menu.php
Descripción: este fichero contiene el menú principal que aparece
  en la cabecera de la aplicación web administración.
************************************************************************************/
?>

<!-- MENU -->
<div id='menuprincipalADM'>
  <ul>
	<!-- Inicio -->
	<li class='activo'><a href='index.php?p=0'>Inicio</a></li>
	<!-- Generos: Añadir/Modificar. -->
	<li class='submenu'><a href='#0'> G&eacute;neros </a>
		<ul>
			<li><a href='index.php?p=01'>A&ntilde;adir G&eacute;neros</a></li>
			<li><a href='index.php?p=02'>Modificar G&eacute;neros</a></li>
		</ul>
	</li>
	<!-- Artistas: Añadir/Modificar. -->
	<li class='submenu'><a href='#1'> Artistas </a>
		<ul>
			<li><a href='index.php?p=11'>A&ntilde;adir Artistas</a></li>
			<li><a href='index.php?p=12'>Eliminar Artistas</a></li>
		</ul>
	</li>
	<!-- Canciones: Añadir/Modificar -->
	<li class='submenu'><a href='#2'> Canciones </a>
		<ul>
			<li><a href='index.php?p=21'>A&ntilde;adir canciones</a></li>
			<li><a href='index.php?p=22'>Eliminar Canciones</a></li>
		</ul>
	</li>
	<!-- Usuarios: Modificar/Crear/Eleiminar -->
	<li class='submenu'><a href='#3'> Usuarios </a>
		<ul>
			<li><a href='index.php?p=31'>Modificar/Eliminar Usuarios</a></li>
			<li><a href='index.php?p=32'>Crear Usuarios</a></li>
		</ul>
	</li>
	<!-- Buscar -->
	<li><a href='index.php?p=4'> Buscar </a></li>
	<!-- Usuario -->
	<li class='submenu'><a href='#'> Usuario  </a>
		<ul>
			<!-- Área Cliente -->
			<li><a href='../index.php?n=1'> &Aacute;rea Cliente </a></li>
			<!-- Cerrar sesión -->
			<li><a href="adm_logout.php">Cerrar Sesi&oacute;n</a></li>
		</ul>
	</li>
	
  </ul>
</div>
