<?php
/**********************************************************************************
Nombre del fichero: netboxmusic_cambiarpass.php
Descripción: contiene el formulario para que los
  usuarios puedan cambiar la contraseña de sus cuentas.
**********************************************************************************/

//Incluimos el fichero de control.
include_once 'netboxmusic_control.php';
?>

<!-- FORMULARIO cambiarpass -->
<div id="cambiarpass">
<form action="netboxmusic_cambiarpass_post.php" name="cambiarpass" method="post" enctype="multipart/form-data" onsubmit="return validar();" class="cambiarpass">
	<div><label for="contrasenaAnterior"> Contrase&ntilde;a actual: </label><br/><input type="password" name="contrasenaAnterior" value="" maxlength="41" /></div>
	<br/>
	<div><label for="contrasenaNueva"> Nueva contrase&ntilde;a: </label><br/><input type="password" name="contrasenaNueva" value="" maxlength="41" /></div>
	<div><label for="confirmarcontrasenaNueva"> Confirmar nueva contrase&ntilde;a: </label><br/><input type="password" name="confirmarcontrasenaNueva" value="" maxlength="41" /></div>
	<br/>
    <div>
		<input type="submit" name="perfil" value="Guardar" />
		<input type="reset" name="restablecer" value="Restablecer" />
    </div>
</form>     
</div>



