<?php
/**
 * Clase TiendaControl
 *
 * @author Ismael Rojas
 */
class TiendaControl extends TableroBase{
	public function __construct() {
		parent::__constructTablero();
		
		$this->setPaginaDistintivos();
		$this->setUsarLibForma(true);
		$this->defineVista("Sitio.php");
		
		
	}
	public function grid() {
		$this->setTituloPagina("Lista de variedades de maíz");
		//Se define el arreglo con el detalle de cultivo
		$cultivo = new Cultivo();
		$cultivo->setArrTblVistaCultivo(" AND `nom_arc_sist` IS NOT NULL ");
		$this->arr_tabla = $cultivo->getArrTbl();
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
	
}
