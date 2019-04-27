<?php 
/**********************************************************************************
Nombre del fichero: portada.php
Descripción: este fichero incluye los botones que permiten 
  al usuario registrarse en el servicio o bien iniciar sesión.
**********************************************************************************/

//Iniciamos una sesión para acceder a la variable informacionusuario de la que hacemos uso más abajo.
session_start();
?>

<!-- DIV contenedor -->
<div id="contenedor">
<center>
	<!-- Logo de la aplicación -->
	<a href="index.php" alt="inicio"> <img src="img/logo2.png" alt="logo" width="60%" /> </a>
	
	<table id="portada">
		<tr>	<!-- BOTONES -->
			<td class="boton"> 
				<a href="#" onclick="comportamiento('mostrarlogin');"> 	<!-- BOTON LOGIN -->
					<img src="img/login.png" alt="login" /> 
				</a>
			</td>
		<!-- SI no hay información de sesión, se muestra el botón de registro. -->
		<?php if(!isset($_SESSION['informacionusuario'])) { ?>
			<td class="boton">
				<a href="#" onclick="comportamiento('mostrarregistro');"> 	<!-- BOTON REGISTRO -->
					<img src="img/registro.png" alt="registro" /> 
				</a>	
			</td>
		<!-- SI hay información de sesión, se muestra el botón para acceder al servicio -->
		<?php } else {?>
			<td class="boton">
				<a href="index.php?n=1"> 	<!-- BOTON NETBOXMUSIC -->
					<img src="img/entrar.png" alt="entrar" /> 
				</a>	
			</td>
		<?php } ?>
		
			<td class="boton" onclick="comportamiento('mostrarinformacion');"> <!-- BOTON INFORMACION -->
				<a id="" href="#">
					<img src="img/informacion.png" alt="informacion" /> 
				</a>
			</td>
		</tr>
	</table>
</center>
</div>

<!-- FLOTANTES -->
<!-- Fondo que se aplica al abrir la ventana flotante -->
<div id="fondo" onclick="comportamiento('cerrartodo');" style="display: none"></div> 

<!-- Flotante LOGIN -->
<div id="flotantelogin">
	<div id="animarlogin">
		<?php include_once("login.php"); ?>
		<p><a href="#" class="cancelarflotante" onclick="comportamiento('cerrarlogin');"> Cancelar </a></p>
	</div>
</div>

<!-- Flotante REGISTRO -->
<div id="flotanteregistro">
	<div id="animarregistro"> 
		<?php include_once("registro.php"); ?>
		<p><a href="#" class="cancelarflotante" onclick="comportamiento('cerrarregistro');"> Cancelar </a></p>
	</div>
</div>

<!-- Flotante INFORMACION -->
<div id="flotanteinformacion">
	<div id="animarinformacion"> 
		<?php include_once("informacion.php"); ?>
		<p><a href="#" class="cancelarflotante" onclick="comportamiento('cerrarinformacion');"> Cancelar </a></p>
	</div>
</div>