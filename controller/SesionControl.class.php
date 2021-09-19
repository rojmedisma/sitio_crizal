<?php
/**
 * Clase SesionControl
 *
 * @author Ismael Rojas
 */
class SesionControl extends TableroBase{
	public function __construct() {
		parent::__constructTablero();
		
	}
	public function inicio() {
		$this->setPaginaDistintivos();
		$this->defineVista("Sitio.php");
		
		$this->frm_crizal = new FormularioCrizal(array());
	}
}
