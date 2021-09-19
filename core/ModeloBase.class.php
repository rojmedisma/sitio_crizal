<?php
/**
 * Clase core ModeloBase
 * Extensión para las clases modelo o que se encuentran en la carpeta 'model'
 * @author Ismael
 *
 */
class ModeloBase extends Ayuda{
	protected $arr_reg;
	protected $arr_tbl;
	protected $bd;
	protected $tbl_nom;
	protected $cmp_id_nom;
	protected $cmp_id_val;
	protected $html_opc_cat;
	protected function __construct(){
		$this->bd = new BaseDatos();
	}
	/**
	 * Genera el arreglo que contiene el detalle de los registros de la tabla definida en tbl_nom
	 * @param string $and	Complemento del query despues del where (AND, ORDER BY...)
	 */
	public function setArrTbl($and="") {
		$and_ft = " AND `borrar` IS NULL ".$and;
		$arr_tbl = $this->bd->getArrDeTabla($this->tbl_nom, $and_ft, $this->cmp_id_nom);
		$this->arr_tbl = $arr_tbl;
	}
	/**
	 * Genera un arreglo con el contenido del registro indicado a partir del valor llave indicado en el argumento
	 * @param string $cmp_id_val	Valor del campo llave del registro
	 */
	public function setArrReg($cmp_id_val, $and=""){
		$this->arr_reg = $this->bd->getArrRegDeTabla($this->tbl_nom, $this->cmp_id_nom, $cmp_id_val, $and);
	}
	/**
	 * Devuelve el arreglo generado en la función setArrTbl
	 * @return array
	 */
	public function getArrTbl(){
		return $this->arr_tbl;
	}
	/**
	 * Devuelve el arreglo generado en la función setArrReg
	 * @return array
	 */
	public function getArrReg(){
		return $this->arr_reg;
	}
	/**
	 * 
	 * @param array $arr_cmps	
	 * @param variant $cmp_id_val	
	 */
	
	/**
	 * Ejecuta el guardar para un registro
	 * @param array $arr_cmps	Arreglo con los nombres y valores de los campos de la forma
	 * @param variant $cmp_id_val	Id del registro a actualizar
	 * @param bool $solo_actualizar	Bandera que al ser activada impide crear registros, haciendo sólo actualizaciones. Esta bandera se activa para casos donde el registro es creado previamente en modo inhabilitado.
	 */
	public function setGuardarReg($arr_cmps, $cmp_id_val, $solo_actualizar=false) {
		if($cmp_id_val){
			//Modificar registro
			$arr_act = array();
			foreach($arr_cmps as $cmp_nom => $cmp_val){
				if($cmp_nom!=$this->cmp_id_nom){
					$arr_act[] = "`".$cmp_nom."` = ".$cmp_val;
				}
			}
			$qry_act = "UPDATE `".$this->bd->getBD()."`.`".$this->tbl_nom."` SET ".implode(",", array_values($arr_act))." WHERE `".$this->cmp_id_nom."` ='".$cmp_id_val."' LIMIT 1;";
			$this->bd->ejecutaQry($qry_act);
		}else{
			//Si se activa la bandera solo_actualizar, no permite guardar y en su lugar se genera un error
			if($solo_actualizar===false){
				//Nuevo registro
				$qry_act = "INSERT INTO `".$this->bd->getBD()."`.`".$this->tbl_nom."` (".implode(",",array_keys($arr_cmps)).") VALUES (".implode(",",array_values($arr_cmps)).");";
				$cmp_id_val = $this->bd->ejecutaQryInsert($qry_act);
			}else{
				//Si $cmp_id_val está vacío
				$this->setError("Argumento id vacío", "En función setGuardarReg se mandó el argumento id vacío.");
			}
			
		}
		$this->cmp_id_val = $cmp_id_val;
	}
	/**
	 * Devuelve el id del registro actualizado, si es que se generó antes un INSERT
	 * @return int
	 */
	public function getCmpIdVal() {
		return $this->cmp_id_val;
	}
	/**
	 * Devuelve el valor del campo especificado en el argumento del contenido en el arreglo 'arr_reg'
	 * @param string $cmp_nom	Nombre del campo
	 * @return variant
	 */
	public function getValCmpReg($cmp_nom) {
		$arr_reg = $this->arr_reg;
		if(!empty($arr_reg) && isset($arr_reg[$cmp_nom])){
			return $arr_reg[$cmp_nom];
		}else{
			return null;
		}
	}
	/**
	 * Devuelve un arreglo de los campos de la tabla definida en 'tbl_nom'
	 * @return array
	 */
	public function getArrCmpsTbl() {
		return $this->bd->getArrCmpsTbl($this->tbl_nom);
	}
	/**
	 * Ordena la tabla definida en 'tbl_nom'; mediante la columna "orden" y vuelve a asignar un orden consecutivo en dicha columna
	 */
	protected function reordenar(){
		$query = "SET @rownumber = 0; ";
		$query .= "UPDATE `".$this->bd->getBD()."`.`".$this->tbl_nom."` SET `orden` = (@rownumber:=@rownumber+1) ORDER BY `orden` ASC";
		$this->bd->ejecutaQryMultiple($query);
	}
	/**
	 * Genera la lista de opciones a desplegar en un campo de tipo 'Select'
	 * @param atring $and Sentencia AND para el filtrado de las opciones
	 */
	public function setHTMLOpcCat($and) {
		$this->setArrTbl($and);
		$lista_opciones = '<option value="" data-desc_val="" data-esp_val="">[Seleccionar]</option>';
		foreach($this->getArrTbl() as $arr_det){
			$cmp_id_val = $arr_det[$this->cmp_id_nom];
			$desc = $arr_det['descripcion'];
			$lista_opciones .= '<option value="'.$cmp_id_val.'" data-desc_val="'.$desc.'" data-esp_val="">'.$desc.'</option>';
		}
		$this->html_opc_cat = $lista_opciones;
	}
	/**
	 * Devuelve la lista de opciones para el campo 'Select'
	 * @return string
	 */
	public function getHTMLOpcCat() {
		return $this->html_opc_cat;
	}
	/**
	 * Ejecuta la sentencia query para marcar como borrado al registro definido en los argumentos
	 * @param string $cmp_id_val	Id del registro a borrar
	 * @param string $tbl_nom	Nombre de la tabla donde se encuentra el registro a borrar
	 * @param string $cmp_id_nom	Nombre del campo Id para la búsqueda
	 */
	public function borrarRegistro($cmp_id_val, $tbl_nom="", $cmp_id_nom="") {
		$tbl_nom_def = ($tbl_nom=="")? $this->tbl_nom : $tbl_nom;
		$cmp_id_nom_def = ($cmp_id_nom=="")? $this->cmp_id_nom : $cmp_id_nom;
		
		$qry = "UPDATE `".$this->bd->getBD()."`.`".$tbl_nom_def."` SET `borrar` = '1' WHERE `".$cmp_id_nom_def."` = '".$cmp_id_val."'";
		$this->bd->ejecutaQry($qry);
		$log = new Log();
		$log->setRegLog($cmp_id_nom_def, $cmp_id_val, 'borrar', 'Aviso', "Se borró el registro de la tabla ".$tbl_nom);
	}
}