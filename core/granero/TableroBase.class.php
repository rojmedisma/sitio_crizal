<?php
/**
 * Clase core TableroBase
 * Es una extensión para todos los controladores que contienen acciones que serán desplegadas dentro del tablero
 *
 * @author Ismael Rojas
 */
class TableroBase extends ControladorBase{
	private int $color;
	protected object $permiso;
	/**
	 * Función propia del proyecto siap_igei
	 * Constructor para el funcionamiento de las opciones del tablero
	 */
	protected function __constructTablero(){
		$this->setArrRegUsuario();	//Se crea el arreglo con el detalle de datos del usuario
		//echo json_encode($this->getArrRegUsuario());
		//Se define el arreglo de permisos
		$this->permiso = new Permiso();
		$this->permiso->setArrPermisos();
		$this->setArrPermisos($this->permiso->getArrPermisos());
		
		//Si el usuario está firmado y no tiene el permiso de acceso, se muestra el error
		if(!empty($this->permiso->getArrPermisos()) &&  !$this->tienePermiso('acceso')){
			$this->redireccionaErrorAccion('sin_permisos', array('tit_accion'=>'Acceso al sistema'));
		}
		$this->color = 8;
	}
	public function getColor() {
		return $this->color;
	}
	/**
	 * Devuelve el Id del usuario actual
	 * @return int
	 */
	public function getUsuarioId(){
		$usuario_id = (isset($_SESSION['cat_usuario_id']))? $_SESSION['cat_usuario_id'] : "";
		return $usuario_id;
	}
	protected function permiteIngreso() {
		$cat_usuario_id = $this->getUsuarioId();
		if(!$cat_usuario_id){
			$this->redireccionaError('Identificador de usuario: cat_usuario_id vacío', 'No se pudo identificar el valor de la variable cat_usuario_id, el cual es necesario para el filtrado de la información en la vista');
		}
	}
	protected function permiteIngresoProductor() {
		$this->permiteIngreso();
		if(!$this->tienePermiso('al-cultivo')){
			$this->redireccionaErrorAccion('sin_permisos', array("tit_accion"=>"Cultivo - Lectura"));
		}
	}
}
