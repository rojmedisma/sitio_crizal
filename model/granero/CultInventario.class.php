<?php
/**
 * Clase CultInventario
 *
 * @author Ismael Rojas
 */
class CultInventario extends ModeloBase{
	public function __construct(){
		parent::__construct();
		$this->tbl_nom = "cult_inventario";
		$this->cmp_id_nom = "cult_inventario_id";
	}
}
