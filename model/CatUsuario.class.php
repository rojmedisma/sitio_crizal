<?php
/**
 * Clase modelo CatUsuario
 * Para el manejo del contenido de la tabla 'cat_usuario'
 * @author Ismael Rojas
 */
class CatUsuario extends ModeloBase{
	public function __construct(){
		parent::__construct();
		$this->tbl_nom = "cat_usuario";
		$this->cmp_id_nom = $this->tbl_nom."_id";
	}
}
