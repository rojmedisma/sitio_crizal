<?php
/**
 * Clase modelo Encriptar
 * Contiene el código para encriptar las contraseñas de los registros del catálogo de usuarios
 */
class Encriptar{
	/**
	 * Método para codificar un texto a partir de una llave, ambos valores especificados en los argumnentos
	 * @param string $string
	 * @param string $key
	 * @return string
	 */
	function encode($string, $key){
		$key = sha1($key);
		$strLen = strlen($string);
		$keyLen = strlen($key);
		$j = 0;
		$hash = '';
		
		for ($i = 0; $i < $strLen; ++$i)
		{
			$ordStr = ord(substr($string,$i,1));
			if ($j == $keyLen)
			{
				$j = 0;
			}
			$ordKey = ord(substr($key, $j, 1));
			$j++;
			$hash .= strrev(base_convert(dechex($ordStr+$ordKey), 16, 36));
		}
		
		return $hash;
	}
	/**
	 * Método para decodificar un texto a partir de una llave, ambos valores especificados en los argumnentos
	 * @param string $string
	 * @param string $key
	 * @return string
	 */
	function decode($string, $key){
		$key = sha1($key);
		$strLen = strlen($string);
		$keyLen = strlen($key);
		$j = 0;
		$hash = '';
		
		for ($i = 0; $i < $strLen; $i += 2)
		{
			$ordStr = hexdec(base_convert(strrev(substr($string, $i, 2)), 36, 16));
			if ($j == $keyLen)
			{
				$j = 0;
			}
			$ordKey = ord(substr($key, $j, 1));
			$j++;
			$hash .= chr($ordStr-$ordKey);
		}
		
		return $hash;
	}
}