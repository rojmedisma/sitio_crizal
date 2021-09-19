<?php
/**
 * Clase modelo Muestra
 * Para el manejo y su integración de los registros de muestra como cuestionarios
 * @author Ismael Rojas
 */
class Muestra extends ModeloBase{
	private $cat_cuestionario_id;
	private $and_cc;
	private $and_no_integ;
	public function __construct($cat_cuestionario_id){
		$this->cat_cuestionario_id = $cat_cuestionario_id;
		parent::__construct();
		$this->tbl_nom = 'muestra';
		$this->cmp_id_nom = 'muestra_id';
		
		$this->and_cc = " AND `cat_cuestionario_id` = '".$this->cat_cuestionario_id."' ";
		$this->and_no_integ = " AND `se_integro` IS NULL ";
	}
	/**
	 * Modifica el arreglo 'arr_tbl' con el contenido de la tabla 'muestra'
	 * @param string $and	Sentencia query para el filtrado de la consulta
	 */
	public function setArrTblMuestra($and) {
		$and_cc = $this->and_cc.$and;
		$this->setArrTbl($and_cc);
	}
	/**
	 * Ejecuta un query para encontrar aquellos registros de muestra cuyo 'muestra_id' ya se encuentra asignado a un cuestionario, generando un arreglo con la lista de esos ids
	 */
	public function setArrYaIntegrados() {
		$str_query = "SELECT `".$this->cmp_id_nom."` FROM `".$this->bd->getBD()."`.`".$this->tbl_nom."` WHERE 1 ".$this->and_cc.$this->and_no_integ." AND `".$this->cmp_id_nom."` IN (SELECT `".$this->cmp_id_nom."` FROM `".$this->bd->getBD()."`.`c00` WHERE `borrar` IS NULL)";
		$this->arr_tbl = $this->bd->getArrLiCmpDeQuery($str_query, $this->cmp_id_nom);
	}
	/**
	 * Ejecuta la actualización al cuestionario previamente creado con la información de la muestra pre-cargada
	 * @param array $arr_update_tbl	Arreglo que contiene toda la información necesaria para realizar la actualización del registro
	 * @param int $cuestionario_id	Id del cuestionario a actualizar
	 */
	public function actualizaCuestDeArr($arr_update_tbl, $cuestionario_id) {
		foreach($arr_update_tbl as $tbl_nom => $arr_det_cmps){
			$arr_act = array();
			foreach($arr_det_cmps as $cmp_nom=>$cmp_val){
				$arr_act[] = "`".$tbl_nom."`.`".$cmp_nom."` = ".txt_sql($cmp_val);
			}
			$qry_act = "UPDATE `".$this->bd->getBD()."`.`".$tbl_nom."` SET ".implode(",", array_values($arr_act))." WHERE `cuestionario_id` ='".$cuestionario_id."' LIMIT 1;";
			$this->bd->ejecutaQry($qry_act);
		}
		return true;
	}
	/**
	 * Ejecuta query UPDATE para marcar como integrado el registro de muestra indicado en el argumento
	 * @param int $muestra_id	Id del registro a marcar como integrado
	 */
	public function marcarComoIntegrado($muestra_id) {
		$qry_act = "UPDATE `".$this->bd->getBD()."`.`".$this->tbl_nom."` SET `se_integro` = '1' WHERE `".$this->tbl_nom."`.`".$this->cmp_id_nom."` = '".$muestra_id."';";
		$this->bd->ejecutaQry($qry_act);
	}
	/**
	 * Ejecuta un query para encontrar aquellos registros de muestra cuyo 'cat_usuario_id' no está dado de alta en el catálogo de usuarios
	 */
	public function setArrNoExisteUsuario() {
		$str_query = "SELECT DISTINCT `cat_usuario_id` FROM `".$this->bd->getBD()."`.`".$this->tbl_nom."` WHERE 1 ".$this->and_cc.$this->and_no_integ." AND `cat_usuario_id` NOT IN (SELECT `cat_usuario_id` FROM `".$this->bd->getBD()."`.`cat_usuario` WHERE `borrar` IS NULL )";
		$this->arr_tbl = $this->bd->getArrLiCmpDeQuery($str_query, 'cat_usuario_id');
	}
}
