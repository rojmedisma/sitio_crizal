<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6">
				<h3 class="card-title"><?php echo $controlador_obj->getDatoVistaValor('tit_tabla'); ?></h3>
			</div>
			<div class="col-md-6">
				<div class="btn-group float-right">
					<?php echo $controlador_obj->getHTMLBtnAlta(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<?php
		switch (strtolower($controlador_obj->getAccion())){
			case 'cat_usuario': include_once 'CatVistaGen/CatUsuario.php';	break;
			case 'cat_grupo': include_once 'CatVistaGen/CatGrupo.php';	break;
			case 'log': include_once 'CatVistaGen/Log.php';	break;
		}
		?>
	</div>
</div><!-- /.card -->



