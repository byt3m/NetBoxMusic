//<![CDATA['

/***********************************************************************************
Nombre del fichero: validacion.js
Descripción: fichero javascript usado para validar formularios.
***********************************************************************************/

function val_nombre(elemento, divTexto) {
            if( elemento == null || elemento.length == 0 || /^\s+$/.test(elemento) || elemento.length < 4) {
                document.getElementById(divTexto).innerHTML = "Nombre inv&aacute;lido. Se requieren m&iacute;nimo 4 caracteres.";
                return false;
            }
            else document.getElementById(divTexto).innerHTML = "";
     return elemento;
}

function val_contrasena(elemento, divTexto) {
            if( elemento == null || elemento.length == 0 || /^\s+$/.test(elemento) || elemento.length < 4) {
                document.getElementById(divTexto).innerHTML = "Contrase&ntilde;a inv&aacute;lida. Se requieren m&iacute;nimo 4 caracteres.";
                return false;
            }
            else document.getElementById(divTexto).innerHTML = "";
     return elemento;
}


function val_CE(elemento, divTexto) {
	    if( !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(elemento)) ) {
		document.getElementById(divTexto).innerHTML = "La direcci&oacute;n de corre electr&oacute;nico es incorrecta.";
		return false;
	    }
	    else document.getElementById(divTexto).innerHTML = "";
     return elemento;
}

function validarCrear(){
var fallo = false;

var nombreusuario = document.forms["crearusu"]["usuario"].value;
var contrasena = document.forms["crearusu"]["password"].value;
var Email = document.forms["crearusu"]["email"].value;

// Nombre
if( nombreusuario == null || nombreusuario.length == 0 || /^\s+$/.test(nombreusuario) || nombreusuario.length < 4) { fallo = true; document.getElementById("cnombre").innerHTML = "Nombre inv&aacute;lido. Se requieren m&iacute;nimo 4 caracteres."; }
// Contraseña
if( contrasena == null || contrasena.length == 0 || /^\s+$/.test(contrasena) || contrasena.length < 4) { fallo = true; document.getElementById("ccontrasena").innerHTML = "Contrase&ntilde;a inv&aacute;lido. Se requieren m&iacute;nimo 4 caracteres."; }
// Correo electrónico
if( !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(Email)) ) { fallo = true; document.getElementById("cCE").innerHTML = "La direcci&oacute;n de corre electr&oacute;nico es incorrecta."; }

if (fallo) return false;
}
//]]>