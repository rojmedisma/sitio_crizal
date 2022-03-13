<?php
/**
 * Clase modelo CatN
 * Clase genérica para la consulta de tablas de catálogo
 * @author Ismael Rojas
 */
class CatN extends ModeloBase{
	private $and_vista;
	private $vista_nom;
	public function __construct($tbl_nom, $cmp_id_nom=""){
		parent::__construct();
		$this->tbl_nom = $tbl_nom;
		$this->cmp_id_nom = ($cmp_id_nom=="")? $tbl_nom."_id" : $cmp_id_nom;
		$this->vista_nom = "v_".$this->tbl_nom;
		$this->and_vista = " AND `".$this->vista_nom."`.`borrar` IS NULL ";
	}
	public function setArrTblVistaCatN($and=""){
		$and_tbl = $this->and_vista." ".$and;
		$str_query = "SELECT * FROM `{$this->bd->getBD()}`.`{$this->vista_nom}` WHERE 1 ".$and_tbl;
		$this->arr_tbl = $this->bd->getArrDeQuery($str_query, $this->cmp_id_nom);
	}
}