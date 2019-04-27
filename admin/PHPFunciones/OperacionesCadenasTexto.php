<?php
/**********************************************************************************
Nombre del fichero: OperacionesCadenasTexto.php
Descripción: contiene las funciones que usamos para trabajar con cadenas de texto.
**********************************************************************************/

/*EliminarEspacios es usada para eliminar los espacios de cualquier cadena de texto
	$string: cadena de texto.
*/
function EliminarEspacios($string){
	$stringArray = explode(" ", $string);
	if ($string)
		return implode($stringArray);
	else 
		return false;
}

/*ReverseCampos es usada para "darle la vuelta" a los campos de una cadena de texto.
	$string: cadena de texto.
	$delimitador: delimitador que las separa.
	$delimitador2: delimitador deseado como resultado al finalizar.
*/
function ReverseCampos($string, $delimitador, $delimitador2){
	$stringArray = explode($delimitador, $string);
	$n = count($stringArray)-1;
	$stringArrayReverse = array();
	for($i=0; $i<count($stringArray); $i++){
		$stringArrayReverse[$i] = $stringArray[$n];
		$n--;
	}
	if ($string && $delimitador && $delimitador2)
		return implode($stringArrayReverse, $delimitador2);
	else 
		return false;
}

/*EsArray es usada para comprobar si una variable es un array.
	$elemento: variable.
*/
function EsArray($elemento){
	if(is_array($elemento)) return "Es un array \n"; else return "No es un array \n";
}
?>
