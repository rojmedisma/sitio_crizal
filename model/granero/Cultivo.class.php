<?php
/**
 * Clase Cultivo
 *
 * @author Ismael Rojas
 */
class Cultivo extends ModeloBase{
	private $and_tbl;
	private $and_vista;
	public function __construct(){
		parent::__construct();
		$this->tbl_nom = "cultivo";
		$this->cmp_id_nom = "cultivo_id";
		$this->and_tbl = " AND `".$this->tbl_nom."`.`borrar` IS NULL ";
		$this->and_vista = " AND `v_".$this->tbl_nom."`.`borrar` IS NULL ";
	}
	/**
	 * Tabla cultivo con LEFT JOIN en `cat_usuario`, 
	 *	LEFT JOIN en `cult_inventario` al primer registro encontrado ordenado por `fecha_disponibilidad`
	 *	LEFT JOIN en `adjunto` al primer registro encontrado ordenado por `fecha` y `hora`
	 * Ver query original el assets\doc\querys_memoria.sql
	 * @param type $and
	 */
	public function setArrTblVistaCultivo($and="") {
		$and_tbl = $this->and_vista." ".$and;
		$str_query = "SELECT * FROM `".$this->bd->getBD()."`.`v_cultivo` WHERE 1 ".$and_tbl;
		$this->str_query = $str_query;
		$this->arr_tbl = $this->bd->getArrDeQuery($str_query, $this->cmp_id_nom);
	}
	public function setArrRegVistaCultivo($cmp_id_val, $and="") {
		//Cambio
		$and_reg = " AND `v_cultivo`.`".$this->cmp_id_nom."` = '".$cmp_id_val."' ".$and;
		$this->setArrTblVistaCultivo($and_reg);
		$arr_tbl = $this->getArrTbl();
		$arr_reg = array();
		if(count($arr_tbl) && isset($arr_tbl[$cmp_id_val])){	
			$arr_reg = $arr_tbl[$cmp_id_val];
		}
		$this->arr_reg = $arr_reg;
	}
	public function ejecutaQryVistaCultivo($and="", $select="") {
		$and_tbl = $this->and_vista." ".$and;
		return $this->ejecutaQryTbl($and_tbl, $select, true);
	}
	
	
}
