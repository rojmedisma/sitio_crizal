<?php
/**
 * Clase Inventario
 *
 * @author Ismael Rojas
 */
class Inventario extends ModeloBase{
	private $and_tbl;
	public function __construct(){
		parent::__construct();
		$this->tbl_nom = "inventario";
		$this->cmp_id_nom = "inventario_id";
		$this->and_tbl = " AND `".$this->tbl_nom."`.`inhabilitar` IS NULL ";
	}
	public function crearInventario() {
		$arr_cmps = array(
			'`inventario_id`'=>txt_sql(""),
			'`inhabilitar`'=>txt_sql("1"),
			'`borrar`'=>txt_sql(""),
		);
		$qry_act = "INSERT INTO `".$this->bd->getBD()."`.`inventario` (".implode(",",array_keys($arr_cmps)).") VALUES (".implode(",",array_values($arr_cmps)).");";
		$inventario_id = $this->bd->ejecutaQryInsert($qry_act);
		
		$log = new Log();
		$log->setRegLog('inventario_id', $inventario_id, 'guardar', 'Aviso', "Se creó registro de inventario en modo inhabilitado");
		return $inventario_id;
	}
	public function setArrTblInv($and="") {
		$and_tbl = $this->and_tbl." ".$and;
		//$this->setArrTbl($and_tbl);
		
		$str_query = "";
		$str_query .= "SELECT ";
		$str_query .= "`".$this->tbl_nom."`.*, ";
		$str_query .= "`adjunto`.`adjunto_tipo`, ";
		$str_query .= "`adjunto`.`ruta_raiz`, ";
		$str_query .= "`adjunto`.`ruta_archivo`, ";
		$str_query .= "`adjunto`.`nom_arc_real`, ";
		$str_query .= "`adjunto`.`nom_arc_sist`, ";
		$str_query .= "`adjunto`.`fecha`, ";
		$str_query .= "`adjunto`.`hora`, ";
		$str_query .= "`adjunto`.`orden` ";
		$str_query .= "FROM `".$this->bd->getBD()."`.`".$this->tbl_nom."` ";
		$str_query .= "LEFT JOIN `".$this->bd->getBD()."`.`adjunto` ON(`".$this->tbl_nom."`.`inventario_id` = `adjunto`.`inventario_id` AND `adjunto`.`borrar` IS NULL)";
		$str_query .= "WHERE `".$this->tbl_nom."`.`borrar` IS NULL ".$and_tbl;
		
		$this->str_query = $str_query;
		$this->arr_tbl = $this->bd->getArrDeQuery($str_query, $this->cmp_id_nom);
	}
}
