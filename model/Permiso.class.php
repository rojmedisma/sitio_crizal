<?php
/**
 * Clase modelo Permiso
 * Para la consulta de permisos del usuario actual
 * @author Ismael
 *
 */
class Permiso{
	private $arr_usr;
    private $arr_permisos;
    public function __construct($cat_usuario_id="") {
        $usuario = new Usuario();
        $usuario->setArrUsuario($cat_usuario_id);
		$this->arr_usr = $usuario->getArrUsuario();
		//$usuario = (isset($arr_usr['usuario']))? $arr_usr['usuario'] : "";
		//$this->setEsDesarrollador($cat_grupo_id, $usuario);
    }
	/**
	 * Genera el arreglo que contiene los permisos del usuario indicado en el constructor
	 */
	public function setArrPermisos() {
		$cat_grupo_id = (isset($this->arr_usr['cat_grupo_id']))? $this->arr_usr['cat_grupo_id'] : "";
		$usuario  = (isset($this->arr_usr['usuario']))? $this->arr_usr['usuario'] : "";
		
		//Se define el arreglo de permisos por grupo
		$bd = new BaseDatos();
        $arr_tbl = $bd->getArrDeTabla("grupo", " AND `cat_grupo_id` = '".$cat_grupo_id."' AND `activo` = 1");
		$arr_permisos = array();
        foreach ($arr_tbl as $arr_det){
            $arr_permisos[] = $arr_det['cat_permiso_cve'];
        }
		//Rol interno y oculto
		if($this->esDesarrollador($cat_grupo_id, $usuario)){
			$arr_permisos[] = 'desarrollador';
		}
		
        $this->arr_permisos = $arr_permisos;
	}
    /**
     * Devuelve el arreglo de los permisos del usuario actual
     * @return array
     */
    public function getArrPermisos(){
        return $this->arr_permisos;
    }
    /**
     * Indica si el usuario tiene el permiso que se manda como argumento como clave permiso
     * @param string $cat_permiso_cve
     * @return boolean
     */
    public function tienePermiso($cat_permiso_cve){
        $arr_permisos = $this->getArrPermisos();
        if(in_array($cat_permiso_cve, $arr_permisos)){
            return true;
        }else{
            return false;
        }
    }
	/**
	 * Para cada permiso de cuestionario (Identificados por un prefijo definido), agrega un permiso alias para una identificación más sencilla
	 * @param int $cat_cuestionario_id
	 */
	public function setArrPermisosCuest($cat_cuestionario_id) {
		$arr_alias = array(
			"ae"=>"escritura",
			"al"=>"lectura",
			"al-mpo"=>"lectura_mpo",
			"al-edo"=>"lectura_edo",
			"al-nal"=>"lectura_nal",
			"al"=>"lectura",
			"nuevo"=>"nuevo_cuest",
			"aprob"=>"aprobar",
			"nac"=>"ver_todo",
			"asig"=>"ver_asignados",
		);
		$cuet_cve = cuest_cve($cat_cuestionario_id);
		$arr_permisos = $this->arr_permisos;
		foreach($arr_permisos as $nom_permiso){
			if(substr($nom_permiso,0,3) == $cuet_cve){
				$p_sin_prefijo = substr($nom_permiso,4);
				$permiso_alias = (isset($arr_alias[$p_sin_prefijo]))? $arr_alias[$p_sin_prefijo] : $p_sin_prefijo;
				array_push($this->arr_permisos, $permiso_alias);
			}
		}
	}
	/**
	 * Indica si el usuario actual tiene los requisitos para tener el rol de desarrollador
	 * @param int $cat_grupo_id
	 * @param string $usuario
	 */
	private function esDesarrollador($cat_grupo_id, $usuario) {
		if($cat_grupo_id==1 && $usuario=='irojas'){
			return true;
		}else{
			return false;
		}
	}

}