<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo $controlador_obj->getDatoVistaValor('tit_forma'); ?></h3>
			</div>
			<form name="frm_cat" role="form" method="post" action="<?php echo define_controlador('guardar', 'inventario'); ?>">
				<?php echo $controlador_obj->frm_al3->cmpOculto('inventario_id', $controlador_obj->getCampoValor('inventario_id')); ?>
				<?php echo $controlador_obj->frm_al3->cmpOculto('inhabilitar', ''); ?>
				<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
				<div class="card-body">
					<h4>Identificación</h4>
					<div class="row">
						<div class="col-md-2"><?php echo $controlador_obj->frm_al3->cmpNum('veh_anio', 0, "Año/Year"); ?></div>
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpSelectDeTbl('veh_marca', 'cat_veh_marca', 'cat_veh_marca_id', 'descripcion', '', 'Marca/Make'); ?></div>
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpSelectDeTbl('veh_modelo', 'cat_veh_modelo', 'cat_veh_modelo_id', 'descripcion', $controlador_obj->getDatoVistaValor('and_veh_modelo'), 'Modelo/Model'); ?></div>
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpTexto('veh_modelo_det', "Más Detalle"); ?></div>
					</div>
					<h4>Propiedades</h4>
					<div class="row">
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpNum('veh_precio', 2, "Precio regular"); ?></div>
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpNum('veh_precio_descuento', 2, "Precio con descuento"); ?></div>
					</div>
					<div class="row">
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpNum('veh_millas', 0, "Millas/Mileage"); ?></div>
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpTexto('veh_motor', "Motor/Engine"); ?></div>
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpTexto('veh_color_interior', "Color interior/Interior Color"); ?></div>
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpTexto('veh_color_exterior', "Color exterior/Exterior Color"); ?></div>
						
					</div>
					<div class="row">
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpTexto('veh_transmision', "Transmisión/Transmission"); ?></div>
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpTexto('veh_traccion', "Tracción/Drivetrain"); ?></div>
						<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpTexto('veh_combustible', "Combustible/Fuel"); ?></div>
					</div>
				</div>
				<div class="card-footer">
					<div class="btn-group float-right">
						<?php if($controlador_obj->tienePermiso('ae-inventario')){?>
						<button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Guardar</button>
						<?php }?>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Foto de portada</h3>
			</div>
			<div class="card-body">
				<form name="frm_adj_princ" role="form" method="post" action="<?php echo define_controlador('adjuntofoto', 'adjuntar'); ?>" enctype="multipart/form-data">
					<input type="hidden" name="gale_cmp_id_nom" value="inventario_id">
					<input type="hidden" name="gale_cmp_id_val" value="<?php echo $controlador_obj->getCampoValor('inventario_id');?>">
					<input type="hidden" name="adjunto_tipo" value="f_princ">
					<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
					<div class="form-group">
						<label for="archivo_subir">Subir imagen</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="archivo_subir"  name="archivo_subir">
								<label class="custom-file-label" for="archivo_subir">Seleccionar archivo</label>
							</div>
							<div class="input-group-append">
								<button type="submit" class="btn btn-info btn-flat"><i class="fas fa-file-upload"></i> Subir</button>
							</div>
						</div>
					</div>
				</form>
				<div class="row mb-3">
					<?php foreach($controlador_obj->getArrRegAdjuntoPrinc() as $arr_reg_adj){?>
					<div class="col-md-10 text-center">
						<img src="<?php echo $arr_reg_adj['ruta_archivo'].$arr_reg_adj['nom_arc_sist']; ?>" class="img-thumbnail"  style="max-height:300px; max-width:100%">
					</div>
					<div class="col-md-2 text-center">
						<form name="frm_borrar_princ" role="form" method="post" action="<?php echo define_controlador('adjuntofoto', 'borrar'); ?>">
							<input type="hidden" name="gale_cmp_id_nom" value="inventario_id">
							<input type="hidden" name="gale_cmp_id_val" value="<?php echo $controlador_obj->getCampoValor('inventario_id');?>">
							<input type="hidden" name="adjunto_id" value="<?php echo $arr_reg_adj['adjunto_id']; ?>">
							<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
							<button type="submit" class="btn btn-block btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
						</form>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Fotos complementarias</h3>
			</div>
			<div class="card-body">
				<form name="frm_adj_sec" role="form" method="post" action="<?php echo define_controlador('adjuntofoto', 'adjuntar'); ?>" enctype="multipart/form-data">
					<input type="hidden" name="gale_cmp_id_nom" value="inventario_id">
					<input type="hidden" name="gale_cmp_id_val" value="<?php echo $controlador_obj->getCampoValor('inventario_id');?>">
					<input type="hidden" name="adjunto_tipo" value="f_sec">
					<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
					<div class="form-group">
						<label for="archivo_subir">Subir imagen</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="archivo_subir"  name="archivo_subir">
								<label class="custom-file-label" for="archivo_subir">Seleccionar archivo</label>
							</div>
							<div class="input-group-append">
								<button type="submit" class="btn btn-info btn-flat"><i class="fas fa-file-upload"></i> Subir</button>
							</div>
						</div>
					</div>
				</form>
				<div class="row mb-3">
					<?php foreach($controlador_obj->getArrRegAdjuntoSec() as $arr_reg_adj){?>
					<div class="col-md-10 text-center">
						<img src="<?php echo $arr_reg_adj['ruta_archivo'].$arr_reg_adj['nom_arc_sist']; ?>" class="img-thumbnail"  style="max-height:300px; max-width:100%">
					</div>
					<div class="col-md-2 text-center">
						<form name="frm_borrar_sec" role="form" method="post" action="<?php echo define_controlador('adjuntofoto', 'borrar'); ?>">
							<input type="hidden" name="gale_cmp_id_nom" value="inventario_id">
							<input type="hidden" name="gale_cmp_id_val" value="<?php echo $controlador_obj->getCampoValor('inventario_id');?>">
							<input type="hidden" name="adjunto_id" value="<?php echo $arr_reg_adj['adjunto_id']; ?>">
							<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
							<button type="submit" class="btn btn-block btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
						</form>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>