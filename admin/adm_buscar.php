<?php
/**********************************************************************************
Nombre del fichero: adm_buscar.php
Descripci�n: contiene el buscador.
**********************************************************************************/

//Incluimos el fichero de control y la configuraci�n de la BDD.
include_once 'adm_control.php'; include_once 'config.php';
?>

<!-- Tipo de busqueda -->
<script type="text/javascript">
//<![CDATA['
/*Con esta funci�n, controlamos lo que se muestra seg�n el tipo de b�squeda
que realiza el usuario, si es fecha se muestran los calendarios, si no
se muestra un input de texto normal.*/
function tipoBusqueda() {
    var SelectTipoBusqueda = document.getElementById("tipo_busqueda");
    var ValorTipoBusqueda = SelectTipoBusqueda.options[SelectTipoBusqueda.selectedIndex].value;

	if (ValorTipoBusqueda=="fecha"){
		document.getElementById("busqueda_fecha1").style.display="";
		document.getElementById("busqueda_fecha2").style.display="";
		document.getElementById("busqueda_texto").style.display="none";
	}
	else {
		document.getElementById("busqueda_fecha1").style.display="none";
		document.getElementById("busqueda_fecha2").style.display="none";
		document.getElementById("busqueda_texto").style.display="";
	}
}
//]]>
</script>

<!-- BUSCADOR -->
<!-- La funci�n inicializarCalendario() se usa para establecer los par�metros de este.
Al cambiar la opci�n en la lista, inicializamos el primer calendario, mientras que
al seleccionar la primera fecha y cambiar a la segunda, se inicializa el segundo. -->
<div id="buscador">
	<label for="tipo_busqueda"> Buscar canciones  por: </label>
	<select id="tipo_busqueda" onchange="tipoBusqueda(); inicializarCalendario('busqueda_fecha1');">
		<option value="" selected>-Seleccionar-</option>
		<option value="cancion">T&iacute;tulo</option>
		<option value="genero"> G&eacute;nero </option>
		<option value="artista">Artista</option>
		<option value="fecha">Fecha</option>
	</select>
	<!-- Si la busqueda es por cancion, genero o artista -->
	<input type="text" id="busqueda_texto" value="" placeholder="Buscar" maxlength="30" size="30" />
	<!---->
	<!-- Si la busqueda es por fecha -->
	<input type="text" id="busqueda_fecha1" style="display: none;" placeholder="Inicio" onblur="inicializarCalendario('busqueda_fecha2');" maxlength=8 size=8 />
	<input type="text" id="busqueda_fecha2" style="display: none;" placeholder="Fin" maxlength=8 size=8/>
	<!---->
	<button type="button" onclick="buscar()">Buscar</button>
	<?php 
	/*Imprimimos las variables de sesi�n correspondientes que muestran
	la cantidad de resultados encontrados y un mensaje de error si no los hay.*/
	echo '<p style="color: red; font-weight: bold;">'.$_SESSION["fallo_busqueda"].'</p>';
	echo '<p style="font-weight: bold;">'.$_SESSION["cantidadresultados"].'</p>';
	?>
</div>
<br/>
<!-- REALIZAR BUSQUEDA -->
<script type="text/javascript">
//<![CDATA['
/*Esta funci�n se utiliza para "voltear" las fechas, ya que 
en MySQL el formato de fecha es AA/MM/DD.*/
function reverse(string){
    return string.split("-").reverse().join("-");
}
/*Esta funci�n de nombre buscar() env�a mediante jquery y el m�todo POST
los datos necesarios para realizar la b�squeda, que son enviados
al fichero "adm_buscar_post.php" desde donde se realizan
las consultas correspondientes a la base de datos, devolviendo
unas variables de sesi�n, entre ellas, un array que contiene los resultados.
Tras enviar la informaci�n se muestran los resultados de la b�squeda o bien 
un mensaje de error si no los hay.*/ 
function buscar() {
	var fechainicio = document.getElementById("busqueda_fecha1").value;
	var fechafin = document.getElementById("busqueda_fecha2").value;
	var fechainicioReverse = reverse(fechainicio);
	var fechafinReverse = reverse(fechafin);
	var texto = document.getElementById("busqueda_texto").value;
	var SelectTipoBusqueda = document.getElementById("tipo_busqueda");
    var ValorTipoBusqueda = SelectTipoBusqueda.options[SelectTipoBusqueda.selectedIndex].value;
	$.post("adm_buscar_post.php", { busqueda: texto, tipo_busqueda: ValorTipoBusqueda, fecha1: fechainicioReverse, fecha2: fechafinReverse } );
	setTimeout(function(){
		$.post("adm_buscar.php", function(data){$("#contenido").html(data);});		
	}, 500);	
}
/*En este apartado de la funci�n buscar() controlamos si el usuario presiona la tecla ENTER.
Como no estamos usando un formulario (por que sino la p�gina se recargar�a
y se perder�a la reproducci�n de la m�sica) hemos escrito este apartado estableciendo
que si se presiona enter cuando el cursor se encuentra enfocado en el input de b�squeda, 
se llama a la funci�n buscar(), de esta forma se puede usar la tecla ENTER para realizar la b�squeda.*/
$("#busqueda_texto").on('keyup', function (e) {
    if (e.keyCode == 13) {
        buscar();
    }
});
//]]>
</script>

<!-- MOSTRAMOS LOS RESULTADOS DE LA BUSQUEDA (array) -->
<?php
$n=count($_SESSION["resultadoBusqueda"]);

for($i=0; $i<$n; $i++){
	echo $_SESSION["resultadoBusqueda"][$i];
}

/*Restablecemos los valores de las variables de sesi�n para evitar 
que se muestre informaci�n incorrecta/inservible al cambiar de una
p�gina a otra, por ejemplo: realizar una b�squeda, cambiar a artistas
y volver al buscador.*/
$_SESSION["fallo_busqueda"]=""; $_SESSION["resultadoBusqueda"] = array(); $_SESSION["cantidadresultados"]=""; 
?>