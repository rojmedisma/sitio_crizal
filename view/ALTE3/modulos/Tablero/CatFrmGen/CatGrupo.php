<div class="row">
	<div class="col-xl-7 col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6">
						<h3 class="card-title"><?php echo $controlador_obj->getDatoVistaValor('tit_forma'); ?></h3>
					</div>
					<div class="col-md-6">
						<div class="btn-group float-right">
						</div>
					</div>
				</div>
			</div>
			<form name="frm_cat" role="form" method="post" action="<?php echo define_controlador('guardar', 'cat_grupo'); ?>">
				<?php echo $controlador_obj->frm_al3->cmpOculto('cat_grupo_id', $controlador_obj->getCampoValor('cat_grupo_id')); ?>
				<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpTexto('tit_corto', "Nombre"); ?></div>
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpTexto('descripcion', "Descripción"); ?></div>
					</div>
				</div>
				<div class="card-footer">
					<div class="btn-group float-right">
						<?php if($controlador_obj->tienePermiso('ae-grupo')){?>
						<button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Guardar</button>
						<?php }?>
					</div>
				</div>
			</form>
		</div><!-- /.card -->
	</div>
	<div class="col-md-12">
		<?php 
		if(!$controlador_obj->getEsNuevo()){
			include_once 'CatGrupo/Permisos.php';
		}
		?>
	</div>
</div>

