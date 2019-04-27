//<![CDATA['

/***************************************************************
Nombre del fichero: portada.js
Descripción: fichero javascript usado la portada de la página.
****************************************************************/

//Parámetros que contiene el id de los elementos a usar más adelante.
var cerrar = ['cerrarlogin', 'cerrarinformacion'];
var mostrar = ['mostrarlogin', 'mostrarinformacion'];
var flotante = ['flotantelogin', 'flotanteinformacion'];
var animar = ['animarlogin', 'animarinformacion'];
var nombreusuario = ['nombreusuario'];

//Al cargar la página, escondemos cada flotante, es decir, cada ventana.
window.onload = function() {
	for (var i in flotante){
		$('#'+flotante[i]).hide();
	}
}

/*La función comportamiento() se encarga de mostrar u esconder las
ventanas o flotantes según las acciones del usuario configuradas 
en html. El argumento tipo nombra el tipo de acción, por ejemplo:
si un usuario desea loguearse y hace clic en el icono de login, se 
ejecuta la funcion comportamiento("mostrarlogin") que se encargará
de desplazar la ventana hasta que esta sea visible por el usuario.*/
function comportamiento(tipo){
	// Mostrar/Esconder el contenido flotante dependiendo del tipo y de la accion del usuario
	for (var i in mostrar){
		if (tipo==mostrar[i]){
			//Mediante JQuery leemos los objetos cuyos ID corresponden a los parámetros anteriores.
			//De ahí que usemos un bucle "for" de arrays.
			
			//Mostramos el flotante.
			$('#'+flotante[i]).show();
			//Desplazamos dicho flotante para que sea visible por el usuario.
			$('#'+animar[i]).animate({marginTop: "-152px"});
			//Mostramos el div fondo, que aplica el fondo oscurecido.
			$('#fondo').show();
			//Si abrimos la ventana de login, enfocamos el puntero en el nombre de usuario.
			if(tipo=="mostrarlogin") $('#'+nombreusuario[i]).focus();
		}
		else if (tipo==cerrar[i]){
			$('#'+animar[i]).animate({
				marginTop: "-1756px"
			});
			setTimeout(function(){
				$('#'+flotante[i]).hide();
				$('#fondo').hide();
			},500)
		}
		//REGISTRO
		/*Debido a su tamaño, el margen de este debe ser superior para que se 
		vea correctamente. Por ello, se trabaja a parte de los demás.*/
		if (tipo=='mostrarregistro'){
			$('#flotanteregistro').show();
			$('#animarregistro').animate({marginTop: "-600px"});
			$('#fondo').show();
			$('#usuario').focus();
		}
		else if (tipo=='cerrarregistro'){
			$('#animarregistro').animate({
				marginTop: "-1756px"
			});
			setTimeout(function(){
				$('#flotanteregistro').hide();
				$('#fondo').hide();
			},500)
		}
	}
	
	// Cerrar todo.
	if (tipo=='cerrartodo'){
		for (var i in flotante){
			$('#'+animar[i]).animate({
				marginTop: "-1756px"
			});
			setTimeout(function(){
				$('#'+flotante[i]).hide();
				$('#fondo').hide();
			},500);
			$('#animarregistro').animate({
				marginTop: "-1756px"
			});
			setTimeout(function(){
				$('#flotanteregistro').hide();
				$('#fondo').hide();
			},500)
		}
	}
	
	// Alternar entre el formulario de login y de registro sin necesidad de volver al inicio
	if (tipo=='cierreloginaperturaregistro'){
		//cierra login
		$('#animarlogin').animate({marginTop: "-756px"});
		setTimeout(function(){
			$('#flotantelogin').hide();	
		},300)
		//abre registro
		$('#flotanteregistro').show();
		$('#animarregistro').animate({marginTop: "-600px"});
		$('#usuario').focus();
	}
	else if (tipo=='cierreregistroaperturalogin'){
		//cierra registro
		$('#animarregistro').animate({marginTop: "-756px"});
		setTimeout(function(){
			$('#flotanteregistro').hide();	
		},300)
		//abre login
		$('#flotantelogin').show();
		$('#animarlogin').animate({marginTop: "-152px"});
		$('#nombreusuario').focus();
	}
}

//]]>


