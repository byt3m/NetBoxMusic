<?php
/**********************************************************************************
Nombre del fichero: login.php
Descripción: contiene el formulario de inicio de sesión.
**********************************************************************************/

/*Si no hay información del usuario en la variable de sesión
$_SESSION['informacionusuario'], se muestra el formulario. */
if(!isset($_SESSION['informacionusuario'])) { 
?>
<div id="login">
<form action="login_post.php" name="iniciarsesion" method="post" enctype="multipart/form-data" class="login">
    <div><label>Usuario o email</label></br><input id="nombreusuario" name="user" type="text"/> </div>	
    <div><label>Contrase&ntilde;a</label></br><input id="contrasenausuario" name="password" type="password" /> </div>
    <div>
		<input name="login" type="submit" value="Login" /></br>   
		<a href="#" id="cuentanueva" onclick="comportamiento('cierreloginaperturaregistro');"> Crear una cuenta nueva </a>
	</div>
</form>
</div>
<?php } 
/*En caso contrario, se muestra, se muestra: el nombre, 
tipo de cuenta y un enlace para cerrar la sesión.*/
else { ?>
<p> Sesion iniciada como <?php echo $_SESSION["informacionusuario"][1]; ?>.</p>
<p> Tipo de cuenta <?php if ($_SESSION["informacionusuario"][2] == 1) echo 'Premium.'; else echo 'Silver.'?> </p>
<p><a href="logout.php"> Cerrar sesi&oacute;n </a></p>
<?php } ?>
