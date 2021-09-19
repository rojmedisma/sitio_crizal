<?php
/**
 * Clase CatVehMarca
 *
 * @author Ismael Rojas
 */
class CatVehMarca extends ModeloBase{
	private $and_opt_sel;
	public function __construct(){
		parent::__construct();
		$this->tbl_nom = 'cat_veh_marca';
		$this->cmp_id_nom = 'cat_veh_marca_id';
	}
	/**
	 * Se crea la sentencia and para las opciones del campo select para el modelo a partir de la marca seleccionada
	 * @param int $cat_veh_marca_id
	 */
	public function setAndOptSel($cat_veh_marca_id) {
		if($cat_veh_marca_id!=""){
			$this->and_opt_sel = " AND `cat_veh_marca_id` = '".$cat_veh_marca_id."' ORDER BY `descripcion` ";
		}else{
			$this->and_opt_sel = " AND FALSE ";
		}
	}
	public function getAndOptSel() {
		return $this->and_opt_sel;
	}
}
