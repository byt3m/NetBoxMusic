<?php
/**********************************************************************************
Nombre del fichero: adm_eliminar_artistas.php
Descripci�n: fichero del apartado de eliminar artistas. Contiene el c�digo html/php
  necesario para este fragmento.
**********************************************************************************/

//Incluimos el fichero de control y la configuraci�n de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
?>

<!-- BUSCADOR -->
<h2> Eliminar Artistas </h2>
<div id="buscador">
	<label for="tipo_busqueda"> Buscar artistas por: </label>
	<select name="tipo_busqueda" id="tipo_busqueda">
		<option value="" selected>-Seleccionar-</option>
		<option value="nombre">Nombre</option>
		<option value="nacionalidad"> Nacionalidad </option>
		<option value="genero"> G&eacute;nero </option>
	</select>
	<input type="text" id="busqueda_texto" value="" placeholder="Buscar" maxlength="30" size="30" />
	<button type="button" onclick="buscar()">Buscar</button>
	<?php //Mostramos las variables de sesi�n correspondientes.
	echo '<p style="color: red; font-weight: bold;">'.$_SESSION["fallo_busqueda"].'</p>';
	echo '<p style="font-weight: bold;">'.$_SESSION["cantidadresultados"].'</p>';
	?>
</div>
<br/>
<!-- REALIZAR BUSQUEDA -->
<script type="text/javascript">
//<![CDATA['
/*Esta funci�n de nombre buscar() env�a mediante jquary y el m�todo POST
los datos necesarios para realizar la b�squeda, que son enviados
al fichero netboxmusic_buscar_post.php desde donde se realizan
las consultas correspondientes a la base de datos, devolviendo
unas variables de sesi�n, entre ellas, un array que contiene los resultados.
Tras enviar la informaci�n se reescribe el apartado b�squeda mostrando as�
los resultados de la b�squeda o bien un mensaje de error si no los hay.*/ 
function buscar() {
	var texto = document.getElementById("busqueda_texto").value;
	var SelectTipoBusqueda = document.getElementById("tipo_busqueda");
    var ValorTipoBusqueda = SelectTipoBusqueda.options[SelectTipoBusqueda.selectedIndex].value;
	$.post("adm_eliminar_artistas_buscar.php", { busqueda: texto, tipo_busqueda: ValorTipoBusqueda } );
	setTimeout(function(){
		$.post("adm_eliminar_artistas.php", function(data){$("#contenido").html(data);});		
	}, 500);	
}
/*En este apartado de la funci�n buscar() controlamos si el usuario presiona la tecla ENTER.
Como no estamos usando un formulario (por que sino la p�gina se recargar�a
y se perder�a la reproducci�n de la m�sica) hemos escrito este apartado estableciendo
que si se presiona enter cuando el cursor se encuentra enfocado en el input de b�squeda, 
se llama a la funci�n buscar().*/
$("#busqueda_texto").on('keyup', function (e) {
    if (e.keyCode == 13) {
        buscar();
    }
});
//]]>
</script>

<?php if ($_SESSION["resultadoBusqueda"] == array()){echo '';}else{ ?>
<!-- MOSTRAMOS LOS RESULTADOS DE LA BUSQUEDA (array) -->
<style>tr, td, th {border: 1px solid black; margin: 5px; padding: 5px;} th{background-color: #E6E6E6;}</style><!-- Estilo de la tabla -->
<form action="adm_eliminar_artistas_post.php" method="post" name="eliminar"> 
	<center>
	<table border=0>
	<tr><th>ID</th><th>Nombre</th><th>Nacionalidad</th><th>G&eacute;nero</th><th>Momento a&ntilde;adido</th><th>Eliminar</th></tr>
<?php
	$n=count($_SESSION["resultadoBusqueda"]);
	for($i=0; $i<$n; $i++){ echo $_SESSION["resultadoBusqueda"][$i]; }
?>
</table>
</center>
<input class="boton" type="submit" name="eliminar" value="Eliminar" />
</form>
<?php } 
//Restablecemos los valores de las variables de sesi�n para evitar que se muestre informaci�n incorrecta/inservible.
$_SESSION["fallo_busqueda"]=""; $_SESSION["resultadoBusqueda"] = array(); $_SESSION["cantidadresultados"]=""; 
?>