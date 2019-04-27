//<![CDATA['

/***********************************************************************************
Nombre del fichero: permitidos.js
Descripción: fichero javascript usado para el control de formularios.
***********************************************************************************/

/*La función permite() establece el tipo de caracteres que se pueden escribir
en un objeto HTML determinado, normalmente en formularios, es decir, inputs 
del tipo texto. El argumento elEvento hace referencia al evento javascript 
que llama a esta función según el evento/acción que tenga lugar, por ejemplo: 
onchange()(cuando el usuario escribe, cada cambio en el texto llama a la función).
Mientras que el argumento permitidos, hace referencia al textos según el cual se 
permiten ciertos caracteres o ninguno.*/
function permite(elEvento, permitidos) {
    // Variables que definen los caracteres permitidos
    var numeros = "0123456789";
	var minusculas = "abcdefghijklmnñopqrstuvwxyz";
	var mayusculas = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
	var caracteres = minusculas+mayusculas;
    var numeros_caracteres = numeros + caracteres;
	var minusculas_numeros = minusculas + numeros;
	var mayusculas_numeros = mayusculas + numeros;
    var teclas_especiales = [8, 9, 37, 39, 46];
	 // 8 = Espacio, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
    // Seleccionar los caracteres a partir del parámetro de la función
	
	var numeros_caracteresCE = numeros_caracteres+'-_@';

    switch(permitidos) {
		case 'num':
		permitidos = numeros;
			break;
		case 'car':
		permitidos = caracteres;
			break;
		case "min":
		permitidos = minusculas;
			break;
		case "may":
		permitidos = mayusculas;
			break;
		case "min_num":
		permitidos = minusculas_numeros;
			break;
		case "may_num":
		permitidos = mayusculas_numeros;
			break;
		case 'num_car':
		permitidos = numeros_caracteres;
			break;
		case 'num_carCE':
		permitidos = numeros_caracteresCE;
			break;
    }
    // Obtener la tecla pulsada
    var evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    var caracter = String.fromCharCode(codigoCaracter);
    // Comprobar si la tecla pulsada es alguna de las teclas especiales
    var tecla_especial = false;
    for(var i in teclas_especiales) {
		if(codigoCaracter == teclas_especiales[i]) {
		tecla_especial = true;
		break;
		}
    }
    // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos o si es una tecla especial
    return permitidos.indexOf(caracter) != -1 || tecla_especial;
}
//]]>