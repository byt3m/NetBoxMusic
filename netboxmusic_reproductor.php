<?php
/************************************************************************************
Nombre del fichero: netboxmusic_reproductor.php
Descripción: fichero que contiene todo lo relacionado con el reproductor HTML5 de la
  aplicación excepto estilos.
*************************************************************************************/

//Incluimos la configuración de la BDD.
include_once 'config.php';
?>

<!-- REPRODUCTOR (parte HTML del reproductor) -->
<center><div id="reproductor"  class="gradient">
	<!-- Reproducir -->
	<a class="button gradient" id="play" href="#" title="Play"></a>
	<!-- Pausar -->
	<a class="button gradient" id="pause" href="#" title="Pause" style="display: none;"></a>
	<!-- Silenciar -->
	<a class="button gradient" id="mute" href="#" title="Mute"></a>
	<!-- Silenciado/Hacer sonar -->
	<a class="button gradient" id="muted" href="#" title="Muted" style="display: none;"></a>
	<!-- Parar reproducción -->
	<a class="button gradient" id="stop" href="#" title="Stop"></a>
	<!-- Barra de progreso -->
	<div id="progressbar"></div><br>
	<!-- Barra de volumen -->
	<div id="volume"></div><br>	
	<!-- Información sobre la reproducción (título y tiempo/duración) -->
	<div id="info"><p id="titulo"></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p id="tiempoactual"></p></div>
</div></center>

<!-- Javascript -->
<script type="text/javascript"> 
//<![CDATA['
/*Aquí creamos las funciones que permiten la reproducción 
de cada canción así como el envío de información al fichero
netboxmusic_contador.php para sumar uno al contador de la BDD
cada vez que se reproduce una canción.*/

//Inicializamos el reproductor.
var reproductor = new Audio();
<?php
//Creamos la sentencia SQL.
$sqlreproducir = "SELECT c.id, c.titulo, c.ruta, a.rutaimagen From canciones c join artistas a where c.idartista = a.id;";
$resultadoreproducir = mysqli_query($conn, $sqlreproducir);
/*Si existen resultados, imprimimos una función por cada canción mostrada en la página.
Dicha función es usada para decirle al reproductor que canción se desea
reproducir al hacer click en la imagen.*/
if (mysqli_num_rows($resultadoreproducir) > 0) {
	mysqli_data_seek($resultadoreproducir, 0);
	while($fila = mysqli_fetch_assoc($resultadoreproducir)) {
		echo '
		function reproducir'.$fila["id"].'() {
			$.post( "netboxmusic_contador.php", { id: "'.$fila["id"].'" } );
			reproductor.src= "music/artist/'.$fila["ruta"].'";
			reproductor.play();
			document.getElementById("titulo").innerHTML = "'.$fila["titulo"].'";
			document.getElementById("pause").style.display = "";
			document.getElementById("play").style.display = "none";
			$("#stop").fadeIn(300);
		}
		';
	}
}
?>

//Funciones de los botones, realizado mediante Jquery.

//Reproducir
$('#play').on('click', function(e) {
	e.preventDefault();
	reproductor.play();
	document.getElementById("pause").style.display = "";
	document.getElementById("play").style.display = "none";
	$('#stop').fadeIn(300);
});
//Pausar
$('#pause').on('click',function(e) {
	e.preventDefault();
	reproductor.pause();
	document.getElementById("pause").style.display = "none";
	document.getElementById("play").style.display = "";
});
//Silenciar
$('#mute').on('click', function(e) {
	e.preventDefault();
	reproductor.volume = 0;
	document.getElementById("mute").style.display = "none";
	document.getElementById("muted").style.display = "";
});
//Silenciado/Hacer sonar
$('#muted').on('click', function(e) {
	e.preventDefault();
	reproductor.volume = 1;
	document.getElementById("muted").style.display = "none";
	document.getElementById("mute").style.display = "";
});
//Parar
$('#stop').click(function(e) {
	e.preventDefault();
	reproductor.pause();
	reproductor.currentTime = 0;
	$('#stop').fadeOut(300);
	document.getElementById("pause").style.display = "none";
	document.getElementById("play").style.display = "";
});

//Funciones de las barras de progreso y volumen
$(function() {
  var $vol = $('#volume'),//Volumen
      $bar = $("#progressbar"),//Progreso
      AUDIO = reproductor;//Reproductor
  
  AUDIO.volume = 0.75;
  AUDIO.addEventListener("timeupdate", progress, false);
  
  function progress() {
    $bar.slider('value', ~~(100/AUDIO.duration*AUDIO.currentTime));
  }

  $vol.slider( {
    value : AUDIO.volume*100,
    slide : function(ev, ui) {
      $vol.css({background:"hsla(180,"+ui.value+"%,50%,1)"});
      AUDIO.volume = ui.value/100; 
    } 
  });
   
  $bar.slider( {
    value : AUDIO.currentTime,
    slide : function(ev, ui) {
      AUDIO.currentTime = AUDIO.duration/100*ui.value;
    }
  });
  
  AUDIO.addEventListener('timeupdate',function (){
	curtime = parseInt(song.currentTime, 10);
  });
});

/*La funcion formatSecondsAsTime() es utilizada para convertir el tiempo
recibido del reproductor en segundos al formato 00:00
de segundos y minutos.*/
function formatSecondsAsTime(secs) {
  var hr  = Math.floor(secs / 3600);
  var min = Math.floor((secs - (hr * 3600))/60);
  var sec = Math.floor(secs - (hr * 3600) -  (min * 60));

  if (min < 10){ 
    min = "0" + min; 
  }
  if (sec < 10){ 
    sec  = "0" + sec;
  }
  
  return min + ':' + sec;
}

//Al actualizar en tiempo real, llamamos a la función ActualizarTiempo();
reproductor.ontimeupdate = function() {ActualizarTiempo()};
/*La función ActualizarTiempo() es usada para escribir en la página el
tiempo restante y duración de la canción así como parar el reproductor 
y poner el tiempo a 0 una vez la canción haya terminado.*/
function ActualizarTiempo() {
	var tiempo = formatSecondsAsTime(reproductor.currentTime);
	var duracion = formatSecondsAsTime(reproductor.duration);
    document.getElementById("tiempoactual").innerHTML = tiempo+" - "+duracion;
	if (tiempo == duracion){	
		reproductor.pause();
		reproductor.currentTime = 0;
		$('#stop').fadeOut(300);
		document.getElementById("pause").style.display = "none";
		document.getElementById("play").style.display = "";
	}
}
//]]>
</script>