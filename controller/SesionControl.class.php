<?php
/**
 * Clase SesionControl
 *
 * @author Ismael Rojas
 */
class SesionControl extends TableroBase{
	private $es_info_incorrecta = false;
	private $url_uri = '';
	private $url_arg = '';
	public function __construct() {
		parent::__constructTablero();
		$this->url_uri = (isset($_REQUEST["url_uri"]))? $_REQUEST["url_uri"] : '';
		$this->url_arg = (isset($_REQUEST["url_arg"]))? $_REQUEST["url_arg"] : '';
		$this->setAutentificar(false);
	}
	public function inicio() {
		$this->setPaginaDistintivos();
		$this->defineVista("Sitio.php");
		
		$this->frm_crizal = new FormularioCrizal(array());
	}
	public function autentificar(){
		$usuario = (isset($_REQUEST["usuario"]))? $_REQUEST["usuario"] : '';
		$clave= (isset($_REQUEST["clave"]))? $_REQUEST["clave"] : '';
		
		$autentificar = new Autentificar();
		$autentificar->setValidar($usuario, $clave);
		if($autentificar->getEsValido()){
			$url_uri = $this->getUrlUri();
			
			if($url_uri!=""){
				header('Location:'.$url_uri);
			}else{
				redireccionar(CONTROLADOR_DEFECTO,'redirigir');
			}
			$log = new Log();
			$log->setRegLog('usuario', $usuario, 'autentificar', 'Aviso', 'Inició sesión');
		}else{
			$this->es_info_incorrecta = true;
			$this->defineVista('Autentificar.php');
			//$this->defineVista('Autentificar.php');
		}
	}
	/**
	 * Acción que elimina la variable de sesión actual y redirecciona al cotrolador defecto
	 */
	public function desautentificar(){
		session_destroy();
		$url_uri = (isset($_REQUEST["url_uri"]))? $_REQUEST["url_uri"] : '';
		$log = new Log();
		$log->setRegLog('', '', 'Desautentificar', 'Aviso', 'Cerró sesión');
		redireccionar(CONTROLADOR_DEFECTO, ACCION_DEFECTO, array("ini_ses"=>INI_SES), $url_uri);
	}
	/**
	 * Devuelve la ruta URL a donde se debe de redireccionar una vez se haya realizado la autentificación
	 * @return string
	 */
	public function getUrlUri(){
		return $this->url_uri;
	}
	/**
	 * Argumentos URL (No se utiliza)
	 * @return string
	 */
	public function getUrlArg(){
		return $this->url_arg;
	}
	/**
	 * Devuelve la indicación de si los datos son correctos en el momento en que se ejecuta la validación de usuario y contraseña
	 * @return boolean
	 */
	public function getEsInfoIncorrecta(){
		return $this->es_info_incorrecta;
	}
}
