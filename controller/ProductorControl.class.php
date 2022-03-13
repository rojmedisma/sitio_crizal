<?php
/**
 * Clase ProductorControl
 *
 * @author Ismael Rojas
 */
class ProductorControl extends TableroBase{
	public function __construct() {
		parent::__constructTablero();
		$this->setPaginaDistintivos();
		$this->defineVista("Sitio.php");
		$this->setAutentificar(true);
		$this->permiteIngresoProductor();
	}
	/**
	 * granero\view\crizal\includes\productor\Contenido.php
	 */
	public function inicio() {
		$cat_usuario_id = $this->getUsuarioId();
		
		
		$cultivo = new Cultivo();
		$cultivo->setArrTbl(" AND `cat_usuario_id` = '".$cat_usuario_id."' ");
		$this->arr_tabla = $cultivo->getArrTbl();
	}
}
