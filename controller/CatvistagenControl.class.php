<?php
/**
 * Controlador CatvistagenControl
 * Usado para mostrar las pantallas con las tablas de consulta de registros o vistas
 * 
 * @author Ismael Rojas
 */
class CatvistagenControl extends TableroBase{
	public function __construct() {
		parent::__constructTablero();
		$this->setPaginaDistintivos();
		$this->setUsarLibVista(true);
		$this->defineVista("Tablero.php");
	}
	/**
	 * Para plataforma granero
	 */
	public function cultivo() {
		$arr_reg_usuario = $this->getArrRegUsuario();
		$cat_usuario_id = intval(valorEnArreglo($arr_reg_usuario, 'cat_usuario_id'));
		if(!$cat_usuario_id){
			$this->redireccionaError('Identidicador de usuario: cat_usuario_id vacío', 'No se pudo identificar el valor de la variable cat_usuario_id, el cual es necesario para el filtrado de la información en la vista');
		}
		
		$this->defineVista("Mostrador.php");
		$this->arr_param = array(
			'permiso_borrar'=>'borrar-cult',
			'permiso_edicion'=>'ae-cultivo',
			'cmp_id_nom'=>'cultivo_id',
			'controlador_frm'=>'cultivo',
			'accion_frm'=>'inicio',
			'catalogo'=>'cultivo',
			'arr_url_arg'=>array('cat_usuario_id'=>$cat_usuario_id),
		);
		$this->setArrDatoVistaValor('tit_tabla', 'Variedad de cultivos');
		$cultivo = new Cultivo();
		$cultivo->setArrTbl(" AND `cat_usuario_id` = '".$cat_usuario_id."' ");
		$this->arr_tabla = $cultivo->getArrTbl();
	}
	/**
	 * Para plataforma wallawalla_adm
	 */
	public function inventario() {
		$this->arr_param = array(
			'permiso_borrar'=>'borrar-invent',
			'permiso_edicion'=>'ae-inventario',
			'cmp_id_nom'=>'inventario_id',
			'controlador_frm'=>'inventariofrm',
			'accion_frm'=>'inicio',
			'catalogo'=>'inventario'
		);
		$this->setArrDatoVistaValor('tit_tabla', 'Inventario');
		$inventario = new Inventario();
		$inventario->setArrTblInv();
		$this->arr_tabla = $inventario->getArrTbl();
		//echo json_encode($this->arr_tabla);
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	/**
	 * Acción de consulta de registros del catálogo de usuarios
	 */
	public function cat_usuario() {
		$this->arr_param = array(
			'permiso_borrar'=>'borrar-usr',
			'permiso_edicion'=>'ae-usuario',
			'cmp_id_nom'=>'cat_usuario_id',
			'controlador_frm'=>'catfrmgen',
			'accion_frm'=>$this->getAccion(),
			'catalogo'=>$this->getAccion()
		);
		
		$this->setArrDatoVistaValor('tit_tabla', 'Catálogo de usuarios');
		$cat_usuario = new CatUsuario();
		$cat_usuario->setArrTbl();
		$this->arr_tabla = $cat_usuario->getArrTbl();
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	/**
	 * Acción de consulta de registros del catálogo de grupos
	 */
	public function cat_grupo() {
		$this->arr_param = array(
			'permiso_borrar'=>'borrar-grupo',
			'permiso_edicion'=>'ae-grupo',
			'cmp_id_nom'=>'cat_grupo_id',
			'controlador_frm'=>'catfrmgpo',
			'accion_frm'=>$this->getAccion(),
			'catalogo'=>$this->getAccion()
		);
		
		$this->setArrDatoVistaValor('tit_tabla', 'Catálogo de grupos');
		$cat_grupo = new CatGrupo();
		$cat_grupo->setArrTbl();
		$this->arr_tabla = $cat_grupo->getArrTbl();
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	/**
	 * Acción de consulta de registros de log
	 */
	public function log() {
		$log = new log();
		$log->setArrTblLog();
		$this->arr_tabla = $log->getArrTbl();
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	/**
	 * Devuelve la estructura HTML para el botón abrir, que se ejecuta en el registro con id definido en el argumento
	 * @param int $cmp_id_val	El valor del campo id definido en el arreglo de parámetros arr_param
	 * @return string
	 */
	public function getHTMLBtnAbrir($cmp_id_val) {
		return '<a href="'.define_controlador($this->getParametro('controlador_frm'), $this->getParametro('accion_frm'), false, array($this->getParametro('cmp_id_nom')=>$cmp_id_val)).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Abrir</a>';
	}
	/**
	 * Devuelve la estructura HTML para el botón borrar, que se ejecuta en el registro con id definido en el argumento
	 * @param int $cmp_id_val El valor del campo id definido en el arreglo de parámetros arr_param
	 * @return string
	 */
	public function getHTMLBtnBorrar($cmp_id_val) {
		$arr_tag = array();
		if($this->tienePermiso($this->getParametro('permiso_borrar'))){
			$arr_tag[] = '<form class="d-inline frm_borrar" action="'.define_controlador('borrar', $this->getParametro('catalogo')).'" method="post">';
			$arr_tag[] = '	'.$this->getHTMLCamposOcultosBase();
			$arr_tag[] = '	<input type="hidden" name="'.$this->getParametro('cmp_id_nom').'" value="'.$cmp_id_val.'">';
			$arr_tag[] = '	<button type="submit" class="btn btn-danger btn-sm btn_borrar"><i class="fas fa-trash-alt"></i> Borrar</button>';
			$arr_tag[] = '</form>';
		}
		return tag_string($arr_tag);
	}
	/**
	 * Devuelve la estructura HTML para dar de alta un nuevo registro
	 * @return string
	 */
	public function getHTMLBtnAlta() {
		if($this->tienePermiso($this->getParametro('permiso_edicion'))){
			return '<a href="'.define_controlador($this->getParametro('controlador_frm'), $this->getParametro('accion_frm'), false, $this->getParametro('arr_url_arg')).'" class="btn btn-info btn-sm"><i class="fa fa-fw fa-file"></i> Alta registro</a>';
		}else{
			return '';
		}
	}
	public function getArrParam() {
		return $this->arr_param;
	}
}
