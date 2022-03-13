<?php
/**
 * Clase ProdcultivoControl
 *
 * @author Ismael Rojas
 */
class ProdcultivoControl extends TableroBase{
	public object $frm_crizal;
	private int $cultivo_id;
	private array $arr_reg_adjunto;
	public function __construct() {
		parent::__constructTablero();
		$this->setPaginaDistintivos();
		$this->defineVista("Sitio.php");
		$this->setAutentificar(true);
		$this->permiteIngresoProductor();
		$this->cultivo_id = (isset($_REQUEST['cultivo_id']))? intval($_REQUEST['cultivo_id']) : 0;
		$this->es_nuevo = ($this->cultivo_id)? false : true;
		
		$this->setUsarLibForma(true);
		
	}
	/**
	 * Vista:
	 * granero\view\crizal\includes\prodcultivo\inicio\Contenido.php
	 */
	public function inicio() {
		$cat_usuario_id = $this->getUsuarioId();
		
		if($this->cultivo_id){
			$cultivo = new Cultivo();
			$cultivo->setArrReg($this->cultivo_id);
			$this->arr_cmps_frm = $cultivo->getArrReg();
		}else{
			$this->arr_cmps_frm = array(
				'cat_usuario_id'=>$cat_usuario_id,
			);
		}
		
		$this->frm_crizal = new FormularioCrizal($this->arr_cmps_frm);
	}
	/**
	 * Vista:
	 * granero\view\crizal\includes\prodcultivo\Inventario\Contenido.php
	 */
	public function inventario() {
		if(!$this->cultivo_id){
			$this->redireccionaError('Argumento cultivo_id vacío', 'Se requiere el argumento cultivo_id para ingresar a la sección de inventario');
		}
		$this->setArrDatoVistaValor('cultivo_id', $this->cultivo_id);
		
		$cult_inventario = new CultInventario();
		$cult_inventario->setArrTbl(" AND `cultivo_id` = '".$this->cultivo_id."' ORDER BY `fecha_disponibilidad` ASC ");
		$this->arr_tabla = $cult_inventario->getArrTbl();
		
		$this->frm_crizal = new FormularioCrizal(array());
	}
	/**
	 * Vista:
	 * granero\view\crizal\includes\prodcultivo\Fotos\Contenido.php
	 */
	public function fotos() {
		$this->setArrDatoVistaValor('cultivo_id', $this->cultivo_id);
		
		//Arreglo de registros de adjunto
		$adjunto = new Adjunto();
		$and_adj = " AND `cultivo_id` = '".$this->cultivo_id."' ";
		$adjunto->setArrTblAdj($and_adj);
		$this->arr_reg_adjunto = $adjunto->getArrTbl();
	}
	public function getEsPestaniaSel($accion) {
		if($this->getAccion() == $accion){
			return 'resp-tab-active';
		}else{
			return '';
		}
	}
	public function getCultivoId() {
		return $this->cultivo_id;
	}
	public function getArrRegAdjunto() {
		return $this->arr_reg_adjunto;
	}
	public function getHTMLBtnBorrarInv($cult_inventario_id) {
		$tag_html = new TagHTMLCrizal();
		$arr_cmps_ocultos = array(
			"controlador_fuente"=>$this->getControlador(),
			"accion_fuente"=>$this->getAccion(),
			"cultivo_id"=>$this->cultivo_id,
			"cult_inventario_id"=>$cult_inventario_id
		);
		$tag_html->setHTMLBtnBorrarReg('borrar', 'cult_inventario', $arr_cmps_ocultos);
		return $tag_html->getHTMLContenido();
	}
}
