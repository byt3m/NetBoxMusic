<?php
/**********************************************************************************
Nombre del fichero: adm_mod_generos.php
Descripción: fichero del apartado de modificar géneros. Contiene el código html/php
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
			var nombrex = document.getElementById("nombre".concat(x));
			var fecha_adicionx = document.getElementById("fecha_adicion".concat(x));
			var t1x = document.getElementById("t1".concat(x));
			var t2x = document.getElementById("t2".concat(x));
			var t3x = document.getElementById("t3".concat(x));
			var t4x = document.getElementById("t4".concat(x));
			
			idx.readOnly = true;
			nombrex.readOnly = true;
			fecha_adicionx.readOnly = true;
			
			idx.style = "background-color: #D0D0D0;";
			nombrex.style = "background-color: white;";
			fecha_adicionx.style = "background-color: #D0D0D0;";
			
			t1x.style = "background-color: #D0D0D0;";
			t2x.style = "background-color: white;";
			t3x.style = "background-color: #D0D0D0;";
		}
	}
	
	/*Esta función desbloquea los inputs necesarios cuando su botón
	de radio correspondiente es seleccionado.*/
	function escritura(radio, i) {
		bloquearInputs();
		
		if (radio.checked) {		
			document.getElementById("nombre".concat(i)).readOnly = false;
			document.getElementById("nombre".concat(i)).style = "background-color: #FFFFA0;";
			document.getElementById("t2".concat(i)).style = "background-color: #FFFFA0;";
		}
	}
	//]]>
	</script>

<?php echo $_SESSION["OperacionModificarCorrecta"]; echo $_SESSION["OperacionModificarIncorrecta"]; ?>

<div id="tnombre" style="color: red; font-weight: bold;"></div>
<div id="tCE" style="color: red; font-weight: bold;"></div>

<div id="modusu">
	<center>
	<form action="adm_mod_generos_post.php" method="post" name="modificar"> 
	<h2> Modificar G&eacute;neros </h2>
	
	<table>

	<tr>
	
	<?php 
	//Recogemos los géneros de la BDD y los mostramos.
	$sqlModGeneros = "SELECT id, nombre, fecha_adicion from generos;";
	$resultadoModGeneros = mysqli_query($conn, $sqlModGeneros);
	
	if ($fila = mysqli_fetch_assoc($resultadoModGeneros)){ 
	foreach($fila as $x => $x_value) {
		if ($x == "id") echo '<th><a href="#" style="text-decoration: none; color: black;"> ID </a></th>';
		else if ($x == "nombre") echo '<th><a href="#" style="text-decoration: none; color: black;"> Nombre </a></th>';
		else if ($x == "fecha_adicion") echo '<th><a href="#" style="text-decoration: none; color: black;"> Momento a&ntilde;adido </a></th>';
		else {
	?>
		<th><?php echo $x ?></th>
	<?php }}} ?>
		<th> <a href="#" style="text-decoration: none; color: black;" > Modificar </a></th> </th>
	</tr>
	
	
	<?php
	
	if (mysqli_num_rows($resultadoModGeneros) > 0) {
		$i = 0;
		mysqli_data_seek($resultadoModGeneros, 0);
		while($fila = mysqli_fetch_assoc($resultadoModGeneros)) {
		$registro[$i] = array($fila["nombre"]);
	?>	
		<tr>
			<td id="t1<?php echo $i ?>"><input type="text" id="id<?php echo $i ?>" name="id[]" value="<?php echo $fila["id"] ?>" readOnly /></td>
			<td id="t2<?php echo $i ?>"><input type="text" id="nombre<?php echo $i ?>" name="nombre[]" value="<?php echo $fila["nombre"] ?>" maxlength="20" size="20" onkeypress="return permite(event, 'num_car')" /></td>
			<td id="t3<?php echo $i ?>"><input type="text" id="fecha_adicion<?php echo $i ?>" name="fecha_adicion[]" value="<?php echo $fila["fecha_adicion"] ?>" maxlength="25" size="25" onkeypress="return permite(event, 'num_carCE')" readOnly /></td>
			<td id="t4<?php echo $i ?>" ><input type="radio" id="radio<?php echo $i ?>" name="radio[]" value="" onchange="escritura(this, <?php echo $i ?>);" /></td>
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

<?php $_SESSION["OperacionModificarCorrecta"] = ""; $_SESSION["OperacionModificarIncorrecta"] = ""; ?>