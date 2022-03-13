<?php
/**
 * Clase modelo ALTE3HTML
 * Genera tags HTML con atributos a partir de la plantilla AdminLTE3
 * @author Ismael Rojas
 */
class ALTE3HTML{
	private $html_contenido;
	private $arr_atrib_li_nav_item = array();
	private $arr_atrib;
	public function __construct() {
		$this->arr_atrib_li_nav_item = array(
			"class"=>"nav-item",
			"a_class"=>"nav-link"
		);
	}
	/**
	 * Genera un string con un tag HTML que contiene la lista para crear el menú horizontal derecho para ul clase navbar-nav. Clase nav-item
	 * @param string $controlador
	 * @param string $accion
	 * @param string $a_contenido
	 * @param array $arr_atrib_usu
	 */
	public function setHTMLLiNavItem($controlador, $accion, $a_contenido, $arr_atrib_usu=array()) {
		$this->setHTMLLiNavItemExt($controlador, $accion, false, array(), false, $a_contenido, $arr_atrib_usu);
	}
	/**
	 * Genera un string con un tag HTML que contiene la lista para crear el menú horizontal derecho para ul clase navbar-nav. Clase nav-item con extención de argumentos para el completo funcionamiento de la función define_controlador
	 * @param string $controlador
	 * @param string $accion
	 * @param boolean $por_js
	 * @param array $arr_url_arg
	 * @param boolean $campo_x_arg
	 * @param string $a_contenido
	 * @param array $arr_atrib_usu
	 */
	public function setHTMLLiNavItemExt($controlador, $accion, $por_js, $arr_url_arg, $campo_x_arg=false, $a_contenido, $arr_atrib_usu=array()) {
		$this->setArrAtrib($this->arr_atrib_li_nav_item, $arr_atrib_usu);
		$arr_tag = array();
		$arr_tag[] = '<li class="'.$this->getAtrib('class').'">';
		$arr_tag[] = '	<a href="'. define_controlador($controlador, $accion, $por_js, $arr_url_arg).'" class="'.$this->getAtrib('a_class').'">'.$a_contenido.'</a>';
		$arr_tag[] = '</li>';
		$this->html_contenido = tag_string($arr_tag);
	}
	/**
	 * Genera string con un tag HTML que contiene el menú para la consulta de la vista y el formulario de registros tipo catálogo
	 * @param string $cmp_id_nom	Nombre de campo Id llave de la tabla que contiene los registros de catálogo
	 * @param string $cmp_id_val	Valor del campo Id llave de la tabla que contiene los registros de catálogo
	 * @param string $controlador_actual	Nombre del controlador que actualmente se está consultando
	 * @param string $accion_actual	Nombre de la acción que actualmente se está consultado
	 * @param string $controlador_consulta	Nombre del controlador usado para la consulta de la vista de registros del catálogo
	 * @param string $accion_consulta	Nombre de la acción usada para la consulta de la vista de registros del catálogo
	 * @param string $controlador_forma	Nombre del controlador usado para la consulta del formulario del catálogo
	 * @param string $accion_forma	Nombre de la acción usada para la consulta del formulario del catálogo
	 * @param boolean $es_nuevo	Bandera que indica si el registro actual consultado es nuevo o es un registro previamente creado
	 * @param string $cat_tag_i	Nombre del ícono a desplegar para identificar el catálogo
	 * @param string $cat_tit	Título del catálogo
	 */
	public function setArrHTMLTagLiNavItemCat($cmp_id_nom, $cmp_id_val, $controlador_actual, $accion_actual, $controlador_consulta, $accion_consulta, $controlador_forma, $accion_forma, $es_nuevo, $cat_tag_i, $cat_tit) {
		$es_consulta = ($controlador_actual == $controlador_consulta && $accion_actual == $accion_consulta);
		$es_forma = ($controlador_actual == $controlador_forma && $accion_actual == $accion_forma);
		//Se activa el menú principal
		if($es_consulta || $es_forma){
			$arr_activar = array(
				'menu-open' => ' menu-open',
				'active' => ' active'
			);
		}else{
			$arr_activar = array(
				'menu-open' => '',
				'active' => ''
			);
		}
		
		//Para el nav-item Consulta
		$tag_consul = "";
		if($controlador_consulta!="" && $accion_consulta!=""){
			$a_cont_consul = '<i class="nav-icon far fa-list-alt"></i>&nbsp;<p>Consulta</p>';
			$arr_atrib_consul = ($es_consulta)? array('a_class'=>'nav-link active') : array();
			$this->setHTMLLiNavItem($controlador_consulta, $accion_consulta, $a_cont_consul, $arr_atrib_consul);
			$tag_consul = $this->getHTMLContenido();
		}
		
		
		if($es_nuevo){
			$a_cont_frm = '<i class="nav-icon fa fa-fw fa-file"></i>&nbsp;<p>Alta registro</p>';
		}else{
			$a_cont_frm = '<i class="nav-icon fa fa-fw fa-file-alt"></i>&nbsp;<p>Registro Id: '.$cmp_id_val.'</p>';
		}
		$arr_atrib_frm = ($es_forma)? array('a_class'=>'nav-link active') : array();
		$arr_url_arg = array(
			$cmp_id_nom =>$cmp_id_val
		);
		$tag_frm = "";
		if($controlador_forma!="" && $accion_forma!=""){
			$this->setHTMLLiNavItemExt($controlador_forma, $accion_forma, false, $arr_url_arg, false, $a_cont_frm, $arr_atrib_frm);
			$tag_frm = $this->getHTMLContenido();
		}
		
		$arr_tag = array();
		$arr_tag[] = '<li class="nav-item has-treeview'.$arr_activar['menu-open'].'">';
		$arr_tag[] = '	<a href="#" class="nav-link'.$arr_activar['active'].'">';
		$arr_tag[] = '		<i class="nav-icon '.$cat_tag_i.'"></i>';
		$arr_tag[] = '		<p>';
		$arr_tag[] = '			'.$cat_tit;
		$arr_tag[] = '			<i class="right fas fa-angle-left"></i>';
		$arr_tag[] = '		</p>';
		$arr_tag[] = '	</a>';
		$arr_tag[] = '	<ul class="nav nav-treeview">';
		$arr_tag[] = '		'.$tag_consul;
		$arr_tag[] = '		'.$tag_frm;
		$arr_tag[] = '	</ul>';
		$arr_tag[] = '</li>';
		$this->html_contenido = tag_string($arr_tag);
	}
	/**
	 * Genera string con un tag HTML que contiene el menú para la consulta de opciones definidas en el arreglo del argumento arr_param
	 * @param type $controlador_actual	Nombre del controlador que actualmente se está consultando
	 * @param type $accion_actual	Nombre de la acción que actualmente se está consultado
	 * @param type $arr_param	Arreglo con las opción del menú a mostrar donde el arreglo debe contener la siguiente estructura:
	 *		{"controlador":{"nombre":"Nombre controlador","titulo":"Título controlador","icono":"Icono controlador Font Awesome"},"arr_acciones":[{"nombre":"Nombre acción 1","titulo":"Título acción 1","icono":"Icono acción Font Awesome"},{"nombre":"Nombre acción 2","titulo":"Título acción 2","icono":"Icono acción Font Awesome"}]}
	 */
	public function setArrHTMLTagLiNavItem($controlador_actual, $accion_actual, $arr_param){
		$arr_controlador = valorEnArreglo($arr_param, 'controlador');
		$arr_acciones = valorEnArreglo($arr_param, 'arr_acciones');
		$controlador_nombre = valorEnArreglo($arr_controlador, 'nombre');
		$controlador_tit = valorEnArreglo($arr_controlador, 'titulo');
		$controlador_ico = valorEnArreglo($arr_controlador, 'icono');
		
		//Busca si en el arr_acciones de arr_param tiene una acción igual a la acción actual (accion_actual)
		$hay_accion_activa = $this->tiene_valor_sub_arreglo($arr_acciones, 'nombre', $accion_actual);
		
		$es_consulta = ($controlador_actual == $controlador_nombre && $hay_accion_activa);
		//Se activa el menú principal
		if($es_consulta){
			$arr_activar = array(
				'menu-open' => ' menu-open',
				'active' => ' active'
			);
		}else{
			$arr_activar = array(
				'menu-open' => '',
				'active' => ''
			);
		}
		
		$arr_tag_consul = array();
		foreach($arr_acciones as $arr_accion){
			if($controlador_nombre!=""){
				$accion_nom = valorEnArreglo($arr_accion, 'nombre');
				$accion_ico = valorEnArreglo($arr_accion, 'icono');
				$accion_tit = valorEnArreglo($arr_accion, 'titulo');
				$a_cont_consul = '<i class="nav-icon '.$accion_ico.'"></i>&nbsp;<p>'.$accion_tit.'</p>';
				$arr_atrib_consul = ($es_consulta && $accion_nom == $accion_actual)? array('a_class'=>'nav-link active') : array();
				$this->setHTMLLiNavItem($controlador_nombre, $accion_nom, $a_cont_consul, $arr_atrib_consul);
				$arr_tag_consul[] = $this->getHTMLContenido();
			}
		}
		$tag_consul = tag_string($arr_tag_consul);
		
		$arr_tag = array();
		$arr_tag[] = '<li class="nav-item has-treeview'.$arr_activar['menu-open'].'">';
		$arr_tag[] = '	<a href="#" class="nav-link'.$arr_activar['active'].'">';
		$arr_tag[] = '		<i class="nav-icon '.$controlador_ico.'"></i>';
		$arr_tag[] = '		<p>';
		$arr_tag[] = '			'.$controlador_tit;
		$arr_tag[] = '			<i class="right fas fa-angle-left"></i>';
		$arr_tag[] = '		</p>';
		$arr_tag[] = '	</a>';
		$arr_tag[] = '	<ul class="nav nav-treeview">';
		$arr_tag[] = '		'.$tag_consul;
		$arr_tag[] = '	</ul>';
		$arr_tag[] = '</li>';
		$this->html_contenido = tag_string($arr_tag);
	}
	
	
	/**
	 * Devuelve la estructura HTML con el vínculo de contenido desplegable
	 * @param string $tag_id	Id único de tag
	 * @param string $titulo	Título del vínculo que despliega el texto informativo
	 * @param string $txt_contenido	Texto informativo a desplegar
	 */
	public function setHTMLInfoLinkCollapse($tag_id, $titulo, $txt_contenido) {
		$arr_tag = array();
		$arr_tag[] = '<p>';
		$arr_tag[] = '	<a data-toggle="collapse" href="#'.$tag_id.'" role="button" aria-expanded="false" aria-controls="'.$tag_id.'">';
		$arr_tag[] = '		<i class="fa fa-fw fa-info"></i> '.$titulo;
		$arr_tag[] = '	</a>';
		$arr_tag[] = '</p>';
		$arr_tag[] = '<div class="collapse" id="'.$tag_id.'">';
		$arr_tag[] = '	<div class="card card-body">';
		$arr_tag[] = '	'.$txt_contenido;
		$arr_tag[] = '	</div>';
		$arr_tag[] = '</div>';
		$this->html_contenido = tag_string($arr_tag);
	}
	/**
	 * Devuelve el string que contiene el tag HTML generado en la función Set definida previamente
	 * @return string
	 */
	public function getHTMLContenido() {
		return $this->html_contenido;
	}
	/**
	 * Genera el arreglo 'arr_atrib' que contiene los atributos para los elementos HTML que se generan 
	 * @param array $arr_atrib_default	Arreglo de atributos por default, declarados en la clase constructor
	 * @param array $arr_atrib_usu	Arreglo de atributos definidos al crear el elemento HTML
	 */
	private function setArrAtrib($arr_atrib_default, $arr_atrib_usu){
		$this->arr_atrib = array_merge($arr_atrib_default,$arr_atrib_usu);
	}
	/**
	 * Devuelve el valor del atributo especificado en el argumento
	 * @param string $nom_atrib	Nombre del atributo que se desea obtener su valor
	 * @return string
	 */
	private function getAtrib($nom_atrib) {
		$arr_atrib = $this->arr_atrib;
		if(isset($arr_atrib[$nom_atrib])){
			return $arr_atrib[$nom_atrib];
		}else{
			return "";
		}
	}
	public function setHTMLAdjuntoBtn($adjunto_id) {
		$arr_tag = array();
		$adjunto = new Adjunto();
		$adjunto->setArrReg($adjunto_id, " AND `borrar` IS NULL ");
		$arr_adjunto = $adjunto->getArrReg();
		if(!empty($arr_adjunto)){
			$nom_arc_real = valorEnArreglo($arr_adjunto, 'nom_arc_real');
			$arr_tag[] = '<input type="hidden" id="prod_geo_adjunto_id" name="prod_geo_adjunto_id" value="'.$adjunto_id.'">';
			$arr_tag[] = '<div class="row">';
			$arr_tag[] = '	<div class="col-md-4">';
			$arr_tag[] = '		<a href="'.define_controlador('adjunto', 'descargar', false, array('adjunto_id'=>$adjunto_id)).'">';
			$arr_tag[] = '			'.$nom_arc_real;
			$arr_tag[] = '		</a>';
			$arr_tag[] = '		<button id="btn_borrar_adj" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Borrar</button>';
			$arr_tag[] = '	</div>';
			$arr_tag[] = '</div>';
		}else{
			$arr_tag[] = '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#mdl_adjuntar">Adjuntar archivo...</button>';
			$arr_tag[] = '<p class="small">En caso de ser varios archivos, favor de hacer un archivo comprimido con todos ellos.</p>';
		}
		$this->html_contenido = tag_string($arr_tag);
	}
	/**
	 * Define la estructura HTML para mostrar el botón de borrar registro
	 * @param type $controlador_borrar	Controlador a ejecutar para borrar el registro
	 * @param type $accion_borrar		Acción a ejecutar para borrar el registro
	 * @param type $controlador_actual	Nombre del controlador actual donde se está ejecutando
	 * @param type $accion_actual		Nombre de la acción actual donde se está ejecutando
	 * @param type $cmp_id_nom			Nombre del campo Id del registro
	 * @param type $cmp_id_val			Valor del campo Id del registro
	 */
	public function setHTMLBtnBorrar($controlador_borrar, $accion_borrar, $controlador_actual, $accion_actual, $cmp_id_nom, $cmp_id_val) {
		$arr_cmps_ocultos = array(
			"controlador_fuente"=>$controlador_actual,
			"accion_fuente"=>$accion_actual,
			$cmp_id_nom=>$cmp_id_val
		);
		$this->setHTMLBtnBorrarReg($controlador_borrar, $accion_borrar, $arr_cmps_ocultos);
	}
	/**
	 * Define la estructura HTML para mostrar el botón de borrar registro, versión para mandar en un arreglo los campos ocultos
	 * @param type $controlador_borrar	Controlador a ejecutar para borrar el registro
	 * @param type $accion_borrar		Acción a ejecutar para borrar el registro
	 * @param type $arr_cmps_ocultos	Arreglo con los campos ocultos requeridos en la acción de borrar
	 */
	public function setHTMLBtnBorrarReg($controlador_borrar, $accion_borrar, $arr_cmps_ocultos) {
		
		$arr_tag_cmps_ocultos = array();
		foreach($arr_cmps_ocultos as $cmp_nom => $cmp_val){
			$arr_tag_cmps_ocultos[] = '<input type="hidden" name="'.$cmp_nom.'" value="'.$cmp_val.'">';
		}
		$tag_cmps_ocultos = tag_string($arr_tag_cmps_ocultos);
		
		$arr_tag = array();
		$arr_tag[] = '<form class="d-inline frm_borrar" action="'.define_controlador($controlador_borrar, $accion_borrar).'" method="post">';
		$arr_tag[] = '	'.$tag_cmps_ocultos;
		$arr_tag[] = '	<button type="submit" class="btn btn-danger btn-sm btn_borrar"><i class="fas fa-trash-alt"></i> Borrar</button>';
		$arr_tag[] = '</form>';
		$this->html_contenido = tag_string($arr_tag);
	}
	
	/**
	 * En un arreglo sin indices con sub-arreglos con misma estructura, busca a partir de la llave indicada en el argumento, si alguno de esos sub-arreglos tienen el valor indicado en el argumento
	 * @param type $arreglo	Arreglo sin índices que contiene los sub-arreglos
	 * @param type $llave	Nombre de la llave a buscar en el sub-arreglo
	 * @param type $valor	Valor a buscar en la llave
	 * @return boolean
	 */
	private function tiene_valor_sub_arreglo($arreglo, $llave, $valor){
		$tiene_valor = false;
		foreach($arreglo as $sub_arreglo){
			if(valorEnArreglo($sub_arreglo, $llave) == $valor){
				$tiene_valor = true;
				break;
			}
		}
		return true;
	}
}
