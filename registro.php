<?php 
/**********************************************************************************
Nombre del fichero: registro.php
Descripción: contiene el formulario de registro, cuya inserción 
  de datos es controlada mediante javascript para impedir el envío 
  de informacion erronea o inútil.
**********************************************************************************/
?>

<!-- FORMULARIO DE REGISTRO -->
<div id="registro">
<h1> REGISTRO </h1>
</br>
<!-- Mediante Javascript (JS) controlamos la información 
que los usuarios pueden o no escribir en cada campo. -->
<form action="registro_post.php" name="registrar" method="post" enctype="multipart/form-data" onsubmit="return validarRegistro();" class="registro">
	<!-- Nombre de usuario -->
	<div>
		<label for="usuario"> Nombre de usuario: &#42; </label><br/>
		<input type="text" id="usuario" name="usuario" value="" maxlength="20" onkeypress="return permite(event, 'num_car')" onblur="val_nombre(this.value, 'tnombre');" />
	</div>
	<div id="tnombre" style="color: red; font-weight: bold;"></div>
	<br/>
	
	<!-- Correo Electronico -->
	<div>
		<label for="email"> Correo electr&oacute;nico: &#42;</label><br/>
		<input type="text" id="email" name="email" value="" maxlength="50" onkeypress="return permite(event, 'num_carCE')" onblur="val_CE(this.value, 'tCE');" />
	</div>
	<div id="tCE" style="color: red; font-weight: bold;"></div>
	<!-- Confirmar Correo Electronico -->
	<div>
		<label for="confirmaremail"> Confirmar correo electr&oacute;nico:&#42;</label><br/>
		<input type="text" id="confirmaremail" name="confirmaremail" value="" maxlength="50" onkeypress="return permite(event, 'num_carCE');" onblur="val_confirmacion_CE('email', 'confirmaremail', 'tCEC');" />
	</div>
	<div id="tCEC" style="color: red; font-weight: bold;"></div>
	<br/>
	
	<input type="checkbox" name="noticias" value="1" />
	<label for="noticias">Deseo recibir noticias e informaci&oacute;n sobre ofertas y otras promociones en mi correo electr&oacute;nico.</label>   
	<br/><br/>
	
	<!-- Las condiciones son obligatorias, sino, el formulario no se envía. -->
    <input type="checkbox" name="condiciones" value="1" />
    <label for="condiciones"> Acepto las condiciones de uso y de servicio <a href="#">(leer condiciones)</a>.</label>
	<div id="tcondiciones" style="color: red; font-weight: bold;"></div>
	<br/>

    <div><input type="submit" name="registro" value="Enviar informaci&oacute;n" /></div>
    <div><input type="reset" name="limpiar" value="Limpiar informaci&oacute;n" /></div>

</form>     

<!-- Enlace que abre la ventana de login y cierra la de registro
en caso de querer cambiar rápida y cómodamente entre ambos-->
<p>
&#191;Ya tienes una cuenta?
<a href="#" id="cuentanueva" onclick="comportamiento('cierreregistroaperturalogin');"> Iniciar sesion </a>
</p>
</div>
