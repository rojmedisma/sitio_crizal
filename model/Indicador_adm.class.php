<?php
/**
 * Clase modelo que ejecuta los procesos para tener el cálculos de indicadores a nivel cuestionario.
 * <strong>Nota:</strong> Esta clase hace uso de otra conexión a la base de datos, utiliza otro usuario con permisos para poder elminar y crear tablas y registros, permisos que la conexión predeterminada no tiene
 * @author Ismael Rojas
 *
 */
class Indicador_adm extends ModeloBase{
	private $and_variables;
	private $arr_cat_cuestionario;
	public function __construct(){
		parent::__construct();
		$this->and_variables = " AND `dato_tipo` IS NOT NULL AND `consolida_nivel` IS NULL AND `consolida_qry` IS NULL AND `borrar` IS NULL";
		$this->arr_cat_cuestionario = $this->bd->getArrDeTabla("cat_cuestionario","","cat_cuestionario_id");
	}
	/**
	 * Devuelve la sentencia query usada para filtrar la consulta en la tabla <strong>ind_var</strong> y así obtener los registros que contienen las variables que se van a convertir en campos dentro de la tabla de detalle de indicadores
	 * @return string
	 */
	private function getAndVariables(){
		return $this->and_variables;
	}
	/**
	 * Devuelve el arreglo que contiene los registros de la tabla <strong>cat_cuestionario</strong>
	 * @return array
	 */
	private function getArrCatCuestionario(){
		return $this->arr_cat_cuestionario;
	}
	/**
	 * A partir de la tabla de configuración de indicadores (ind_var), se crean todas las tablas que contienen el detalle de indicadores de todos los cuestionarios
	 */
	public function setCrearTablasInd(){
		foreach ($this->getArrCatCuestionario() as $cat_cuestionario_id =>$arr_det){
			$this->setCrearTablasDeCatCuest($cat_cuestionario_id);
		}
	}
	/**
	 * A partir de la tabla de configuración de indicadores (ind_var), se crean las tablas que contienen el detalle de indicadores del cuestionario indicado en el argumento a partir del <strong>cat_cuestionario_id</strong>
	 * @param unknown $cat_cuestionario_id	Id del registro de catálogo de cuestionarios
	 */
	private function setCrearTablasDeCatCuest($cat_cuestionario_id){
		$nom_tbl_ind = nom_tbl_ind($cat_cuestionario_id);
		
		$arr_qry_create = array ();
		$arr_qry_create[] = "`cuestionario_id` int(11) NOT NULL";
		$arr_qry_create[] = "`cat_usuario_id` int(11) DEFAULT NULL";
		$arr_qry_create[] = "`cat_estado_id` varchar(2) DEFAULT NULL";
		$arr_qry_create[] = "`cat_cader_id` varchar(7) DEFAULT NULL";
		$arr_qry_create[] = "`cat_municipio_id` varchar(5) DEFAULT NULL";
		
		$and_ind_var = $this->getAndVariables()." AND `cat_cuestionario_id` = '".$cat_cuestionario_id."' ";
		$order_by = " ORDER BY `orden` ASC";
		$arr_ind_var = $this->bd->getArrDeTabla("ind_var", $and_ind_var.$order_by, "ind_var_id");
		
		foreach ($arr_ind_var as $ind_var_id=>$arr_det){
			$arr_qry_create[] = "`".$arr_det['variable']."` ".$this->getTxtTipo($arr_det['dato_tipo']);
		}
		
		$qry_drop = "DROP TABLE IF EXISTS `".$this->bd->getBD()."`.`" . $nom_tbl_ind. "`;";
		$this->bd->ejecutaQry($qry_drop);
		$qry_create = "CREATE TABLE IF NOT EXISTS `".$this->bd->getBD()."`.`".$nom_tbl_ind."` (".implode(",", array_values($arr_qry_create)).") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		$this->bd->ejecutaQry($qry_create);
		$this->bd->ejecutaQry("ALTER TABLE `".$this->bd->getBD()."`.`".$nom_tbl_ind."` ADD PRIMARY KEY (`cuestionario_id`);");
	}
	/**
	 * A partir de lo que contiene la columna <strong>dato_tipo</strong> de la tabla <strong>ind_var</strong>, devuelve parte de la sentecia query perteneciente al tipo de dato del campo a crear en la tabla de de detalle de indicadores
	 * @param string $dato_tipo	Tipo de dato en la tabla
	 * @return string
	 */
	private function getTxtTipo($dato_tipo){
		switch ($dato_tipo){
			case 'double':	return 'double DEFAULT NULL'; break;
			case 'int':	return 'int(11) DEFAULT NULL';	break;
			case 'varchar':	return 'varchar(55) DEFAULT NULL';	break;
		}
	}
	/**
	 * Realiza el cálculo de indicadores a nivel cuestionario y almacena el resultado en las tablas de detalle de indicadores
	 */
	public function setCalcDetalle(){
		foreach ($this->getArrCatCuestionario() as $cat_cuestionario_id =>$arr_det){
			$cuestionario = new Cuestionario($cat_cuestionario_id);
			$indicador_calc_det = new Indicador_calc_det($cat_cuestionario_id);
			$indicador_calc_det->setCalculoDetalle();
			$nom_tbl_ind = nom_tbl_ind($cat_cuestionario_id);
			
			$qry_vaciar = "TRUNCATE TABLE `".$this->bd->getBD()."`.`".$nom_tbl_ind."` ";
			$this->bd->ejecutaQry($qry_vaciar);
			
			$cuestionario->setArrCuestionarioId();
			foreach ($cuestionario->getArrCuestionarioId() as $cuestionario_id){
				$indicador_calc_det->setArrVariablesGen($cuestionario_id);
				$arr_variables = $indicador_calc_det->getArrVariables();
				
				if(count($arr_variables)){
					$qry_insert = "INSERT INTO `".$this->bd->getBD()."`.`".$nom_tbl_ind."` (".implode(",", array_keys($arr_variables)).") VALUES (".implode(",", array_values($arr_variables)).");";
					$this->bd->ejecutaQry($qry_insert);
				}
			}
		}
	}
	
	
}
