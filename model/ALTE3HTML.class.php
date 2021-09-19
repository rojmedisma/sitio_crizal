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
		$a_cont_consul = '<i class="nav-icon far fa-list-alt"></i>&nbsp;<p>Consulta</p>';
		$arr_atrib_consul = ($es_consulta)? array('a_class'=>'nav-link active') : array();
		$this->setHTMLLiNavItem($controlador_consulta, $accion_consulta, $a_cont_consul, $arr_atrib_consul);
		$tag_consul = $this->getHTMLContenido();
		
		if($es_nuevo){
			$a_cont_frm = '<i class="nav-icon fa fa-fw fa-file"></i>&nbsp;<p>Alta registro</p>';
		}else{
			$a_cont_frm = '<i class="nav-icon fa fa-fw fa-file-alt"></i>&nbsp;<p>Registro Id: '.$cmp_id_val.'</p>';
		}
		$arr_atrib_frm = ($es_forma)? array('a_class'=>'nav-link active') : array();
		$arr_url_arg = array(
			$cmp_id_nom =>$cmp_id_val
		);
		$this->setHTMLLiNavItemExt($controlador_forma, $accion_forma, false, $arr_url_arg, false, $a_cont_frm, $arr_atrib_frm);
		$tag_frm = $this->getHTMLContenido();
		
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
			$arr_tag[] = '<p class="small">Por cuestiones de seguridad, sólo se permite adjuntar un archivo de tipo texto o imagen que no supere los 2 Mb.</p>';
		}
		$this->html_contenido = tag_string($arr_tag);
	}
}
