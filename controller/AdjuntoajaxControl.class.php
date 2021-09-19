<?php
/**
 * Clase AdjuntoajaxControl
 *
 * @author Ismael Rojas
 */
class AdjuntoajaxControl extends ControladorBase{
	private $ruta_raiz;
	private $ruta_archivo;
	private $cmp_arc_nom;	//Nombre del campo tipo file
	private $solo_imagenes = false;	//Para validar que solo se pueda subir archivos de imagen
	private $max_tam_bytes = 2097152; //Tamaño máximo permitido para subir archivos (2097152 Bytes = 2 MB)
	private $revisar_extensiones = true;
	//private $arr_extensiones = array("doc","docx","xls","xlsx","ppt","pptx","jpg","png","gif","bmp","jpeg","pdf","txt","csv","xml","mp3","mp4","zip","rar","shp","kmz","kml","gdb","mdb","lyr","osm");	//Arreglo de formatos/extensiones permitidos
	private $arr_extensiones = array("jpg","png","gif","bmp","jpeg","pdf","txt","csv");	//Arreglo de formatos/extensiones permitidos
	private $nom_arc_sist;
	public function __construct() {
		
		$this->ruta_raiz = $_SERVER['DOCUMENT_ROOT'];
		$this->ruta_archivo = "/adjuntos/siap_igei/";
	}
	public function adjuntar(){
		$adjunto_tipo = "prod_geo_poligono";
		
		if($adjunto_tipo==""){
			$this->imprimeError("Error Interno", "No fue posible identificar el valor del argumento adjunto_tipo.");
		}
		$this->cmp_arc_nom  = array_key_first($_FILES);
		$archivo_nombre = $_FILES[$this->cmp_arc_nom]["name"];
		if($this->cmp_arc_nom=="" || !isset($_FILES[$this->cmp_arc_nom]["name"]) || $_FILES[$this->cmp_arc_nom]["name"]==""){
			$this->imprimeError('Nombre de archivo sin identificar', 'Favor de seleccionar el archivo que desea subir', false);
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
			$this->imprimeError("Ruta inexistente", "La ruta de almacenamiento <strong>".$ruta_compuesta."</strong> no existe.");
		}
		
		if(!move_uploaded_file($_FILES[$this->cmp_arc_nom]["tmp_name"], $target_file)) {
			$this->imprimeError("Error al intentar subir el archivo", "Se presentó un problema al intentar subir el archivo, favor de volve a intentarlo. Gracias", false);
		}
		$nom_arc_real = $_FILES[$this->cmp_arc_nom]["name"];
		$adjunto = new Adjunto();
		$adjunto->setRegistrar($adjunto_tipo, $this->ruta_raiz, $this->ruta_archivo, $nom_arc_real, $nom_arc_sist);
		$adjunto_id = $adjunto->getAdjuntoId();
		//redireccionar($this->controlador_destino, $this->accion_destino, array("adjunto_id"=>$adjunto_id));
		
		$alte3_html = new ALTE3HTML();
		$alte3_html->setHTMLAdjuntoBtn($adjunto_id);
		echo $alte3_html->getHTMLContenido();
	}
	public function borrar() {
		$adjunto_id = (isset($_REQUEST['adjunto_id']))? $_REQUEST['adjunto_id'] : "";
		if($adjunto_id==""){
			$this->imprimeError("Error interno", "Argumento identificador de archivo vacío.");
		}
		$adjunto = new Adjunto();
		$adjunto->borrar($adjunto_id);
		
		$alte3_html = new ALTE3HTML();
		$alte3_html->setHTMLAdjuntoBtn($adjunto_id);
		echo $alte3_html->getHTMLContenido();
	}
	private function revisaEsImg(){
		$check = getimagesize($_FILES[$this->cmp_arc_nom]["tmp_name"]);
		if($check===false){
			$this->imprimeError("Archivo no es de tipo imagen", "El archivo seleccionado no es un archivo de tipo imagen.", false);
		}
	}
	private function revisaMaxTam(){
		if ($_FILES[$this->cmp_arc_nom]["size"] > $this->max_tam_bytes) {
			$max_tam_megas = $this->max_tam_bytes/(1024*1024);
			$this->imprimeError("Tamaño de archivo no permitido", "El tamaño del archivo seleccionado es mayor al permitido (".$max_tam_megas." MB)", false);
		}
	}
	private function revisaExtensiones(){
		$arr_extensiones = $this->arr_extensiones;
		if(count($arr_extensiones)){
			$fileType = strtolower(pathinfo($_FILES[$this->cmp_arc_nom]["name"],PATHINFO_EXTENSION));
			if(!in_array($fileType, $arr_extensiones)){
				$this->imprimeError("Tipo de archivo no permitido", "No se permiten archivos con extensión: <strong>".$fileType."</strong>.<br>Extensiones permitidas: ".implode(", ", $arr_extensiones), false);
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
	private function imprimeError($tit_error, $txt_error){
		$arr_tag = array();
		$arr_tag[] = '<div class="alert alert-danger alert-dismissible">';
		$arr_tag[] = '	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
		$arr_tag[] = '	<h5><i class="icon fas fa-ban"></i> '.$tit_error.'</h5>';
		$arr_tag[] = '	'.$txt_error;
		$arr_tag[] = '</div>';
		echo tag_string($arr_tag);
		die();
	}
	
}
