<?php
/**
 * Controlador CuestcatControl
 * Clase alterna para CuestFormaControl, sin la ejecución del contructor.
 * Debido a que la clase controlador CuestFormaControl ejecuta varias cosas en la función __constructor, se utiliza esta como alternativa para cuando no se desea que eso pase.
 * 
 * @author Ismael Rojas
 */
class CuestcatControl extends CuestBase{
	public function __construct() {
		//Se declara el constructor para así evitar que se ejecute el constructor que tiene CuestBase
	}
	/**
	 * Imprime la lista de municipios como estructura HTML con las opciones para el campo select
	 * Esta acción es llamada mediante Ajax para volver a imprimir la lista de municipios cuando se cambia de opción de estado
	 */
	public function imprime_municipios() {
		$cat_estado_id = (isset($_REQUEST["cat_estado_id"]))? $_REQUEST["cat_estado_id"] : "";
		$opt_municipio = "";
		if($cat_estado_id!=""){
			$cat_municipio = new CatN('cat_municipio');
			$cat_municipio->setHTMLOpcCat($this->getAndMpo($cat_estado_id));
			$opt_municipio = $cat_municipio->getHTMLOpcCat();
		}
		echo $opt_municipio;
	}
	/**
	 * Imprime la lista de localidades como estructura HTML con las opciones para el campo select
	 * Esta acción es llamada mediante Ajax para volver a imprimir la lista de localidades cuando se cambia de opción de municipio
	 */
	public function imprime_localidades() {
		$cat_municipio_id = (isset($_REQUEST["cat_municipio_id"]))? $_REQUEST["cat_municipio_id"] : "";
		$opt_localidad = "";
		if($cat_municipio_id!=""){
			$cat_localidad = new CatN('cat_localidad');
			$cat_localidad->setHTMLOpcCat($this->getAndLoc($cat_municipio_id));
			$opt_localidad = $cat_localidad->getHTMLOpcCat();
		}
		echo $opt_localidad;
	}
	/**
	 * Acción para generar archivo de exportación de cuestionarios en formato Excel
	 */
	public function exportar_xls() {
		$cat_cuestionario_id = (isset($_REQUEST["cat_cuestionario_id"]))? $_REQUEST["cat_cuestionario_id"] : "";
		$cuestionario = new Cuestionario($cat_cuestionario_id);
		$archivo = $this->getNombreArchivoExp($cat_cuestionario_id);
		$arr_cmps_excluir = $this->getArrCmpsExcluExp();
		
		
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$archivo.'.xls');
		header('Pragma: no-cache');
		header('Expires: 0');
		
		$cuestionario->exportarExcel("", $arr_cmps_excluir);
		if($cuestionario->getEsError()){
			$this->redireccionaErrorDeArr($cuestionario->getArr1erError(), true);
		}
	}
	/**
	 * Acción para generar archivo de exportación de cuestionarios en formato CSV
	 */
	public function exportar_csv() {
		$cat_cuestionario_id = (isset($_REQUEST["cat_cuestionario_id"]))? $_REQUEST["cat_cuestionario_id"] : "";
		$cuestionario = new Cuestionario($cat_cuestionario_id);
		$archivo = $this->getNombreArchivoExp($cat_cuestionario_id);
		$arr_cmps_excluir = $this->getArrCmpsExcluExp();
		
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Content-type: text/x-csv');
		header('Content-Disposition: attachment; filename='.$archivo.'.csv');
		
		$cuestionario->exportarCSV("", $arr_cmps_excluir);
		if($cuestionario->getEsError()){
			$this->redireccionaErrorDeArr($cuestionario->getArr1erError(), true);
		}
	}
	/**
	 * Acción para cambiar el estatus del cuestionario a Aprobado
	 */
	public function aprobar() {
		$cat_cuestionario_id = (isset($_REQUEST["cat_cuestionario_id"]))? intval($_REQUEST["cat_cuestionario_id"]) : 0;
		$cuestionario_id = (isset($_REQUEST["cuestionario_id"]))? $_REQUEST["cuestionario_id"] : '';
		
		if($cat_cuestionario_id===0){
			$this->redireccionaErrorAccion('sin_arg_cat_cuestionario_id');
		}
		if($cuestionario_id ===''){
			$this->redireccionaError("Argumento Id de cuestionario no identificado", "No se pudo identificar el argumento cuestionario_id");
		}
		
		$permiso = new Permiso();
		$permiso->setArrPermisos();
		$permiso->setArrPermisosCuest($cat_cuestionario_id);
		
		if(!$permiso->tienePermiso('aprobar')){
			$this->redireccionaErrorAccion('sin_permisos', array("tit_accion"=>"Aprobar"));
		}
		
		$cuestionario = new Cuestionario($cat_cuestionario_id);
		$cuestionario->setArrRegTblC00($cuestionario_id);
		$arr_reg_cuest = $cuestionario->getArrRegCuestionario();
		if(empty($arr_reg_cuest)){
			$this->redireccionaError("Id de cuestionario inválido", "El id de cuestionario proporcionado en el argumento no se encuentra disponible");
		}
		
		$estatus_cuest = intval(valorEnArreglo($arr_reg_cuest, 'estatus_cuest'));
		if($estatus_cuest!==6){
			$this->redireccionaError("No se puede aprobar el cuestionario", "El estatus actual del cuestionario no es el que permite hacer la transición a Aprobado");
		}
		//Se cambia el estatus a aprobado (estatus_cuest = 7)
		$cuestionario->AprobarCuestionario($cuestionario_id);
		$arr_url_arg = array('cat_cuestionario_id'=>$cat_cuestionario_id, 'cuestionario_id'=>$cuestionario_id);
		redireccionar('cuestforma', 'inicio', $arr_url_arg);
	}
	/**
	 * Genera y devuelve el nombre del archivo a exportar
	 * @param int $cat_cuestionario_id
	 * @return string
	 */
	private function getNombreArchivoExp($cat_cuestionario_id){
		$ahora = date('Ymd_hi');
		return cuest_cve($cat_cuestionario_id)."_".$ahora;
	}
	/**	 * Devuelve el arreglo que contiene la lista de campos a excluir en la exportación
	 * @return array
	 */
	private function getArrCmpsExcluExp(){
		return array("json_parametros","json_validaciones");
	}
	
}
