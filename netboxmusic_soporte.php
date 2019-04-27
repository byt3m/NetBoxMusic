<?php
/************************************************************************************
Nombre del fichero: netboxmusic_soporte.php
Descripción: fichero que contiene el formulario para enviar una petición al soporte 
  de netboxmusic.
*************************************************************************************/

//Incluimos el fichero de control y la configuración de la BDD.
include_once 'netboxmusic_control.php';
include_once 'config.php';
?>

<!-- Soporte -->
<div id="soporte">
<h1> Enviar ticket de soporte <h2><br/>
<!-- Formulario Soporte -->
<form action="netboxmusic_soporte_post.php" name="soporte" method="post" enctype="multipart/form-data" onsubmit="return validar();" class="soporte">
	<div>
		<label for="asunto"> Asunto: </label><br/>
		<input type="text" name="asunto" value="" maxlength="40" size="45" />
	</div>

	<div>
		<label for="sugerencia"> Problema/Sugerencia: </label><br/>
		<textarea id="sugerencia" rows=6 cols=60 name="sugerencia" value="" maxlength="300" onkeypress="LimiteCaracteres(this, document.getElementById('caracteresTextArea'), 300);"></textarea>
	</div>	<div id="caracteresTextArea"></div>

    <div>
		<input type="submit" name="enviar" value="Enviar" />
		<input type="reset" name="restablecer" value="Restablecer" />
    </div>
</form>
</div>

<!-- Mostramos en una tabla que contiene un histórico sobre los "tickets" de soporte enviados por el usuario -->
<div id="historial_soporte">
<style>tr, td {margin: 5px; padding: 5px;} th, td, tr {border: 1px solid black;} </style><!-- Estilo de la tabla -->
<center>
<table>
	<tr><th colspan=3> Hist&oacute;rico </th></tr>
	<tr><th> Asunto </th><th> Sugerencia </th></tr>
<?php
//Creamos la sentencia SQL.
$sqlSoporteUsuario = "select asunto, sugerencia from soporte where idusuario=".$_SESSION['informacionusuario']["id"];;
$resultado = mysqli_query($conn, $sqlSoporteUsuario);
//Si existen resultados los mostramos.
if (mysqli_num_rows($resultado) > 0) {
	mysqli_data_seek($resultado, 0);
	while($fila = mysqli_fetch_assoc($resultado)) {
		echo '<tr><td>'.$fila["asunto"].'</td><td>'.$fila["sugerencia"].'</td></tr>';
	}
}
//Si no hay resultados mostramos una tabla "vacía".
else {
	echo '<tr><td>-</td><td>-</td><td>-</td></tr>';
}
?>
</table>
</center>
</div>


