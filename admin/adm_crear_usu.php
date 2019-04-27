<?php
/**********************************************************************************
Nombre del fichero: adm_crear_usu.php
Descripción: fichero usado para crear usuarios.
**********************************************************************************/

//Incluimos el fichero de control
include_once 'adm_control.php';
?>

<script type="text/javascript" src="../js/control_formularios/permitidos.js"></script>

<div id="crearusu">
<!-- Formulario para crear usuarios -->
<form action="adm_crear_usu_post.php" method="post" name="crearusu"  onsubmit="return validarCrear();" class="crearusu">
<h2> Crear usuario </h2><br/>

<?php 
//Variables que muestran el resultado
echo $_SESSION["OperacionCrearCorrecta"]; echo $_SESSION["OperacionCrearIncorrecta"]; 
?>

<div><label>Privilegios: </label>
	<select name="privilegios">
		<option name="ususinpriv" value="0"> Usuario sin privilegios </option>
		<option name="admin" value="1"> Administrador </option>
	</select>
</div>
<div><label>Nombre de usuario:</label><br/><input name="usuario" type="text" onkeypress="return permite(event, 'num_car')" maxlength="20" onblur="val_nombre(this.value, 'cnombre');"/></div>
	<div id="cnombre" style="color: red; font-weight: bold;"></div>
<div><label>Contrase&ntilde;a:</label><br/><input name="password" type="password" onkeypress="return permite(event, 'num_car')" maxlength="41" onblur="val_contrasena(this.value, 'ccontrasena');"/></div>
	<div id="ccontrasena" style="color: red; font-weight: bold;"></div>
<div><label>Email:</label><br/><input name="email" type="text" onkeypress="return permite(event, 'num_carCE')" maxlength="25" onblur="val_CE(this.value, 'cCE');"/></div>
	<div id="cCE" style="color: red; font-weight: bold;"></div>
<div><input name="crearusuario" type="submit" value="Crear usuario" /></div>
</form>
</div>

<?php 
//Restablecemos las variables de resultado.
$_SESSION["OperacionCrearCorrecta"] = ""; $_SESSION["OperacionCrearIncorrecta"] = ""; 
?>