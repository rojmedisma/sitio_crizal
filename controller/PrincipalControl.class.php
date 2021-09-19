<?php

/**
 * Clase PrincipalControl
 *
 * @author Ismael Rojas
 */
class PrincipalControl extends TableroBase{
	
	private array $arr_tbl_vi_cultivos;
	public function __construct() {
		parent::__constructTablero();
		$this->setPaginaDistintivos();
		//$this->setUsarLibForma(true);
		$this->defineVista("Sitio.php");
	}
	public function inicio() {
		$this->setArrTblViCultivos();
	}
	private function setArrTblViCultivos(): void {
		$cultivo = new Cultivo();
		$cultivo->setArrTblVistaCultivo();
		$this->arr_tbl_vi_cultivos = $cultivo->getArrTbl();
	}
	public function getArrTblViCultivos(): array {
		return $this->arr_tbl_vi_cultivos;
	}

	
}
