<?php
session_start();
include_once 'core/Global.php';
include_once 'core/Auxiliar.class.php';
include_once 'core/Frecuente.func.php';
include_once 'core/Ayuda.class.php';	//NOTA: Ver si en realidad va a servir
include_once 'core/ControladorBase.class.php';
include_once 'core/'.CARPETA_PROYECTO.'/TableroBase.class.php';	//Archivo propio del proyecto
require_once 'vendor/autoload.php';
$controlador = (isset($_REQUEST['controlador']))? $_REQUEST['controlador'] : CONTROLADOR_DEFECTO;
$accion = (isset($_REQUEST['accion']))? $_REQUEST['accion'] : ACCION_DEFECTO;

$clase_controlador = ucwords($controlador).'Control';

$arc_controlador = $clase_controlador.'.class.php';
$ruta_controlador ='controller/'.$arc_controlador;

if(!is_file($ruta_controlador)){
	echo "Ruta de controlador <em>".$ruta_controlador."</em> no existe.";
	die();
}
require_once $ruta_controlador;
if(class_exists($clase_controlador)){
	include_once 'core/Conectar.class.php';
	include_once 'core/BaseDatos.class.php';
	include_once 'core/ModeloBase.class.php';	//NOTA: Ver si en realidad va a servir
	
	
	$conexion = new Conectar();
	$mysqli = $conexion->getConexion();    //Variable global usada en la clase BaseDatos
	
	//Incluir todos los modelos
	foreach(glob("model/*.php") as $file){
		require_once $file;
	}
	//Modelos propios del proyecto
	foreach(glob("model/".CARPETA_PROYECTO."/*.php") as $file){
		require_once $file;
	}
	$controlador_obj = new $clase_controlador();
	
	
	
	//Se valida la sesion a menos que el controlador no lo permita
	if($controlador_obj->getAutentificar()){
		$controlador_obj->setValidaSesion();	//De ControladorBase
	}
}else{
	redireccionar('error', 'sin_obj', array("objeto"=>$clase_controlador));
}

if(method_exists($controlador_obj, $accion)){
	$controlador_obj->$accion();
	if($controlador_obj->getCargarVista()){
	    $ruta_vista = 'view/'.CARPETA_VIEW.'/'.$controlador_obj->getNombreVista();
	    if(!is_file($ruta_vista)){
			echo "Ruta de vista <em>".$ruta_vista."</em> no existe.";
			die();
	    }
	    require_once $ruta_vista;
	}
}else{
	redireccionar('error', 'sin_metodo',array("clase"=>$controlador, "metodo"=>$accion));
}