<?php
/**
 * Clase modelo CatSubCat
 * Para el manejo del contenido de la tabla 'cat_sub_cat'
 * @author Ismael Rojas
 */
class CatSubCat extends ModeloBase{
	private $opc_descripcion;
	public function __construct(){
		parent::__construct();
		$this->tbl_nom = "cat_sub_cat";
		//$this->cmp_id_nom = $this->tbl_nom."_id";
	}
	public function setOpcDescripcion($cat_nombre, $opc_id) {
		$query = "SELECT `opc_descripcion` FROM `".$this->bd->getBD()."`.`".$this->tbl_nom."` WHERE `cat_nombre` LIKE '".$cat_nombre."' AND `opc_id` = '".$opc_id."' ";
		$this->opc_descripcion = $this->bd->get1erElemQry('opc_descripcion', $query);
	}
	public function getOpcDescripcion() {
		return $this->opc_descripcion;
	}
}