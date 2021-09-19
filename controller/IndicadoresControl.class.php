<?php
/**
 * Controlador IndicadoresControl
 *
 * @author Ismael Rojas
 */
class IndicadoresControl extends ControladorBase{
	/**
	 * Acción que ejecuta el proceso donde se crean todas las tablas de detalle de indicadores a partir de la tabla de configuración <strong>ind_var</strong>
	 */
	public function crear_tablas_ind(){
		$ind_adm = new Indicador_adm();
		$ind_adm->setCrearTablasInd();
		$this->defineVista("Tablero.php");
	}
	/**
	 * Acción que ejecuta el proceso donde se calculan todos los indicadores a nivel cuestionarios, llenando las variables contenidas en las tablas de detalle de indicadores
	 */
	public function genera_detalle(){
		$ind_adm = new Indicador_adm();
		$ind_adm->setCalcDetalle();
		$this->defineVista("Tablero.php");
	}
}
