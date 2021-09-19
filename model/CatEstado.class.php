<?php
/**
 * Clase modelo CatEstado
 * Para el manejo del contenido de la tabla 'cat_estado'
 * @author Ismael Rojas
 */
class CatEstado extends ModeloBase{
	public function __construct(){
		parent::__construct();
		$this->tbl_nom = "cat_estado";
		$this->cmp_id_nom = $this->tbl_nom."_id";
	}
}
