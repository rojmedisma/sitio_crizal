<div class="row">
	<div class="col-sm-12 col-md-6">
		<form name="frm_adj" role="form" method="post" action="<?php echo define_controlador('adjuntofoto', 'adjuntar'); ?>" enctype="multipart/form-data">
			<input type="hidden" name="gale_cmp_id_nom" value="cultivo_id">
			<input type="hidden" name="gale_cmp_id_val" value="<?php echo $controlador_obj->getDatoVistaValor('cultivo_id');?>">
			<input type="hidden" name="adjunto_tipo" value="cultivo">
			<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
			<div class="form-group">
				<div class="input-group">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="archivo_subir"  name="archivo_subir">
						<label class="custom-file-label" for="archivo_subir">Seleccionar imagen</label>
					</div>
					<div class="input-group-append">
						<button type="submit" class="btn btn-outline-dark"><i class="fas fa-file-upload"></i> Subir</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row">
	<?php foreach($controlador_obj->getArrRegAdjunto() as $arr_reg_adj):?>
	<div class="col-sm-12 col-md-6">
		<div class="row mb-3">
			<div class="col-md-10 text-center">
				<img src="<?php echo $arr_reg_adj['ruta_archivo'].$arr_reg_adj['nom_arc_sist']; ?>" class="img-thumbnail"  style="max-height:300px; max-width:100%">
			</div>
			<div class="col-md-2 text-center">
				<form name="frm_borrar_princ" role="form" method="post" action="<?php echo define_controlador('adjuntofoto', 'borrar'); ?>">
					<input type="hidden" name="gale_cmp_id_nom" value="cultivo_id">
					<input type="hidden" name="gale_cmp_id_val" value="<?php echo $controlador_obj->getCultivoId();?>">
					<input type="hidden" name="adjunto_id" value="<?php echo $arr_reg_adj['adjunto_id']; ?>">
					<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
					<button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
				</form>
			</div>
		</div>
	</div>
	<?php endforeach;?>
</div>