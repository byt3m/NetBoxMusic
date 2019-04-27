<?php
/**********************************************************************************
Nombre del fichero: adm_mod_usu.php
Descripción: fichero del apartado de modificar usuarios. Contiene el código html/php
  necesario para este fragmento.
**********************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
?>

<script type="text/javascript">
    //<![CDATA[
	//Al cargar la página, se bloquean los inputs de la tabla.
	window.onload = function() {
		bloquearInputs();
	}

	/*Esta función, controla que los campos input del formulario de la tabla
	se encuentre bloqueados o no según nuestras necesidades y según las acciones
	del usuario administrador.*/
	function bloquearInputs(){
		var cuantos = document.getElementById("valorI").value;
		
		for(var x=0; x<cuantos; x++){	
			var idx = document.getElementById("id".concat(x));	
			var nombreusuariox = document.getElementById("nombreusuario".concat(x));
			var emailusuariox = document.getElementById("emailusuario".concat(x));
			var privilegiosx = document.getElementById("privilegios".concat(x));
			var t1x = document.getElementById("t1".concat(x));
			var t2x = document.getElementById("t2".concat(x));
			var t3x = document.getElementById("t3".concat(x));
			var t5x = document.getElementById("t5".concat(x));
			var t6x = document.getElementById("t6".concat(x));
			var t7x = document.getElementById("t7".concat(x));
			
			nombreusuariox.readOnly = true;
			emailusuariox.readOnly = true;
			privilegiosx.readOnly = true;
			
			idx.style = "background-color: #D0D0D0;";
			nombreusuariox.style = "background-color: white;";
			emailusuariox.style = "background-color: white;";
			privilegiosx.style = "background-color: white;";
			
			t1x.style = "background-color: #D0D0D0;";
			t2x.style = "background-color: white;";
			t3x.style = "background-color: white;";
			t5x.style = "background-color: white;";
			t6x.style = "background-color: none;";
			t7x.style = "background-color: none;";
		}
	}
	
	/*Esta función desbloquea los inputs necesarios cuando su botón
	de radio correspondiente es seleccionado.*/
	function escritura(radio, i) {
		bloquearInputs();
		
		if (radio.checked) {		
			document.getElementById("nombreusuario".concat(i)).readOnly = false;
			document.getElementById("emailusuario".concat(i)).readOnly = false;

			document.getElementById("privilegios".concat(i)).readOnly = false;
			document.getElementById("nombreusuario".concat(i)).style = "background-color: #FFFFA0;";
			document.getElementById("emailusuario".concat(i)).style = "background-color: #FFFFA0;";
			document.getElementById("privilegios".concat(i)).style = "background-color: #FFFFA0;";
			document.getElementById("t2".concat(i)).style = "background-color: #FFFFA0;";
			document.getElementById("t5".concat(i)).style = "background-color: #FFFFA0;";
		}
	}
	
	//Validamos el formulario y su contenido antes de enviar información a la BDD:
	function validarModificar(){
		var fallo = false;
		
		var cuantos = document.getElementById("valorI").value;
		for(var x=0; x<cuantos; x++){
			var usuariox = document.forms["modificar"]["nombreusuario".concat(x)].value;
			var Emailx = document.forms["modificar"]["emailusuario".concat(x)].value;
			// Nombre
			if( usuariox == null || usuariox.length == 0 || /^\s+$/.test(usuariox) || usuariox.length < 4) { fallo = true; document.getElementById("tnombre").innerHTML = "Nombre inv&aacute;lido."; }
			// Correo electrónico
			if( !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(Emailx)) ) { fallo = true; document.getElementById("tCE").innerHTML = "La direcci&oacute;n de corre electr&oacute;nico es incorrecta."; }
		}
	
		if (fallo) return false;
	}
	
	//]]>
	</script>

<?php echo $_SESSION["OperacionModificarCorrecta"]; echo $_SESSION["OperacionModificarIncorrecta"]; echo $_SESSION["OperacionEliminarCorrecta"]; echo $_SESSION["OperacionEliminarIncorrecta"]; ?>

<div id="tnombre" style="color: red; font-weight: bold;"></div>
<div id="tCE" style="color: red; font-weight: bold;"></div>

<div id="modusu">
	<center>
	<form action="adm_mod_usu_post.php" method="post" name="modificar" onsubmit="return validarModificar();"> 
	<h2> Modificar/Eliminar usuarios </h2>
	
	<table>

	<tr>
	
	<?php 
	$sqlModUsu = "SELECT id, nombreusuario, emailusuario, privilegios from usuarios;";
	$resultadoModUsu = mysqli_query($conn, $sqlModUsu);
	
	if ($fila = mysqli_fetch_assoc($resultadoModUsu)){ 
	foreach($fila as $x => $x_value) {
		if ($x == "id") echo '<th><a href="#" style="text-decoration: none; color: black;" class="ayuda" title="ID de los usuarios."> ID </a></th>';
		else if ($x == "nombreusuario") echo '<th><a href="#" style="text-decoration: none; color: black;" class="ayuda" title="Nombre de los usuarios."> Nombre </a></th>';
		else if ($x == "emailusuario") echo '<th><a href="#" style="text-decoration: none; color: black;" class="ayuda" title="Email de los usuarios."> Email </a></th>';
		else if ($x == "privilegios") echo '<th><a href="#" style="text-decoration: none; color: black;" class="ayuda" title="0=Sin privilegios.  1=Administrador."> Privilegios </a></th>';
		else {
	?>
		<th><?php echo $x ?></th>
	<?php }}} ?>
		<th> <a href="#" style="text-decoration: none; color: black;" > Modificar </a></th> </th>
		<th> <a href="#" style="text-decoration: none; color: black;" > Eliminar </a></th> </th>
	</tr>
	
	
	<?php
	
	if (mysqli_num_rows($resultadoModUsu) > 0) {
		$i = 0;
		mysqli_data_seek($resultadoModUsu, 0);
		while($fila = mysqli_fetch_assoc($resultadoModUsu)) {
		$registro[$i] = array($fila["id"], $fila["nombreusuario"], $fila["emailusuario"], $fila["privilegios"]);
	?>	
		<tr>
			<td id="t1<?php echo $i ?>"><input type="text" id="id<?php echo $i ?>" name="id[]" value="<?php echo $fila["id"] ?>" readOnly /></td>
			<td id="t2<?php echo $i ?>"><input type="text" id="nombreusuario<?php echo $i ?>" name="nombreusuario[]" value="<?php echo $fila["nombreusuario"] ?>" maxlength="20" size="20" onkeypress="return permite(event, 'num_car')" /></td>
			<td id="t3<?php echo $i ?>"><input type="text" id="emailusuario<?php echo $i ?>" name="emailusuario[]" value="<?php echo $fila["emailusuario"] ?>" maxlength="25" size="25" onkeypress="return permite(event, 'num_carCE')" /></td>
			<td id="t5<?php echo $i ?>"><input type="text" id="privilegios<?php echo $i ?>" name="privilegios[]" value="<?php echo $fila["privilegios"] ?>" onkeypress="return permite(event, 'num')" maxlength="1" /></td>
			<td id="t6<?php echo $i ?>" ><input type="radio" id="radio<?php echo $i ?>" name="radio[]" value="" onchange="escritura(this, <?php echo $i ?>);" /></td>
			<td id="t7<?php echo $i ?>"><input type="checkbox" name="AGD[]" value="<?php echo $fila["id"] ?>" /></td>
		</tr>
		
	<?php $i++; } ?>
	
	<input type="hidden" id="valorI" value="<?php echo $i ?>"/>
	
<?php } $_SESSION["registro"]=$registro; $_SESSION["cuantos"]=$i; ?>
	
		<tr > 
			<td style="border: 0px;" colspan=6><center><input id="modificar" type="submit" name="modificar" value="Realizar cambios"></center></td>
		</tr>
	</table><br/>
	</form>
	</center>
</div>


<?php
$_SESSION["OperacionModificarCorrecta"] = "";
$_SESSION["OperacionModificarIncorrecta"] = "";
$_SESSION["OperacionEliminarCorrecta"] = "";
$_SESSION["OperacionEliminarIncorrecta"] = "";
?>