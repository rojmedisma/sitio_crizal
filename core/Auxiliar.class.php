<?php
/**
 * Clase Auxiliar con métodos estáticos
 *	- La intención es que sustituya gradualmente a la clase core Ayuda y las funciones del archivo core Frecuentes.func.php
 * @author Ismael Rojas
 */
class Auxiliar{
	public static function getSesUsuarioId() {
		$usuario_id = (isset($_SESSION['cat_usuario_id']))? $_SESSION['cat_usuario_id'] : "";
		return $usuario_id;
	}
}
