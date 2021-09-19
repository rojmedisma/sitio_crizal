<?php
/**
 * Controlador TableroControl
 * Para mostrar el tablero de navegación vacío
 * Controlador defecto
 * @author Ismael Rojas
 */
class TableroControl extends TableroBase{
	private $arr_cat_cuestionario = array();
	public function __construct() {
		parent::__constructTablero();
	}
	/**
	 * Acción para desplegar el tablero de navegación
	 */
	public function inicio() {
		$this->defineVista("Tablero.php");
		
		$cat_cuestionario = new CatCuestionario();
		$cat_cuestionario->setArrTbl();
		$this->arr_cat_cuestionario = $cat_cuestionario->getArrTbl();
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	/**
	 * Devuelve el arreglo del registro del catálogo de cuestionario
	 * @return array
	 */
	public function getArrCatCuestionario() {
		return $this->arr_cat_cuestionario;
	}
}
