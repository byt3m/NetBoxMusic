<?php
/**********************************************************************************
Nombre del fichero: OperacionesConFicheros.php
Descripción: contiene las funciones que usamos para trabajar con ficheros.
**********************************************************************************/

/*Nota: Las funciones de imágenes son usadas a través del programa ImageMagick que ha sido 
enlazado manualmente a PHP mediante ciertas librerías por lotes de Windows.*/

/*Función RecortarImagen: Esta función es usada para recortar una imágen a la resolución deseada.
	$origen: ruta donde se encuentra la imagen.
	$destino: ruta donde queremos que se guarde la imagen resultante.
	$ancho: ancho de la imagen tras recortarla.
	$alto: alto de la imagen tras recortarla.
*/
function RecortarImagen($origen, $destino, $ancho, $alto){
	$img = new Imagick($origen);
	$img->cropThumbnailImage($ancho, $alto);
	$img->writeImage($destino);
}
/*Función RedimensionarImagen: esta función es usada para redimensionar imágenes.
	$origen: ruta donde se encuentra la imagen.
	$destino: ruta donde queremos que se guarde la imagen resultante.
	$ancho: ancho de la imagen tras redimensionarla.
	$alto: alto de la imagen tras redimensionarla.
*/
function RedimensionarImagen($origen, $destino, $ancho, $alto){
	$img = new Imagick($origen);
	$imageprops = $img->getImageGeometry();
	$width = $imageprops['width'];
	$height = $imageprops['height'];
	if($width > $height){
		$newHeight = $alto;
		$newWidth = ($ancho / $height) * $width;
	}else{
		$newWidth = $ancho;
		$newHeight = ($alto / $width) * $height;
	}
	$img->resizeImage($newWidth,$newHeight, imagick::FILTER_LANCZOS, 0.9, true);
	$img->cropImage ($ancho,$alto,0,0);
	$img->writeImage($destino);
}

/*Función ValidarImagen: usada para comprobar que un fichero es una imagen.
	$elemento: elemento [type] del array $FILES al subir la imagen.
*/
function ValidarImagen($elemento){
	$string = $elemento;
	$stringArray = explode("/", $string);
	$tipo = $stringArray[0];
	$extension = $stringArray[1];
	if($tipo=='image')
		return true;
	else
		return false;
}

/*Función ValidarAudio: usada para comprobar que un fichero es audio.
	$elemento: elemento [type] del array $FILES al subir el audio.
*/
function ValidarAudio($elemento){
	$string = $elemento;
	$stringArray = explode("/", $string);
	$tipo = $stringArray[0];
	$extension = $stringArray[1];
	if($tipo=='audio')
		return true;
	else
		return false;
}

/*Fución BorrarDirectorio: esta función elimina cualquier directorio aunque este
contenga otros directorios o ficheros. Usado para eliminar artistas.
Esta función no ha sido escrita por mi, sino por la comunidad de 
https://stackoverflow.com 
	$path: ruta del directorio.
*/
function BorrarDirectorio($path)
{
    $path = rtrim( strval( $path ), '/' ) ;
    
    $d = dir( $path );
    
    if( ! $d )
        return false;
    
    while ( false !== ($current = $d->read()) )
    {
        if( $current === '.' || $current === '..')
            continue;
        
        $file = $d->path . '/' . $current;
        
        if( is_dir($file) )
            BorrarDirectorio($file);
        
        if( is_file($file) )
            unlink($file);
    }
    
    rmdir( $d->path );
    $d->close();
    return true;
}
?>
