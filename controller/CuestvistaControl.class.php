<?php
/**
 * Controlador CuestvistaControl
 * Usado para desplegar la pantalla con la consulta de registros de cuestionario o vista
 *
 * @author Ismael Rojas
 */
class CuestvistaControl extends CuestBase{
	private $arr_tbl_cuestionario = array();
	public function __construct() {
		parent::__construct();
	}
	/**
	 * Acción inicio para mostrar la vista de cuestionarios
	 */
	public function inicio() {
		$this->setPaginaDistintivos();
		$this->setUsarLibVista(true);
				
		$cuestionario = new Cuestionario($this->getCatCuestionarioId());
		$cuestionario->setArrTblCuestionario("", true);
		if($cuestionario->getEsError()){
			$this->redireccionaErrorDeArr($cuestionario->getArr1erError(), true);
		}
		
		$this->arr_tbl_cuestionario = $cuestionario->getArrTblCuestionario();
		
		$this->defineVista("Tablero.php");
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	/**
	 * Regresa el arreglo que contiene el detalle formado por todas las tablas pertenecientes al cuestionario actual 
	 * @return array
	 */
	public function getArrTblCuestionario() {
		return $this->arr_tbl_cuestionario;
	}
	/**
	 * Devuelve la estructura HTML para los botones que se muestran en la vista en la columna Opciones
	 * @param string $cuestionario_id	Id del cuestionario
	 * @return string
	 */
	public function getHTMLBotones($cuestionario_id) {
		$arr_tag = array();
		if($this->tienePermiso("lectura")){
			$arr_tag[] = '<a href="'.define_controlador('cuestforma', 'inicio', false, array('cat_cuestionario_id'=>$this->getCatCuestionarioId(), 'cuestionario_id'=>$cuestionario_id)).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Abrir</a>';
		}
		if($this->tienePermiso("borrar")){
			$arr_tag[] = '<form class="d-inline frm_borrar" action="'.define_controlador('borrar', 'cuestionario').'" method="post">';
			$arr_tag[] = '	'.$this->getHTMLCamposOcultosBase();
			$arr_tag[] = '	<input type="hidden" name="cat_cuestionario_id" value="'.$this->getCatCuestionarioId().'">';
			$arr_tag[] = '	<input type="hidden" name="cuestionario_id" value="'.$cuestionario_id.'">';
			$arr_tag[] = '	<button type="submit" class="btn btn-danger btn-sm btn_borrar"><i class="fas fa-trash-alt"></i> Borrar</button>';
			$arr_tag[] = '</form>';
		}
		return tag_string($arr_tag);
	}
	/**
	 * Devuelve el texto del estatus del cuestionario con formato de color
	 * @param int $estatus_cuest	Id del estatus
	 * @param string $estatus_cuest_desc	Descripción del estatus 
	 * @return string
	 */
	public function getHTMLColEstatus($estatus_cuest, $estatus_cuest_desc) {
		if(intval($estatus_cuest)===6 || intval($estatus_cuest)===7){
			return '<p class="text-success">'.$estatus_cuest_desc.'</p>';
		}elseif(intval($estatus_cuest)=== 1){
			return '<p>'.$estatus_cuest_desc.'</p>';
		}else{
			return '<p class="text-danger">'.$estatus_cuest_desc.'</p>';
		}
	}
}
