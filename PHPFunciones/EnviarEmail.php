<?php 
/**********************************************************************************
Nombre del fichero: EnviarEmail.php
Descripción: contiene las funciones relativas a Email.
**********************************************************************************/

/*Creamos una función para poder enviar Emails de forma cómoda desde
cualquier parte del codigo siempre y cuando se incluya este fichero
y se haga la llamada a la función de forma adecuada.
	$destinatario: destinatario del mensaje.
	$sujeto: sujeto/razón de ser del mensaje.
	$mensaje: contenido del mensaje.
*/
function EnviarEmail($destinatario, $sujeto, $mensaje) {
	//Incluimos la configuración de la base datos para acceder a la información necesaria.
	include("config.php");
	//Sacamos la informacion necesaria de la base de datos
	$sqlAutenticacion = "SELECT * from info_correo where direccion_correo='';";
	$resultadoAutenticacion = mysqli_query($conn, $sqlAutenticacion);
	if (mysqli_num_rows($resultadoAutenticacion) > 0) {
		mysqli_data_seek($resultadoAutenticacion, 0);
		while($fila = mysqli_fetch_assoc($resultadoAutenticacion)) {
			$direccion_correo = $fila["direccion_correo"];
			$contrasena_correo = $fila["contrasena_correo"];
			$host_smtp = $fila["host_smtp"];
		}
	}
	/*Iniciamos/incluimos PHPMailer que es orientado a objetos.
	(Programa obtenido de los repositorios de github)*/
	require_once "PHPMailer/autoload.php";
	//Creamos la instancia sobre PHPMailer
	$mail = new PHPMailer;
	//Activar SMTP debugging. 
	$mail->SMTPDebug = 3;                               
	//Usar SMTP.
	$mail->isSMTP();            
	//Nombre de host SMTP                         
	$mail->Host = $host_smtp;
	//Activamos la autenticación
	$mail->SMTPAuth = true;                          
	//Nombre de usuario y contraseña para autenticarse, cogemos los datos de la BDD para mayor seguridad.
	$mail->Username = $direccion_correo;             
	$mail->Password = $contrasena_correo;
	//Usaremos encriptación de los datos en TLS
	$mail->SMTPSecure = "tls";                           
	//Puerto TCP SMTP al que conectarse
	$mail->Port = 587;                                   
	//Parametros del correo
	$mail->From = $direccion_correo;
	$mail->FromName = "Netboxmusic";
	$mail->addAddress($destinatario);
	/*El contenido del mensaje se enviará como html, 
	de forma que podemos personalizarlo con libertad.*/
	$mail->isHTML(true);
	//Sujeto/Asunto del mensaje.
	$mail->Subject = $sujeto;
	//Cuerpo del mensaje.
	$mail->Body = $mensaje;

	if(!$mail->send()) 
		return "<script> alert('Ha ocurrido un problema al enviar el mensaje.') </script>"; 
		//"Mailer Error: " . $mail->ErrorInfo;
}

/*Hemos creado dos funciones que contienen
la información necesaria que se enviará dependiendo de la acción
del usuario. Estas funciones han sido creadas para obtener un
mejor acceso a la información que se necesita enviar en cada caso
	$opcion: valor del cual se desea extraer contenido según la necesidad.
	$datos: información extra que se desee añadir, según necesidades.
*/
function MensajesCorreo($opcion, $datos){
	if($opcion=="Registro")
		return 	"
				<h3>Gracias por registrarse en netboxmusic</h3>
				<p>Para iniciar sesi&oacute;n, utilice la siguiente contrase&ntilde;a: <span style='font-weight: bold;'>".$datos."</span><p>
				<p>Podr&aacute; cambiar la contrase&ntilde;a en el apartado 'Cambiar contrase&ntilde;a' una vez inicie sesi&oacute;n.</p>
				";
	else if($opcion=="CambiarContrasena")
		return "
				<h3>La contrase&ntilde;a de su cuenta de netboxmusic ha sido modificada.</h3>
				<p>Si no has sido tu contacta con un administrador o bien sigue el siguiente enlace para restablecerla.</p>
				<a href='#'>Restablecer contrase&ntilde;a</a>
			   ";
	else if($opcion=="Soporte"){
		return '
				<p> La informaci&oacute;n ha sido enviada a un administrador y ser&aacute; revisada lo antes posible </p>
				<p> Muchas gracias por participar en nuestro programa de soporte. </p>
				<p> Atentamente, <b>Netboxmusic</b>.</p>
				';
	}
}

/*Esta función es usada para añadir distintos sujetos según las necesidades.
	$opcion: determina el resultado según el valor.
*/
function SujetosCorreo($opcion){
	if($opcion=="Registro")
		return "Registro Completado.";
	else if($opcion=="CambiarContrasena")
		return "Se ha modificado la contraseña.";
	else if($opcion=="Soporte")
		return 'Sugerencia enviada.';
}

?>
