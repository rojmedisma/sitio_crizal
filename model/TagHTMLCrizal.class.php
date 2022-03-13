<?php
/**
 * Clase TagHTMLCrizal
 *
 * @author Ismael Rojas
 */
class TagHTMLCrizal{
	private $html_contenido;
	/**
	 * Devuelve el string que contiene el tag HTML generado en la función Set definida previamente
	 * @return string
	 */
	public function getHTMLContenido() {
		return $this->html_contenido;
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
		$arr_tag[] = '	<button type="submit" class="btn btn-outline-danger btn-sm btn_borrar"><i class="fas fa-trash-alt"></i> Borrar</button>';
		//$arr_tag[] = '	<button type="submit" class="btn btn-danger btn-sm btn_borrar"><i class="fas fa-trash-alt"></i> Borrar</button>';
		$arr_tag[] = '</form>';
		$this->html_contenido = tag_string($arr_tag);
	}
}
