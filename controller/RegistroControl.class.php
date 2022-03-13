<?php
/**
 * Clase RegistroControl
 *
 * @author Ismael Rojas
 */
class RegistroControl extends TableroBase{
	public object $frm_crizal;
	public function __construct() {
		parent::__constructTablero();
		$this->setPaginaDistintivos();
		$this->setUsarLibForma(true);
		$this->defineVista("Sitio.php");
	}
	public function inicio() {
		$usuario_tipo = (isset($_REQUEST['usuario_tipo']))? intval($_REQUEST['usuario_tipo']) : 0;
		if($usuario_tipo){
			$cat_sub_cat = new CatSubCat();
			$cat_sub_cat->setOpcDescripcion('usuario_tipo', $usuario_tipo);
			$usuario_tipo_desc = $cat_sub_cat->getOpcDescripcion();
			
			$this->setArrDatoVistaValor('usuario_tipo', $usuario_tipo);
			$this->setArrDatoVistaValor('usuario_tipo_desc', $usuario_tipo_desc);
			$mostrar_sel_usr_tipo = false;
		}else{
			$mostrar_sel_usr_tipo = true;
		}
		
		$tit_formulario = "Registro de usuario";
		if($usuario_tipo==1){
			$tit_formulario = "Registro de productor";
			$cat_grupo_id = 7;
		}elseif($usuario_tipo==2){
			$tit_formulario = "Registro de comprador";
			$cat_grupo_id = 6;
		}
		
		$this->setArrDatoVistaValor('mostrar_sel_usr_tipo', $mostrar_sel_usr_tipo);
		$this->setArrDatoVistaValor('tit_formulario', $tit_formulario);
		$this->setArrDatoVistaValor('cat_grupo_id', $cat_grupo_id);
		
		$this->frm_crizal = new FormularioCrizal(array());
	}
	public function registrado() {
		
	}
}
