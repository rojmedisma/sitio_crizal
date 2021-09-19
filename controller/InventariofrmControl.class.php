<?php
/**
 * Clase InventariofrmControl
 *
 * @author Ismael Rojas
 */
class InventariofrmControl extends TableroBase{
	private $inventario_id;
	public object $frm_al3;
	private $arr_reg_adjunto_princ;
	private $arr_reg_adjunto_sec;
	public function __construct() {
		parent::__constructTablero();
		$this->inventario_id = (isset($_REQUEST['inventario_id']))? $_REQUEST['inventario_id'] : "";
	}
	public function inicio() {
		$this->setPaginaDistintivos();
		$this->setUsarLibForma(true);
		$this->defineVista("Tablero.php");
		$this->setArrDatoVistaValor('tit_forma', 'Formulario');
		$this->usar_lib_fie_input = true;	//Se activa el llamado a la librería para el uso de campos adjuntos
		
		if(!$this->inventario_id){
			$this->inventario_id = $this->crear_reg();
		}
		$this->arr_cmps_frm = $this->defineArrCmpsForm();
		$this->setEsNuevo();
		
		//Se define la sentencia AND para el campo opt de veh_modelo
		$cat_veh_marca = new CatVehMarca();
		$cat_veh_marca->setAndOptSel($this->getCampoValor('veh_marca'));
		$and_veh_modelo = $cat_veh_marca->getAndOptSel();
		$this->setArrDatoVistaValor('and_veh_modelo', $and_veh_modelo);
		
		//Arreglo del adjunto
		$this->arr_reg_adjunto_princ = $this->defineArrRegAdjunto('f_princ');
		$this->arr_reg_adjunto_sec = $this->defineArrRegAdjunto('f_sec');
		
		$this->frm_al3 =new FormularioALTE3($this->arr_cmps_frm);
		$this->frm_al3->setConSelect2(true);
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	private function crear_reg(){
		if(!$this->tienePermiso("ae-inventario")){
			$this->redireccionaErrorAccion('sin_permisos', array('tit_accion'=>'Indicadores - Edición'));
		}
		$inventario = new Inventario();
		return $inventario->crearInventario();
	}
	/**
	 * Devuelve el arreglo con el contenido de todos los campos de todas la tablas de que conforman el registro de inventario actual
	 * @return array
	 */
	private function defineArrCmpsForm(){
		$inventario = new Inventario();
		$inventario->setArrReg($this->inventario_id);
		return $inventario->getArrReg();
	}
	/**
	 * Se asigna valor a la variable es_nuevo declarada en ControladorBase
	 * Con esto, se identifica si el registro actual es un registro nuevo, que no ha sido guardado por el usuario.
	 */
	private function setEsNuevo(){
		$inhabilitar = intval($this->getCampoValor('inhabilitar'));
		//Para identificar un registro nuevo, en los cuestinarios es a partir del campo inhabilitar, debido a que el registro puede ser creado en la tabla previamente antes de ser usado
		$this->es_nuevo = ($inhabilitar)? true : false;
	}
	
	private function defineArrRegAdjunto($adjunto_tipo) {
		$adjunto = new Adjunto();
		$and_adj = " AND `adjunto_tipo` LIKE '".$adjunto_tipo."' AND `inventario_id` = '".$this->inventario_id."' ";
		$adjunto->setArrTblAdj($and_adj);
		return $adjunto->getArrTbl();
	}
	public function getArrRegAdjuntoPrinc() {
		return $this->arr_reg_adjunto_princ;
	}
	public function getArrRegAdjuntoSec() {
		return $this->arr_reg_adjunto_sec;
	}
}
