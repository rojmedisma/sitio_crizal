<?php
/**
 * Clase TiendaControl
 *
 * @author Ismael Rojas
 */
class TiendaControl extends TableroBase{
	public object $rs_cvo;
	public array $arr_obj_rs_filtros;
	public object $rs_cat_cvo;
	public $zebra_pagination;
	public function __construct() {
		parent::__constructTablero();
		
		$this->setPaginaDistintivos();
		$this->setUsarLibForma(true);
		$this->defineVista("Sitio.php");
		
		
	}
	public function grid() {
		$cat_cultivo_id = (isset($_REQUEST['cat_cultivo_id']))? intval($_REQUEST['cat_cultivo_id']) : 0;
		$cat_estado_id = (isset($_REQUEST['cat_estado_id']))? $_REQUEST['cat_estado_id'] : "";
		$buscar = (isset($_REQUEST['buscar']))? $_REQUEST['buscar'] : "";
		$this->setTituloPagina("Lista de variedades de maíz");
		//Se define el arreglo con el detalle de cultivo}
		$and_cvo = " AND `nom_arc_sist` IS NOT NULL ";
		$and_filtro = $and_cvo;
		if($cat_cultivo_id){
			$and_cvo .= " AND `cat_cultivo_id` = '".$cat_cultivo_id."' ";
		}
		if($cat_estado_id){
			$and_cvo .= " AND `cat_estado_id` = '".$cat_estado_id."' ";
		}
		
		$cultivo = new Cultivo();
		if($buscar!=""){
			$arr_cmps_search = array(
				"cat_cultivo_id_desc",
				"semilla_origen_desc",
				"produc_metodo_desc",
				"agroqui_uso_desc",
				"cat_estado_desc",
				"cantidad_um_desc",
				"nom_arc_real",
			);
			$cultivo->setQryAndSearch($arr_cmps_search, $buscar);
			$and_cvo .= $cultivo->getQryAndSearch();
			$this->arr_cmps_frm = array('buscar'=>$buscar);
		}
		
		//	*	Se crea el grid de contenido
		$rs = $cultivo->ejecutaQryVistaCultivo($and_cvo);
		$tot_regs_cvos = $rs->num_rows;
		$tot_regs_x_pag = 6;
		$this->zebra_pagination = new Zebra_Pagination();
		$this->zebra_pagination->records($tot_regs_cvos);
		$this->zebra_pagination->records_per_page($tot_regs_x_pag);
		//El número de la página de cultivo
		$pagina_cvo = $this->zebra_pagination->get_page();
		//El límite inicial
		$lim_ini = ($pagina_cvo - 1) * $tot_regs_x_pag;
		//Se crea el objeto recordset de cultivo
		$this->rs_cvo = $cultivo->ejecutaQryVistaCultivo($and_cvo." LIMIT ".$lim_ini.", ".$tot_regs_x_pag);
		
		//	*	Se hacen las categorías para el filtrador
		$arr_obj_rs_filtros = array(
			'cat_cvo'=>array(
				"tit"=>"Variedad",
				"collapse"=>($cat_cultivo_id)? " show" : "",
				"cmp_id_nom"=>"cat_cultivo_id",
				"cmp_id_val"=>$cat_cultivo_id,
				"ob_rs"=>$cultivo->ejecutaQryVistaCultivo($and_filtro, "DISTINCT `cat_cultivo_id` AS `filtro_id`, `cat_cultivo_id_desc` `filtro_desc`"),
			),
			'cat_edo'=>array(
				"tit"=>"Región",
				"collapse"=>($cat_estado_id)? " show" : "",
				"cmp_id_nom"=>"cat_estado_id",
				"cmp_id_val"=>$cat_estado_id,
				"ob_rs"=>$cultivo->ejecutaQryVistaCultivo($and_filtro, "DISTINCT `cat_estado_id` AS `filtro_id`, `cat_estado_desc` `filtro_desc`"),
			)
		);
		
		
		$this->arr_obj_rs_filtros = $arr_obj_rs_filtros;
	}
	public function producto() {
		$this->setTituloPagina("Producto");
		$cultivo_id = (isset($_REQUEST['cultivo_id']))? intval($_REQUEST['cultivo_id']) : 0;
		if(!$cultivo_id){
			$this->redireccionaErrorAccion('faltan_args', array('argumento'=>'cultivo_id'));
		}
		
		//Arreglo con el registro de cultivo
		$cultivo = new Cultivo();
		$cultivo->setArrRegVistaCultivo($cultivo_id);
		$this->arr_cmps_frm = $cultivo->getArrReg();
		
		//Arreglo con los registros de adjunto (imágenes)
		$adjunto = new Adjunto();
		$adjunto->setArrTbl(" AND `cultivo_id` = '".$cultivo_id."' ");
		$arr_tbl_adj = $adjunto->getArrTbl();
		if(count($arr_tbl_adj)){
			$this->setArrDatoVistaValor('arr_tbl_adj', $arr_tbl_adj);
			//Se obtiene el primer registro
			foreach($arr_tbl_adj as $adjunto_id => $arr_det){
				$adj_ref = $arr_det['ruta_archivo'].$arr_det['nom_arc_sist'];
				$this->setArrDatoVistaValor('adj_1er_adj_ref', $adj_ref);
				break;
			}
		}
		if(empty($this->arr_cmps_frm)){
			$this->redireccionaError("No existe registro de cultivo", "No se encontró el registro con cultivo_id = ".$cultivo_id);
		}
	}
	public function buscar() {
		$controlador_destino = (isset($_REQUEST["controlador_fuente"]))? $_REQUEST["controlador_fuente"] : "";
		$accion_destino = (isset($_REQUEST["accion_fuente"]))? $_REQUEST["accion_fuente"] : "";
		
		redireccionar($controlador_destino, $accion_destino);
	}
}
