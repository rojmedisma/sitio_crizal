<?php
/**
 * Clase modelo que contiene las fórmulas para el cálculo de indicadores a nivel cuestionario y por cada cuestionario o grupo de indicadores especificado
 * @author Ismael Rojas
 *
 */
class Indicador_calc_det extends ModeloBase{
	private $cuestionario;
	private $cat_cuestionario_id;
	private $nom_metodo_gen_detalle;
	private $arr_campos_ind;
	private $arr_variables = array();
	public function __construct($cat_cuestionario_id){
		parent::__construct();
		$this->cat_cuestionario_id = $cat_cuestionario_id;
		$this->cuestionario = new Cuestionario($cat_cuestionario_id);
	}
	/**
	 * Devuelve el Id del catálogo de cuestionarios del cuestionario al que se le va a realizar el cálculo de indicadores
	 * @return integer
	 */
	private function getCatCuestionarioId(){
		return $this->cat_cuestionario_id;
	}
	/**
	 * Modifica la variable que indican el nombre del método que contiene las fórmulas de indicadores. El nomnbre del método se crea a partir del id del catálogo de cuestionarios. Además que modifica el arreglo que contiene la lista de campos que se van a llenar al realiar el cálculo a nivel cuestionario
	 */
	public function setCalculoDetalle(){
		//Nombre del método
		$nom_metodo_gen_detalle = "get".strtoupper(cuest_cve($this->getCatCuestionarioId()))."IndDet";
		
		if(method_exists($this, $nom_metodo_gen_detalle)){
			$this->nom_metodo_gen_detalle = $nom_metodo_gen_detalle;
		}else{
			die($this->getTagError("Nombre de método incorrecto", "No se encontró el método/función <strong>".$nom_metodo_gen_detalle."</strong> En la clase <strong>Indicador_calc_det</strong>"));
		}
		
		$nom_tbl_ind = nom_tbl_ind($this->getCatCuestionarioId());
		$this->arr_campos_ind = $this->bd->getArrCmpsTbl($nom_tbl_ind);
	}
	/**
	 * Devuelve el nombre del método que contiene las fórmulas de indicadores
	 * @return string
	 */
	private function getNomMetodoGenDetalle(){
		return $this->nom_metodo_gen_detalle;
	}
	/**
	 * Devuelve el arreglo que contiene la lista de campos que se van a llenar al realiar el cálculo a nivel cuestionario
	 * @return array
	 */
	private function getArrCamposInd(){
		return $this->arr_campos_ind;
	}
	/**
	 * 
	 * @param integer $cuestionario_id
	 */
	public function setArrVariablesGen($cuestionario_id){
		$this->cuestionario->setArrTblCuestionario();
		$arr_tbl_cuest = $this->cuestionario->getArrTblCuestionario();
		$arr_campos_cuest = $arr_tbl_cuest[$cuestionario_id];
		$nom_metodo_gen_detalle = $this->getNomMetodoGenDetalle();
		$this->arr_variables = $this->$nom_metodo_gen_detalle($arr_campos_cuest);
	}
	public function getArrVariables(){
		return $this->arr_variables;
	}
	/**
	 * Formulas de cálculo para los indicadores derivados del cuestionario para productores
	 * @param array $arr_campos_cuest	Arreglo de todos los campos del registro de cuestionario
	 * @return array
	 */
	private function getC01IndDet($arr_campos_cuest){
		extract($arr_campos_cuest, EXTR_OVERWRITE);
		
		$es_agr = ($prod_sector1==1);
		$es_gan = ($prod_sector2==1);
		$es_pes = ($prod_sector3==1);
		$es_acu = ($prod_sector4==1);
		
		//	*	Agricultura
		//	*	*	1 Producción por cultivo
		if($es_agr){
			//	*	*	*	Granos
			$es_i1r1 = $agr_p3r1_cultivo;
			$i1r1 = $agr_p3r1_cantidad;
			//	*	*	*	Tubérculos y raíces
			$es_i1r2 = $agr_p3r2_cultivo;
			$i1r2 = $agr_p3r2_cantidad;
			//	*	*	*	Forrajes
			$es_i1r3 = $agr_p3r3_cultivo;
			$i1r3 = $agr_p3r3_cantidad;
			//	*	*	*	Leguminosas (fijadores de nitrógeno)
			$es_i1r4 = $agr_p3r4_cultivo;
			$i1r4 = $agr_p3r4_cantidad;
			//	*	*	*	Hortalizas
			$es_i1r5 = $agr_p3r5_cultivo;
			$i1r5 = $agr_p3r5_cantidad;
			//	*	*	*	Frutas o Frutales
			$es_i1r6 = $agr_p3r6_cultivo;
			$i1r6 = $agr_p3r6_cantidad;
			//	*	*	*	Cultivos de azúcar
			$es_i1r7 = $agr_p3r1_cultivo;
			$i1r7 = $agr_p3r1_cantidad;
			//	*	*	*	Cultivos de fibras
			$es_i1r8 = $agr_p3r1_cultivo;
			$i1r8 = $agr_p3r1_cantidad;
			//	*	*	*	Cultivos de oleaginosas
			$es_i1r9 = $agr_p3r1_cultivo;
			$i1r9 = $agr_p3r1_cantidad;	
			//	*	*	*	Estimulantes (por ejemplo: café, cacao y tabaco)
			$es_i1r10 = $agr_p3r1_cultivo;
			$i1r10 = $agr_p3r1_cantidad;
		}
		
		
		
		$arr_variables = array();
		foreach ($this->getArrCamposInd() as $arr_det){
			$ind_variable= $arr_det['Field'];
			$arr_variables[$ind_variable] = (isset($$ind_variable))? txt_sql($$ind_variable, false) : 'NULL';
		}
		$arr_variables['cat_municipio_id'] = txt_sql($prod_mpo);	//Asigno el municipio
		return $arr_variables;
	}
}