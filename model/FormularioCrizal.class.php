<?php
/**
 * Clase modelo FormularioALTE3
 * @author Ismael Rojas
 */
class FormularioCrizal{
	private bool $lectura = false;
	private array $arr_cmp_atrib = array();	//Arreglo de atributos/propiedades por campo
	private bool $usar_div_agrupar = true;
	private array $arr_error = array();
	private $ver_nombre_campo = false;
	private $con_select2 = false;   //Campos select con las propiedades de la clase select2
	private $act_opt_desc = false;
	private $arr_deft_prop = array();
	private $arr_val_sin_cmp = array();	//Arreglo de validaciones que no estan ligadas a un campo en específico
	public function __construct(array $arr_cmps) {
		//Se hace el primer llenado del arreglo arr_cmp_atrib (Arreglo de atributos/propiedades por campo), con el contenido del arreglo arr_cmp, arreglo obligatorio y necesario
		if(count($arr_cmps)){
			$arr_cmp_atrib = array();
			foreach($arr_cmps as $cmp_id_nom=>$cmp_id_val){
				$arr_cmp_atrib[$cmp_id_nom] = array(
					"cmp_id_nom"=>$cmp_id_nom,
					"value"=>$cmp_id_val,
				);
			}
			$this->arr_cmp_atrib = $arr_cmp_atrib;
		}
	}
	/**
	 * Se agrega el atributo "alerta" al arreglo de atributos/propiedades por campo (arr_cmp_atrib).
	 * Este evento se declara cuando se requiere mostrar mensajes de alerta de validaciones generadas a partir de la Clase modelo contenida en la carpeta "model_cuest" correspondiente al formulario/cuestionario actual.
	 * @param array $arr_validaciones	Subarreglo obtenido del arreglo arr_validaciones (contenido en la llave "detalle") generado a partir de la Clase modelo contenida en la carpeta "model_cuest" correspondiente al formulario/cuestionario actual
	 * @return void
	 */
	public function asignaValidaciones(array $arr_validaciones): void{
		if(is_array($arr_validaciones) && count($arr_validaciones)){
			$arr_val_sin_cmp = array();
			$arr_cmp_atrib = $this->arr_cmp_atrib;
			foreach($arr_validaciones as $cmp_id_nom => $arr_val_det){
				if(isset($arr_val_det["alerta"]) && $arr_val_det["alerta"]!=""){
					if(isset($arr_val_det["no_es_campo"])){
						/**
						 * Si en el arreglo un registro tiene la propiedad "no_es_campo", significa que dicho registro su llave no es un campo, por lo tanto, no se considera para el arreglo arr_cmp_atrib, 
						 * sin embargo sí se agrega al arreglo arr_val_sin_cmp, para permitir ser desplegada la alerta usando el método validacionSinCmp
						 */
						$arr_val_sin_cmp[$cmp_id_nom]['alerta'] = $arr_val_det["alerta"];
					}elseif(isset($arr_cmp_atrib[$cmp_id_nom])){
						$arr_cmp_atrib[$cmp_id_nom]['alerta'] = $arr_val_det["alerta"];
					}
					
				}
			}
			$this->arr_cmp_atrib = $arr_cmp_atrib;
			$this->arr_val_sin_cmp = $arr_val_sin_cmp;
		}
	}
	/**
	 * Activa/desactiva la bandera 'lectura', la cual imprime el campo en modo de lectura
	 * @param bool $lectura	Valor de la bandera
	 * @return void
	 */
	public function setLectura(bool $lectura): void{
		$this->lectura = $lectura;
	}
	/**
	 * Modifica la variable que indica si se va a mostrar o no el nombre del campo debajo del campo y así poder tener la nomenclatura del cuestionario
	 * @param boolean $ver_nombre_campo	Valor de la bandera
	 */
	public function setVerNombreCampo(bool $ver_nombre_campo): void{
	    $this->ver_nombre_campo = $ver_nombre_campo;
	}
	/**
	 * Activa/desactiva la bandera para agrupar el campo con un div de identificación de campo bootstrap
	 * @param bool $usar_div_agrupar	Valor de la bandera
	 * @return void
	 */
	public function setUsarDivAgrupar(bool $usar_div_agrupar): void{
		$this->usar_div_agrupar = $usar_div_agrupar;
	}
	/**
	 * Modifica la variable que indica si se va a utilizar la clase Select2 de AdminLTE, dicha clase viene con un buscar integrado en el campo
	 * @param string $bandera	Valor de la bandera
	 */
	public function setConSelect2(bool $con_select2): void{
	    $this->con_select2 = $con_select2;
	}
	/**
	 * Para el campo tipo select. Cada vez que se carga el formulario en modo edición, al generarse el campo, vuelve a actualizar su descripción con el último valor en la fuente de datos.
	 * La actualización se realiza al generarse las opciones e identificar el valor actual seleccionado.
	 * Esta modalidad puede no ser muy util cuando la fuente de datos no cambia, pero serviría en el caso de que hubiera correcciónes en la fuente.
	 * Esta configuración no se tiene como atributo por campo, es general.
	 * @param bool $act_opt_desc	Valor de la bandera
	 * @return void
	 */
	public function setActOptDesc(bool $act_opt_desc): void{
		$this->act_opt_desc = $act_opt_desc;
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo texto
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpTexto(string $cmp_id_nom, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		$arr_atrib_usu['cmp_tipo'] = "text";
		return $this->getCmpTexto($cmp_id_nom, $arr_atrib_usu);
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo numérico
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param int $decimales	Total de decimales permitidas en el campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpNum(string $cmp_id_nom, int $decimales, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['decimales'] = $decimales;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		$arr_atrib_usu['cmp_tipo'] = "num";
		//$class_decimales = ($decimales==0)? 'positive text-right' : 'decimal-'.$decimales.'-places text-right';
		
		return $this->getCmpTexto($cmp_id_nom, $arr_atrib_usu);
	}
	
	/**
	 * Devuelve el elemento HTML para un campo de tipo numérico para captura de coordenadas, permitiendo ingresar hasta 6 decimales y números negativos.
	 * Nota. Debido a que para las coordenadas son 6 decimales, ya no se tiene el argumento de decimales
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpNumCoord(string $cmp_id_nom, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['decimales'] = 6;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		$arr_atrib_usu['cmp_tipo'] = "num_coord";
		//$class_decimales = ($decimales==0)? 'positive text-right' : 'decimal-'.$decimales.'-places text-right';
		
		return $this->getCmpTexto($cmp_id_nom, $arr_atrib_usu);
	}
	
	
	/**
	 * Devuelve el elemento HTML para un campo de tipo correo
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpCorreo(string $cmp_id_nom, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		$arr_atrib_usu['cmp_tipo'] = "email";
		return $this->getCmpTexto($cmp_id_nom, $arr_atrib_usu);
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo contraseña
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpContrasenia(string $cmp_id_nom, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		$arr_atrib_usu['cmp_tipo'] = "password";
		return $this->getCmpTexto($cmp_id_nom, $arr_atrib_usu);
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo fecha
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpFecha(string $cmp_id_nom, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		$arr_atrib_usu['cmp_tipo'] = "date";
		return $this->getCmpTexto($cmp_id_nom, $arr_atrib_usu);
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo lectura
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpLectura(string $cmp_id_nom, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		return $this->getCmpLectura($cmp_id_nom, $arr_atrib_usu);
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo oculto
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $cmp_valor	Valor del campo
	 * @return string
	 */
	public function cmpOculto(string $cmp_id_nom, string $cmp_valor): string{
		$arr_atrib_usu['value'] = $cmp_valor;
		$arr_atrib_usu['cmp_tipo'] = "oculto";
		$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
		return $this->getTagCmpOculto($cmp_id_nom);
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo textarea
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpTextArea(string $cmp_id_nom, string $lbl_txt="", array $arr_atrib_usu=array()): string {
		if($this->esLectura($arr_atrib_usu)){
			return $this->getCmpLecturaTextArea($cmp_id_nom, $lbl_txt, $arr_atrib_usu);
		}else{
			$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
			$arr_atrib_usu['lbl_txt'] = $lbl_txt;
			$arr_atrib_usu['cmp_tipo'] = "textarea";
			$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
			
			$tag_cmp = '<textarea';
			$tag_cmp .= ' id="'.$cmp_id_nom.'"';
			$tag_cmp .= ' name="'.$cmp_id_nom.'"';
			$tag_cmp .= ' class="'.$this->getAtributo($cmp_id_nom, 'class').'"';
			$tag_cmp .= ' placeholder="'.$this->getAtributo($cmp_id_nom, 'placeholder').'"';
			$tag_cmp .= ' rows="'.$this->getAtributo($cmp_id_nom, 'rows').'"';
			$tag_cmp .= ' '.$this->getAtributo($cmp_id_nom, 'readonly');
			$tag_cmp .= '>';
			$tag_cmp .= $this->getAtributoValue($cmp_id_nom);
			$tag_cmp .= '</textarea>';
			
			$arr_tag = array();
			$arr_tag[] = $this->getLabel($cmp_id_nom);
			$arr_tag[] = $tag_cmp;
			return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
		}
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo select. El contenido del select se obtiene a partir del arreglo enviado en el argumento
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_options	Arreglo de opciones que apareceran en el select
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpSelectArreglo(string $cmp_id_nom, string $lbl_txt="", array $arr_options, array $arr_atrib_usu=array()): string{
		if($this->esLectura($arr_atrib_usu)){
			return $this->getCmpLecturaSelect($cmp_id_nom, $lbl_txt, $arr_atrib_usu);
		}else{
			$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
			$arr_atrib_usu['lbl_txt'] = $lbl_txt;
			$arr_atrib_usu['arr_options'] = $arr_options;
			$arr_atrib_usu['cmp_tipo'] = "select";
			$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
			
			$tag_cmp = '<select';
			$tag_cmp .= ' id="'.$cmp_id_nom.'"';
			$tag_cmp .= ' name="'.$cmp_id_nom.'"';
			$tag_cmp .= ' class="'.$this->getAtributo($cmp_id_nom, 'class').'"';
			//No sirve en los select el: $tag_cmp .= ' '.$this->getAtributo($cmp_id_nom, 'readonly');
			$tag_cmp .= '>';
			$tag_cmp .= $this->getTagOptions($cmp_id_nom);
			$tag_cmp .= '</select>';
			
			$cmp_desc_nom = $cmp_id_nom.'_desc';
			$arr_tag = array();
			$arr_tag[] = $this->getLabel($cmp_id_nom);
			$arr_tag[] = $tag_cmp;
			$arr_tag[] = $this->cmpOculto($cmp_desc_nom, $this->getAtributo($cmp_desc_nom, 'value'));
			return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
		}
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo select. El contenido del select se obtiene de una tabla cuyos parámetros se definen en los argumentos
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $tbl_nom	Nombre de la tabla que contiene la información a mostrar dentro del select
	 * @param string $id_val_nom	Nombre del campo que se va a considerar como Id de cada opción
	 * @param string $desc_val_nom	Nombre del campo que se mostrará como contenido de cada opción
	 * @param string $and_tbl	Sentencia query para filtrar el contendido
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu
	 * @return string
	 */
	public function cmpSelectDeTbl(string $cmp_id_nom, string $tbl_nom, string $id_val_nom, string $desc_val_nom, string $and_tbl, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		if($this->esLectura($arr_atrib_usu)){
			return $this->getCmpLecturaSelect($cmp_id_nom, $lbl_txt, $arr_atrib_usu);
		}else{
			$db = new BaseDatos();
			$arr_tbl = $db->getArrDeTabla($tbl_nom, $and_tbl, $id_val_nom);

			$arr_opt = array();
			foreach ($arr_tbl as $id_val=>$arr_det){
				$desc_val = (isset($arr_det[$desc_val_nom]))? $arr_det[$desc_val_nom] : "";
				$es_esp = (isset($arr_det['es_esp']))? $arr_det['es_esp'] : "";
				$arr_opt[] = array("id_val"=>$id_val, "desc_val"=>$desc_val, "es_esp"=>$es_esp);
			}
			return $this->cmpSelectArreglo($cmp_id_nom, $lbl_txt, $arr_opt, $arr_atrib_usu);
		}
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo select. El contenido del select se obtiene de una tabla específica para almacenar sub-catálogos usados para este fin.
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $cat_nombre	Nombre de la llave que contiene la información dentro de la tabla
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpSelectDeSubCat(string $cmp_id_nom, string $cat_nombre, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		$and_tbl = " AND `cat_nombre` LIKE '".$cat_nombre."' ORDER BY `orden` ASC ";
		return $this->cmpSelectDeTbl($cmp_id_nom, 'cat_sub_cat', 'opc_id', 'opc_descripcion', $and_tbl, $lbl_txt, $arr_atrib_usu);
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo checkbox
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpCheckbox(string $cmp_id_nom, string $lbl_txt="", array $arr_atrib_usu=array()): string {
		if($this->esLectura($arr_atrib_usu)){
			return $this->getCmpLecturaCheckBox($cmp_id_nom, $lbl_txt, $arr_atrib_usu);
		}else{
			$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
			$arr_atrib_usu['lbl_txt'] = $lbl_txt;
			$arr_atrib_usu['cmp_tipo'] = 'checkbox';
			$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
			
			$tag_cmp = '<input';
			$tag_cmp .= ' class="'.$this->getAtributo($cmp_id_nom, 'class').'"';
			$tag_cmp .= ' type="'.$this->getAtributo($cmp_id_nom, 'type').'"';
			$tag_cmp .= ' name="'.$cmp_id_nom.'"';
			$tag_cmp .= ' id="'.$cmp_id_nom.'"';
			$tag_cmp .= ' value="'.$this->getAtributo($cmp_id_nom, 'checked_val').'"';
			$tag_cmp .= ' '.$this->getAtributo($cmp_id_nom, 'readonly');
			$tag_cmp .= ' '.$this->getCheckedChk($cmp_id_nom);
			$tag_cmp .= '>';
			
			$arr_tag = array();
			$arr_tag[] = '<input name="'.$cmp_id_nom.'" id="'.$cmp_id_nom.'_h" type="hidden" value="'.$this->getAtributo($cmp_id_nom, 'unchecked_val').'">';
			$arr_tag[] = $tag_cmp;
			$arr_tag[] = $this->getLabel($cmp_id_nom);
			return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
		}
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo radio
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $id_val	Valor que almacenará cuando se marque como seleccionado
	 * @param string $desc_val	Descrpción valor
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	public function cmpRadioOpt(string $cmp_id_nom , string $id_val, string $desc_val, array $arr_atrib_usu=array()): string {
		if($this->esLectura($arr_atrib_usu)){
			return $this->getCmpLecturaRadio($cmp_id_nom, $id_val, $desc_val, $arr_atrib_usu);
		}else{
			$id = $cmp_id_nom.'_'.$id_val;
			$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
			$arr_atrib_usu['id'] = $id;
			$arr_atrib_usu['name'] = $cmp_id_nom;
			$arr_atrib_usu['lbl_txt'] = $desc_val;
			$arr_atrib_usu['cmp_tipo'] = 'radio';
			$arr_atrib_usu['id_val'] = $id_val;
			$arr_atrib_usu['desc_val'] = $desc_val;
			$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
			
			$tag_cmp ='<input';
			$tag_cmp .=' type="'.$this->getAtributo($cmp_id_nom, 'type').'"';
			$tag_cmp .=' class="'.$this->getAtributo($cmp_id_nom, 'class').'"';
			$tag_cmp .=' id="'.$id.'"';
			$tag_cmp .=' name="'.$cmp_id_nom.'"';
			$tag_cmp .=' value="'.$id_val.'"';
			$tag_cmp .= ' '.$this->getCheckedRadio($cmp_id_nom);
			$tag_cmp .='>';
			
			$cmp_desc_nom = $cmp_id_nom.'_desc';
			$arr_tag = array();
			$arr_tag[] = $tag_cmp;
			$arr_tag[] = '<label class="'.$this->getAtributo($cmp_id_nom, 'lbl_class').'" for="'.$id.'">'.$desc_val.'</label>';
			$arr_tag[] = ($this->getCheckedRadio($cmp_id_nom)!="")? $this->cmpOculto($cmp_desc_nom, $desc_val) : "";
			return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
		}
	}
	/**
	 * Alerta de validación para aquellas cuya llave no es un campo o que no están ligadas a un campo si probablemente a varios, en especial para los campo checbox
	 * @param string $div_al_nom
	 * @return string
	 */
	public function validacionSinCmp(string $div_al_nom): string {
		$arr_val_sin_cmp = $this->arr_val_sin_cmp;
		$arr_tag = array();
		if(isset($arr_val_sin_cmp[$div_al_nom]['alerta']) && $arr_val_sin_cmp[$div_al_nom]['alerta']!=""){
			$arr_tag[] = '<div id="'.$div_al_nom.'">';
			$arr_tag[] = '<span class="help-block">'.$arr_val_sin_cmp[$div_al_nom]['alerta'].'</span>';
			$arr_tag[] = '</div>';
		}
		return tag_string($arr_tag);
	}
	
	/**
	 * Devuelve el arreglo de atributos generados por cada campo declarado dentro de un formulario.
	 * Sirve para identificar todas las propiedades de cada campo.
	 * @return string
	 */
	public function imprimeArrCmpAtrib(): string{
		return json_encode($this->arr_cmp_atrib);
	}
	/**
	 * Devuelve el elemento HTML para todos los campos input
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	private function getCmpTexto(string $cmp_id_nom, array $arr_atrib_usu): string{
		if($this->esLectura($arr_atrib_usu)){
			return $this->getCmpLectura($cmp_id_nom, $arr_atrib_usu);
		}else{
			$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
			$tag_cmp = '<input';
			$tag_cmp .= ' type="'.$this->getAtributo($cmp_id_nom, 'type').'"';
			$tag_cmp .= ' id="'.$cmp_id_nom.'"';
			$tag_cmp .= ' name="'.$cmp_id_nom.'"';
			if($this->getAtributo($cmp_id_nom, 'class')!=''){
				$tag_cmp .= ' class="'.$this->getAtributo($cmp_id_nom, 'class').'"';
			}
			$tag_cmp .= ' placeholder="'.$this->getAtributo($cmp_id_nom, 'placeholder').'"';
			$tag_cmp .= ' value="'.$this->getAtributoValue($cmp_id_nom).'"';
			$tag_cmp .= ' '.$this->getAtributo($cmp_id_nom, 'readonly');
			$tag_cmp .= '>';
			if($this->getAtributo($cmp_id_nom, 'posfijo')!=""){
				$tag_cmp .= '<div class="input-group-append">';
				$tag_cmp .= '<span class="input-group-text">'.$this->getAtributo($cmp_id_nom, 'posfijo').'</span>';
				$tag_cmp .= '</div>';
			}
			
			$arr_tag = array();
			$arr_tag[] = $this->getLabel($cmp_id_nom);
			$arr_tag[] = $tag_cmp;
			return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
		}
	}
	/**
	 * Devuelve el elemento HTML para imprimir en modo lectura los campos
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	private function getCmpLectura(string $cmp_id_nom, array $arr_atrib_usu=array()): string{
		$arr_atrib_usu['cmp_tipo'] = "lectura";
		$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
		
		$arr_tag = array();
		$arr_tag[] = $this->getLabel($cmp_id_nom);
		$arr_tag[] = $this->getTxtLectura($this->getAtributo($cmp_id_nom, 'value'));
		$arr_tag[] = $this->getTagCmpOculto($cmp_id_nom);
		return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo select pero que se muestra en modo lectura
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	private function getCmpLecturaSelect(string $cmp_id_nom, string $lbl_txt, array $arr_atrib_usu): string{
		$cmp_desc_nom = $cmp_id_nom.'_desc';
		$arr_atrib_usu['cmp_id_nom'] = $cmp_desc_nom;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		$arr_atrib_usu['cmp_tipo'] = "lectura";
		$this->defineArrCmpAtrib($cmp_desc_nom, $arr_atrib_usu);
		
		$arr_tag = array();
		$arr_tag[] = $this->getLabel($cmp_desc_nom);
		$arr_tag[] = $this->getTxtLectura($this->getAtributo($cmp_desc_nom,'value'));
		$arr_tag[] = $this->getTagCmpOculto($cmp_desc_nom);
		$arr_tag[] = $this->cmpOculto($cmp_id_nom, $this->getAtributo($cmp_id_nom,'value'));
		return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo textarea pero que se muestra en modo lectura
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	private function getCmpLecturaTextArea(string $cmp_id_nom, string $lbl_txt, array $arr_atrib_usu): string{
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		$arr_atrib_usu['cmp_tipo'] = "lectura";
		$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
		
		$arr_tag = array();
		$arr_tag[] = $this->getLabel($cmp_id_nom);
		$arr_tag[] = $this->getTxtLectura(nl2br($this->getAtributo($cmp_id_nom,'value')));
		$arr_tag[] = $this->getTagCmpOculto($cmp_id_nom);
		return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo checkbox pero que se muestra en modo lectura
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	private function getCmpLecturaCheckBox(string $cmp_id_nom, string $lbl_txt="", array $arr_atrib_usu=array()): string{
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['lbl_txt'] = $lbl_txt;
		$arr_atrib_usu['cmp_tipo'] = "lectura_chk";
		$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
		
		$i_class = ($this->getCheckedChk($cmp_id_nom)!="")? $this->getAtributo($cmp_id_nom, 'i_class_chk') : $this->getAtributo($cmp_id_nom, 'i_class_unchk');
		$texto = '<i class="'.$i_class.'"></i> '.$this->getAtributo($cmp_id_nom, 'lbl_txt');
		
		$arr_tag = array();
		$arr_tag[] = $this->getLabel($cmp_id_nom, $texto);
		$arr_tag[] = $this->getTagCmpOculto($cmp_id_nom);
		return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
		
	}
	/**
	 * Devuelve el elemento HTML para un campo de tipo radio pero que se muestra en modo lectura
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $id_val	Valor que almacenará cuando se marque como seleccionado
	 * @param string $desc_val	Descripción del valor
	 * @param array $arr_atrib_usu	Arreglo de atributos de configuración para el campo
	 * @return string
	 */
	private function getCmpLecturaRadio(string $cmp_id_nom , string $id_val, string $desc_val, array $arr_atrib_usu=array()): string{
		$id = $cmp_id_nom.'_'.$id_val;
		$arr_atrib_usu['cmp_id_nom'] = $cmp_id_nom;
		$arr_atrib_usu['lbl_txt'] = $desc_val;
		$arr_atrib_usu['cmp_tipo'] = "lectura_radio";
		$arr_atrib_usu['id'] = $id;
		$arr_atrib_usu['name'] = $cmp_id_nom;
		$arr_atrib_usu['id_val'] = $id_val;
		$this->defineArrCmpAtrib($cmp_id_nom, $arr_atrib_usu);
		
		$i_class = ($this->getCheckedRadio($cmp_id_nom)!="")? $this->getAtributo($cmp_id_nom, 'i_class_chk') : $this->getAtributo($cmp_id_nom, 'i_class_unchk');
		$texto = '<i class="'.$i_class.'"></i> '.$this->getAtributo($cmp_id_nom, 'lbl_txt');
		
		$cmp_desc_nom = $cmp_id_nom.'_desc';
		$arr_tag = array();
		$arr_tag[] = $this->getLabel($cmp_id_nom, $texto);
		$arr_tag[] = $this->getTagCmpOculto($cmp_id_nom);
		$arr_tag[] = ($this->getCheckedRadio($cmp_id_nom)!="")? $this->cmpOculto($cmp_desc_nom, $desc_val) : "";
		return $this->getDivAgrupar($cmp_id_nom, tag_string($arr_tag));
	}
	
	/**
	 * Devuelve el tag para un campo oculto, se usa para incluir campos ocultos extra dentro de una definición de campo, como el de tipo lectura
	 * Aviso, no llamar esta función para declarar un campo oculto definido, para eso está la función cmpOculto. De lo contrario, no aparecerá en el arreglo de atributos
	 * @param string $cmp_id_nom
	 * @return string
	 */
	private function getTagCmpOculto(string $cmp_id_nom): string{
		return '<input type="hidden" id="'.$cmp_id_nom.'" name="'.$cmp_id_nom.'" value="'.$this->getAtributoValue($cmp_id_nom).'">';
	}
	/**
	 * Devuelve el elemento HTML label para desplegar el título del campo
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $lbl_txt	Título del campo
	 * @return string
	 */
	private function getLabel(string $cmp_id_nom, string $lbl_txt=""): string{
		$lbl_txt_atrib = $this->getAtributo($cmp_id_nom, 'lbl_txt');
		if($lbl_txt!="" || $lbl_txt_atrib!=""){
			$class = $this->getAtributo($cmp_id_nom, 'lbl_class');
			$lbl_class = ($class!="")? ' class="'.$class.'"' : '';
			$texto = ($lbl_txt!="")? $lbl_txt : $lbl_txt_atrib;
			return '<label'.$lbl_class.' for="'.$cmp_id_nom.'">'.$texto.'</label>';
		}else{
			return '';
		}
	}
	/**
	 * Devuelve el elemento HTML que muestra el valor de un campo que está en modo lectura
	 * @param string $texto	VAlor del campo
	 * @return string
	 */
	private function getTxtLectura($texto): string{
		return '<p class="text-navy">'.$texto.'</p>';
	}
	/**
	 * Devuelve el elemento HTML con el contenido de todas las opciones a desplegar dentro de un campo select
	 * @param string $cmp_id_nom	Nombre/Id del campo select
	 * @return string
	 */
	private function getTagOptions($cmp_id_nom){
		$arr_tag_options = array('<option value="" data-desc_val="" data-esp_val="">[Seleccionar]</option>');
		$arr_options = $this->getAtributo($cmp_id_nom, 'arr_options');
		$valor_act = $this->getAtributo($cmp_id_nom, 'value');
		foreach($arr_options as $arr_detalle){
			if(isset($arr_detalle['id_val']) && $arr_detalle['desc_val']){
				$id_val = $arr_detalle['id_val'];
				$desc_val = $arr_detalle['desc_val'];
				$selected = '';
				if(($id_val== $valor_act && $valor_act!="")){
					$selected = 'selected="selected"';
					$this->actualizaCmpDescDe($cmp_id_nom, $desc_val);
				}
				
			}else{
				$this->setError($cmp_id_nom, 'Arreglo <strong>arr_options</strong> mal estructurado, debe ser del tipo: '. htmlentities(json_encode(array(array("id_val"=>"1","desc_val"=>"Valor 1")))));
				break;
			}
			$es_esp = (isset($arr_detalle['es_esp']))? $arr_detalle['es_esp'] : "";
			
			$tag_option = '<option';
			$tag_option .= ' value="'.$id_val.'"';
			$tag_option .= ' data-desc_val="'.$desc_val.'"';
			$tag_option .= ' data-es_esp="'.$es_esp.'"';
			$tag_option .= ' '.$selected;
			$tag_option .= '>';
			$tag_option .= $desc_val;
			$tag_option .='</option>';
			$arr_tag_options[] = $tag_option;
		}
		return tag_string($arr_tag_options);
	}
	/**
	 * Genera el arreglo de atributos para el campo
	 * @param string $cmp_id_nom
	 * @param array $arr_atrib_usr
	 * @return void
	 */
	private function setArrCmpAtrib($cmp_id_nom, $arr_atrib_usr): void{
		$arr_cmp_atrib = $this->arr_cmp_atrib;
		$arr_cmp_atrib[$cmp_id_nom] = $arr_atrib_usr;
		$this->arr_cmp_atrib = $arr_cmp_atrib;
	}
	/**
	 * Devuelve el arreglo de atributos de campo
	 * @param string $cmp_id_nom
	 * @return array
	 */
	private function getArrCmpAtrib($cmp_id_nom){
		$arr_cmp_atrib = $this->arr_cmp_atrib;
		if(isset($arr_cmp_atrib[$cmp_id_nom])){
			return $arr_cmp_atrib[$cmp_id_nom];
		}else{
			return array();
		}
	}
	/**
	 * Devuelve el atributo del campo indicado en el argumento
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $atrib_nombre	Nombre del atributo buscado
	 * @return string
	 */
	private function getAtributo(string $cmp_id_nom, string $atrib_nombre){
		$arr_cmp_atrib = $this->arr_cmp_atrib;
		if(isset($arr_cmp_atrib[$cmp_id_nom][$atrib_nombre])){
			return $arr_cmp_atrib[$cmp_id_nom][$atrib_nombre];
		}else{
			return "";
		}
	}
	/**
	 * Devuelve el elemento HTML div con el cual se encierran la mayoría de los campos
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $tag_campo	Elemento HTML del campo a encerrar dentro del div
	 * @return string
	 */
	private function getDivAgrupar(string $cmp_id_nom, $tag_campo): string{
		$tag_error = $this->getTagError($cmp_id_nom);
		$tag_alerta = $this->getTagAlerta($cmp_id_nom);
		$tag_ver_nom_cmp = $this->getTagVerNombreCampo($cmp_id_nom);
		
		$arr_tag_tags = array();
		$arr_tag_tags[] = $tag_campo;
		$arr_tag_tags[] = $tag_error;
		$arr_tag_tags[] = $tag_alerta;
		$arr_tag_tags[] = $tag_ver_nom_cmp;
		$tag_tags = tag_string($arr_tag_tags);
		
		if($this->getAtributo($cmp_id_nom, 'usar_div_agrupar')){
			
			
			$arr_tag = array();
			$arr_tag[] = '<div class="'.$this->getAtributo($cmp_id_nom, 'div_group_class').'" id="fg_'.$cmp_id_nom.'">';
			$arr_tag[] = '	'.$tag_tags;
			$arr_tag[] = '</div>';
			return tag_string($arr_tag);
		}else{
			return $tag_tags;
		}
	}
	/**
	 * Al generarse un error, este se va almacenando en un arreglo específico, para despues poder mostrar en lugar del campo
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param string $txt_error	Texto de error
	 * @return void
	 */
	private function setError(string $cmp_id_nom, string $txt_error): void {
		$arr_error = $this->arr_error;
		$arr_error[$cmp_id_nom] = $txt_error;
		$this->arr_error = $arr_error;
	}
	/**
	 * Devuelve el error producido
	 * @param string $cmp_id_nom	Nombre/Id del campo que generó el error
	 * @return string
	 */
	private function getError(string $cmp_id_nom): string{
		$arr_error = $this->arr_error;
		if(isset($arr_error[$cmp_id_nom])){
			return $arr_error[$cmp_id_nom];
		}else{
			return "";
		}
	}
	/**
	 * Devuelve el elemento HTML para desplegar un error
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @return string
	 */
	private function getTagError(string $cmp_id_nom): string{
		if($this->getError($cmp_id_nom)!=""){
			$arr_tag_error = array();
			$arr_tag_error[] = '<p class="bg-danger text-white">';
			$arr_tag_error[] = '<strong>Error interno: </strong>';
			$arr_tag_error[] = $this->getError($cmp_id_nom);
			$arr_tag_error[] = '</p>';
			return tag_string($arr_tag_error);
		}else{
			return "";
		}
	}
	/**
	 * Devuelve el elemento HTML para desplegar un error y terminar la ejecución
	 * @param string $txt_error	Texto del error
	 * @return void
	 */
	private function dieError(string $txt_error): void{
		$arr_tag_error = array();
		$arr_tag_error[] = '<p class="bg-danger text-white">';
		$arr_tag_error[] = '<strong>Error interno: </strong>';
		$arr_tag_error[] = $txt_error;
		$arr_tag_error[] = '</p>';
		die(tag_string($arr_tag_error));
	}
	/**
	 * Devuelve el elemento HTML con el texto que despliega las alertas por campo
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @return string
	 */
	private function getTagAlerta(string $cmp_id_nom): string{
		$alerta = $this->getAlerta($cmp_id_nom);
		if($alerta!=""){
			return '<span class="help-block">'.$alerta.'</span>';
		}else{
			return '<span class="help-block" style="display: none;">'.$alerta.'</span>';
		}
	}
	/**
	 * Devuelve el texto de alerta a desplegar
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @return string
	 */
	private function getAlerta(string $cmp_id_nom): string{
		$alerta = $this->getAtributo($cmp_id_nom, 'alerta');
		if($alerta!="" && $alerta!="[sin_desc]"){
			return $alerta;
		}else{
			return "";
		}
	}
	/**
	 * Devuelve el elemento HTML para desplegar el nombre del campo debajo del campo
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @return string
	 */
	private function getTagVerNombreCampo(string $cmp_id_nom): string{
		$ver_nombre_campo = $this->getAtributo($cmp_id_nom, 'ver_nombre_campo');
		if($ver_nombre_campo){
			return '<p class="campo_nombre">'.$cmp_id_nom.'</p>';
		}else{
			return '<p class="campo_nombre" style="display: none;">'.$cmp_id_nom.'</p>';
		}
	}
	/**
	 * Actualiza el atributo value del campo _desc pertenciente al campo select indicado en el argumento.
	 * El valor actualizado es el enviado en el argumento.
	 * @param string $cmp_id_nom
	 * @param string $val_desc
	 * @return void
	 */
	private function actualizaCmpDescDe(string $cmp_id_nom, string $val_desc): void{
		if($this->act_opt_desc){
			$cmp_desc_id_nom = $cmp_id_nom.'_desc';
			$arr_cmp_atrib = $this->getArrCmpAtrib($cmp_desc_id_nom);
			$arr_cmp_atrib['value'] = $val_desc;
			$this->setArrCmpAtrib($cmp_desc_id_nom, $arr_cmp_atrib);
		}
	}
	/**
	 * Devuelve el dato lectura a partir de la fuente prioritaria, primero si existe del argumento, despues de la propiedad lectura
	 * @param array $arr_atrib_usu
	 * @return bool
	 */
	private function esLectura($arr_atrib_usu): bool {
		if(isset($arr_atrib_usu['lectura'])){
			return $arr_atrib_usu['lectura'];
		}else{
			return $this->lectura;
		}
	}
	/**
	 * Devuelve el valor del atributo value pero aplicando htmlentities
	 * Únicamente se debe usar para la asignación del valor dentro del tag value, de lo contrario el valor original cambia.
	 * @param string $cmp_id_nom
	 * @return string
	 */
	private function getAtributoValue(string $cmp_id_nom): string{
		return htmlentities($this->getAtributo($cmp_id_nom, 'value'));
	}
	/**
	 * Devuelve el atributo que indica que un campo de tipo checkbox está seleccionado
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @return string
	 */
	private function getCheckedChk(string $cmp_id_nom): string{
		if($this->getAtributo($cmp_id_nom, 'checked_val')== $this->getAtributo($cmp_id_nom, 'value')){
			return 'checked="checked"';
		}else{
			return '';
		}
	}
	/**
	 * Devuelve el atributo que indica que un campo de tipo radio está seleccionado
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @return string
	 */
	private function getCheckedRadio(string $cmp_id_nom): string{
		if($this->getAtributo($cmp_id_nom, 'id_val') == $this->getAtributo($cmp_id_nom, 'value')){
			return 'checked="checked"';
		}else{
			return '';
		}
	}
	/**
	 * A partir de un arreglo predeterminado de propiedades de campo, devuelve el valor predeterminado del campo indicado en el argumento
	 * Función no utilizada, considerar quitarla
	 * @param string $cmp_tipo	Nombre/Id del campo
	 * @param string $prop_nom	Nombre de la propiedad a buscar
	 * @return string
	 */
	private function getDeftPropCmpTipo(string $cmp_tipo, string $prop_nom): string{
		$arr_deft_prop = $this->arr_deft_prop;
		if(isset($arr_deft_prop[$cmp_tipo][$prop_nom])){
			return $arr_deft_prop[$cmp_tipo][$prop_nom];
		}else{
			$this->dieError("No se encontró la propiedad predeterminada [".$prop_nom."] para el tipo de campo [".$cmp_tipo."]");
		}
	}
	/**
	 * Actualiza el arreglo con las propiedades predeterminadas y/o preconfiguradas en la declaración del objeto.
	 * Nota 1. Se llama cada vez que se crea un campo debido a que tiene que tomar lo último de las propiedades preconfiguradas
	 * Nota 2. Toda propiedad de configuración aquí tiene que ser asignada dentro de cada tipo de campo en el arreglo,
	 * sólo si esa propiedad es exclusiva, se declara en los tipos de campo correspondientes.
	 * @return void
	 */
	private function setArrDeftProp(): void{
		$checked_val = 1;
		$unchecked_val = 0;
		$lectura = $this->lectura;	//Tipo: General
		$usar_div_agrupar = $this->usar_div_agrupar;	//Tipo: General
		$ver_nombre_campo = $this->ver_nombre_campo;	//Tipo: General
		$con_select2 = $this->con_select2;	//Tipo: Exclusiva para select
		$act_opt_desc = $this->act_opt_desc;	//Tipo: Exclusiva para select
		
		$this->arr_deft_prop = array(
			'text'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'class'=>'',
				'type'=>'text',
				'div_group_class'=>'form-group',
			),
			'num'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'class'=>'',
				'type'=>'text',
				'div_group_class'=>'form-group',
			),
			'num_coord'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'class'=>'',
				'type'=>'text',
				'div_group_class'=>'form-group',
			),
			'email'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'class'=>'',
				'type'=>'email',
				'div_group_class'=>'form-group',
			),
			'password'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'class'=>'',
				'type'=>'password',
				'div_group_class'=>'form-group',
			),
			'date'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'class'=>'',
				'type'=>'date',
				'div_group_class'=>'form-group',
			),
			'lectura'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'type'=>'hidden',
				'div_group_class'=>'form-group',
			),
			'oculto'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'type'=>'hidden',
				'div_group_class'=>'form-group',
			),
			'textarea'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'class'=>'',
				'div_group_class'=>'form-group',
				'rows'=>3,
			),
			'select'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'con_select2'=>$con_select2,
				'act_opt_desc'=>$act_opt_desc,
				'class'=> '',
				'div_group_class'=>'form-group',
			),
			'checkbox'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'class'=>'form-check-input',
				'type'=>'checkbox',
				'div_group_class'=>'form-check',
				'lbl_class'=>'form-check-label',
				'checked_val'=>$checked_val,
				'unchecked_val'=>$unchecked_val
			),
			'lectura_chk'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'type'=>'hidden',
				'i_class_chk'=>'far fa-check-square',
				'i_class_unchk'=>'far fa-square',
				'lbl_class'=>'form-check-label',
				'checked_val'=>$checked_val,
				'unchecked_val'=>$unchecked_val
			),
			'radio'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'class'=>'form-check-input',
				'type'=>'radio',
				'div_group_class'=>'form-check',
				'lbl_class'=>'form-check-label',
			),
			'lectura_radio'=>array(
				'lectura'=>$lectura,
				'usar_div_agrupar'=>$usar_div_agrupar,
				'ver_nombre_campo'=>$ver_nombre_campo,
				'type'=>'hidden',
				'i_class_chk'=>'far fa-check-circle',
				'i_class_unchk'=>'far fa-circle',
				'lbl_class'=>'form-check-label',
			)
		);
	}
	/**
	 * A partir de un arreglo predeterminado de propiedades de tipo de campo, devuelve el arreglo de propiedades por tipo de campo
	 * @param string $cmp_tipo	Tipo de campo
	 * @return array
	 */
	private function getArrDeftPropCmpTipo(string $cmp_tipo){
		$arr_deft_prop = $this->arr_deft_prop;
		if(isset($arr_deft_prop[$cmp_tipo])){
			return $arr_deft_prop[$cmp_tipo];
		}else{
			$this->dieError("No se encontró arreglo de propiedades para el tipo de campo [".$cmp_tipo."]");
		}
	}
	/**
	 * Al declararse un campo, se definen todas sus propiedades a partir de las predeterminadas y las enviadas por argumento para así tener una lista única de propiedades de campo
	 * @param string $cmp_id_nom	Nombre/Id del campo
	 * @param array $arr_atrib_usr	Arreglo de atributos de configuración para el campo
	 * @return void
	 */
	private function defineArrCmpAtrib(string $cmp_id_nom, array $arr_atrib_usr):void {
		if(!isset($arr_atrib_usr['cmp_tipo'])){
			$this->dieError('Variable [cmp_tipo] no definida al momento de crear el campo con id: ['.$cmp_id_nom.']. Revisar la función que crea el campo.');
		}
		$cmp_tipo = $arr_atrib_usr['cmp_tipo'];
		$this->setArrDeftProp();	//Se actualiza arreglo arr_deft_prop
		$arr_deft_prop_cmp_t = $this->getArrDeftPropCmpTipo($cmp_tipo);	//Se obtiene el arreglo del tipo de campo ($cmp_tipo) a definir
		
		$arr_cmp_atrib = $this->getArrCmpAtrib($cmp_id_nom);	//Arreglo generado en el constructor
		$arr_merge_deflProp = array_merge($arr_cmp_atrib, $arr_deft_prop_cmp_t);	//Primer merge
		$arr_atrib_usr_cmp = array_merge($arr_merge_deflProp, $arr_atrib_usr);	//Segundo merge
		
		if(!isset($arr_atrib_usr_cmp['lectura'])){
			$this->dieError('Propiedad [lectura] no definida para campo id: '.$cmp_id_nom);
		}
		$lectura = $arr_atrib_usr_cmp['lectura'];
		
				
		$class = isset($arr_atrib_usr_cmp['class'])? $arr_atrib_usr_cmp['class'] :'';
		$class_adic = $class;
		if($lectura==false){
			$con_select2 = (isset($arr_atrib_usr_cmp['con_select2']))? $arr_atrib_usr_cmp['con_select2'] : false;
			if($con_select2){
				$class_adic = $class.' select2';
			}elseif($cmp_tipo=='num' && isset($arr_atrib_usr_cmp['decimales'])){
				$decimales = intval($arr_atrib_usr_cmp['decimales']);
				$class_adic = ($decimales==0)? $class.' positive text-right' : $class.' decimal-'.$decimales.'-places text-right';
			}elseif($cmp_tipo=='num_coord'){
				$class_adic = $class.' coordenadas-decimales text-right';
			}
		}elseif(isset($arr_atrib_usr_cmp['readonly']) && $arr_atrib_usr_cmp['readonly']==true){
			$arr_atrib_usr_cmp['class'] = $class.'-plaintext';
		}
		$arr_atrib_usr_cmp['class'] = $class_adic;
		
		//div_group_class
		if(isset($arr_atrib_usr_cmp['posfijo']) && $arr_atrib_usr_cmp['posfijo']!=""){
			$arr_atrib_usr_cmp['div_group_class'] = 'input-group mb-3';
		}
		//Se agrega has-error para que al dar click sobre el campo se borre el mensaje de alerta
		if($this->getAlerta($cmp_id_nom)!=""){
			$arr_atrib_usr_cmp['div_group_class'] = $arr_atrib_usr_cmp['div_group_class'].' has-error';
		}
		
		
		$this->setArrCmpAtrib($cmp_id_nom, $arr_atrib_usr_cmp);
	}
}