<?php
/**
 * Controlador CuestformaControl
 * Contiene toda la funcionalidad para la consulta de formulario de cuestionarios
 *
 * @author Ismael Rojas
 */
class CuestformaControl extends CuestBase{
	private $cuestionario_id;
	private $cat_cuest_modulo_id;
	private $es_aprobado = false;
	private array $arr_reglas_val = array();
	public object $frm_al3;
	private array $arr_modulos;
	private $para_dflt_es_habilitado = true;	//Bandera con el valor predeterminado que va a indicar si mostrar o no las opciones de navegación de cada módulo, previo a los valores asignados con los parametros json p_es_mod_N_habilitad
	private object $cuestionario;
	private $permite_ver_reg_cuest = false;
	private array $arr_cmp_llave_val;
	private string $cc_modulo_desc = "";
	private $arr_json_param = array();
	private $estatus_cuest = 0;
	private $modulo_es_ultimo;
	/**
	 * Constructor para el controlador CuestFormaControl
	 */
	public function __construct() {
		parent::__construct();
		$this->cuestionario_id = (isset($_REQUEST['cuestionario_id']))? $_REQUEST['cuestionario_id'] : "";
		$this->cat_cuest_modulo_id = $this->defineCatCuestModuloId();
		$this->cuestionario = new Cuestionario($this->getCatCuestionarioId());
	}
	/**
	 * Acción para redireccionar al cuestionario en la sección/módulo definida con los argumentos de identificación (cat_cuestionario_id, cuestionario_id, cat_cuest_modulo_id)
	 */
	public function inicio() {
		
		$this->setPaginaDistintivos();
		$this->setUsarLibForma(true);
		$this->defineVista("Tablero.php");
		
		if(!$this->cuestionario_id){
			$this->cuestionario_id = $this->nuevo();
		}
		$this->arr_cmps_frm = $this->defineArrCmpsForm();
		
		$this->setEsNuevo();	//Se asigna valor a la variable es_nuevo declarada en ControladorBase
		$this->es_aprobado = (intval($this->getCampoValor('estatus_cuest'))===7)? true:false;
		$this->setPermiteVerRegCuest();
		if(!$this->permite_ver_reg_cuest){
			$this->redireccionaError("Se negó el acceso al registro actual", "El usuario (<strong>".$this->usuario_dato('usuario')."</strong>) no cuenta con los permisos para consultar el registro con Id: <strong>".$this->cuestionario_id."</strong>");
		}
		
		$this->arr_modulos = $this->defineArrModulos();
		$this->setModuloEsUltimo();
		//Si el módulo actual está activo, se genera arreglo de validaciones
		$arr_validaciones = array();
		if(isset($this->arr_modulos[$this->cat_cuest_modulo_id]['es_activo']) && intval($this->arr_modulos[$this->cat_cuest_modulo_id]['es_activo']) === 1){
			$arr_validaciones = $this->defineArrValidaciones();	//Se define la Clase de validación que corresponde al cuestionario actual
			
		}
		
		$this->frm_al3 =new FormularioALTE3($this->arr_cmps_frm);
		//$this->frm_al3->setVerNombreCampo(true);
		$this->frm_al3->asignaValidaciones(arregloEnArreglo($arr_validaciones, 'detalle'));
		
		$this->accionesPorModulo();
		
		$this->setArrHTMLTagLiNavItemCuestFrm();
		parent::setArrHTMLTagLiNavItem();	//Se crean los items del tablero
	}
	/**
	 * Funcionalidad guardar para la sección actual de cuestionario
	 */
	public function actualizar() {
		
		$ccm_siguiente = (isset($_REQUEST['ccm_siguiente']))? intval($_REQUEST['ccm_siguiente']) : 0;
		if(!$this->permiteGuardar()){
			$this->redireccionaErrorAccion('sin_permisos', array("tit_accion"=>"Guardar"));
		}
		$cat_cuest_modulo = new CatCuestModulo($this->getCatCuestionarioId());
		$cat_cuest_modulo->setArrCmpListaTablas($this->cat_cuest_modulo_id);
		$arr_lista_tablas = $cat_cuest_modulo->getArrCmpListaTablas();	//Arreglo con la lista de tablas pertenecientes al módulo actual
		$this->cc_modulo_desc = $cat_cuest_modulo->getValCmpReg('descripcion');
		
		
		if(empty($arr_lista_tablas)){
			$this->redireccionaErrorAccion("valor_de_campo_vacio", array("tbl_nom"=>"cat_cuest_modulo", "cmp_nom"=>"lista_tablas"));
		}
		$bd = new BaseDatos();
		//Se define el arreglo de tablas - campos a actualizar correspondientes al formulario actual
		$arr_cmps = array();
		$arr_cmps_mod_act = array();	//Arreglo de campos del módulo actual
		foreach ($arr_lista_tablas as $tabla){
			$arr_cmps_cu = $bd->getArrCmpsTbl($tabla);
			foreach ($arr_cmps_cu as $arr_cmps_cu_det){
				$cmp_nom = $arr_cmps_cu_det['Field'];
				switch($cmp_nom){
					case 'cuestionario_id':
						break;
					default:
						$arr_cmps[$tabla][$cmp_nom] = (isset($_REQUEST[$cmp_nom]))? txt_sql($_REQUEST[$cmp_nom]) : "NULL";
						$arr_cmps_mod_act[$cmp_nom] = (isset($_REQUEST[$cmp_nom]))? $_REQUEST[$cmp_nom] : "";
						break;
				}
			}
		}
		//Se actulizan las tablas con los campos pertenecientes al formulario actual
		if(!$this->cuestionario->actualizaFrmCuest($arr_cmps, $this->cuestionario_id)){
			$this->redireccionaErrorDeArr($this->cuestionario->getArr1erError(), true);
		}
		//Se actualiza la tabla c00
		$this->cuestionario->setArrQryTblC00($this->cuestionario_id);
		$this->cuestionario->c00AgregaParamJSON('json_parametros', $this->getNomLlaveEsModActivo($this->cat_cuest_modulo_id), 1);
		$this->modulosHabilitar($arr_cmps_mod_act);
		$this->parametroValidacionesGuardar();
		$this->arr_json_param = $this->cuestionario->getArrJsonParam();
		$this->arr_modulos = $this->defineArrModulos();
		$this->defineSituacionCuest();
		$this->cuestionario->c00AgregaRegQry('estatus_cuest', $this->estatus_cuest);
		$this->cuestionario->c00AgregaRegQry('estatus_cuest_desc', $this->getEstatusDesc($this->estatus_cuest));
		if(!$this->cuestionario->actualizaTblC00($this->cuestionario_id)){
			$this->redireccionaErrorDeArr($this->cuestionario->getArr1erError(), true);
		}
		
		
		
		
		//Se define el cat_cuest_modulo_id dependiendo si dieron guardar o guardar siguiente
		$cat_cuest_modulo_id_sig = ($ccm_siguiente)? $this->defineSiguienteCatCuestModuloId() : $this->cat_cuest_modulo_id;
		
		$this->setSesionArrToastrAlerta('success', 'El módulo <strong>'.$this->cc_modulo_desc.'</strong> ha sido guardado exitosamente.');
		
		redireccionar('cuestforma','inicio', $this->getArrRedirecForma($cat_cuest_modulo_id_sig));
	}
	/**
	 * Devuelve el cat_cuest_modulo_id siguiente a partir del cat_cuest_modulo_id actual, considerando que este se encuentre habilitado (es_habilitado=1 en el arreglo de modulos)
	 * @return int
	 */
	private function defineSiguienteCatCuestModuloId() {
		foreach($this->arr_modulos as $cat_cuest_modulo_id=>$arr_det_modulos){
			if($cat_cuest_modulo_id>$this->cat_cuest_modulo_id && valorEnArreglo($arr_det_modulos, 'es_habilitado')){
				return $cat_cuest_modulo_id;
			}
		}
		return $this->cat_cuest_modulo_id;		
	}
	
	/**
	 * Devuelve la ruta donde se encuentra el archivo que contiene la forma de cuestionario actual. Se usa dentro de un include_once en la vista view/ALTE3/modulos/Cuest/Forma.php
	 * @return string
	 */
	public function getSubRutaVista() {
		$carpeta = "C".str_pad($this->getCatCuestionarioId(), 2, "0", STR_PAD_LEFT);
		$archivo = "Modulo".str_pad($this->cat_cuest_modulo_id, 2, "0", STR_PAD_LEFT).".php";
		return $carpeta."/".$archivo;
	}
	/**
	 * Devuelve la estructura HTML  de una lista de campos ocultos con la información obtenida en el controldador base CuestBase
	 * Sirve para poder ser enviada mediante un formulario a otro controlador y tener esos datos
	 */
	public function getHTMLCamposOcultosCuest(){
		$arr_tag = array();
		$arr_tag[] = '<input type="hidden" name="cat_cuestionario_id" value="'.$this->getCatCuestionarioId().'">';
		$arr_tag[] = '<input type="hidden" name="cat_cuest_modulo_id" value="'.$this->cat_cuest_modulo_id.'">';
		$arr_tag[] = '<input type="hidden" name="cuestionario_id" value="'.$this->cuestionario_id.'">';
		$arr_tag[] = '<input type="hidden" name="ccm_siguiente" value="">';
		
		return tag_string($arr_tag);
	}
	
	/**
	 * Devuelve la estructura HTML con el vínculo de contenido desplegable para mostrar el contenido del campo "definicion" de la tabla "cat_cuestionario" del cuestionario actual.
	 * @return string
	 */
	public function getHTMLIntroduccion() {
		return $this->getHTMLInfoLink('cuest_intro', 'Introducción', $this->getDatoVistaValor('cc_definicion'));
	}
	/**
	 * Devuelve la estructura HTML con el vínculo de contenido desplegable
	 * @param string $tag_id	Id único de tag
	 * @param string $titulo	Título del vínculo que despliega el texto informativo
	 * @param string $txt_contenido	Texto informativo a desplegar
	 * @return string
	 */
	public function getHTMLInfoLink($tag_id, $titulo, $txt_contenido) {
		$alte3_html = new ALTE3HTML();
		$alte3_html->setHTMLInfoLinkCollapse($tag_id, $titulo, $txt_contenido);
		return $alte3_html->getHTMLContenido();
	}
	/**
	 * Devuelve la estructura HTML con los botones del formulario del cuestionario
	 * @return string
	 */
	public function getHTMLBotonesMenu() {
		$arr_tag = array();
		$arr_tag[] = $this->getHTMLBtnMasOpc();
		$arr_tag[] = $this->getHTMLBtnGuardar();
		return tag_string($arr_tag);
	}
	/**
	 * Devuelve la estructura HTML con los botones para guardar el cuestionario
	 * @return string
	 */
	private function getHTMLBtnGuardar() {
		if($this->permiteGuardar()){
			$arr_modulos = $this->arr_modulos;
			
			$tag_btn_siguiente = '';
			if(isset($arr_modulos[$this->cat_cuest_modulo_id]['es_ultimo']) && $arr_modulos[$this->cat_cuest_modulo_id]['es_ultimo'] === false){
				$tag_btn_siguiente = '<button type="button" class="btn btn-info btn_guardar_sig"><i class="fas fa-save"></i> Guardar y siguiente <i class="fas fa-arrow-right"></i></button>';
			}
			
			$arr_tag = array();
			$arr_tag[] = '<div class="btn-group float-right">';
			$arr_tag[] = '	<button type="button" class="btn btn-info btn_guardar"><i class="fas fa-save"></i> Guardar</button>';
			$arr_tag[] = '	'.$tag_btn_siguiente;
			$arr_tag[] = '</div>';
			return tag_string($arr_tag);
		}else{
			return '';
		}
	}
	/**
	 * Imprime la declaración de la ruta hacia el archivo script perteneciente al módulo actual, además de activar la función correspondiente.
	 * @return string
	 */
	public function getHTMLScriptCuest() {
		
		$modulo_cve = ucfirst(modulo_cve($this->cat_cuest_modulo_id));
		$src = 'assets/js/'.ucfirst(cuest_cve($this->getCatCuestionarioId())).'/'.$modulo_cve.'.js';
		if(is_file($src)){
			$arr_tag = array();
			$arr_tag[] = '<script src="'.$src.'"></script>';
			$arr_tag[] = '<script type="text/javascript">';
			$arr_tag[] = '	try{';
			$arr_tag[] = '		Modulo.activar();';
			$arr_tag[] = '	}catch(err){';
			$arr_tag[] = '		if(err.message=="Modulo is not defined")';
			$arr_tag[] = '			alert(err.message+". \nRevisar que el archivo: '.$src.' contenga la función: Modulo.\nFavor de notificar al administrador del sistema. Gracias!");';
			$arr_tag[] = '		else';
			$arr_tag[] = '			alert(err);';
			$arr_tag[] = '	}';
			$arr_tag[] = '';
			$arr_tag[] = '</script>';
			return tag_string($arr_tag);
		}else{
			return '<!-- AVISO: Para ejecutar el código referente a éste módulo, es necesario crearlo en el archivo: '.$src.'  -->';
		}
	}
	/**
	 * Devuelve la estructura HTML con el cuadro que contiene la lista de alertas pendientes a resolver en la sección actual
	 * @return string
	 */
	public function getHTMLValidacionesLista() {
		$arr_modulos = $this->arr_modulos;
		if(!isset($arr_modulos[$this->cat_cuest_modulo_id]['arr_validaciones'])){
			return '';
		}
		$arr_validaciones = $arr_modulos[$this->cat_cuest_modulo_id]['arr_validaciones'];
		if(empty($arr_validaciones)){
			return '';
		}
		$arr_tag = array();
		if(isset($arr_validaciones['detalle']) && isset($arr_validaciones['total']) && intval($arr_validaciones['total'])>0 ){
			$arr_tag_alerta[] = '<ul>';
			foreach($arr_validaciones['detalle'] as $llave_cmp => $arr_val_det){
				$alerta = '';
				$alerta .= (isset($arr_val_det->tit_preg))? $arr_val_det->tit_preg.' ' : '';
				$alerta .= (isset($arr_val_det->alerta))? $arr_val_det->alerta : '';
				
				$arr_tag_alerta[] = '<li>';
				$arr_tag_alerta[] = ' <a href="#'.$llave_cmp.'">';
				$arr_tag_alerta[] = ' 	'.$alerta;
				$arr_tag_alerta[] = ' </a>';
				$arr_tag_alerta[] = '</li>';
			}
			$arr_tag_alerta[] = '</ul>';
			$tag_alerta = tag_string($arr_tag_alerta);
			
			$arr_tag[] = '<div class="row">';
			$arr_tag[] = '	<div class="col-md-12">';
			$arr_tag[] = '		<div class="callout callout-warning">';
			$arr_tag[] = '			<h5>Mensajes de validación a atender</h5>';
			$arr_tag[] = '			'.$tag_alerta;
			$arr_tag[] = '		</div>';
			$arr_tag[] = '	</div>';
			$arr_tag[] = '</div>';
		}
		
		return tag_string($arr_tag);
	}
	public function getHTMLAdjunto() {
		$prod_geo_adjunto_id = intval($this->getCampoValor('prod_geo_adjunto_id'));
		$alte3_html = new ALTE3HTML();
		$alte3_html->setHTMLAdjuntoBtn($prod_geo_adjunto_id);
		return $alte3_html->getHTMLContenido();
	}
	/**
	 * Devuelve en modo de string el arreglo arr_modulos
	 * @return string
	 */
	public function imprimeArrModulos() {
		return json_encode($this->arr_modulos);
	}
	/**
	 * Devuelve la estructura HTML con el botón desplegable Más opciones
	 * @return string
	 */
	private function getHTMLBtnMasOpc() {
		$mostrar_mas_opc = false;
		$tab_btn_ver_cmps = '';
		$tab_btn_aprob = '';
		if($this->tienePermiso("ver-cmp-nom")){
			$mostrar_mas_opc = true;
			$tab_btn_ver_cmps = '<a class="dropdown-item" href="javaScript:Forma.verNombreCampo()"><i class="fas fa-eye-slash"></i> Ver/Ocultar nombre de campos</a>';
		}
		$estatus_cuest = intval($this->getCampoValor('estatus_cuest'));
		if($this->tienePermiso("aprobar") && intval($estatus_cuest)===6){
			$mostrar_mas_opc = true;
			$arr_url_arg = array('cat_cuestionario_id'=>$this->getCatCuestionarioId(), 'cuestionario_id'=>$this->cuestionario_id);
			$tab_btn_aprob = '<a class="dropdown-item" href="'. define_controlador('cuestcat', 'aprobar', false, $arr_url_arg).'"><i class="fas fa-check"></i> Aprobar cuestionario</a>';
		}
		
		if($mostrar_mas_opc){
			$arr_tag = array();
			$arr_tag[] = '<div class="dropdown dropleft float-right pl-1">';
			$arr_tag[] = '	<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">';
			$arr_tag[] = '		Más opciones...';
			$arr_tag[] = '	</button>';
			$arr_tag[] = '	<div class="dropdown-menu">';
			$arr_tag[] = '		'.$tab_btn_aprob;
			$arr_tag[] = '		'.$tab_btn_ver_cmps;
			$arr_tag[] = '	</div>';
			$arr_tag[] = '</div>';
			return tag_string($arr_tag);
		}else{
			return '';
		}
	}
	/**
	 * Al ejecutare la alta de un cuestionario, antes de desplegarse el formulario, se genera los registros necesarios en las tablas de cuestionarios
	 * @return int
	 */
	private function nuevo() {
		$cat_usuario_id_rq = (isset($_REQUEST['cat_usuario_id']))? intval($_REQUEST['cat_usuario_id']) : 0;
		$cat_usuario_id = ($cat_usuario_id_rq)? $cat_usuario_id_rq: $this->usuario_dato('cat_usuario_id');
		
		if(!$cat_usuario_id){
			$this->redireccionaError("Cuestionario sin usuario asignado", "No se pudo crear el cuestionario debido a que no se asignó el usuario responsable para su captura");
		}
		
		if(!$this->tienePermiso("nuevo_cuest") || !$this->tienePermiso("escritura")){
			$this->redireccionaErrorAccion('sin_permisos', array('tit_accion'=>'Cuest. - Edición y Cuest. - Nuevo'));
		}
		//Se crea el cuestionario en modo inhabilitado
		$cuetionario = new Cuestionario($this->getCatCuestionarioId());
		return $cuetionario->crearCuest($cat_usuario_id);	//Devuelve el cuestionario_id
	}
	/**
	 * Devuelve el arreglo con el contenido de todos los campos de todas la tablas de que conforman el registro de cuestionario actual
	 * @return array
	 */
	private function defineArrCmpsForm(){
		$this->cuestionario->setArrRegCuestionario($this->cuestionario_id, false, false);
		return $this->cuestionario->getArrRegCuestionario();
	}
	/**
	 * Se asigna valor a la variable es_nuevo declarada en ControladorBase
	 * Con esto, se identifica si el registro actual es un registro nuevo, que no ha sido guardado por el usuario.
	 */
	private function setEsNuevo(){
		$inhabilitar = intval($this->getCampoValor('inhabilitar'));
		//Para identificar un registro nuevo, en los cuestinarios es a partir del campo inhabilitar, debido a que el registro puede ser creado en la tabla previamente antes de ser usado
		$this->es_nuevo = ($inhabilitar)? true : false;
	}
	/**
	 * Define el arreglo de detalle respecto a los modulos
	 * Hasta el momento, este método es llamado por dos acciones: "inicio" y "actualizar".
	 * En "inicio" los campos JSON se obtienen directo de la tabla "c00". 
	 * En "actualizar", los campos JSON se obtienen del campo "arr_json_param", previamente definido.
	 * @return boolean
	 */
	private function defineArrModulos(){
		$cmp_json_param = new CampoJSON('json_parametros');
		if(isset($this->arr_json_param['json_parametros'])){
			$cmp_json_param->setJSONPredefinido($this->arr_json_param['json_parametros']);
		}else{
			$cmp_json_param->setJSONCampo($this->cuestionario_id);
		}
		$cmo_json_valida = new CampoJSON("json_validaciones");
		if(isset($this->arr_json_param['json_validaciones'])){
			$cmo_json_valida->setJSONPredefinido($this->arr_json_param['json_validaciones']);
		}else{
			$cmo_json_valida->setJSONCampo($this->cuestionario_id);
		}
		
		$arr_json_validaciones = $cmo_json_valida->getJSONCampo();
		
		
		
		
		$cat_cuest_modulo = new CatCuestModulo($this->getCatCuestionarioId());
		$cat_cuest_modulo->setArrTblCat(" ORDER BY `cat_cuest_modulo`.`orden` ASC ");
		$arr_cat_cuest_modulo = $cat_cuest_modulo->getArrTbl();
		$arr_modulos = array();
		$arr_ccm_id_habilitados = array();	//Arreglo que va a contener solo los cat_cuest_modulo_id habilitados
		foreach($arr_cat_cuest_modulo as $cat_cuest_modulo_id => $arr_det){
			//Se obtiene el arreglo de validaciones
			$ccm_id = "ccm_id_".$cat_cuest_modulo_id;
			$arr_validaciones = (isset($arr_json_validaciones->$ccm_id))? (array) $arr_json_validaciones->$ccm_id : array();
			
			$es_habilitado = $this->defineEsHabilitado($cat_cuest_modulo_id, $cmp_json_param->getValor($this->getNomLlaveEsModHabilitado($cat_cuest_modulo_id)));
			
			$arr_modulos[$cat_cuest_modulo_id] = array_merge($arr_det, array(
				"es_activo"=>$cmp_json_param->getValor($this->getNomLlaveEsModActivo($cat_cuest_modulo_id)),
				"arr_validaciones"=>$arr_validaciones,
				"es_ultimo"=>false,
				"es_habilitado"=>$es_habilitado,
			));
			if($es_habilitado){
				$arr_ccm_id_habilitados[] = $cat_cuest_modulo_id;
			}
		}
		//Se obtiene el último cat_cuest_modulo_id habilitado
		$ultimo_ccm_id = (count($arr_ccm_id_habilitados))? array_pop($arr_ccm_id_habilitados) : 1;
		$arr_modulos[$ultimo_ccm_id]["es_ultimo"] = true;	//Se marca el último módulo
		
		return $arr_modulos;
	}
	/**
	 * Se define el valor de la variable es_habilitado para el arreglo de modulo
	 * @param int $cat_cuest_modulo_id	Id del registro de modulo
	 * @param int $es_habilitado_val	Bandera con el valor propuesto para asignar
	 * @return int
	 */
	private function defineEsHabilitado($cat_cuest_modulo_id, $es_habilitado_val){
		if($cat_cuest_modulo_id==1){
			$es_habilitado = 1;
		}else{
			$es_habilitado = ($es_habilitado_val==="" || $es_habilitado_val===null)? $this->para_dflt_es_habilitado : $es_habilitado_val;
		}
		return $es_habilitado;
	}
	/**
	 * Genera la estructura HTML con las opciones de navegación entre los distintos módulos del cuestionario
	 */
	private function setArrHTMLTagLiNavItemCuestFrm(){
		$alte3_html = new ALTE3HTML();
		
		//Se crean las entradas de navegación por módulo
		$arr_tag_li_nav_item = array();
		foreach($this->arr_modulos as $arr_det_ccm){
			//Se crea entrada de módulo sólo si se encuentra habilitado
			if(valorEnArreglo($arr_det_ccm, "es_habilitado")){
				$arr_url_arg = array(
					"cat_cuestionario_id"=>$this->getCatCuestionarioId(),
					"cat_cuest_modulo_id"=>$arr_det_ccm['cat_cuest_modulo_id'],
					"cuestionario_id"=>$this->cuestionario_id,
				);
				$tag_info = '';
				if(!valorEnArreglo($arr_det_ccm, "es_activo")){
					$tag_info = '<span class="badge badge-info right">Nuevo</span>';
				}else{
					$arr_validaciones = valorEnArreglo($arr_det_ccm, "arr_validaciones");
					if(isset($arr_validaciones["total"]) && $arr_validaciones["total"]){
						$tag_info = '<span class="badge badge-danger right">'.$arr_validaciones["total"].'</span>';
					}
				}

				$a_contenido = '&nbsp;<i class="far fa-circle nav-icon"></i><p>'.$arr_det_ccm['tit_corto'].$tag_info.'</p>';
				$arr_atrib_usu = ($this->cat_cuest_modulo_id == $arr_det_ccm['cat_cuest_modulo_id'])? array('a_class'=>'nav-link active') : array();
				$alte3_html->setHTMLLiNavItemExt("cuestforma", "inicio", false, $arr_url_arg, false, $a_contenido, $arr_atrib_usu);
				$arr_tag_li_nav_item[] = $alte3_html->getHTMLContenido();
			}
		}
		$tag_li_nav_item = tag_string($arr_tag_li_nav_item);
		
		if($this->es_nuevo){
			$reg_tit_i = 'nav-icon fa fa-fw fa-file';
			$reg_tit_p = 'Nuevo registro';
		}else{
			$reg_tit_i = 'nav-icon fa fa-fw fa-file-alt';
			$reg_tit_p = 'Registro Id: '.$this->cuestionario_id;
		}
		$arr_li_nav_item[] = '<li class="nav-item has-treeview menu-open">';
		$arr_li_nav_item[] = '	<a href="#" class="nav-link active">';
		$arr_li_nav_item[] = '		<i class="'.$reg_tit_i.'"></i>';
		$arr_li_nav_item[] = '		<p>';
		$arr_li_nav_item[] = '			'.$reg_tit_p;
		$arr_li_nav_item[] = '			<i class="right fas fa-angle-left"></i>';
		$arr_li_nav_item[] = '		</p>';
		$arr_li_nav_item[] = '	</a>';
		$arr_li_nav_item[] = '	<ul class="nav nav-treeview">';
		$arr_li_nav_item[] = '		'.$tag_li_nav_item;
		$arr_li_nav_item[] = '	</ul>';
		$arr_li_nav_item[] = '</li>';
		$this->arr_html_tag['li_ni_sb_frm'] = $arr_li_nav_item;
	}
	/**
	 * Define el valor cat_cuest_modulo_id a desplegar a partir de cat_cuest_modulo_id, de no existir dicha variable, se usa el primer módulo
	 * @return int
	 */
	private function defineCatCuestModuloId() {
		$cat_cuest_modulo_id = (isset($_REQUEST['cat_cuest_modulo_id']))? $_REQUEST['cat_cuest_modulo_id'] : 0;
		if(!$cat_cuest_modulo_id){
			//Se busca el primer registro en la tabla cat_cuest_modulo para identificar el primer id cat_cuest_modulo_id
			$cat_cuest_modulo = new CatCuestModulo($this->getCatCuestionarioId());
			$cat_cuest_modulo->setCatCuestModuloIdIni();
			$cat_cuest_modulo_id = $cat_cuest_modulo->getCatCuestModuloId();
		}
		if(!$cat_cuest_modulo_id){
			$this->redireccionaError("Dato cat_cuest_modulo_id no identificado", "No se pudo identificar el valor cat_cuest_modulo_id", true);
		}
		return $cat_cuest_modulo_id;
	}
	/**
	 * Se identfica el nombre de la Clase modelo de validaciones para cuestionario, esto a partir de cat_cuestionario_id, si esa clase existe, se declara y se obtiene el arreglo de validaciones respectivo
	 * @return array
	 */
	private function defineArrValidaciones(){
		if(!$this->ejecuta_validaciones){
			return array();
		}
		
		$nom_clase_val_cuest = 'Valida'.ucfirst(cuest_cve($this->getCatCuestionarioId()));
		
		if(!class_exists($nom_clase_val_cuest)){
			$this->redireccionaError("Cuestionario actual no tiene archivo con clase para validaciones", "Favor de crear el achivo <strong>".$nom_clase_val_cuest.".class.php</strong> con su respectiva clase en la carpeta <strong>model_cuest</strong>", $es_error_interno);
		}
		
		
		$valida_c = new $nom_clase_val_cuest($this->arr_cmps_frm);
		$valida_c->setArrValidaciones($this->cat_cuest_modulo_id);
		if($valida_c->getEsError()){
			$this->redireccionaError($valida_c->get1erErrorTit(), $valida_c->get1erErrorTxt());
		}
		
		return $valida_c->getArrValidaciones();
	}
	/**
	 * Devuelve el nombre que se puede usar para los archivos que exitan por cat_cuestionario_id
	 * NOTA. Ya no se usa este método, considerar borrarlo.
	 * @param int $cat_cuestionario_id	Id del catálogo de cuestionario
	 * @return string
	 */
	private function getNomArcCuest($cat_cuestionario_id){
		return ucfirst(cuest_cve($cat_cuestionario_id));
	}
	/**
	 * Devuelve la validación para permitir guardar el registro actual
	 * @return boolean
	 */
	private function permiteGuardar() {
		return ($this->tienePermiso('escritura') && !$this->es_aprobado)? true : false;
	}
	/**
	 * Regresa un arreglo con los parámetros o argumentos necesarios para redireccionarse a la acción forma.
	 * Nota. Éste arreglo debe estar conformado con las variables obtenidas mediante el arreglo $_REQUEST en el constructor, además que dentro del formulario; también deberían estar dentro de los campos usados declarados para frm_cero
	 */
	private function getArrRedirecForma($cat_cuest_modulo_id=""){
		$cat_cuest_modulo_id=($cat_cuest_modulo_id=="")? $this->cat_cuest_modulo_id : $cat_cuest_modulo_id;
		return array(
				'cuestionario_id'=>$this->cuestionario_id,
				'cat_cuestionario_id'=>$this->getCatCuestionarioId(),
				'cat_cuest_modulo_id'=>$cat_cuest_modulo_id
		);
	}
	/**
	 * Es llamada en al acción de inicio. Son instrucciones a calcular específicas por módulo al momento de cargar el formulario
	 */
	private function accionesPorModulo(){
		switch ($this->cat_cuest_modulo_id){
			case 1:
				//Se define el AND para el campo de municipio
				$and_mpo = $this->getAndMpo($this->getCampoValor($this->cuestionario->getCmpNomEnCuest('edo')));
				$this->setArrDatoVistaValor("and_mpo", $and_mpo);
				//Se define el AND para el campo de localidad
				$and_loc = $this->getAndLoc($this->getCampoValor($this->cuestionario->getCmpNomEnCuest('mpo')));
				$this->setArrDatoVistaValor("and_loc", $and_loc);
				$this->usar_lib_fie_input = true;	//Se activa el llamado a la librería para el uso de campos adjuntos
				break;
			case 2:	//Módulo de Agricultura
				$this->setArrCmpLlaveModAgr();
				break;
			case 3:	//Módulo de Ganadería
				$this->setArrCmpLlaveModPec();
				break;
			case 4:	//Módulo de Pesca
				$this->setArrCmpLlaveModPes();
				break;
			case 5:	//Módulo de Acuacultura
				$this->setArrCmpLlaveModAcu();
				break;
		}
	}
	/**
	 * A partir del contenido en el arreglo "arr_cmp_llave_val" devuelve el valor requerido a partir de los argumentos "cmp_llave" e "indice" 
	 * @param string $cmp_llave	Llave identificadora
	 * @param int $indice	Índice respecto al número de opción
	 * @return string
	 */
	public function getCmpLlaveVal($cmp_llave, $indice) {
		if(isset($this->arr_cmp_llave_val[$cmp_llave][$indice])){
			return $this->arr_cmp_llave_val[$cmp_llave][$indice];
		}else{
			return "";
		}
	}
	/**
	 * Devuelve el arreglo contenido en el arreglo "arr_cmp_llave_val" de la llave indicada en el argumento
	 * @param string $cmp_llave	Llave identificadora
	 * @return array
	 */
	public function getArrCmpLlave($cmp_llave) {
		if(isset($this->arr_cmp_llave_val[$cmp_llave])){
			return $this->arr_cmp_llave_val[$cmp_llave];
		}else{
			return array();
		}
	}
	/**
	 * Genera el arreglo de "arr_cmp_llave_val" para el módulo Agrícola
	 */
	private function setArrCmpLlaveModAgr(){
		$this->arr_cmp_llave_val = array(
			'tipo_cultivo'=>array(
				1=>'Sub-pregunta 1',
				2=>'Sub-pregunta 2',
				3=>'Sub-pregunta 3',
				4=>'Sub-pregunta 4',
			),
			'agr_p5rN_tipo'=>array(
				1=>'Renglón 1',
				2=>'Renglón 2',
				3=>'Renglón 3',
				4=>'Renglón 4',
				5=>'Renglón 5',
			),
			'agr_p5rN_um'=>array(
				1=>'Pesos',
				2=>'Litros',
				3=>'Kilogramos',
				4=>'Litros',
				5=>'Pesos',
			),
			'agr_p6'=>array(
				1=>'Aire acondicionado',
				2=>'Bombeo de agua para riego',
				3=>'Calefacción',
				4=>'Cosechadora o combinada',
				5=>'Selección y/o empaque',
				6=>'Iluminación',
				7=>'Invernadero',
				8=>'Secadora',
				9=>'Tractor con implementos de siembra y/o labranza y/o equipo de aspersión',
				10=>'Transporte',
				11=>'Ventilación',
				12=>'Aspersión aérea',
				13=>'Otra'
			),
			'agr_p7_pago'=>array(
				1=>'Nunc viverra turpis eget risus feugiat',
				2=>'Suspendisse lacinia velit at nunc venenatis',
				3=>'Phasellus imperdiet orci eget enim rutrum',
				4=>'Ut eu nulla et mi tincidunt faucibus',
				5=>'Nam tincidunt urna volutpat porta porttitor',
			),
			'agr_p8_t_ferti'=>array(
				1=>'Fertilizante foliar',
				2=>'Fosfato de amonio',
				3=>'NPK 10 20 20',
				4=>'NPK 22 10 6',
				5=>'NPK 15 15 15',
				6=>'NPK 17 17 17',
				7=>'Nitrato de amonio',
				8=>'Sulfato de amonio',
				9=>'Amoniaco anhidro',
				10=>'Urea',
				11=>'Fertilizante orgánico',
				12=>'Composta',
				13=>'Estiércol y orina de animales',
				14=>'Residuos de cultivos',
				15=>'Otro',
			),
			'agr_p9_t_cal'=>array(
				1=>'Caliza (CaCO3)',
				2=>'Dolomita ((CaMg(CO3)2)',
				3=>'Óxido y/o hidróxido de calcio (CaO y/o Ca(OH)2)',
			),
			'agr_p10_aq'=>array(
				1=>'Renglón 1',
				2=>'Renglón 2',
				3=>'Renglón 3',
			),
		);
	}
	/**
	 * Genera el arreglo de "arr_cmp_llave_val" para el módulo Pecuario
	 */
	private function setArrCmpLlaveModPec(){
		$this->arr_cmp_llave_val = array(
			'pec_especie_g1'=>array(
				1=>'Especie 1',
				2=>'Especie 2',
				3=>'Especie 3',
				4=>'Especie 4',
				5=>'Especie 5',
				6=>'Especie 6',
			),
			'pec_hato_e1'=>array(
				1=>'Especie 1 - Producto 1',
				2=>'Especie 1 - Producto 2',
				3=>'Especie 1 - Producto 3',
				4=>'Especie 1 - Producto 4',
				5=>'Especie 1 - Producto 5',
				6=>'Especie 1 - Producto 6',
				7=>'Especie 1 - Producto 7',
			),
			'pec_hato_e2'=>array(
				1=>'Especie 2 - Producto 1',
				2=>'Especie 2 - Producto 2',
			),
			'pec_hato_e3'=>array(
				1=>'Especie 3 - Producto 1',
				2=>'Especie 3 - Producto 2',
				3=>'Especie 3 - Producto 3',
				4=>'Especie 3 - Producto 4',
				5=>'Especie 3 - Producto 5',
			),
			'pec_hato_e4'=>array(
				1=>'Especie 4 - Producto 1',
				2=>'Especie 4 - Producto 2',
				3=>'Especie 4 - Producto 3',
				4=>'Especie 4 - Producto 4',
				5=>'Especie 4 - Producto 5',
				6=>'Especie 4 - Producto 6',
				7=>'Especie 4 - Producto 7',
			),
			'pec_hato_e5'=>array(
				1=>'Especie 5 - Producto 1',
				2=>'Especie 5 - Producto 2',
			),
			'pec_hato_e6'=>array(
				1=>'Especie 6 - Producto 1',
				2=>'Especie 6 - Producto 2',
				3=>'Especie 6 - Producto 3',
				4=>'Especie 6 - Producto 4',
				5=>'Especie 6 - Producto 5',
				6=>'Especie 6 - Producto 6',
			),
			'pec_especie_g2'=>array(
				7=>'Especie 7',
				8=>'Especie 8',
				9=>'Especie 9',
				10=>'Especie 10',
				11=>'Especie 11',
				12=>'Especie 12',
				13=>'Especie 13',
				14=>'Especie 14',
				15=>'Especie 15',
			),
			'pec_t_ene'=>array(
				1=>'Renglón 1',
				2=>'Renglón 2',
				3=>'Renglón 3',
				4=>'Renglón 4',
				5=>'Renglón 5',
				6=>'Renglón 6',
				7=>'Renglón 7',
				8=>'Renglón 8',
				9=>'Renglón 9',
				10=>'Renglón 10',
			),
			'pec_p3_um'=>array(
				1=>'Litros',
				2=>'Litros',
				3=>'Litros',
				4=>'Litros',
				5=>'Kilowatt por hora',
				6=>'Kilowatt por hora',
				7=>'Litros',
				8=>'Kilogramos',
				9=>'Kilogramos',
				10=>'',
			),
			'pec_p4'=>array(
				1=>'Aire acondicionado',
				2=>'Bombeo de agua para propósitos diferentes del riego',
				3=>'Bombeo para riego',
				4=>'Calefacción',
				5=>'Calentamiento de agua',
				6=>'Selección y/o empaque',
				7=>'Equipo de enfriamiento',
				8=>'Iluminación',
				9=>'Matanza de animales/ rastro',
				10=>'Ordeñadora',
				11=>'Transporte',
				12=>'Ventilación',
				13=>'Otro',
			),
			'pec_p5_donde'=>array(
				1=>'Corral o establo',
				2=>'Pastizal o Agostadero con superficie moderada donde gastan poca energía desplazándose',
				3=>'Pastizal o agostadero de gran área donde gastan una buena cantidad de energía desplazándose',
				4=>'Otro'
			),
			'pec_p5_ov_ca'=>array(
				1=>'Las hembras en gestación están estabuladas durante último trimestre',
				2=>'Los animales pastorean',
				3=>'Los animales comen en su corral o establo',
			),
			'pec_p6_espe'=>array(
				1=>'Vacas doble propósito',
				2=>'Vacas adultas',
				3=>'Ovejas adultas lecheras',
				4=>'Cabras lecheras',
			),
			'pec_p7_espe'=>array(
				1=>'Vacas para cría para carne',
				2=>'Vacas doble propósito',
				3=>'Vacas adultas',
				4=>'Ovejas adultas para producción de crías',
				5=>'Ovejas adultas para producción de crías y de lana',
				6=>'Cerdas en gestación',
				7=>'Cabras lecheras',
				8=>'Cabras adultas',
			),
			'pec_10_espe'=>array(
				1=>'Bueyes para fuerza de tiro',
				2=>'Mulas y Asnos',
				3=>'Equinos',
				4=>'No realizan trabajos de tracción',
			),
			'pec_p11r2_p'=>array(
				1=>'Por 1 mes',
				2=>'Por 3 meses',
				3=>'Por 4 meses',
				4=>'Por 6 meses',
				5=>'Por 12 meses',
			),
			'pec_p11r3_p'=>array(
				1=>'Mas de 1 mes',
				2=>'Menos de 1 mes',
			),
			'pec_p11r4_p'=>array(
				1=>'En pilas con material de la cama de los animales',
				2=>'Con cubierta o compactado',
				3=>'Con agentes de aglutinamiento',
				4=>'Con aditivos (para reducir emisiones)',
			),
			'pec_p11r7_p'=>array(
				1=>'Aireación forzada',
				2=>'Aireación pasiva',
			),
			'pec_p11r12_p'=>array(
				1=>'Bajo nivel de fugas',
				2=>'Alto nivel de fugas',
			)
		);
	}
	private function setArrCmpLlaveModPes() {
		$this->arr_cmp_llave_val = array(
			'pes_especies'=>array(
				1=>'Abulón',
				2=>'Almeja',
				3=>'Túnidos',
				4=>'Calamar',
				5=>'Camarón',
				6=>'Carpa',
				7=>'Erizo',
				8=>'Guachinango',
				9=>'Jaiba',
				10=>'Langosta',
				11=>'Langostino',
				12=>'Lisa',
				13=>'Mero',
				14=>'Tilapia / Mojarra',
				15=>'Ostión',
				16=>'Pulpo',
				17=>'Robalo',
				18=>'Sardina',
				19=>'Sierra',
				20=>'Tiburón y cazón',
				21=>'Trucha',
				22=>'Otro',
			),
			'pes_p7_ener'=>array(
				1=>'Diesel',
				2=>'Gasolina',
				3=>'Electricidad de la red',
				4=>'Electricidad de fuentes renovables (solar o eólica)',
				5=>'Combustóleo',
				6=>'No usa energía',
			),
			'pes_p7_um'=>array(
				1=>'Litros',
				2=>'Litros',
				3=>'Kilowatt por hora',
				4=>'Kilowatt por hora',
				5=>'Litros',
				6=>''
			)
		);
	}
	private function setArrCmpLlaveModAcu(){
		$this->arr_cmp_llave_val = array(
			'acu_p1_tipo'=>array(
				1=>'Rural de autoconsumo y venta de excedentes',
				2=>'Comercial de pequeña escala',
				3=>'Industrial de gran escala',
				4=>'Maricultura de pequeña escala',
			),
			'acu_p2_especie'=>array(
				1=>'Abulón',
				2=>'Almeja',
				3=>'Atún',
				4=>'Camarón',
				5=>'Carpa',
				6=>'Bagre',
				7=>'Langostino',
				8=>'Tilapia / Mojarra',
				9=>'Peces de ornato',
				10=>'Ostión',
				11=>'Robalo',
				12=>'Jurel',
				13=>'Huauchinango',
				14=>'Trucha',
				15=>'Otro',

			),
			'acu_p6_tipo'=>array(
				1=>'Diesel',
				2=>'Gasolina',
				3=>'Electricidad de la red',
				4=>'Electricidad de fuentes renovables (solar o eólica)',
				5=>'No usa energía',
			),
			'acu_p6_um'=>array(
				1=>'Litros',
				2=>'Litros',
				3=>'Kilowatt por hora',
				4=>'Kilowatt por hora',
				5=>'',
			)
		);
	}
	/**
	 * Actualiza en el campo json_parametros la variable respectiva al módulo actual (p_es_mod_[cat_cuest_modulo_id]_activo) con valor 1.
	 * Indicando así, que el módulo actual está activo, lo que significa que ya fue actualizado o se le dio guardar
	 */
	private function parametroModuloActivar(){
		$llave_p_es_mod_n_activo = $this->getNomLlaveEsModActivo($this->cat_cuest_modulo_id);
		//Se crea/modifica la variable indicada en el campo json_parametros
		$cmp_json_param = new CampoJSON('json_parametros');
		$cmp_json_param->setJSONCampo($this->cuestionario_id);
		$cmp_json_param->modificaValor($llave_p_es_mod_n_activo, 1);
		$cmp_json_param->guardar();
	}
	/**
	 * Actualiza en el campo json_parametros la variable respectiva al módulo actual (p_es_mod_[cat_cuest_modulo_id]_habilitado)
	 * @param int $cat_cuest_modulo_id
	 * @param int $valor
	 */
	private function parametroModuloHabilitar($cat_cuest_modulo_id, $valor) {
		$llave_p_es_mod_n_habilitado = $this->getNomLlaveEsModHabilitado($cat_cuest_modulo_id);
		//Se crea/modifica la variable indicada en el campo json_parametros
		$cmp_json_param = new CampoJSON('json_parametros');
		$cmp_json_param->setJSONCampo($this->cuestionario_id);
		$cmp_json_param->modificaValor($llave_p_es_mod_n_habilitado, $valor);
		$cmp_json_param->guardar();
	}
	
	/**
	 * Actualiza en el campo json_parametros los modulos que se tienen que deshabilitar/habilitar dependiendo de las acciones hechas en el módulo actual
	 * En el arreglo de módulo la variable es es_habilitado
	 * @param array $arr_cmps_mod_act	Arreglo de campos obtenidos del $_REQUEST del módulo actual
	 */
	private function modulosHabilitar($arr_cmps_mod_act){
		switch ($this->cat_cuest_modulo_id){
			case 1:	//Sección 1
				for($cat_cuest_modulo_id=2; $cat_cuest_modulo_id<=5; $cat_cuest_modulo_id++){
					$nom_prod_sector = 'prod_sector'.($cat_cuest_modulo_id-1);
					$val_prod_sector = (isset($arr_cmps_mod_act[$nom_prod_sector]))? intval($arr_cmps_mod_act[$nom_prod_sector]) : "";	
					//$this->parametroModuloHabilitar($cat_cuest_modulo_id, $val_prod_sector);
					$this->cuestionario->c00AgregaParamJSON('json_parametros', $this->getNomLlaveEsModHabilitado($cat_cuest_modulo_id), $val_prod_sector);
				}
				break;
		}
	}
	
	/**
	 * Actualiza el campo json_validaciones de la tabla c00. Almacena el arreglo obtenido con las validaciones del registro actual
	 */
	private function parametroValidacionesGuardar(){
		$this->arr_cmps_frm = $this->defineArrCmpsForm();
		$this->setEsNuevo();
		$arr_validaciones = $this->defineArrValidaciones();	//Se define la Clase de validación que corresponde al cuestionario actual
		
		
		
		$this->cuestionario->c00AgregaParamJSON('json_validaciones', $this->getNomLlaveCCMId($this->cat_cuest_modulo_id), $arr_validaciones);
		
		/*
		$cmo_json_valida = new CampoJSON("json_validaciones");	//Se define el campo json (json_validaciones)
		$cmo_json_valida->setJSONCampo($this->cuestionario_id);	//Se define el arreglo del registro actual
		
		$llave_ccm_val = $this->getNomLlaveCCMId($this->cat_cuest_modulo_id);
		$cmo_json_valida->modificaValor($llave_ccm_val, $arr_validaciones);
		$cmo_json_valida->guardar();*/
	}
	/**
	 * Devuelve el nombre de la llave usada para identificar si el módulo es activo
	 * @param int $cat_cuest_modulo_id	De la variable a identificar
	 * @return string
	 */
	private function getNomLlaveEsModActivo($cat_cuest_modulo_id){
		return "p_es_mod_".$cat_cuest_modulo_id."_activo";
	}
	
	/**
	 * Devuelve el nombre de la llave usada para identificar si el módulo está habilitado (es_habilitado es el arreglo de módulos)
	 * @param int $cat_cuest_modulo_id
	 * @return atring
	 */
	private function getNomLlaveEsModHabilitado($cat_cuest_modulo_id){
		return "p_es_mod_".$cat_cuest_modulo_id."_habilitado";
	}
	
	/**
	 * Devuelve el nombre de la llave usada para almacenar el arreglo de validaciones del módulo indicado en el argumento
	 * @param int $cat_cuest_modulo_id	De la variable a identificar
	 * @return string
	 */
	private function getNomLlaveCCMId($cat_cuest_modulo_id){
		return "ccm_id_".$this->cat_cuest_modulo_id;
	}
	/**
	 * Modifica el valor de la bandera permite_ver_reg_cuest, permitiendo con esta, validar la consulta del registro actual
	 */
	private function setPermiteVerRegCuest(){
		$permite_ver_reg_cuest = false;
		//if($this->es_nuevo || $this->tienePermiso('lectura_nal')){
		if($this->tienePermiso('lectura_nal')){
			//Si nuevo cuestionario o si tiene permisos de lectura Nacional
			$permite_ver_reg_cuest = true;
		}else{
			if(intval($this->getCampoValor('cat_usuario_id')) === intval($this->usuario_dato('cat_usuario_id'))){
				//Si es autor del registro de cuestionario actual
				$permite_ver_reg_cuest = true;
			}elseif($this->tienePermiso('lectura_edo') && $this->getCampoValor($this->cuestionario->getCmpNomEnCuest('edo')) == $this->usuario_dato('cat_estado_id')){
				//Si tiene permiso de lectura Estatal y el registro actual coincide en la entidad Estatal revisora
				$permite_ver_reg_cuest = true;
			}elseif($this->tienePermiso('lectura_mpo') && $this->getCampoValor($this->cuestionario->getCmpNomEnCuest('mpo')) == $this->usuario_dato('cat_municipio_id')){
				//Si tiene permiso de lectura Municioal y el registro actual coincide en la entidad Municipal revisora
				$permite_ver_reg_cuest = true;
			}
		}
		$this->permite_ver_reg_cuest = $permite_ver_reg_cuest;
	}
	/**
	 * Devuelve el valor de la variable cuestionario_id
	 * @return int
	 */
	public function getCuestionarioId() {
		return $this->cuestionario_id;
	}
	/**
	 * Revisa la situación actual del cuestionario indentificando los módulos terminados y sin errores, activando las alertas toastr respectivas
	 */
	private function defineSituacionCuest(){
		$tot_habilitados = 0;
		$tot_activos = 0;
		$ccm_id_ultimo = 0;
		$tot_validaciones = 0;
		$tot_val_mod_act = 0;
		foreach($this->arr_modulos as $cat_cuest_modulo_id=>$arr_det_modulos){
			$es_habilitado = (isset($arr_det_modulos['es_habilitado']) && intval($arr_det_modulos['es_habilitado'])===1)? true : false;
			$es_ultimo = (isset($arr_det_modulos['es_ultimo']) && intval($arr_det_modulos['es_ultimo'])===1)? true : false;
			if($es_habilitado){
				$es_activo = (isset($arr_det_modulos['es_activo']) && intval($arr_det_modulos['es_activo'])===1)? true : false;
				if($es_activo){
					$validaciones_total = (isset($arr_det_modulos['arr_validaciones']["total"]))? intval($arr_det_modulos['arr_validaciones']["total"]) : 0;
					$tot_validaciones += $validaciones_total;
					if(intval($cat_cuest_modulo_id)=== intval($this->cat_cuest_modulo_id)){
						$tot_val_mod_act = $validaciones_total;
					}
					
					$tot_activos++;
				}
				//Es una sección habilitada en la pregunta 1 de Identificación
				$tot_habilitados++;
			}
			if($es_ultimo){
				$ccm_id_ultimo = $cat_cuest_modulo_id;
			}
			
		}
		//Que exista más de un módulo habilitado, significa que se seleccionó al menos un sector
		$al_menos_un_sector = ($tot_habilitados>1);
		//Si el total de habilitados es igual al total de activos, significa que se ha entrado a guardar a todos los módulos
		$se_guardo_en_todos = ($tot_habilitados === $tot_activos);
		//Si el módulo actual es el último
		$es_ultimo_modulo = (intval($this->cat_cuest_modulo_id)=== intval($ccm_id_ultimo));
		
		
		//Se define el estatus del cuestionario
		if(!$al_menos_un_sector){
			//Sin sector
			$this->estatus_cuest = 2;
		}elseif(!$se_guardo_en_todos){
			//Incompleto
			if($tot_validaciones>0){
				//Con observaciones
				$this->estatus_cuest = 3;
			}else{
				//Sin observaciones
				$this->estatus_cuest = 4;
			}
		}else{
			if($tot_validaciones>0){
				//Completado con observaciones
				$this->estatus_cuest = 5;
			}else{
				//Terminado
				$this->estatus_cuest = 6;
			}
		}
		
		
		if($al_menos_un_sector && $se_guardo_en_todos && $es_ultimo_modulo){
			if($tot_validaciones>0){
				if($tot_val_mod_act>0 && $this->cc_modulo_desc){
					$this->setSesionArrToastrAlerta('warning', 'En el módulo <strong>'.$this->cc_modulo_desc.'</strong> quedan '.$tot_val_mod_act.' mensajes de validación por resolver.');
				}else{
					$this->setSesionArrToastrAlerta('warning', 'Existen en total '.$tot_validaciones.' mensaje(s) de validación pendiente(s) por resolver en el cuestionario.');
				}				
			}else{
				$this->setSesionArrToastrAlerta('success', 'Cuestionario terminado. Gracias por su participación.');
			}
		}elseif($tot_val_mod_act>0 && $this->cc_modulo_desc){
			$this->setSesionArrToastrAlerta('warning', 'En el módulo <strong>'.$this->cc_modulo_desc.'</strong> quedan '.$tot_val_mod_act.' mensajes de validación por resolver.');
		}
	}
	/**
	 * A partir del Id del estatus del cuestionario, regresa su identificación o descripción
	 * @param int $estatus_cuest	Id del estatus del cuestinario
	 * @return string
	 */
	public function getEstatusDesc($estatus_cuest=0) {
		return $this->cuestionario->getEstatusCuestDesc($estatus_cuest);
	}
	/**
	 * Asigna el valor a la variable modulo_es_ultimo, la cual indica si el módulo actual es el último en el cuestionario
	 */
	private function setModuloEsUltimo() {
		$modulo_es_ultimo = isset($this->arr_modulos[$this->cat_cuest_modulo_id]['es_ultimo'])? $this->arr_modulos[$this->cat_cuest_modulo_id]['es_ultimo'] : false;
		if(intval($modulo_es_ultimo)){
			$this->modulo_es_ultimo = true;
		}else{
			$this->modulo_es_ultimo = false;
		}
	}
	/**
	 * Devuelve el valor de la variable modulo_es_ultimo
	 * @return bool
	 */
	public function getModuloEsUltimo() {
		return $this->modulo_es_ultimo;
	}
}
