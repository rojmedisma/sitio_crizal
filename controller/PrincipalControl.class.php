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
		
	}
	public function inicio() {
		$this->setPaginaDistintivos();
		//$this->setUsarLibForma(true);
		$this->defineVista("Sitio.php");
		$this->setUsarLibForma(true);
		$this->setArrTblViCultivos();
	}
	/**
	 * Para cuando te firmas como productor o comprador aparezca como default la página correspondiente al interés del usuario
	 * 
	 */
	public function redirigir() {
		if($this->tienePermiso('as-productor')){
			redireccionar('productor', 'inicio');
		}elseif($this->tienePermiso('as-comprador')){
			redireccionar('tienda', 'grid');
		}else{
			redireccionar();
		}
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
