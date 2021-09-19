<?php
/**
 * Clase modelo Cuestionario
 * Para el manejo del contenido del registro de cuestinario distribuido en diferentes tablas dentro de la base de datos
 * @author Ismael Rojas
 */
class Cuestionario extends ModeloBase{
	private $cat_cuestionario_id;
	private $arr_tbl_cuestionario = array();
	private $arr_reg_cuestionario = array();
	private $arr_tablas_cuest = array();
	private $str_query = "";
	private $and_tbl_c00;
	private $and_cuest_permisos="";
	private $arr_qry_act_c00 = array();
	private $arr_reg_c00 = array();
	private $arr_json_param = array();
	private $arr_cuestionario_id;
	public function __construct($cat_cuestionario_id){
		parent::__construct();
		$this->cat_cuestionario_id = $cat_cuestionario_id;
		//Sentencia AND básica para consultar los cuestionarios activos o válidos para consulta y cálculo
		$this->and_tbl_c00 = " AND `c00`.`inhabilitar` IS NULL AND `c00`.`borrar` IS NULL AND `c00`.`cat_cuestionario_id` = '".$this->cat_cuestionario_id."' ";
	}
	/**
	 * Genera el arreglo que contiene el detalle formado por todas las tablas pertenecientes al cuestionario actual
	 * @param string $and	Complemento del query despues del where (AND, ORDER BY...)
	 * @param boolean $con_cat_detalle	Bandera para indicar si el query va a contener detalle obtenido de las tablas de catálogo
	 * @param boolean $con_and_tbl_c00	Bandera para incluir la sentencia query AND básica para consultar los cuestionarios activos o válidos para consulta y cálculo
	 * @param boolean $con_cuest_permisos	Para filtrar la búsqueda a partir del los permisos del usuario actual
	 */
	public function setArrTblCuestionario($and="", $con_cat_detalle=false, $con_and_tbl_c00=true, $con_cuest_permisos= true) {
		$this->setArrTablasCuest();
		
		$str_query = "SELECT";
		$str_query .= " `c00`.*,";
		if($con_cat_detalle){
			$str_query .= " `cat_cuestionario`.`descripcion` AS `cat_cuestionario_desc`,";
			$str_query .= " `cat_estado`.`descripcion` AS `cat_estado_desc`,";
			$str_query .= " `cat_usuario`.`usuario` AS `autor_usuario`,";
			$str_query .= " CONCAT_WS(' ', `cat_usuario`.`ap_paterno`, `cat_usuario`.`ap_materno`, `cat_usuario`.`nombre`) AS `autor_nombre`,";
		}
		$str_query .= " ".$this->getQrySelCmpsTablas();
		$str_query .= " FROM `".$this->bd->getBD()."`.`c00`";
		if($con_cat_detalle){
			$str_query .= " LEFT JOIN `".$this->bd->getBD()."`.`cat_cuestionario` ON(`c00`.`cat_cuestionario_id` = `cat_cuestionario`.`cat_cuestionario_id`)";
			$str_query .= " LEFT JOIN `".$this->bd->getBD()."`.`cat_estado` ON(`c00`.`cat_estado_id` = `cat_estado`.`cat_estado_id`)";
			$str_query .= " LEFT JOIN `".$this->bd->getBD()."`.`cat_usuario` ON(`c00`.`cat_usuario_id` = `cat_usuario`.`cat_usuario_id`)";
		}
		$str_query .= " ".$this->getQryJoinTablas();
		$str_query .= " WHERE 1";
		if($con_and_tbl_c00){
			$str_query .= " ".$this->and_tbl_c00;
		}
		if($con_cuest_permisos){
			$this->setAndCuestPermisos();
			$str_query .= " ".$this->and_cuest_permisos;
		}
		$str_query .= " ".$and;
		$this->str_query = $str_query;
		
		$this->arr_tbl_cuestionario = $this->bd->getArrDeQuery($str_query, 'cuestionario_id');
	}
	
	/**
	 * Genera el arreglo que contiene el detalle del registro con id indicado en el argumento $cuestionario_id
	 * @param variant $cuestionario_id
	 * @param boolean $con_cat_detalle
	 * @param boolean $con_and_tbl_c00
	 */
	public function setArrRegCuestionario($cuestionario_id, $con_cat_detalle=false, $con_and_tbl_c00=true) {
		if($cuestionario_id){
			$and = " AND `c00`.`cuestionario_id` = '".$cuestionario_id."' ";
			$this->setArrTblCuestionario($and, $con_cat_detalle, $con_and_tbl_c00, false);
			$arr_tbl_cuest = $this->getArrTblCuestionario();
			$this->arr_reg_cuestionario = $arr_tbl_cuest[$cuestionario_id];
		}else{
			$this->arr_reg_cuestionario = array();
		}	
	}
	
	/**
	 * Imprime una tabla HTML con el contenido de las tablas de cuestionario para permitir generar un archivo Excel
	 * @param string $and	Sentencia AND para el fitrado de la información a exportar
	 * @param array $arr_cmps_excluir	Arreglo de campos a excluir en la exportación
	 */
	public function exportarExcel($and="", $arr_cmps_excluir=array()) {
		$this->setArrTblCuestionario($and);
		$arr_tbl_cuestionario = $this->getArrTblCuestionario();
		//echo "<br>".json_encode($arr_tbl_cuestionario)."<br>";
		
		echo '<table>';
		//Se imprime el título
		echo '<thead>';
		foreach ($arr_tbl_cuestionario as $arr_det){
			echo '<tr>';
			foreach ($arr_det as $cmp_tit=>$cmp_val){
				if(!in_array($cmp_tit, $arr_cmps_excluir)){
					echo '<th>'.$cmp_tit.'</th>';
				}
			}
			echo '</tr>';
			break;  //Me salgo en el primer registro
		}
		echo '</thead>';
		echo '<tbody>';
		foreach ($arr_tbl_cuestionario as $arr_det){
			echo '<tr>';
			foreach ($arr_det as $cmp_tit=>$cmp_val){
				if(!in_array($cmp_tit, $arr_cmps_excluir)){
					echo '<td>'.utf8_decode($cmp_val).'</td>'; //Mas adelante ver como quitar el utf8_decode
				}
			}
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
	}
	/**
	 * Imprime el contenido de las tablas de cuestionario para permitir generar un archivo CSV
	 * @param string $and	Sentencia AND para el fitrado de la información a exportar
	 * @param array $arr_cmps_excluir	Arreglo de campos a excluir en la exportación
	 */
	public function exportarCSV($and="", $arr_cmps_excluir=array()){
		$this->setArrTblCuestionario($and);
		$arr_tbl_cuestionario = $this->getArrTblCuestionario();
		$arr_h = array();
		foreach ($arr_tbl_cuestionario as $arr_det){
			foreach ($arr_det as $cmp_tit=>$cmp_val){
				if(!in_array($cmp_tit, $arr_cmps_excluir)){
					$arr_h[] = '"'.$cmp_tit.'"';
				}
			}
			break;  //Me salgo en el primer registro
		}
		echo implode(",", $arr_h);
		echo "\n";
		$arr_reemp = array("\\"=>"", "\""=>"'");
		foreach ($arr_tbl_cuestionario as $arr_det){
			$arr_b = array();
			foreach ($arr_det as $cmp_tit=>$cmp_val){
				if(!in_array($cmp_tit, $arr_cmps_excluir)){
					$arr_b[] = '"'.str_replace(array_keys($arr_reemp), array_values($arr_reemp), utf8_decode($cmp_val)).'"';
				}
			}
			echo implode(",", $arr_b);
			echo "\n";
		}
	}
	
	/**
	 * Genera arreglo arr_tablas_cuest que contiene las tablas declaradas en el campo lista_tablas
	 */
	private function setArrTablasCuest(){
		$cat_cuest_modulo = new CatCuestModulo($this->cat_cuestionario_id);
		$cat_cuest_modulo->setArrCmpListaTablas();
		$this->arr_tablas_cuest = $cat_cuest_modulo->getArrCmpListaTablas();
	}
	/**
	 * Devuelve la sentencia query para el SELECT de las tablas 
	 * @return string
	 */
	private function getQrySelCmpsTablas() {
		$arr_qry_param = array(
			"query"=>"`%nom_tbl%`.*",
			"separador"=>", "
		);
		return $this->getQryStrDeTablas($arr_qry_param);
	}
	/**
	 * Devuelve la sentencia query para el JOIN de las tablas
	 * @return string
	 */
	private function getQryJoinTablas(){
		$arr_qry_param = array(
			"query"=>" LEFT JOIN `".$this->bd->getBD()."`.`%nom_tbl%` ON(`c00`.`cuestionario_id` = `%nom_tbl%`.`cuestionario_id`)",
			"separador"=>" "
		);
		return $this->getQryStrDeTablas($arr_qry_param);
	}
	/**
	 * Genera la sentencia query que viene indicada en el argumento para las tablas del cuestionario
	 * @param array $arr_qry_param
	 * @return string
	 */
	private function getQryStrDeTablas($arr_qry_param){
		$qry_sel = "";
		$arr_tablas_cuest = $this->arr_tablas_cuest;
		if(!empty($arr_tablas_cuest) && isset($arr_qry_param['query']) && isset($arr_qry_param['separador'])){
			$arr_qry_sel = array();
			foreach($arr_tablas_cuest as $nom_tbl_c){
				$arr_qry_sel[] = str_replace("%nom_tbl%", $nom_tbl_c, $arr_qry_param['query']);
			}
			$qry_sel = implode($arr_qry_param['separador'], array_values($arr_qry_sel));
		}
		return $qry_sel;
	}
	/**
	 * Crea el cuestionario en modo inhabilitado, para no ser tomado en cuenta en las consultas hasta que sea guardado
	 * @param int $cat_usuario_id	Id del usuario autor
	 * @return int	Regresa cuestionario_id
	 */
	public function crearCuest($cat_usuario_id) {
		$cat_usuario = new Usuario();
		$cat_usuario->setArrUsuario($cat_usuario_id);
		$cat_estado_id = $cat_usuario->get_val_campo('cat_estado_id');
		
		$arr_cmps_c00 = array(
			'`cuestionario_id`'=>txt_sql(""),
			'`cat_cuestionario_id`'=>txt_sql($this->cat_cuestionario_id, false),
			'`cat_usuario_id`'=>txt_sql($cat_usuario_id, false),
			'`cat_estado_id`'=>txt_sql($cat_estado_id, false),
			'`cat_cader_id`'=>txt_sql(""),
			'`estatus_cuest`'=>txt_sql(""),
			'`creacion_fecha`'=>txt_sql(""),
			'`creacion_hora`'=>txt_sql(""),
			'`modifica_fecha`'=>txt_sql(""),
			'`modifica_hora`'=>txt_sql(""),
			'`inhabilitar`'=>txt_sql("1"),
			'`borrar`'=>txt_sql(""),
		);
		
		
		$qry_act = "INSERT INTO `".$this->bd->getBD()."`.`c00` (".implode(",",array_keys($arr_cmps_c00)).") VALUES (".implode(",",array_values($arr_cmps_c00)).");";
		$cuestionario_id = $this->bd->ejecutaQryInsert($qry_act);
		
		$cat_cuest_modulo = new CatCuestModulo($this->cat_cuestionario_id);
		$cat_cuest_modulo->setArrCmpListaTablas();
		
		$arr_tablas_cuest = $cat_cuest_modulo->getArrCmpListaTablas();
		//Se inserta el registro en el resto de las tablas
		foreach($arr_tablas_cuest as $tbl_nom){
			$arr_cmps_ins = array('cuestionario_id'=>txt_sql($cuestionario_id));
			$qry_act = "INSERT INTO `".$this->bd->getBD()."`.`".$tbl_nom."` (".implode(",",array_keys($arr_cmps_ins)).") VALUES (".implode(",",array_values($arr_cmps_ins)).");";
			$this->bd->ejecutaQry($qry_act);
		}
		
		$log = new Log();
		$log->setRegLog('cuestionario_id', $cuestionario_id, 'guardar', 'Aviso', "Se creó cuestionario en modo inhabilitado");
		return $cuestionario_id;
	}
	/**
	 * Ejecuta la actualización de cuestionario a partir de un arreglo de campos
	 * NOTA: Se usa en los controladores CuestForma y Muestra
	 * @param array $arr_cmps	Arreglo de campos con la información a actualizar
	 * @param int $cuestionario_id	Id del cuestionario a actualizar
	 * @return boolean
	 */
	public function actualizaFrmCuest($arr_cmps, $cuestionario_id) {
		$log = new Log();
		if(!$cuestionario_id){
			$this->setError("Argumento cuestionario_id vacío", "En función actualizaFrmCuest se mandó el argumento cuestionario_id vacío.");
			return false;
		}
		foreach($arr_cmps as $tbl_nom => $arr_cmp_det){
			$arr_act = array();
			foreach ($arr_cmp_det as $cmp_nom => $cmp_val){
				if($cmp_nom!='cuestionario_id'){
					$arr_act[] = "`".$tbl_nom."`.`".$cmp_nom."` = ".$cmp_val;
				}
			}
			$qry_act = "UPDATE `".$this->bd->getBD()."`.`".$tbl_nom."` SET ".implode(",", array_values($arr_act))." WHERE `cuestionario_id` ='".$cuestionario_id."' LIMIT 1;";
			$this->bd->ejecutaQry($qry_act);
		}
		return true;
	}
	/**
	 * Ejecuta la sentencia query para marcar como borrado el registro de cuestionario con Id indicado en el argumento
	 * @param int $cuestionario_id	Id del registro de cuestionario que se desea borrar
	 */
	public function borrarCuestionario($cuestionario_id) {
		$this->borrarRegistro($cuestionario_id, 'c00', 'cuestionario_id');
	}
	/**
	 * Se actualizan los valores necesarios en la tabla c00
	 * @param integer $cuestionario_id
	 */
	public function actualizaTblC00($cuestionario_id){
		if(empty($this->arr_qry_act_c00)){
			$this->setError("Arreglo para tabla `c00` vacío", "No se definió el arreglo de campos a actualizar para la tabla `c00`");
			return false;
		}
		
		$qry_act = "UPDATE `".$this->bd->getBD()."`.`c00` SET ".implode(",", array_values($this->arr_qry_act_c00))." WHERE `cuestionario_id` = '".$cuestionario_id."';";
		$this->bd->ejecutaQry($qry_act);
		return true;
	}
	/**
	 * Genera un arreglo con el contenido del registro de la tabla 'c00'
	 * @param string $cuestionario_id	Id del registro de cuestionario
	 */
	private function setArrRegC00($cuestionario_id) {
		if($cuestionario_id){
			$this->arr_reg_c00 = $this->bd->getArrRegDeTabla('c00', 'cuestionario_id', $cuestionario_id);
		}else{
			$this->arr_reg_c00 = array();
		}
	}
	/**
	 * Genera un arreglo con el contenido del registro de la tabla 'c00', filtrando el contenido con el valor de and_tbl_c00
	 * @param int $cuestionario_id	Id del registro de cuestionario
	 */
	public function setArrRegTblC00($cuestionario_id) {
		$arr_reg_cuestionario = array();
		if($cuestionario_id){
			$arr_reg_cuestionario = $this->bd->getArrRegDeTabla('c00', 'cuestionario_id', $cuestionario_id, $this->and_tbl_c00);
		}
		$this->arr_reg_cuestionario = $arr_reg_cuestionario;
	}
	
	
	/**
	 * Genera el arreglo que contiene las sentencias query UPDATE para cada campo de la tabla 'c00'
	 * @param int $cuestionario_id
	 */
	public function setArrQryTblC00($cuestionario_id) {
		$this->setArrRegC00($cuestionario_id);
		
		$arr_cmps_act = array();
		if(valorEnArreglo($this->arr_reg_c00, 'creacion_fecha') == ""){
			$arr_cmps_act['creacion_fecha'] = "`creacion_fecha` = IFNULL(`creacion_fecha`, CURDATE())";
		}
		if(valorEnArreglo($this->arr_reg_c00, 'creacion_hora') == ""){
			$arr_cmps_act['creacion_hora'] = "`creacion_hora` = IFNULL(`creacion_hora`, CURTIME())";
		}
		$arr_cmps_act['modifica_fecha'] = "`modifica_fecha` = CURDATE()";
		$arr_cmps_act['modifica_hora'] = "`modifica_hora`= CURTIME()";
		$arr_cmps_act['inhabilitar'] = "`inhabilitar`= NULL";
		
		$this->arr_qry_act_c00 = $arr_cmps_act;
	}
	
	/**
	 * Lo principal en esta función es:
	 *	1. Va generando un arreglo "arr_json_param" conforme sea llamada la función, debido a esto se declara la variable "arr_json_param"	como propiedad
	 *	2. Agrega el registro query para la variable definida en el argumento "json_cmp_nom" que será actualizado junto con los demás registros query que al final formaran la sentencia UPDATE para la tabla c00
	 * @param string $json_cmp_nom	Nombre del campo JSON de la tabla c00 que será actualizado
	 * @param string $llave_nom	Nombre de la llave dentro del arreglo JSON que será modificada
	 * @param variant $llave_val	Valor a asignar a la llave
	 */
	public function c00AgregaParamJSON($json_cmp_nom, $llave_nom, $llave_val) {
		//De principio arr_json_param está vacío pero se puede ir llenando conforme sea llamada esta función
		if(isset($this->arr_json_param[$json_cmp_nom])){
			$json_cmp_val = valorEnArreglo($this->arr_json_param, $json_cmp_nom);
		}else{
			$json_cmp_val = valorEnArreglo($this->arr_reg_c00, $json_cmp_nom);
		}
		
		$o_json_campo = ($json_cmp_val!="")? json_decode($json_cmp_val) : (object)[];
		$o_json_campo->$llave_nom = $llave_val;
		$this->arr_json_param[$json_cmp_nom] = json_encode($o_json_campo);
		
		$this->c00AgregaRegQry($json_cmp_nom, $this->arr_json_param[$json_cmp_nom]);
	}
	/**
	 * Genera el registro de sentencia query perteneciente al campo definido en el argumento, con la finalidad de complementar el arreglo "arr_qry_act_c00" para hacer el UPDATE de la tabla c00
	 * @param string $cmp_nom	Nombre del campo a asignar dentro de la sentencia
	 * @param string $cmp_val	Valor del campo a asignar dentro de la sentencia
	 */
	public function c00AgregaRegQry($cmp_nom, $cmp_val) {
		$arr_qry_act_c00 = $this->arr_qry_act_c00;
		$arr_qry_act_c00[$cmp_nom] = "`".$cmp_nom."` = ".txt_sql($cmp_val);
		$this->arr_qry_act_c00 = $arr_qry_act_c00;
	}
	
	/**
	 * Regresa el arreglo que contiene el detalle formado por todas las tablas pertenecientes al cuestionario actual
	 * @return string
	 */
	public function getArrTblCuestionario() {
		return $this->arr_tbl_cuestionario;
	}
	/**
	 * Regresa el arreglo que contiene el detalle del registro de cuestionario creado en setArrRegCuestionario
	 * @return array
	 */
	public function getArrRegCuestionario() {
		return $this->arr_reg_cuestionario;
	}
	/**
	 * Regresa el query generado y asignado en ciertas funciones
	 * @return string
	 */
	public function getStrQuery() {
		return $this->str_query;
	}
	/**
	 * Para aquellos campos de identificación que pueden llegar a tener nombre de campo distinto entre cuestionarios, se creó este método que hace la relación de los campos mediante una llave enviada en el argumento
	 * @param string $llave
	 * @return string
	 */
	public function getCmpNomEnCuest($llave){
		$cmp_nom = "";
		if(intval($this->cat_cuestionario_id)===1){
			switch ($llave){
				case 'edo':	$cmp_nom = "prod_edo"; break;
				case 'mpo':	$cmp_nom = "prod_mpo"; break;
				case 'loc':	$cmp_nom = "prod_loc"; break;
			}
		}
		return $cmp_nom;
	}
	/**
	 * Define el valor de la variable "and_cuest_permisos", la cual contiene la sentencia AND para hacer el filtro de consulta de cuestionarios por permisos
	 * @return string
	 */
	private function setAndCuestPermisos() {
		$permiso = new Permiso();
		$permiso->setArrPermisos();
		$permiso->setArrPermisosCuest($this->cat_cuestionario_id);
		
		$usuario = new Usuario();
		$usuario->setArrUsuario();
		$cat_usuario_id = $usuario->get_val_campo('cat_usuario_id');	//$this->usuario_dato('cat_usuario_id');
		
		$and = "";
		if($permiso->tienePermiso("lectura_nal")){
			//Permiso de lectura Nacional. Significa que puede ver todos los registros
			$and = "";
		}elseif($permiso->tienePermiso("lectura_edo")){
			//Permiso de lectura Estatal. Significa que puede ver los registros del estado configurado en el catálogo de usuarios
			$cat_estado_id = $usuario->get_val_campo('cat_estado_id');
			if($cat_estado_id==""){
				$this->setError("Dato <strong>Estado</strong> no identificado", "La información del usuario actual parece incompleta, favor de verificar que el campo <strong>Estado</strong> se encuentre registrado en el catálogo de usuarios.");
				return false;
			}
			$and = " AND (`".$this->getCmpNomEnCuest("edo")."` LIKE '".$cat_estado_id."' OR ".$this->getQrySelAutor($cat_usuario_id).")";
		}elseif($permiso->tienePermiso("lectura_mpo")){
			//Permiso de lectura Municipal. Significa que puede ver los registros del municipio configurado en el catálogo de usuarios
			$cat_municipio_id = $usuario->get_val_campo('cat_municipio_id');
			if($cat_municipio_id==""){
				$this->setError("Dato <strong>Municipio</strong> no identificado", "La información del usuario actual parece incompleta, favor de verificar que el campo <strong>Municipio</strong> se encuentre registrado en el catálogo de usuarios.");
				return false;
			}
			$and = " AND (`".$this->getCmpNomEnCuest("mpo")."` LIKE '".$cat_municipio_id."' OR ".$this->getQrySelAutor($cat_usuario_id).")";
		}else{
			//Permiso predeterminado. El permiso predeterminado es de lectura a nivel autor, significa que sólo muestra los cuestionarios creados por el usuario actual
			
			if($cat_usuario_id==""){
				$this->setError("Dato cat_usuario_id no identificado", "No se identificó el cat_usuario_id");
				return false;
			}
			$and = " AND ".$this->getQrySelAutor($cat_usuario_id);
		}
		$this->and_cuest_permisos = $and;
	}
	/**
	 * Devuelve parte de la sentencia query AND para hacer el filtro por usuario mediante el campo cat_usuario_id de la tabla c00
	 * @return string
	 */
	private function getQrySelAutor($cat_usuario_id){
		if($cat_usuario_id==""){
			$this->setError("Dato cat_usuario_id no identificado", "No se identificó el cat_usuario_id");
			return false;
		}
		return "`c00`.`cat_usuario_id` = '".$cat_usuario_id."'";
	}
	/**
	 * Devuelve el arreglo JSON de parámetros
	 * @return array
	 */
	public function getArrJsonParam() {
		return $this->arr_json_param;
	}
	/**
	 * Cambia el estatus del cuestionario actual a Aprobado
	 * @param int $cuestionario_id	Id del cuestionario a aprobar
	 */
	public function AprobarCuestionario($cuestionario_id) {
		$estatus_cuest = 7;
		$estatus_cuest_desc = $this->getEstatusCuestDesc($estatus_cuest);
		
		$qry_update = "UPDATE `".$this->bd->getBD()."`.`c00` SET `estatus_cuest` = '7', `estatus_cuest_desc` = '".$estatus_cuest_desc."' WHERE `cuestionario_id` = '".$cuestionario_id."'; ";
		$this->bd->ejecutaQry($qry_update);
		$log = new Log();
		$log->setRegLog('cuestionario_id', $cuestionario_id, 'aprobar', 'Aviso', "Se cambió estatus a Aprobado");
	}
	/**
	 * Devuelve la descripción del estatus del cuestionario
	 * @param int $estatus_cuest	Id del estatus del cuestionario
	 * @return string
	 */
	public function getEstatusCuestDesc($estatus_cuest) {
		if(!$estatus_cuest){
			$estatus_cuest = intval($this->getCampoValor('estatus_cuest'));
		}
		
		$estatus_desc = "";
		switch ($estatus_cuest){
			case 2: $estatus_desc = "Sin sector"; break;
			case 3: $estatus_desc = "Incompleto con observaciones"; break;
			case 4: $estatus_desc = "Incompleto"; break;
			case 5: $estatus_desc = "Completado con observaciones"; break;
			case 6: $estatus_desc = "Terminado"; break;
			case 7: $estatus_desc = "Aprobado"; break;
		}
		return $estatus_desc;
	}
	/**
	 * Modifica el arreglo que contiene únicamente el campo cuestionario_id de todos los registros de cuestionario
	 * @param string $and
	 */
	public function setArrCuestionarioId($and=""){
		$arr_cuest = array();
		$qry = "SELECT `cuestionario_id` FROM `".$this->bd->getBD()."`.`c00` WHERE 1 ".$this->and_tbl_c00.$and;
		$rs = $this->bd->getRes($qry);
		if(!$rs){
			die($this->bd->getTagErrorSQL($qry));
		}	
		while($row = $rs->fetch_array()){
			$arr_cuest[] = $row['cuestionario_id'];
		}
		$rs->close();
		$this->arr_cuestionario_id = $arr_cuest;
	}
	/**
	 * Devuelve el arreglo que contiene únicamente el campo cuestionario_id de todos los registros de cuestionario
	 * @return array
	 */
	public function getArrCuestionarioId(){
		return $this->arr_cuestionario_id;
	}
}
