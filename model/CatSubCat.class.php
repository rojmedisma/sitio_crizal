<?php
/**
 * Clase modelo CatSubCat
 * Para el manejo del contenido de la tabla 'cat_sub_cat'
 * @author Ismael Rojas
 */
class CatSubCat extends ModeloBase{
	public function __construct(){
		parent::__construct();
		$this->tbl_nom = "cat_sub_cat";
		$this->cmp_id_nom = $this->tbl_nom."_id";
	}
}

