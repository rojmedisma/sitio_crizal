<?php
/**
 * Clase core Ayuda
 * Contiene principalmente la generación de formatos para mensajes de error, en caso de que se presenten.
 * @author Ismael Rojas
 */
class Ayuda{
	private $es_error= false;
	private $arr_error = array();
	private function setEsErrorTrue(){
		$this->es_error=true;
	}
	/**
	 * Devuelve la indicación cuando en el proceso actual se produjo un error
	 * @return boolean
	 */
	public function getEsError(){
		return $this->es_error;
	}
	/**
	 * Activa la bandera es_error, indicando que se generó un error y asigna el título y la descripción del error a un arreglo de errores
	 * @param string $tit_error	Título del error
	 * @param string $txt_error	Descripción del error
	 */
	protected function setError($tit_error, $txt_error){
		$this->setArrError($tit_error, $txt_error);
	}
	/**
	 * Modifica el arreglo del atributo arr_error con la información necesaria para señalar el error producido
	 * @param string $tit_error	Título del error
	 * @param string $txt_error	Descripción del error
	 */
	private function setArrError($tit_error, $txt_error){
		if($tit_error!="" && $txt_error!=""){
			$this->setEsErrorTrue();
			$arr_error = $this->getArrError();
			$arr_error[] = array('tit_error'=>$tit_error, 'txt_error'=>$txt_error);
			$this->arr_error = $arr_error;
		}
	}
	/**
	 * Devuelve el arreglo generado tras haberse producido un error en la ejecución
	 * @return array
	 */
	protected function getArrError(){
		return $this->arr_error;
	}
	/**
	 * Regresa el primer arreglo de error generado con la intención de ser impreso en pantalla mediante el rediereccionamiento al controlador de Error.
	 * @return array
	 */
	public function getArr1erError() {
		$arr_error = $this->arr_error;
		if(count($arr_error)){
			return $arr_error[0];
		}else{
			return array('tit_error'=>'Error al llamado a función getArr1erError', 'txt_error'=>'El error no pudo ser desplegado al generarse un error en la función getArr1erError. <br>Verificar primera haber insertado un return true al final de la función que llama a setError.');
		}
	}
	/**
	 * A partir del arreglo de errores, se obtiene el título del primer error que se generó
	 * @return string
	 */
	public function get1erErrorTit() {
		return $this->get1erError('tit_error');
	}
	/**
	 * A partir del arreglo de errores, se obtiene la descripción del primer error que se generó
	 * @return string
	 */
	public function get1erErrorTxt() {
		return $this->get1erError('txt_error');
		
	}
	/**
	 * A partir del arreglo de errores, se obtiene el título o la descripción del primer error que se generó, dependiendo de la instrucción enviada en el argumento
	 * @param string $parte	Llave con la parte a obtener del arreglo del error
	 * @return string
	 */
	private function get1erError($parte){
		$arr_1er_err = $this->getArr1erError();
		if(isset($arr_1er_err[$parte])){
			return $arr_1er_err[$parte];
		}else{
			return "Título o Descripción de error no identificado, revisar clase ".get_class($this);
		}
	}
	/**
	 * Devuelve un cuadro de alerta en formato HTML para informar del error producido
	 * @param string $txt_tit
	 * @param string $txt_desc
	 * @param string $sin_libreria
	 * @return string
	 */
	protected function getTagError($txt_tit, $txt_desc, $sin_libreria=false){
		$alerta = new AlertaGenerica($sin_libreria);
		return $alerta->getAlerta($txt_tit, $txt_desc, 'danger');
	}
	/**
	 * Devuelve el Id del usuario actual
	 * @return int
	 */
	protected function getUsuarioId(){
		$usuario_id = (isset($_SESSION['cat_usuario_id']))? $_SESSION['cat_usuario_id'] : "";
		return $usuario_id;
	}
}
?>