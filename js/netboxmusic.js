//<![CDATA['

/***************************************************************
Nombre del fichero: netboxmusic.js
Descripción: fichero javascript usado en el área de clientes.
****************************************************************/

/*La función recargar() es la que se encarga del contenido de la página.
Mediante JQuery podemos actualizar dicho contenido sin recargar, incluso podemos
enviar información a PHP mediante el método POST sin necesidad de llevar a cabo
esta acción. Por lo tanto, evitamos "parones" en la música que pueda estar escuchando 
el usuario al mismo tiempo que navega por la página.*/
function recargar(pagina){	
	/*Mediante el método post, se envía a si mismo el contenido
	que escribirá en el div escogido, en netboxmusic usamos
	el contenedor "contenido" para escribir los cambios. Sin embargo,
	al no recargar la página el código fuente no cambia, con lo cual
	tenemos un pequeño plus de seguridad. El argumento "pagina" hace 
	referencia al fichero cuyo contenido queremos aplicar.*/ 
	$.post(pagina, function(data){
	$("#contenido").html(data);
	});			
}

/*La función LimiteCaracteres() escribe el límite de caracteres restantes 
en un cuadro de tipo texto en HTML, como por ejemplo un input o un textarea.*/
function LimiteCaracteres(Elemento, Elemento2, MaxCaracteres){
	/*El argumento "Elemento" hace referencia al objeto que contiene
	el texto del cual se desea calcular los caracteres restantes.
	El argumento "Elemento2" es el objeto en el cual escribiremos
	dichos caracteres restantes. Mientras que el argumento 
	"MaxCaracteres" hace referencia al número máximo de carateres, es 
	decir, es el límite.
	Nota: dicho límite no se aplica al objeto html "Elemento", sino que 
	se debe aplicar manualmente en el objeto deseado, por lo tanto, deducimos
	que el parámetro MaxCaracteres solo es conceptual y usado en la función, 
	no se aplica en ningún otro sitio.*/
	var LongitudTexto = Elemento.value.length;
	var diferenciaTexto = MaxCaracteres - LongitudTexto;
	Elemento2.innerHTML = (diferenciaTexto + " caracteres.");
}
//]]>