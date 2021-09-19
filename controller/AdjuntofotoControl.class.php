<?php
/**
 * Clase AdjuntofotoControl
 *
 * @author Ismael Rojas
 */
class AdjuntofotoControl extends ControladorBase{
	private $ruta_raiz;
	private $ruta_archivo;
	private $cmp_arc_nom;	//Nombre del campo tipo file
	private $solo_imagenes = true;	//Para validar que solo se pueda subir archivos de imagen
	private $max_tam_bytes = 10485760; //Tamaño máximo permitido para subir archivos (10485760 Bytes = 10 MB)
	private $revisar_extensiones = true;
	private $arr_extensiones = array("jpeg","jpg","png","bmp","svg","webp","gif");	//Arreglo de formatos/extensiones permitidos
	private $nom_arc_sist;
	private $controlador_destino;
	private $accion_destino;
	private $gale_cmp_id_nom;
	private $gale_cmp_id_val;
	public function __construct() {
		/**
		 * Nota: controlador_fuente y accion_fuente son variables que pueden ser llamadas desde la vista fuente usando la función getHTMLCamposOcultosBase perteneciente a ControladorBase
		 *	- El argumento controlador_actual se convierte en variable controlador_destino.
		 *	- El argumento accion_actual se convierte en variable accion_destino
		 */
		$this->ruta_raiz = $_SERVER['DOCUMENT_ROOT'];
		$this->ruta_archivo = ADJ_RUTA_ARCHIVO; //	/adjuntos/wallwalla/;
		$this->controlador_destino = isset($_REQUEST['controlador_fuente'])? $_REQUEST['controlador_fuente'] : "";
		$this->accion_destino = isset($_REQUEST['accion_fuente'])? $_REQUEST['accion_fuente'] : "";
		$this->gale_cmp_id_nom = isset($_REQUEST['gale_cmp_id_nom'])? $_REQUEST['gale_cmp_id_nom'] : "";
		$this->gale_cmp_id_val = isset($_REQUEST['gale_cmp_id_val'])? $_REQUEST['gale_cmp_id_val'] : "";
	}
	public function adjuntar(){
		$adjunto_tipo = isset($_REQUEST['adjunto_tipo'])? $_REQUEST['adjunto_tipo'] : "";
		//Para el formulario de Fotografia
		$sesion_foto_id = isset($_REQUEST['sesion_foto_id'])? $_REQUEST['sesion_foto_id'] : "";
		
		if($adjunto_tipo=="" || $this->controlador_destino=="" || $this->accion_destino==""){
			$this->redireccionaError("Error Interno", "No fue posible identificar el valor de alguno de los siguientes argumentos: [adjunto_tipo, controlador_fuente, accion_fuente].");
		}
		
		$this->cmp_arc_nom  = array_key_first($_FILES);
		$archivo_nombre = $_FILES[$this->cmp_arc_nom]["name"];
		
		
		if($this->cmp_arc_nom=="" || !isset($_FILES[$this->cmp_arc_nom]["name"]) || $_FILES[$this->cmp_arc_nom]["name"]==""){
			$this->redireccionaError('Nombre de archivo sin identificar', 'Favor de seleccionar el archivo que desea subir', false);
		}
		
		if($this->solo_imagenes){
			$this->revisaEsImg();
		}
		$this->revisaMaxTam();
		if($this->revisar_extensiones){
			$this->revisaExtensiones();
		}
		//Se crea el nombre de archivo como se va a conocer dentro del sistema
		$this->setNomArcSist();
		$nom_arc_sist = $this->nom_arc_sist;
		$ruta_compuesta = $this->ruta_raiz.$this->ruta_archivo;
		$target_file = $ruta_compuesta . basename($nom_arc_sist);
		
		if(!file_exists($ruta_compuesta)){
			$this->redireccionaError("Ruta inexistente", "La ruta de almacenamiento <strong>".$ruta_compuesta."</strong> no existe.");
		}
		
		if(!move_uploaded_file($_FILES[$this->cmp_arc_nom]["tmp_name"], $target_file)) {
			$this->redireccionaError("Error al intentar subir el archivo", "Se presentó un problema al intentar subir el archivo, favor de volve a intentarlo. Gracias", false);
		}
		$nom_arc_real = $_FILES[$this->cmp_arc_nom]["name"];
		$adjunto = new Adjunto();
		$adjunto->setRegistrar($adjunto_tipo, $this->ruta_raiz, $this->ruta_archivo, $nom_arc_real, $nom_arc_sist, $this->gale_cmp_id_nom, $this->gale_cmp_id_val);
		$adjunto_id = $adjunto->getAdjuntoId();
		
		$arr_url_arg = array("adjunto_id"=>$adjunto_id, "sesion_foto_id"=>$sesion_foto_id);
		if($this->gale_cmp_id_nom!="" && $this->gale_cmp_id_val!=""){
			$arr_url_arg[$this->gale_cmp_id_nom] = $this->gale_cmp_id_val;
		}
		
		
		redireccionar($this->controlador_destino, $this->accion_destino, $arr_url_arg);
		
	}
	public function descargar(){
		$adjunto_id = (isset($_REQUEST['adjunto_id']))? $_REQUEST['adjunto_id'] : "";
		if($adjunto_id==""){
			$this->redireccionaError("Error interno", "Argumento identificador de archivo vacío.", false);
		}
		$adjunto = new Adjunto();
		$adjunto->setArrReg($adjunto_id);
		$arr_reg_adj = $adjunto->getArrReg();
		if(empty($arr_reg_adj)){
			$this->redireccionaError("Archivo no encontrado", "El archivo seleccionado ya no se encuentra disponible", false);
		}
		$ruta_raiz = (isset($arr_reg_adj['ruta_raiz']))? $arr_reg_adj['ruta_raiz'] : "";
		$ruta_archivo = (isset($arr_reg_adj['ruta_archivo']))? $arr_reg_adj['ruta_archivo'] : "";
		$nom_arc_sist = (isset($arr_reg_adj['nom_arc_sist']))? $arr_reg_adj['nom_arc_sist'] : "";
		$nom_arc_real =  (isset($arr_reg_adj['nom_arc_real']))? $arr_reg_adj['nom_arc_real'] : "";
		if($nom_arc_sist==""){
			$this->redireccionaError("Error interno", "Nombre de archivo interno vacío en registro de tabla adjunto.");
		}
		$ruta_arc_sist = $ruta_raiz.$ruta_archivo.$nom_arc_sist;
		if (!file_exists($ruta_arc_sist)) {
			$this->redireccionaError("No se encontró archivo", "El archivo <em>".$nom_arc_real."</em> no fue encontrado en la carpeta de archivos adjuntos.");
		}

		header('Content-Description: File Transfer');
		//header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.$nom_arc_real.'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($ruta_arc_sist));
		readfile($ruta_arc_sist);
		
	}
	public function borrar() {
		$adjunto_id = (isset($_REQUEST['adjunto_id']))? $_REQUEST['adjunto_id'] : "";
		if($adjunto_id==""){
			$this->redireccionaError("Error interno", "Argumento identificador de archivo vacío.");
		}
		$adjunto = new Adjunto();
		$adjunto->borrar($adjunto_id);
		$arr_url_arg = array("adjunto_id"=>$adjunto_id);
		if($this->gale_cmp_id_nom!="" && $this->gale_cmp_id_val!=""){
			$arr_url_arg[$this->gale_cmp_id_nom] = $this->gale_cmp_id_val;
		}
		redireccionar($this->controlador_destino, $this->accion_destino, $arr_url_arg);
	}
	
	public function subir() {
		$this->subir_bajar();
	}
	public function bajar() {
		$this->subir_bajar();
	}
	private function subir_bajar() {
		$adjunto_id = (isset($_REQUEST['adjunto_id']))? $_REQUEST['adjunto_id'] : "";
		$adjuunto = new Adjunto();
	}
	private function revisaEsImg(){
		$check = getimagesize($_FILES[$this->cmp_arc_nom]["tmp_name"]);
		if($check===false){
			$this->redireccionaError("Archivo no es de tipo imagen", "El archivo seleccionado no es un archivo de tipo imagen.", false);
		}
	}
	private function revisaMaxTam(){
		if ($_FILES[$this->cmp_arc_nom]["size"] > $this->max_tam_bytes) {
			$max_tam_megas = $this->max_tam_bytes/(1024*1024);
			$this->redireccionaError("Tamaño de archivo no permitido", "El tamaño del archivo seleccionado es mayor al permitido (".$max_tam_megas." MB)", false);
		}
	}
	private function revisaExtensiones(){
		$arr_extensiones = $this->arr_extensiones;
		if(count($arr_extensiones)){
			$fileType = strtolower(pathinfo($_FILES[$this->cmp_arc_nom]["name"],PATHINFO_EXTENSION));
			if(!in_array($fileType, $arr_extensiones)){
				$this->redireccionaError("Tipo de archivo no permitido", "No se permiten archivos con extensión: <strong>".$fileType."</strong>.<br>Extensiones permitidas: ".implode(", ", $arr_extensiones), false);
			}
		}
	}
	private function setNomArcSist(){
		$nom_arc_sist = "t_".time()."_r_".rand(0,200).".".strtolower(pathinfo($_FILES[$this->cmp_arc_nom]["name"],PATHINFO_EXTENSION));
		$target_file = $this->ruta_raiz.$this->ruta_archivo . basename($nom_arc_sist);
		if(file_exists($target_file)) {
			$this->setNomArcSist();
		}else{
			$this->nom_arc_sist = $nom_arc_sist;
		}
	}
}
