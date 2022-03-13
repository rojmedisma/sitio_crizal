<?php
/**
 * Controlador BorrarControl
 * Contiene las acciones de borrar de los diferentes tipos de formularios (cuestionarios, catálogos, etc)
 * @author Ismael Rojas
 */
class BorrarControl extends ControladorBase{
	private $controlador_destino;
	private $accion_destino;
	private $permiso;
	public function __construct() {
		$this->controlador_destino = isset($_REQUEST['controlador_fuente'])? $_REQUEST['controlador_fuente'] : "";
		$this->accion_destino = isset($_REQUEST['accion_fuente'])? $_REQUEST['accion_fuente'] : "";
		$this->permiso = new Permiso();
		$this->permiso->setArrPermisos();
		$this->setArrPermisos($this->permiso->getArrPermisos());
		
	}
	/**
	 * Acción borrar registro para el formulario de cuestionario
	 */
	public function cuestionario() {
		$cat_cuestionario_id = (isset($_REQUEST['cat_cuestionario_id']))? intval($_REQUEST['cat_cuestionario_id']) : 0;
		$cuestionario_id = (isset($_REQUEST['cuestionario_id']))? $_REQUEST['cuestionario_id'] : "";
		$this->permiso->setArrPermisosCuest($cat_cuestionario_id);
		$this->setArrPermisos($this->permiso->getArrPermisos());
		
		if(!$this->tienePermiso("borrar")){
			$this->redireccionaErrorAccion('sin_permisos', array('tit_accion'=>'Borrar cuestionario'));
		}
		
		$cuestionario = new Cuestionario($cat_cuestionario_id);
		$cuestionario->borrarCuestionario($cuestionario_id);
		redireccionar($this->controlador_destino, $this->accion_destino, array('cat_cuestionario_id'=>$cat_cuestionario_id));
	}
	/**
	 * Acción borrar registro para el formulario de usuarios (cat_usuario)
	 */
	public function cat_usuario() {
		$cat_usuario_id = (isset($_REQUEST['cat_usuario_id']))? intval($_REQUEST['cat_usuario_id']) : 0;
		if(!$this->tienePermiso('borrar-usr')){
			$this->redireccionaErrorAccion('sin_permisos', array('tit_accion'=>'Borrar usuario'));
		}
		
		$cat_usuario = new CatUsuario();
		$cat_usuario->borrarRegistro($cat_usuario_id);
		redireccionar($this->controlador_destino, $this->accion_destino);
	}
	/**
	 * Acción borrar registro para el formulario de grupos (cat_grupo)
	 */
	public function cat_grupo() {
		$cat_grupo_id = (isset($_REQUEST['cat_grupo_id']))? intval($_REQUEST['cat_grupo_id']) : 0;
		if(!$this->tienePermiso('borrar-grupo')){
			$this->redireccionaErrorAccion('sin_permisos', array('tit_accion'=>'Borrar grupo'));
		}
		$cat_grupo = new CatGrupo();
		$cat_grupo->borrarRegistro($cat_grupo_id);
		redireccionar($this->controlador_destino, $this->accion_destino);
	}
	/**
	 * Acción borrar registro para el formulario de inventario
	 */
	public function inventario() {
		$inventario_id = (isset($_REQUEST['inventario_id']))? intval($_REQUEST['inventario_id']) : 0;
		if(!$this->tienePermiso('borrar-invent')){
			$this->redireccionaErrorAccion('sin_permisos', array('tit_accion'=>'Borrar inventario'));
		}
		$inventario = new Inventario();
		$inventario->borrarRegistro($inventario_id);
		redireccionar($this->controlador_destino, $this->accion_destino);
	}
	public function cult_inventario() {
		$cultivo_id = (isset($_REQUEST['cultivo_id']))? intval($_REQUEST['cultivo_id']) : 0;
		$cult_inventario_id = (isset($_REQUEST['cult_inventario_id']))? intval($_REQUEST['cult_inventario_id']) : 0;
		if(!$this->tienePermiso('borrar-cult')){
			$this->redireccionaErrorAccion('sin_permisos', array('tit_accion'=>'Borrar Inventario'));
		}
		$cult_inventario = new CultInventario();
		$cult_inventario->borrarRegistro($cult_inventario_id);
		$arr_url_arg = array('cultivo_id'=>$cultivo_id);
		redireccionar($this->controlador_destino, $this->accion_destino, $arr_url_arg);
	}
}
