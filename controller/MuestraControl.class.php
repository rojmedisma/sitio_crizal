<?php
/**
 * Controlador MuestraControl
 *
 * @author Ismael Rojas
 */
class MuestraControl extends TableroBase{
	private $cat_cuestionario_id;
	private $arr_tbl_muestra;
	private $ver_aviso = false;
	private array $arr_avisos = array();
	private $arr_rel_tbl_cmps;
	private $arr_update_tbl;
	private object $muestra;
	public function __construct() {
		parent::__constructTablero();
		$this->cat_cuestionario_id = (isset($_REQUEST['cat_cuestionario_id']))? intval($_REQUEST['cat_cuestionario_id']) : "";
		if($this->cat_cuestionario_id==""){
			$this->redireccionaErrorAccion("sin_arg_cat_cuestionario_id");
		}
		$this->setUsarLibForma(true);
		$this->setUsarLibVista(true);
		$this->setPaginaDistintivos();
		$this->defineVista("Tablero.php");
	}
	/**
	 * Acción para mostrar la información de la muestra
	 */
	public function inicio() {
		$this->defineInfoCatCuest();	//Para mostrar información en la vista
		$this->muestra = new Muestra($this->cat_cuestionario_id);
		$this->setArrTblMuestra();
		
		
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	/**
	 * Acción para validar la muestra
	 */
	public function validar() {
		$this->muestra = new Muestra($this->cat_cuestionario_id);
		$this->revYaIntegrados();
		$this->revUsrNoExisten();
		
		$this->setArrDatoVistaValor('ver_aviso', $this->ver_aviso);
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	/**
	 * Acción para integrar la muestra pre-cargada
	 */
	public function integrar() {
		$this->muestra = new Muestra($this->cat_cuestionario_id);
		$cuestionario = new Cuestionario($this->cat_cuestionario_id);
		
		$this->setArrTblMuestra();
		$this->setArrRelTblCmps();
		
		foreach($this->arr_tbl_muestra as $muestra_id=>$arr_det_reg_m){
			$cat_usuario_id = (isset($arr_det_reg_m['cat_usuario_id']))? $arr_det_reg_m['cat_usuario_id'] : 0;
			if(!$cat_usuario_id){
				$this->redireccionaError("Valor cat_usuario_id vacío", "En el registro con muestra_id = ".$muestra_id.", el valor cat_usuario_id está vacío");
			}
			//Se crea el cuestionario
			$cuestionario_id = $cuestionario->crearCuest($cat_usuario_id);
			
			$arr_update_tbl = array();
			$arr_update_tbl = $this->defineArrUpdateTbl($arr_det_reg_m);
			//if($this->muestra->actualizaCuestDeArr($arr_update_tbl, $cuestionario_id)){
			//	$this->muestra->marcarComoIntegrado($muestra_id);
			//}
			if($cuestionario->actualizaFrmCuest($arr_update_tbl, $cuestionario_id)){
				$this->muestra->marcarComoIntegrado($muestra_id);
			}else{
				$this->redireccionaErrorDeArr($cuestionario->getArr1erError(), true);
			}
			
		}
		
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	
	/**
	 * Define el arreglo que contiene toda la información necesaria para actualizar el registro de cuestionario
	 * @param array $arr_det_reg_m	Arreglo con la información del registro de muestra
	 * @return array
	 */
	private function defineArrUpdateTbl($arr_det_reg_m){
		$arr_update_tbl = array();
		foreach($this->arr_rel_tbl_cmps as $tabla => $arr_cmps){
			foreach($arr_cmps as $cmp_nom){
				if(isset($arr_det_reg_m[$cmp_nom])){
					$arr_update_tbl[$tabla][$cmp_nom] = txt_sql($arr_det_reg_m[$cmp_nom]);
				}
			}
		}
		$arr_update_tbl['c00']['estatus_cuest'] = txt_sql("1");
		$arr_update_tbl['c00']['estatus_cuest_desc'] = txt_sql("Creado desde muestra");
		$arr_update_tbl['c00']['inhabilitar'] = txt_sql("");
		return $arr_update_tbl;
	}
	/**
	 * Se genera la información necesaria obtenida del catálogo de cuestionario para mostrar en la página vista
	 */
	private function defineInfoCatCuest(){
		$cat_cuestionario = new CatCuestionario();
		$cat_cuestionario->setArrReg($this->cat_cuestionario_id);
		$arr_reg_cat_c = $cat_cuestionario->getArrReg();
		$cat_cuestionario_desc = valorEnArreglo($arr_reg_cat_c, 'descripcion');
		$this->setArrDatoVistaValor('cat_cuestionario_desc', $cat_cuestionario_desc);
	}
	/**
	 * Genera el arreglo con el contenido de la tabla muestra con registros que aún no son integrados
	 */
	private function setArrTblMuestra(){
		$this->muestra->setArrTblMuestra(" AND `se_integro` IS NULL ");
		$this->arr_tbl_muestra = $this->muestra->getArrTbl();
	}
	/**
	 * Devuelve el valor del arreglo 'arr_tbl_muestra'
	 * @return array
	 */
	public function getArrTblMuestra() {
		return $this->arr_tbl_muestra;
	}
	/**
	 * Devuelve el valor del id del catálogo de cuestionarios 'cat_cuestionario_id'
	 * @return int
	 */
	public function getCatCuestionarioId() {
		return $this->cat_cuestionario_id;
	}
	/**
	 * Devuelve el valor del arreglo de avisos 'arr_avisos'
	 * @return array
	 */
	public function getArrAvisos() {
		return $this->arr_avisos;
	}
	/**
	 * Arreglo para la relación de tablas campos
	 */
	private function setArrRelTblCmps() {
		$this->arr_rel_tbl_cmps = array(
			"c00"=>array('muestra_id','cat_cuestionario_id','cat_usuario_id','cat_estado_id'),
			"c01t01"=>array('prod_sector1', 'prod_sector2', 'prod_sector3', 'prod_sector4', 'prod_tipo', 'prod_tipo_desc', 'prod_curp', 'prod_rfc', 'prod_edo', 'prod_edo_desc', 'prod_mpo', 'prod_mpo_desc', 'prod_loc', 'prod_loc_desc'),
		);
	}
	/**
	 * Revisión, corrección y generación de avisos para el caso donde el registro de muestra ya fue usado y generado como cuestionario
	 */
	private function revYaIntegrados(){
		$this->muestra->setArrYaIntegrados();
		$arr_rev = $this->muestra->getArrTbl();
		if(count($arr_rev)){
			$this->ver_aviso = true;
			foreach($arr_rev as $muestra_id){
				//Se marca como integrado para que no genere error en la integración
				$this->muestra->marcarComoIntegrado($muestra_id);
				$this->arr_avisos[] = "Registro con muestra_id = ".$muestra_id." ya se encuentra asignado a un registro de cuestionario. El registro fue marcado para no ser considerado.";
			}
		}
		
	}
	/**
	 * Revisión y generación de avisos para el caso de que existan registros de muestra cuyo id de usuario no existe en el catálogo de usuarios
	 */
	private function revUsrNoExisten(){
		$this->muestra->setArrNoExisteUsuario();
		$arr_rev = $this->muestra->getArrTbl();
		if(count($arr_rev)){
			$this->ver_aviso = true;
			foreach($arr_rev as $cat_usuario_id){
				$this->arr_avisos[] = "Existen registros con cat_usuario_id = ".$cat_usuario_id.". No existe un registro de usuario con ese id.";
			}
		}
	}
}
