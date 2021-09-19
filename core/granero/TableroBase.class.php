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
}
