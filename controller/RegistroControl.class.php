<?php
/**
 * Clase RegistroControl
 *
 * @author Ismael Rojas
 */
class RegistroControl extends TableroBase{
	public object $frm_crizal;
	public function __construct() {
		parent::__constructTablero();
		
	}
	public function inicio() {
		$this->setPaginaDistintivos();
		$this->defineVista("Sitio.php");
		
		$this->frm_crizal = new FormularioCrizal(array());
	}
}
