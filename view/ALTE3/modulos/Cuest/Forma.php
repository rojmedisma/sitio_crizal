<div class="card card-default card-outline">
	<div class="card-header">
		<div class="d-flex justify-content-between">
			<h3 class="card-title"><?php echo $controlador_obj->getDatoVistaValor('cat_cuestionario_desc'); ?></h3>
			<a href="" data-toggle="modal" data-target="#modal_ayuda"><i class="fas fa-question-circle"></i> Ayuda cuestionario</a>
		</div>
		
		
	</div>
	<div class="card-body">
		<form name="frm_cuest" role="form" method="post" action="<?php echo define_controlador('cuestforma', 'actualizar'); ?>">
			<?php echo $controlador_obj->getHTMLCamposOcultosCuest(); ?>
			<?php echo $controlador_obj->getHTMLBotonesMenu(); ?>
			<div class="row">
				<div class="col-md-4">
					<label>Cuestionario Id:</label><spam class="pl-2"><?php echo $controlador_obj->getCuestionarioId(); ?></spam>
				</div>
				<div class="col-md-8">
					<label>Estatus:</label><spam class="pl-2"><?php echo $controlador_obj->getCampoValor('estatus_cuest_desc'); ?></spam>
				</div>
			</div>
			<?php echo $controlador_obj->getHTMLValidacionesLista(); ?>
			<?php include_once $controlador_obj->getSubRutaVista(); ?>
			<?php if($controlador_obj->getModuloEsUltimo()){?>
			<div class="alert alert-info alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-info"></i> Ha llegado al final del cuestionario</h5>
				AGRICULTURA agradece su tiempo y esfuerzo para responder el cuestionario. Los resultados servirán para mejorar el inventario de Gases y Compuestos de Efecto Invernadero a cargo del Instituto Nacional de Ecología y Cambio Climático.
			</div>
			<?php }?>
			<?php echo $controlador_obj->getHTMLBotonesMenu(); ?>
		</form>
	</div>
</div>
<!-- /.card -->
