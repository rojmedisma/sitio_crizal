<?php
/**
 * Clase modelo Adjunto
 * Su funcionalidad principal es para el control de registros de adjunto
 * @author Ismael Rojas
 */
class Adjunto extends ModeloBase{
	private $adjunto_id;
	public function __construct(){
		parent::__construct();
		$this->tbl_nom = "adjunto";
		$this->cmp_id_nom = $this->tbl_nom."_id";							   
	}
	/**
	 * Genera registro de adjunto con la información del archivo adjuntado
	 * @param string $adjunto_tipo	Tipo de adjunto
	 * @param string $ruta_raiz	Ruta raiz hasta donde se encuentra la carpeta del sistema
	 * @param string $ruta_archivo	Ruta donde se almacenan los archivos de adjunto
	 * @param string $nom_arc_real	Nombre del archivo
	 * @param string $nom_arc_sist	Nombre del archivo asignado por el sistema
	 */
	public function setRegistrar($adjunto_tipo, $ruta_raiz, $ruta_archivo, $nom_arc_real, $nom_arc_sist, $gale_cmp_id_nom="", $gale_cmp_id_val=""){
		$cat_usuario_id = $this->getUsuarioId();
		$arr_cmps_upd = array(
				"`adjunto_id`"=>"NULL",
				"`adjunto_tipo`" =>txt_sql($adjunto_tipo),
				"`cat_usuario_id`"=>txt_sql($cat_usuario_id, false),
				"`ruta_raiz`"=>txt_sql($ruta_raiz),
				"`ruta_archivo`"=>txt_sql($ruta_archivo),
				"`nom_arc_real`"=>txt_sql($nom_arc_real),
				"`nom_arc_sist`"=>txt_sql($nom_arc_sist),
				"`fecha`"=>"CURDATE()",
				"`hora`"=>"CURTIME()",
		);
		if($gale_cmp_id_nom!=="" && $gale_cmp_id_val!==""){
			$arr_cmps_upd["`".$gale_cmp_id_nom."`"] = txt_sql($gale_cmp_id_val);
		}
		$this->adjunto_id = $this->bd->ejecutaQryInsertDeArr($arr_cmps_upd, "adjunto");
		//Se inserta el valor de orden con el valor de adjunto_id
		//$qry_orden = "UPDATE `".$this->bd->getBD()."`.`adjunto` SET `orden` = '".$this->adjunto_id."' WHERE `adjunto`.`adjunto_id` = '".$this->adjunto_id."'; ";
		//$this->bd->ejecutaQry($qry_orden);												   																																						 
	}
	/**
	 * Devuelve el Id del registro de adjunto
	 * @return int
	 */
	public function getAdjuntoId() {
		return $this->adjunto_id;
	}
	/**
	 * Ejecuta query para marcar como borrado el registro de adjunto
	 * @param int $adjunto_id
	 * @return boolean
	 */
	public function borrar($adjunto_id) {
		$qry_update = "UPDATE `".$this->bd->getBD()."`.`".$this->tbl_nom."` SET `borrar` = '1' WHERE `adjunto_id` = '".$adjunto_id."'; ";
		if($this->bd->ejecutaQry($qry_update)){
			return true;
		}else{
			return false;
		}
	}
	public function setArrTblAdj($and="") {
		$and_ft = " AND `borrar` IS NULL ".$and;
		$arr_tbl = $this->bd->getArrDeTabla($this->tbl_nom, $and_ft);
		$this->arr_tbl = $arr_tbl;
	}
}

