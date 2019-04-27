//<![CDATA['

/***********************************************************************************
Nombre del fichero: registro.js
Descripción: fichero javascript usado para validar el formulario de registro.
***********************************************************************************/

/*
Esta función valida el campo nombre de usuario, si hay algo mal no se envía información a PHP.
	- elemento: elemento que se desea validar.
	- divTexto: div que contiene el texto de error en caso de que algo esté mal.
*/
function val_nombre(elemento, divTexto) {
            if( elemento == null || elemento.length == 0 || /^\s+$/.test(elemento) || elemento.length < 4) {
                document.getElementById(divTexto).innerHTML = "Nombre inv&aacute;lido. Se requieren m&iacute;nimo 4 caracteres.";
                return false;
            }
            else document.getElementById(divTexto).innerHTML = "";
     return elemento;
}

/*
Esta función valida el campo correo electrónico, si hay algo mal no se envía información a PHP.
	- elemento: elemento que se desea validar.
	- divTexto: div que contiene el texto de error en caso de que algo esté mal.
*/
function val_CE(elemento, divTexto) {
	    if( !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(elemento)) ) {
		document.getElementById(divTexto).innerHTML = "La direcci&oacute;n de corre electr&oacute;nico es incorrecta.";
		return false;
	    }
	    else document.getElementById(divTexto).innerHTML = "";
     return elemento;
}

/*
Esta función valida que el los dos emails escritos coinciden.
	- CE1: campo del primer correo electrónico.
	- CE2: campo del segundo correo electrónico.
	- divTexto: div que contiene el texto de error en caso de que algo esté mal.
*/
function val_confirmacion_CE(CE1, CE2, divTexto) {
		var Correo1 = document.getElementById(CE1).value;
		var Correo2 = document.getElementById(CE2).value;
	    if( Correo1 != Correo2) {
			document.getElementById(divTexto).innerHTML = "Las direcciones de correo electr&oacute;nico no coinciden.";
			return false;
	    }
	    else document.getElementById(divTexto).innerHTML = "";
     return CE1;
}

/*Esta última función valida cada campo cuando el usuario envía el formulario.
De esta forma nos aseguramos completamente que no se envía información no deseada.*/
function validarRegistro(){
var fallo = false;

var usuario = document.forms["registrar"]["usuario"].value;
var Email = document.forms["registrar"]["email"].value;
var ConfirmarEmail = document.forms["registrar"]["confirmaremail"].value;
var condiciones = document.forms["registrar"]["condiciones"];

// Nombre
if( usuario == null || usuario.length == 0 || /^\s+$/.test(usuario) || usuario.length < 4) { fallo = true; document.getElementById("tnombre").innerHTML = "Nombre inv&aacute;lido. Se requieren m&iacute;nimo 4 caracteres."; }
// Correo electrónico
if( !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(Email)) ) { fallo = true; document.getElementById("tCE").innerHTML = "La direcci&oacute;n de corre electr&oacute;nico es incorrecta."; }
// Confirmar Correo electrónico
if( Email != ConfirmarEmail) { fallo = true; document.getElementById('tCEC').innerHTML = "Las direcciones de correo electr&oacute;nico no coinciden.";}
// Condiciones
if (!condiciones.checked){ fallo = true; document.getElementById("tcondiciones").innerHTML = "Debe aceptar los terminos y condiciones";}
else document.getElementById("tcondiciones").innerHTML = "";

if (fallo) return false;
}
//]]>