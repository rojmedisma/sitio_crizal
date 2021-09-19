<?php
/**
 * Clase modelo que tiene los cálculos para actualizar y reflejar el resultado de indicadores por consolidado de registros, el parámetro para determinar el consolidado es definido a partir de la sentencia query que contiene el filtro
 * @author Ismael
 *
 */
class Indicador_calc_consol extends ModeloBase{
	private $and_iv;
	private $arr_tbl_consol = array();
	private $arr_consol_res = array();
	private $arr_consol_val = array();
	private $arr_consol_n = array();
	public function __construct(){
		$this->and_iv = " AND `borrar` IS NULL ";
	}
	/**
	 * Devuelve parte de la sentencia query que define los parámetros predeterminados para realizar el filtro consolidado
	 * @return string
	 */
	private function getAndIv(){
		return $this->and_iv;
	}
	/**
	 * Modifica el arreglo que contiene los registros de la tabla de configuración de indicadores (ind_var) para obtener todos los títulos de indicadores a desplegar
	 */
	public function setArrTblConsol(){
		$and_iv = $this->getAndIv()." AND (`dato_tipo` IS NULL OR `consolida_nivel` = 1) ORDER BY `orden` ASC";
		$arr_iv = $this->bd->getArrDeTabla("ind_var", $and_iv, "ind_var_id");
		$this->arr_tbl_consol = $arr_iv;
	}
	/**
	 * Devuelve el arreglo que contiene los registros de la tabla de configuración de indicadores (ind_var) para obtener todos los títulos de indicadores a desplegar
	 * @return array
	 */
	public function getArrTblConsol(){
		return $this->arr_tbl_consol;
	}
	/**
	 * Modifica el arreglo que contiene el resultado de los indicadores a nivel consolidado
	 * @param integer $cat_cuestionario_id	Id del registro de catálogo de cuestionarios
	 * @param string $and
	 */
	public function setArrConsolVal($cat_cuestionario_id, $and){
		$and_iv = $this->getAndIv()." AND `cat_cuestionario_id` = '".$cat_cuestionario_id."' AND `consolida_nivel` = 1 ORDER BY `ind_var`.`orden` ASC";
		$arr_iv = $this->bd->getArrDeTabla("ind_var", $and_iv, "ind_var_id");
		$this->setArrConsolRes($arr_iv, $cat_cuestionario_id, $and);
		$this->arr_consol_val = $this->getArrConsolRes();
	}
	/**
	 * Devuelve el arreglo que contiene el resultado de los indicadores a nivel consolidado
	 * @return array
	 */
	public function getArrConsolVal() {
		return $this->arr_consol_val;
	}
	/**
	 * Modifica el arreglo que contiene el resultado de las N (Total de cuestionarios por indicador) de los indicadores a nivel consolidado
	 * @param integer $cat_cuestionario_id	Id del registro de catálogo de cuestionarios
	 * @param string $and
	 */
	public function setArrConsolN($cat_cuestionario_id, $and){
		$and_iv = $this->getAndIv()." AND `cat_cuestionario_id` = '".$cat_cuestionario_id."' AND `consolida_nivel` = 2 AND `etiqueta` LIKE 'tot_N' ORDER BY `ind_var`.`orden` ASC";
		$arr_iv = $this->bd->getArrDeTabla("ind_var", $and_iv, "ind_var_padre_id");
		
		$this->setArrConsolRes($arr_iv, $cat_cuestionario_id, $and);
		$this->arr_consol_n = $this->getArrConsolRes();
	}
	/**
	 * Devuelve el arreglo que contiene el resultado de las N (Total de cuestionarios por indicador) de los indicadores a nivel consolidado
	 * @return array
	 */
	public function getArrConsolN(){
		return $this->arr_consol_n;
	}
	/**
	 * Modifica el arreglo que contiene las operaciones a calcular por consolidado a partir de un arreglo de operaciones a ejecutar enviadas por argumento
	 * @param array $arr_iv	Arreglo de operaciones a calcular
	 * @param integer $cat_cuestionario_id	Id del registro de catálogo de cuestionarios
	 * @param string $and	Sentencia de query AND para filtrar el contenido
	 */
	private function setArrConsolRes($arr_iv, $cat_cuestionario_id, $and){
		$arr_res = array();
		if(count($arr_iv)){
			$arr_qry_sel = array();
			foreach ($arr_iv as $ind_var_id=>$arr_det){
				$arr_qry_sel[] = $arr_det["consolida_qry"]." AS `".$ind_var_id."`";
			}
			
			$nom_tbl_ind = nom_tbl_ind($cat_cuestionario_id);
			$qry = "SELECT ".implode(", ", array_values($arr_qry_sel))." FROM `".$this->bd->getBD()."`.`".$nom_tbl_ind."` WHERE 1 ".$and;
			$rs = $this->bd->getRes($qry);
			if(!$rs)	die($this->bd->getTagErrorSQL($qry));
			while($row = $rs->fetch_array()){
				foreach ($arr_iv as $ind_var_id=>$arr_det){
					$arr_res[$ind_var_id] = $row[$ind_var_id];
				}
			}
			$rs->close();
		}
		$this->arr_consol_res = $arr_res;
	}
	/**
	 * Devuelve el arreglo que contiene las operaciones a calcular por consolidado a partir de un arreglo de operaciones a ejecutar enviadas por argumento
	 * @return array
	 */
	private function getArrConsolRes(){
		return $this->arr_consol_res;
	}
	
}
?>