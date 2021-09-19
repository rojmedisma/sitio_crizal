<?php
/**
 * Descripción de ValidaC[N]
 * La clase ValidaC[N] es donde se definen las reglas de validación del cuestionario con clave N.
 * Las reglas de validación se dividen por los módulos que contiene el cuestionario, existiendo una función/método por cada clase.
 * En esta caso, esta clase es exclusiva para el cuestionario para Productores del proyecto SIAP, con cat_cuestionario_id = 1
 * 
 * 
 * @author Ismael Rojas
 */
class ValidaC01 extends ModeloValidaBase{
	public function __construct($arr_cmps_frm) {
		parent::__construct($arr_cmps_frm);
	}
	/**
	 * Definición de reglas para el módulo cat_cuest_modulo_id = 1 del cuestionario cat_cuestionario_id = 1
	 */
	protected function setArrReglasM01() {
		//extract($this->arr_cmps_frm, EXTR_PREFIX_ALL, 'e');
		$arr_reglas_val = array();
		$arr_reglas_val['div_an_prod_sector'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk', 
			'arr_cmp_nom'=>array('prod_sector1','prod_sector2','prod_sector3','prod_sector4'),
			'val_n'=>1,
			'tit_preg'=>'Pregunta 1'
		);
		$arr_reglas_val['prod_i_genero'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
		$arr_reglas_val['prod_edad'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
		
		
		$arr_reglas_val['prod_tipo'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
		$p1r1c1 = $this->getCmpVal('prod_tipo');
		if($p1r1c1==1){
			$arr_reglas_val['prod_curp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
			if($this->getCmpVal('prod_curp')!=""){
				$arr_reglas_val['prod_curp'] = array('regla'=>'curp_valida', 'tit_preg'=>'Pregunta 3');
			}
		}elseif($p1r1c1==2){
			$arr_reglas_val['prod_rfc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
			if($this->getCmpVal('prod_rfc')!=""){
				$arr_reglas_val['prod_rfc'] = array('regla'=>'rfc_valido', 'tit_preg'=>'Pregunta 3');
			}
			$arr_reglas_val['prod_integrantes'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
		}
		$arr_reglas_val['prod_edo'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
		$arr_reglas_val['prod_mpo'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
		$arr_reglas_val['prod_loc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
		
		//$arr_reglas_val['prod_geo_latitud'] = array('regla'=>'requerido');
		//$arr_reglas_val['prod_geo_longitud'] = array('regla'=>'requerido');
		
		$this->arr_reglas_val = $arr_reglas_val;
	}
	/**
	 * Definición de reglas para el módulo cat_cuest_modulo_id = 2 del cuestionario cat_cuestionario_id = 1
	 */
	protected function setArrReglasM02() {
		$arr_reglas_val = array();
		//	*	Pregunta 1 y 2
		$arr_reglas_val['div_an_agr_p1rN'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk', 
			'arr_cmp_nom'=>array('agr_p1r1','agr_p1r2'),
			'val_n'=>1,
			'tit_preg'=>'Pregunta 1'
		);
		//	*	*	Convenional
		if($this->es_chk_sel('agr_p1r1')){
			$arr_reglas_val['div_an_agr_p1r1_N'] = array(
				'no_es_campo'=>true,
				'regla'=>'al_menos_n_chk', 
				'arr_cmp_nom'=>array('agr_p1r1_1','agr_p1r1_2'),
				'val_n'=>1,
				'tit_preg'=>'Pregunta 1'
			);
			
			//	*	*	Temporal
			if($this->es_chk_sel('agr_p1r1_1')){
				$arr_reglas_val['agr_p1r1_1_has'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				$arr_reglas_val['agr_p2r1_1'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
			}
			//	*	*	Riego
			if($this->es_chk_sel('agr_p1r1_2')){
				$arr_reglas_val['div_an_agr_p1r1_2_N'] = array(
					'no_es_campo'=>true,
					'regla'=>'al_menos_n_chk', 
					'arr_cmp_nom'=>array('agr_p1r1_2_1','agr_p1r1_2_2', 'agr_p1r1_2_3'),
					'val_n'=>1,
					'tit_preg'=>'Pregunta 1'
				);
				//	*	*	Por gravedad
				if($this->es_chk_sel('agr_p1r1_2_1')){
					$arr_reglas_val['agr_p1r1_2_1_has'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
					$arr_reglas_val['agr_p2r1_2_1'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				}
				//	*	*	 Superficial
				if($this->es_chk_sel('agr_p1r1_2_2')){
					$arr_reglas_val['agr_p1r1_2_2_has'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
					$arr_reglas_val['agr_p2r1_2_2'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				}
				//	*	*	Presurizado
				if($this->es_chk_sel('agr_p1r1_2_3')){
					$arr_reglas_val['agr_p1r1_2_3_has'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
					$arr_reglas_val['agr_p2r1_2_3'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				}
			}
		}
		//	*	*	Protegida
		if($this->es_chk_sel('agr_p1r2')){
			$arr_reglas_val['div_an_agr_p1r2_N'] = array(
				'no_es_campo'=>true,
				'regla'=>'al_menos_n_chk', 
				'arr_cmp_nom'=>array('agr_p1r2_1','agr_p1r2_2', 'agr_p1r2_3'),
				'val_n'=>1,
				'tit_preg'=>'Pregunta 1'
			);
			//	*	*	Con invernadero
			if($this->es_chk_sel('agr_p1r2_1')){
				$arr_reglas_val['agr_p1r2_1_has'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				$arr_reglas_val['agr_p2r2_1'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
			}
			//	*	*	Con micro y macro túneles
			if($this->es_chk_sel('agr_p1r2_2')){
				$arr_reglas_val['agr_p1r2_2_has'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				$arr_reglas_val['agr_p2r2_2'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
			}
			//	*	*	Con casas malla sombra
			if($this->es_chk_sel('agr_p1r2_3')){
				$arr_reglas_val['agr_p1r2_3_has'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				$arr_reglas_val['agr_p2r2_3'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
			}
		}
		//	*	Pregunta 3
		$r_p3 = 16;
		$arr_an_agr_p3 = array();
		for($i=1; $i<=$r_p3; $i++){
			$arr_an_agr_p3[] = 'agr_p3r'.$i.'_cultivo';
			if($this->es_chk_sel('agr_p3r'.$i.'_cultivo')){
				$arr_reglas_val['agr_p3r'.$i.'_cantidad'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
				$arr_reglas_val['agr_p3r'.$i.'_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
			}
		}
		$arr_reglas_val['div_an_agr_p3'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk', 
			'arr_cmp_nom'=>$arr_an_agr_p3,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 3'
		);
		if($this->es_chk_sel('agr_p3r7_cultivo')){
			$arr_reglas_val['agr_p3r7_cultivo_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
		}
		if($this->es_chk_sel('agr_p3r'.$r_p3.'_cultivo')){
			$arr_reglas_val['agr_p3r'.$r_p3.'_cultivo_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
		}
		
		
		//	*	Pregunta 5
		$arr_an_agr_p5 = array();
		for($i=1; $i<=9; $i++){
			$arr_an_agr_p5[] = 'agr_p5r'.$i.'_tipo';
			if($this->es_chk_sel('agr_p5r'.$i.'_tipo')){
				$arr_reglas_val['agr_p5r'.$i.'_cantidad'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
				$arr_reglas_val['agr_p5r'.$i.'_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
			}
		}
		$arr_an_agr_p5[] = 'agr_p5r9_tipo';
		$arr_reglas_val['div_an_agr_p5'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk', 
			'arr_cmp_nom'=>$arr_an_agr_p5,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 2'
		);
		
		//	*	Pregunta 7
		$r_p7 = 10;
		for($i=1; $i<=$r_p3; $i++){
			if($this->es_chk_sel('agr_p3r'.$i.'_cultivo')){
				//echo 'entra en agr_p3r'.$i.'_cultivo';
				$arr_an_agr_p7_pago = array();
				for($j=1; $j<=$r_p7; $j++){
					$arr_an_agr_p7_pago[] = 'agr_p7r'.$i.'_'.$j.'_pago';
					if($this->es_chk_sel('agr_p7r'.$i.'_'.$j.'_pago')){
						$arr_reglas_val['agr_p7r'.$i.'_'.$j.'_prop'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
					}
				}
				$arr_reglas_val['div_an_agr_p7r'.$i] = array(
					'no_es_campo'=>true,
					'regla'=>'al_menos_n_chk', 
					'arr_cmp_nom'=>$arr_an_agr_p7_pago,
					'val_n'=>1,
					'tit_preg'=>'Pregunta 4'
				);
				$arr_reglas_val['div_an_agr_p7r'.$i.'_tot'] = array(
					'regla'=>'val_es_igual',
					'val_campo'=>$this->getCmpVal('agr_p7r'.$i.'_tot'),
					'val_compara'=>100,
					'no_es_campo'=>true,
					'txt_alerta'=>'Valor total debe ser igual a 100%',
					'tit_preg'=>'Pregunta 4'
				);
				if($this->es_chk_sel('agr_p7r'.$i.'_10_pago')){
					$arr_reglas_val['agr_p7r'.$i.'_10_pago_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
				}
			}
		}
		
		//	*	Pregunta 10
		$arr_reglas_val['agr_p10_aplico'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
		if(intval($this->getCmpVal('agr_p10_aplico'))==2){
			$arr_an_agr_p10 = array();
			for($i=1; $i<=3; $i++){
				$arr_an_agr_p10[] = 'agr_p10r'.$i.'_t_ag';
				if($this->es_chk_sel('agr_p10r'.$i.'_t_ag')){
					$arr_reglas_val['agr_p10r'.$i.'_nom'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
					$arr_reglas_val['agr_p10r'.$i.'_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
					$arr_reglas_val['agr_p10r'.$i.'_cant'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
					$arr_reglas_val['agr_p10r'.$i.'_um'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
					$arr_reglas_val['agr_p10r'.$i.'_n_vez'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
					$arr_reglas_val['agr_p10r'.$i.'_met'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
				}
			}
			$arr_reglas_val['div_an_agr_p10'] = array(
				'no_es_campo'=>true,
				'regla'=>'al_menos_n_chk', 
				'arr_cmp_nom'=>$arr_an_agr_p10,
				'val_n'=>1,
				'tit_preg'=>'Pregunta 10'
			);
		}
		
		$this->arr_reglas_val = $arr_reglas_val;
	}
	/**
	 * Definición de reglas para el módulo cat_cuest_modulo_id = 3 del cuestionario cat_cuestionario_id = 1
	 */
	protected function setArrReglasM03() {
		$arr_reglas_val = array();
		
		//	*	Pregunta 1
		$arr_reglas_val['div_an_pec_p1rN'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk', 
			'arr_cmp_nom'=>array('pec_p1r1','pec_p1r2','pec_p1r3'),
			'val_n'=>1,
			'tit_preg'=>'Pregunta 1'
		);
		if($this->es_chk_sel('pec_p1r1')){
			$arr_reglas_val['pec_p1r1_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
			$arr_reglas_val['pec_p1r1_tp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
		}
		if($this->es_chk_sel('pec_p1r2')){
			$arr_reglas_val['div_an_pec_p1r2_N'] = array(
				'no_es_campo'=>true,
				'regla'=>'al_menos_n_chk', 
				'arr_cmp_nom'=>array('pec_p1r2_1','pec_p1r2_2'),
				'val_n'=>1,
				'tit_preg'=>'Pregunta 1'
			);
			if($this->es_chk_sel('pec_p1r2_1')){
				$arr_reglas_val['div_an_pec_p1r2_1_N'] = array(
					'no_es_campo'=>true,
					'regla'=>'al_menos_n_chk', 
					'arr_cmp_nom'=>array('pec_p1r2_1_1','pec_p1r2_1_2'),
					'val_n'=>1,
					'tit_preg'=>'Pregunta 1'
				);
				if($this->es_chk_sel('pec_p1r2_1_1')){
					$arr_reglas_val['pec_p1r2_1_1_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
					$arr_reglas_val['pec_p1r2_1_1_tp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				}
				if($this->es_chk_sel('pec_p1r2_1_2')){
					$arr_reglas_val['pec_p1r2_1_2_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
					$arr_reglas_val['pec_p1r2_1_2_tp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				}
			}
			if($this->es_chk_sel('pec_p1r2_2')){
				$arr_reglas_val['div_an_pec_p1r2_2_N'] = array(
					'no_es_campo'=>true,
					'regla'=>'al_menos_n_chk', 
					'arr_cmp_nom'=>array('pec_p1r2_2_1','pec_p1r2_2_2'),
					'val_n'=>1,
					'tit_preg'=>'Pregunta 1'
				);
				if($this->es_chk_sel('pec_p1r2_2_1')){
					$arr_reglas_val['pec_p1r2_2_1_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
					$arr_reglas_val['pec_p1r2_2_1_tp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				}
				if($this->es_chk_sel('pec_p1r2_2_2')){
					$arr_reglas_val['pec_p1r2_2_2_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
					$arr_reglas_val['pec_p1r2_2_2_tp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
				}
			}
		}
		if($this->es_chk_sel('pec_p1r3')){
			$arr_reglas_val['pec_p1r3_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
			$arr_reglas_val['pec_p1r3_tp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
		}
		
		//	*	Pregunta 2
		$arr_an_pec_p2 = array();
		for($i=1; $i<=15; $i++){
			$arr_an_pec_p2[] = 'pec_p2r'.$i.'_especie';
			
		}
		$arr_reglas_val['div_an_pec_p2'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk', 
			'arr_cmp_nom'=>$arr_an_pec_p2,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 2'
		);
		$arr_p2_sub_t = array(1=>7, 2=>2, 3=>5, 4=>7, 5=>2, 6=>6);
		//Bovinos, Bovinos leche, Ovinos, Porcinos, Aves de corral, Caprinos
		for($i=1; $i<=6; $i++){
			if($this->es_chk_sel('pec_p2r'.$i.'_especie')){
				$arr_an_pec_p2_hato = array();
				for($j=1; $j<=$arr_p2_sub_t[$i]; $j++){
					$arr_an_pec_p2_hato[] = 'pec_p2r'.$i.'_'.$j.'_hato';
					if($this->es_chk_sel('pec_p2r'.$i.'_'.$j.'_hato')){
						$arr_reglas_val['pec_p2r'.$i.'_'.$j.'_cabe'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
						$arr_reglas_val['pec_p2r'.$i.'_'.$j.'_peso'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
						$arr_reglas_val['pec_p2r'.$i.'_'.$j.'_prod'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
					}
				}
				$arr_reglas_val['div_an_pec_p2r'.$i.'_hato'] = array(
					'no_es_campo'=>true,
					'regla'=>'al_menos_n_chk', 
					'arr_cmp_nom'=>$arr_an_pec_p2_hato,
					'val_n'=>1,
					'tit_preg'=>'Pregunta 2'
				);
			}
		}
		//Conejos, Pavos, Patos, Gansos, Pilíferos, Mulas y Asnos, Equinos, Ciervos, Otro
		for($i=7; $i<=15; $i++){
			if($this->es_chk_sel('pec_p2r'.$i.'_especie')){
				$arr_reglas_val['pec_p2r'.$i.'_cabe'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
				$arr_reglas_val['pec_p2r'.$i.'_peso'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
				$arr_reglas_val['pec_p2r'.$i.'_prod'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
			}
		}
		if($this->es_chk_sel('pec_p2r15_especie')){
			$arr_reglas_val['pec_p2r15_especie_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
		}
		//	*	Pregunta 3
		$arr_an_pec_p3 = array();
		for($i=1; $i<=10; $i++){
			$arr_an_pec_p3[] = 'pec_p3r'.$i.'_t_ene';
			if($this->es_chk_sel('pec_p3r'.$i.'_t_ene') && $i<=9){
				$arr_reglas_val['pec_p3r'.$i.'_cant'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
				$arr_reglas_val['pec_p3r'.$i.'_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
			}
		}
		$arr_reglas_val['div_an_pec_p3'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk', 
			'arr_cmp_nom'=>$arr_an_pec_p3,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 3'
		);
		
		//	*	Pregunta 4
		$arr_an_pec_p4 = array();
		for($i=1; $i<=13; $i++){
			$arr_an_pec_p4[] = 'pec_p4r'.$i;
		}
		$arr_reglas_val['div_an_pec_p4'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk', 
			'arr_cmp_nom'=>$arr_an_pec_p4,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 4'
		);
		if($this->es_chk_sel('pec_p4r13')){
			$arr_reglas_val['pec_p4r13_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
		}
		
		//	*	Pregunta 5
		if($this->es_chk_sel('pec_p2r1_especie') || $this->es_chk_sel('pec_p2r2_especie') || $this->es_chk_sel('pec_p2r3_especie') || $this->es_chk_sel('pec_p2r6_especie')){
			//Sección A
			if($this->es_chk_sel('pec_p2r1_especie') || $this->es_chk_sel('pec_p2r2_especie')){
				$arr_an_pec_p5_a = array();
				for($i=1; $i<=4; $i++){
					$arr_an_pec_p5_a[] = 'pec_p5r'.$i.'_donde';
					if($this->es_chk_sel('pec_p5r'.$i.'_donde')){
						if($i==4){
							$arr_reglas_val['pec_p5r'.$i.'_donde_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
						}
						$arr_reglas_val['pec_p5r'.$i.'_lluvia'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
						$arr_reglas_val['pec_p5r'.$i.'_secas'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
						$arr_reglas_val['pec_p5r'.$i.'_dieta'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
					}
				}
				$arr_reglas_val['div_an_pec_p5_a'] = array(
					'no_es_campo'=>true,
					'regla'=>'al_menos_n_chk', 
					'arr_cmp_nom'=>$arr_an_pec_p5_a,
					'val_n'=>1,
					'tit_preg'=>'Pregunta 5'
				);
				
				
			}
			//Sección B
			if($this->es_chk_sel('pec_p2r3_especie') || $this->es_chk_sel('pec_p2r6_especie')){
				$arr_an_pec_p5_b = array();
				for($i=4; $i<=6; $i++){
					$arr_an_pec_p5_b[] = 'pec_p5r'.$i;
				}
				$arr_reglas_val['div_an_pec_p5_b'] = array(
					'no_es_campo'=>true,
					'regla'=>'al_menos_n_chk', 
					'arr_cmp_nom'=>$arr_an_pec_p5_b,
					'val_n'=>1,
					'tit_preg'=>'Pregunta 5'
				);
				if($this->es_chk_sel('pec_p5r5')){
					$arr_reglas_val['div_an_pec_p5r5'] = array(
						'no_es_campo'=>true,
						'regla'=>'al_menos_n_chk', 
						'arr_cmp_nom'=>array('pec_p5r5_1', 'pec_p5r5_2', 'pec_p5r5_3', 'pec_p5r5_4', 'pec_p5r5_5', 'pec_p5r5_6'),
						'val_n'=>1,
						'tit_preg'=>'Pregunta 5'
					);
					$arr_reglas_val['pec_p5r5_3_1'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
					if($this->es_chk_sel('pec_p5r5_6')){
						$arr_reglas_val['pec_p5r5_6_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
					}
				}
			}
		}
		
		//	*	Pregunta 6
		if($this->es_chk_sel('pec_p2r1_3_hato') || $this->es_chk_sel('pec_p2r2_1_hato') || $this->es_chk_sel('pec_p2r3_1_hato') || $this->es_chk_sel('pec_p2r3_3_hato') || $this->es_chk_sel('pec_p2r6_1_hato')){
			$arr_an_pec_p6 = array();
			for($i=1; $i<=4; $i++){
				$arr_an_pec_p6[] = 'pec_p6r'.$i.'_espe';
				if($this->es_chk_sel('pec_p6r'.$i.'_espe')){
					$arr_reglas_val['pec_p6r'.$i.'_prod'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 6');
				}
			}
			$arr_reglas_val['div_an_pec_p6'] = array(
				'no_es_campo'=>true,
				'regla'=>'al_menos_n_chk', 
				'arr_cmp_nom'=>$arr_an_pec_p6,
				'val_n'=>1,
				'tit_preg'=>'Pregunta 6'
			);
		}
		
		//	*	Pregunta 7
		//Vacas para cría para carne
		if($this->es_chk_sel('pec_p2r1_1_hato') || $this->es_chk_sel('pec_p2r1_3_hato') || $this->es_chk_sel('pec_p2r2_1_hato') || $this->es_chk_sel('pec_p2r3_1_hato') || $this->es_chk_sel('pec_p2r3_2_hato') || $this->es_chk_sel('pec_p2r4_1_hato') || $this->es_chk_sel('pec_p2r6_1_hato') || $this->es_chk_sel('pec_p2r6_2_hato') || $this->es_chk_sel('pec_p2r6_3_hato')){
			$arr_an_pec_p7 = array();
			for($i=1; $i<=9; $i++){
				$arr_an_pec_p7[] = 'pec_p7r'.$i.'_espe';
				if($this->es_chk_sel('pec_p7r'.$i.'_espe')){
					$arr_reglas_val['pec_p7r'.$i.'_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 7');
					if($i>=4){
						$arr_reglas_val['pec_p7r'.$i.'_crias'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 7');
					}
				}
			}
			
			
			$arr_reglas_val['div_an_pec_p7'] = array(
				'no_es_campo'=>true,
				'regla'=>'al_menos_n_chk', 
				'arr_cmp_nom'=>$arr_an_pec_p7,
				'val_n'=>1,
				'tit_preg'=>'Pregunta 7'
			);
		}
		
		//	*	Pregunta 8
		if($this->es_chk_sel('pec_p2r1_6_hato')){
			$arr_reglas_val['pec_p8'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 8');
		}
		
		//	*	Pregunta 9
		if($this->es_chk_sel('pec_p2r3_2_hato')){
			$arr_reglas_val['pec_p9'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 9');
		}
		
		//	*	Pregunta 10
		if($this->es_chk_sel('pec_p2r1_5_hato') || $this->es_chk_sel('pec_p2r12_especie') || $this->es_chk_sel('pec_p2r13_especie')){
			$arr_an_pec_p10 = array();
			for($i=1; $i<=4; $i++){
				$arr_an_pec_p10[] = 'pec_p10r'.$i.'_espe';
				if($this->es_chk_sel('pec_p10r'.$i.'_espe') && $i<=3){
					$arr_reglas_val['pec_p10r'.$i.'_h_dia'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 10');
					$arr_reglas_val['pec_p10r'.$i.'_d_anio'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 10');
				}
			}
			$arr_reglas_val['div_an_pec_p10'] = array(
				'no_es_campo'=>true,
				'regla'=>'al_menos_n_chk', 
				'arr_cmp_nom'=>$arr_an_pec_p10,
				'val_n'=>1,
				'tit_preg'=>'Pregunta 10'
			);
		}
		
		//	*	Pregunta 11
		$arr_an_pec_p11 = array();
		for($i=1; $i<=12; $i++){
			$arr_an_pec_p11[] = 'pec_p11r'.$i;
		}
		$arr_reglas_val['div_an_pec_p11'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk', 
			'arr_cmp_nom'=>$arr_an_pec_p11,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 11'
		);
		if($this->es_chk_sel('pec_p11r1')){
			$arr_reglas_val['pec_p11r1_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r2')){
			$arr_reglas_val['pec_p11r2_p'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
			$arr_reglas_val['pec_p11r2_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r3')){
			$arr_reglas_val['pec_p11r3_p'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
			$arr_reglas_val['pec_p11r3_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r4')){
			$arr_reglas_val['pec_p11r4_p'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
			$arr_reglas_val['pec_p11r4_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r5')){
			$arr_reglas_val['pec_p11r5_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r6')){
			$arr_reglas_val['pec_p11r6_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r7')){
			$arr_reglas_val['pec_p11r7_p'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
			$arr_reglas_val['pec_p11r7_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r8')){
			$arr_reglas_val['pec_p11r8_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r9')){
			$arr_reglas_val['pec_p11r9_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r10')){
			$arr_reglas_val['pec_p11r10_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r11')){
			$arr_reglas_val['pec_p11r11_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		if($this->es_chk_sel('pec_p11r12')){
			$arr_reglas_val['pec_p11r12_p'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
			$arr_reglas_val['pec_p11r12_porc'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 11');
		}
		$pec_p11_tot = 0;
		for($i=1; $i<=12; $i++){
			$pec_p11_tot += intval($this->getCmpVal('pec_p11r'.$i.'_porc'));
		}
		
		$arr_reglas_val['div_an_pec_p11_tot'] = array(
			'regla'=>'val_es_igual', 
			'val_campo'=>$pec_p11_tot, 
			'val_compara'=>100, 
			'no_es_campo'=>true,
			'txt_alerta'=>'Valor total debe ser igual a 100%',
			'tit_preg'=>'Pregunta 11'
		);
		
		$this->arr_reglas_val = $arr_reglas_val;
	}
	/**
	 * Definición de reglas para el módulo cat_cuest_modulo_id = 4 del cuestionario cat_cuestionario_id = 1
	 */
	protected function setArrReglasM04() {
		$arr_reglas_val = array();
		
		//	*	Pregunta 1
		$arr_reglas_val['pes_p1'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
		
		//	*	Pregunta 2
		$arr_an_pes_p2 = array();
		for($i=1; $i<=22; $i++){
			$arr_an_pes_p2[] = 'pes_p2r'.$i;
			if($this->es_chk_sel('pes_p2r'.$i)){
				$arr_reglas_val['pes_p2r'.$i.'_cant'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
			}
		}
		$arr_reglas_val['div_an_pes_p2'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk',
			'arr_cmp_nom'=>$arr_an_pes_p2,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 2'
		);
		if($this->es_chk_sel('pes_p2r22')){
			$arr_reglas_val['pes_p2r22_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
		}
		//	*	Pregunta 3
		$arr_reglas_val['pes_p3_reg'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
		$arr_reglas_val['div_an_pes_p3r1'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk',
			'arr_cmp_nom'=>array('pes_p3r1_z', 'pes_p3r2_z', 'pes_p3r3_z', 'pes_p3r4_z'),
			'val_n'=>1,
			'tit_preg'=>'Pregunta 3'
		);
		
		//	*	Pregunta 4
		$arr_reglas_val['pes_p4'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
		if(intval($this->getCmpVal('pes_p4')) === 2){
			$arr_reglas_val['pes_p4_pot'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
		}
		
		//	*	Pregunta 5
		$arr_reglas_val['pes_p5'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
		
		//	*	Pregunta 6
		$arr_reglas_val['pes_p6_ref'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 6');
		if(intval($this->getCmpVal('pes_p6_ref')) === 2){
			$arr_reglas_val['pes_p6_anio'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 6');
			$arr_reglas_val['pes_p6_cap'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 6');
			$arr_reglas_val['pes_p6_um'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 6');
			$arr_reglas_val['div_an_pes_p6'] = array(
				'no_es_campo'=>true,
				'regla'=>'al_menos_n_chk',
				'arr_cmp_nom'=>array('pes_p6r1', 'pes_p6r2', 'pes_p6r3', 'pes_p6r4', 'pes_p6r5','pes_p6r6', 'pes_p6r7', 'pes_p6r8', 'pes_p6r9'),
				'val_n'=>1,
				'tit_preg'=>'Pregunta 6'
			);
			if($this->es_chk_sel('pes_p6r9')){
				$arr_reglas_val['pes_p6r9_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 6');
			}
			
		}
		
		//	*	Pregunta 7
		$arr_an_pes_p7 = array();
		for($i=1; $i<=6; $i++){
			$arr_an_pes_p7[] = 'pes_p7r'.$i.'_ener';
			if($this->es_chk_sel('pes_p7r'.$i.'_ener') && $i<=5){
				$arr_reglas_val['pes_p7r'.$i.'_cant'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 7');
			}
		}
		$arr_reglas_val['div_an_pes_p7'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk',
			'arr_cmp_nom'=>$arr_an_pes_p7,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 7'
		);
		
		//	*	Pregunta 8
		$arr_an_pes_p8 = array();
		for($i=1; $i<=12; $i++){
			$arr_an_pes_p8[] = 'pes_p8r'.$i;
		}
		$arr_reglas_val['div_an_pes_p8'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk',
			'arr_cmp_nom'=>$arr_an_pes_p8,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 8'
		);
		
		//	*	Pregunta 9
		$arr_reglas_val['pes_p9'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 9');
		
		
		$this->arr_reglas_val = $arr_reglas_val;
	}
	/**
	 * Definición de reglas para el módulo cat_cuest_modulo_id = 5 del cuestionario cat_cuestionario_id = 1
	 */
	protected function setArrReglasM05() {
		$arr_reglas_val = array();
		
		//	*	Pregunta 1
		$arr_an_acu_p1 = array();
		for($i=1; $i<=4; $i++){
			$arr_an_acu_p1[] = 'acu_p1r'.$i.'_tipo';
			if($this->es_chk_sel('acu_p1r'.$i.'_tipo')){
				$arr_reglas_val['acu_p1r'.$i.'_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 1');
			}
		}
		$arr_reglas_val['div_an_acu_p1'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk',
			'arr_cmp_nom'=>$arr_an_acu_p1,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 1'
		);
		
		//	*	Pregunta 2
		$arr_an_acu_p2 = array();
		//Arreglo con las especies ostión, abulón, almejas, atún, robalo huachinango y jurel. Opciones para ocultar pregunta 3 y 4
		$arr_opc_esp_ocul = array('acu_p2r1_especie', 'acu_p2r2_especie', 'acu_p2r3_especie', 'acu_p2r10_especie', 'acu_p2r11_especie', 'acu_p2r12_especie', 'acu_p2r13_especie');
		$valida_p3_p4 = true;
		for($i=1; $i<=15; $i++){
			$arr_an_acu_p2[] = 'acu_p2r'.$i.'_especie';
			if($this->es_chk_sel('acu_p2r'.$i.'_especie')){
				$arr_reglas_val['acu_p2r'.$i.'_tec'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
				$arr_reglas_val['acu_p2r'.$i.'_prod'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
				if(in_array('acu_p2r'.$i.'_especie', $arr_opc_esp_ocul)){
					$valida_p3_p4 = false;
				}
				if($i==15){
					$arr_reglas_val['acu_p2r'.$i.'_especie_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 2');
				}
			}
		}
		$arr_reglas_val['div_an_acu_p2'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk',
			'arr_cmp_nom'=>$arr_an_acu_p2,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 2'
		);
		
		
		//	*	Pregunta 3
		if($valida_p3_p4){
			$arr_reglas_val['acu_p3'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
			if(intval($this->getCmpVal('acu_p3')) === 2){
				$arr_reglas_val['acu_p3_cant'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 3');
			}
		}
		
		
		//	*	Pregunta 4
		if($valida_p3_p4){
			$arr_reglas_val['acu_p4'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
			if(intval($this->getCmpVal('acu_p4')) === 2){
				$arr_reglas_val['acu_p4_comp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
				$arr_reglas_val['acu_p4_cant'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 4');
			}
		}
		
		
		//	*	Pregunta 5
		$arr_reglas_val['acu_p5'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
		if(intval($this->getCmpVal('acu_p5')) === 2){
			$arr_reglas_val['acu_p5_anio'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
			$arr_reglas_val['acu_p5_cap'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
			
			$arr_an_acu_p5 = array();
			for($i=1; $i<=9; $i++){
				$arr_an_acu_p5[] = 'acu_p5r'.$i.'_ref';
			}
			$arr_reglas_val['div_an_acu_p5'] = array(
				'no_es_campo'=>true,
				'regla'=>'al_menos_n_chk',
				'arr_cmp_nom'=>$arr_an_acu_p5,
				'val_n'=>1,
				'tit_preg'=>'Pregunta 5'
			);
			if($this->es_chk_sel('acu_p5r9_ref')){
				$arr_reglas_val['acu_p5r9_ref_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 5');
			}
			
		}
		
		//	*	Pregunta 6
		$arr_an_acu_p6 = array();
		for($i=1; $i<=5; $i++){
			$arr_an_acu_p6[] = 'acu_p6r'.$i.'_tipo';
			if($this->es_chk_sel('acu_p6r'.$i.'_tipo') && $i <= 4){
				$arr_reglas_val['acu_p6r'.$i.'_cat'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 6');
				$arr_reglas_val['acu_p6r'.$i.'_sup'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 6');
			}
		}
		$arr_reglas_val['div_an_acu_p6'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk',
			'arr_cmp_nom'=>$arr_an_acu_p6,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 6'
		);
		
		//	*	Pregunta 7
		$arr_an_acu_p7 = array();
		for($i=1; $i<=12; $i++){
			$arr_an_acu_p7[] = 'acu_p7r'.$i;
		}
		$arr_reglas_val['div_an_acu_p7'] = array(
			'no_es_campo'=>true,
			'regla'=>'al_menos_n_chk',
			'arr_cmp_nom'=>$arr_an_acu_p7,
			'val_n'=>1,
			'tit_preg'=>'Pregunta 7'
		);
		if($this->es_chk_sel('acu_p7r12')){
			$arr_reglas_val['acu_p7r12_esp'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 7');
		}
		
		//	*	Pregunta 8
		$arr_reglas_val['acu_p8'] = array('regla'=>'requerido', 'tit_preg'=>'Pregunta 8');
		
		
		$this->arr_reglas_val = $arr_reglas_val;
	}
}
