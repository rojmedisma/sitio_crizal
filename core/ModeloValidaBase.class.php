<?php
/**
 * Clase core ModeloValidaBase
 * Es una extensión para la(s) Clase(s) modelo contenidas en la carpeta "model_cuest", donde existen tantas clases como formularios/cuestionarios se estén validando (Una clase por cada cuestionario/formulario)
 * El objetivo principal de esta clase es generar el arreglo de validaciones (arr_validaciones).
 * Orden de declaración para métodos para generar el arreglo de validaciones a partir de un formulario tipo cuestionario con uso de módulos.
 *  - Entendiendo como Clase Valida[N] a la Clase modelo de la carpeta "model_cuest" correspondiente al formulario/cuestionario actual, misma que debe extender a esta clase, entonces:
 *	1. Se declara la Clase Valida[N]
 *	2. Se manda llamar el método setArrValidaciones contenido en esta clase (ModeloValidaBase)
 *	3. El método setArrValidaciones manda llamar a su vez el método de la Clase Valida[N] corresponidente al módulo actual, mismo que llena el arreglo arr_reglas_val
 *	4. Teniendo el arreglo de reglas de validaciones, el método setArrValidaciones genera el arreglo arr_validaciones
 * @author Ismael Rojas
 */
class ModeloValidaBase extends Ayuda{
	protected $arr_cmps_frm = array();
    protected $arr_validaciones = array();
	protected array $arr_reglas_val;
	private $arr_cmps_no_existen = array();
	
	public function __construct($arr_cmps_frm) {
		$this->arr_cmps_frm = $arr_cmps_frm;
	}
	
	/**
	 * Modifica el arreglo de validaciones a partir de una serie de reglas predefinidas, en donde mediante el arreglo de reglas de validación del cuestionario, regresa otro arreglo pero con las validaciones que fueron aplicadas
	 * @param int $cat_cuest_modulo_id
	 * @return boolean
	 */
    public function setArrValidaciones($cat_cuest_modulo_id) {
		$this->setArrReglasVal($cat_cuest_modulo_id);
	   if(!isset($this->arr_reglas_val)){
		   $this->setError("Reglas de validación no definidas", "El arreglo <strong>arr_reglas_val</strong> no tiene reglas asignadas  en la clase <strong>".get_class($this)."</strong>");
		   return false;
	   }
		
        $arr_cmps_frm = $this->arr_cmps_frm;
        $arr_validaciones = array();
        
        foreach($this->arr_reglas_val as $campo=>$arr_param){
            $alerta = "";
            switch($arr_param['regla']){
                case 'requerido':
                    if($this->getValorCampo($campo) == ""){
						if(isset($arr_param['desc'])){
                            $alerta = $arr_param['desc'].'. Es requerido';
						}elseif(isset($arr_param['txt_alerta'])){
							$alerta = $arr_param['txt_alerta'];
						}else{
                            $alerta = 'Dato requerido';
                        }
                    }
                    break;
                case 'al_menos_n_chk':
                    //
					/**
					 * Al menos N opciones en campos chk y posiblemente combos.
					 * Parámetros requeridos.
					 *	- no_es_campo:	Aunque no se utiliza en esta parte del código, es necesaria para que en la clase de formulario de campos (FormularioALTE3) no se tome en cuenta dentro del arreglo de arr_cmp_atrib
					 *	- arr_cmp_nom:	Es el arreglo de campos check
					 *  - val_n:	Es el mínimo de opciones a tener seleccionadas
					 *	- desc:	(Opcional)	Para hacer más específica la descripción de la alerta
					 */
                    if(isset($arr_param['arr_cmp_nom']) && isset($arr_param['val_n'])){
                        $tot_sel = 0;
                        foreach ($arr_param['arr_cmp_nom'] as $cmp_nom){
							$cmp_val_chk = $this->getValorCampo($cmp_nom);
                            if($cmp_val_chk==1 || $cmp_val_chk!=0){
                                $tot_sel ++;
                            }
                        }
                        $val_n = intval($arr_param['val_n']);
                        if($tot_sel<$val_n){
							
                            //foreach ($arr_param['arr_cmp_nom'] as $cmp_nom){
                            //    $arr_validaciones[$cmp_nom] = array("alerta"=>'[sin_desc]');
                            //}
							 
                            if(isset($arr_param['desc'])){
                                $alerta = ($val_n==1)? 'En <strong>'.$arr_param['desc'].'</strong>, seleccionar al menos una opción' : 'En <strong>'.$arr_param['desc'].'</strong>, seleccionar al menos '.$val_n.' opciones';
                            }else{
                                $alerta = ($val_n==1)? 'Seleccionar al menos una opción' : 'Seleccionar al menos '.$val_n.' opciones';
                            }
                        }
                    }
                    break;
				case 'val_es_igual':
					if(isset($arr_param['val_compara'])){
						$val_compara = $arr_param['val_compara'];
						if(isset($arr_param['no_es_campo'])){
							$val_campo = $arr_param['val_campo'];
						}else{
							$val_campo = $this->getValorCampo($campo);
						}
						
						if($val_campo!="" && $val_compara!="" && $val_campo != $val_compara){
							if(isset($arr_param['desc'])){
								$alerta = $arr_param['desc'].'. Debe ser igual a '.$val_compara;
							}elseif(isset($arr_param['txt_alerta'])){
								$alerta = $arr_param['txt_alerta'];
							}else{
								$alerta = 'Dato debe ser igual a '.$val_compara;
							}
						}
					}
					break;
				case 'curp_valida':
					if(!$this->valida_curp($this->getValorCampo($campo))){
						if(isset($arr_param['desc'])){
                            $alerta = $arr_param['desc'].'. CURP no válida';
						}elseif(isset($arr_param['txt_alerta'])){
							$alerta = $arr_param['txt_alerta'];
						}else{
                            $alerta = 'CURP no válida';
                        }
                    }
					break;
				case 'rfc_valido':
					if(!$this->valida_rfc($this->getValorCampo($campo))){
						if(isset($arr_param['desc'])){
                            $alerta = $arr_param['desc'].'. RFC no válido';
						}elseif(isset($arr_param['txt_alerta'])){
							$alerta = $arr_param['txt_alerta'];
						}else{
                            $alerta = 'RFC no válido';
                        }
                    }
					break;
                case 'al_menos_1_cmp':
                	if(isset($arr_param['arr_cmp_nom'])){
                		$al_menos_1_cmp = false;
                		foreach ($arr_param['arr_cmp_nom'] as $cmp_nom){
                			if($arr_cmps_frm[$cmp_nom]!=""){
                				$al_menos_1_cmp = true;
                			}
                		}
                		if(!$al_menos_1_cmp){
                			if(isset($arr_param['desc'])){
                				$alerta = $arr_param['desc'];
                			}else{
                				$alerta = 'Llenar al menos uno de los campos';
                			}
                		}
                	}
                	break;
                case 'suma_igual_a_N':
                    //Si la suma da igual a N
                    if(isset($arr_param['arr_cmp_nom']) && isset($arr_param['val_n'])){
                        $suma = 0;
                        foreach ($arr_param['arr_cmp_nom'] as $cmp_nom){
                            $suma += $arr_cmps_frm[$cmp_nom];
                        }
                        if($arr_param['val_n'] != $suma){
                            foreach ($arr_param['arr_cmp_nom'] as $cmp_nom){
                                $arr_validaciones[$cmp_nom] = array("alerta"=>'[sin_desc]');
                            }
                            if(isset($arr_param['desc'])){
                                $alerta = 'En <strong>'.$arr_param['desc'].'</strong>, el total es '.$suma.' y debe ser igual a '.$arr_param['val_n'];
                            }else{
                                $alerta = 'El total es '.$suma.' y debe ser igual a '.$arr_param['val_n'];
                            }
                        }
                    }
                    break;
            }
            if($alerta!=""){
				$arr_val_contenido = array();
				$arr_val_contenido["alerta"] = htmlentities($alerta);
				if(isset($arr_param['tit_preg'])){
					$arr_val_contenido["tit_preg"] = $arr_param['tit_preg'];
				}
				if(isset($arr_param['no_es_campo'])){
					$arr_val_contenido["no_es_campo"] = $arr_param['no_es_campo'];
				}
            	$arr_validaciones[$campo] = $arr_val_contenido;
            }
            
        }
        
        $this->arr_validaciones['detalle'] = $arr_validaciones;
		$this->arr_validaciones['total'] = count($arr_validaciones);
       
    }
	/**
     * Devuelve el arreglo de validaciones obtenidas para el cuestionario actual
     * @return array
     */
    public function getArrValidaciones(){
        return $this->arr_validaciones;
    }
	/**
	 * Devuelve el arreglo que contiene el detalle de las validaciones
	 * @return array
	 */
	public function getArrValidacionesDetalle() {
		if(isset($this->arr_validaciones['detalle'])){
			return $this->arr_validaciones['detalle'];
		}
	}
	/**
	 * Manda a llamar el método setArrReglasM[cat_cuest_modulo_id] que debe estar declarada en la clase origen.
	 * El método ejecutado se enuentra contenido en la clase modelo contenida en la carpeta "model_cuest", que correspondiente al formulario actual y que además es la que desencadaena su ejecución
	 * El método al ejecutarse, llena el arreglo arr_reglas_val
	 * @param int $cat_cuest_modulo_id
	 */
	private function setArrReglasVal($cat_cuest_modulo_id) {
		$nom_func_modulo = $this->getNomFuncModulo($cat_cuest_modulo_id);
		if(!method_exists($this, $nom_func_modulo)){
			$this->setError("Función/Método sin declarar", "La función/Método <strong>".$nom_func_modulo."</strong> no ha sido declarada en la clase <strong>".get_class($this)."</strong>");
		}else{
			$this->$nom_func_modulo();
		}
	}
	/**
	 * Devuelve el valor del campo; definidio en el argumento, del arreglo 'arr_cmps_frm'
	 * @param string $cmp_nom	Nombre del campo que se desea obtener su valor
	 * @return variant
	 */
	private function getValorCampo($cmp_nom){
		$arr_cmps_frm = $this->arr_cmps_frm;
		if(isset($arr_cmps_frm[$cmp_nom])){
			return $arr_cmps_frm[$cmp_nom];
		}else{
			$this->setArrCmpNoExiste($cmp_nom);
			return "";
		}
	}
    /**
	 * Devuelve el nombre del método a llamar encontrado en la clase origen, perteneciente al módulo indicado en el argumento 
	 * @param int $cat_cuest_modulo_id
	 * @return string
	 */
	private function getNomFuncModulo($cat_cuest_modulo_id){
		return "setArrReglas".ucfirst(modulo_cve($cat_cuest_modulo_id));
	}
	/**
	 * Devuelve el valor del campo; definidio en el argumento, del arreglo 'arr_cmps_frm'. Si no se encuentra en el arreglo, se genera un error.
	 * @param string $cmp_nom	Nombre del campo que se desea obtener su valor
	 * @return variant
	 */
	protected function getCmpVal($cmp_nom){
		if(array_key_exists($cmp_nom, $this->arr_cmps_frm)){
			return $this->arr_cmps_frm[$cmp_nom];
		}else{
			$this->setError('Nombre de campo inválido en las validaciones', 'En la clase <strong>'.get_class($this).'</strong> (carpeta model_cuest), el campo <strong>'.$cmp_nom.'</strong> no está definido en el arreglo <strong>arr_cmps_frm</strong>.');
			return null;
		}
	}
	/**
	 * Para los campos identificados como checkbox, devuelve el boleano de si es seleccionado o no
	 * @param string $cmp_nom	Nombre del campo
	 * @return boolean
	 */
	protected function es_chk_sel($cmp_nom) {
		if(intval($this->getValorCampo($cmp_nom))===1){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * Valida si el RFC es correcto
	 * @param string $valor	Texto con el RFC
	 * @return boolean
	 */
	private function valida_rfc($valor) {
		$valor = str_replace("-", "", $valor);
		$cuartoValor = substr($valor, 3, 1);
		//RFC sin homoclave
		if (strlen($valor) == 10) {
			$letras = substr($valor, 0, 4);
			$numeros = substr($valor, 4, 6);
			if (ctype_alpha($letras) && ctype_digit($numeros)) {
				return true;
			}
			return false;
		}
		// Sólo la homoclave
		else if (strlen($valor) == 3) {
			$homoclave = $valor;
			if (ctype_alnum($homoclave)) {
				return true;
			}
			return false;
		}
		//RFC Persona Moral.
		else if (ctype_digit($cuartoValor) && strlen($valor) == 12) {
			$letras = substr($valor, 0, 3);
			$numeros = substr($valor, 3, 6);
			$homoclave = substr($valor, 9, 3);
			if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
				return true;
			}
			return false;
			//RFC Persona Física.

		} else if (ctype_alpha($cuartoValor) && strlen($valor) == 13) {
			$letras = substr($valor, 0, 4);
			$numeros = substr($valor, 4, 6);
			$homoclave = substr($valor, 10, 3);
			if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
				return true;
			}
			return false;
		} else {
			return false;
		}
	}
	/**
	 * Valida si la CURP es correcta
	 * @param string	Texto con la CURP a validar
	 * @return boolean
	 */
	private function valida_curp($string = '') {
		$string = trim($string);
		if (strlen($string) != 18) {
			return false;
		}
		// By @JorhelR
		// TRANSFORMARMOS EN STRING EN MAYÚSCULAS RESPETANDO LAS Ñ PARA EVITAR ERRORES
		$string = mb_strtoupper($string, "UTF-8");
		// EL REGEX POR @MARIANO
		$pattern = "/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/";
		$validate = preg_match($pattern, $string, $match);
		if ($validate === false) {
			// SI EL STRING NO CUMPLE CON EL PATRÓN REQUERIDO RETORNA FALSE
			return false;
		}
		if (count($match) == 0) {
			return false;
		}
		// ASIGNAMOS VALOR DE 0 A 36 DIVIDIENDO EL STRING EN UN ARRAY
		$ind = preg_split('//u', '0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ', null, PREG_SPLIT_NO_EMPTY);
		// REVERTIMOS EL CURP Y LE COLOCAMOS UN DÍGITO EXTRA PARA QUE EL VALOR DEL PRIMER CARACTER SEA 0 Y EL DEL PRIMER DIGITO DE LA CURP (INVERSA) SEA 1
		$vals = str_split(strrev($match[0] . "?"));
		// ELIMINAMOS EL CARACTER ADICIONAL Y EL PRIMER DIGITO DE LA CURP (INVERSA)
		unset($vals[0]);
		unset($vals[1]);
		$tempSum = 0;
		foreach ($vals as $v => $d) {
			// SE BUSCA EL DÍGITO DE LA CURP EN EL INDICE DE LETRAS Y SU CLAVE(VALOR) SE MULTIPLICA POR LA CLAVE(VALOR) DEL DÍGITO. TODO ESTO SE SUMA EN $tempSum
			$tempSum = (array_search($d, $ind) * $v) + $tempSum;
		}
		// ESTO ES DE @MARIANO NO SUPE QUE ERA
		$digit = 10 - $tempSum % 10;
		// SI EL DIGITO CALCULADO ES 10 ENTONCES SE REASIGNA A 0
		$digit = $digit == 10 ? 0 : $digit;
		// SI EL DIGITO COINCIDE CON EL ÚLTIMO DÍGITO DE LA CURP RETORNA TRUE, DE LO CONTRARIO FALSE
		return $match[2] == $digit;
	}
	/**
	 * Va agregando aquellos nombres de campos que son detectados como inexistentes
	 * @param array $cmp_no_existen
	 */
	private function setArrCmpNoExiste($cmp_no_existen){
		$this->arr_cmps_no_existen[] = $cmp_no_existen;
	}
}
