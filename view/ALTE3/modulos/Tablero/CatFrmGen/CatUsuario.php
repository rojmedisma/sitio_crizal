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
			<form name="frm_cat" role="form" method="post" action="<?php echo define_controlador('guardar', 'cat_usuario'); ?>">
				<?php echo $controlador_obj->frm_al3->cmpOculto('cat_usuario_id', $controlador_obj->getCampoValor('cat_usuario_id')); ?>
				<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
				<div class="card-body">
					<h4>Datos personales</h4>
					<div class="row">
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpTexto('nombre', "Nombre"); ?></div>
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpTexto('ap_paterno', "Apellido paterno"); ?></div>
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpTexto('ap_materno', "Apellido materno"); ?></div>
					</div>
					<div class="row">
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpSelectDeTbl('cat_estado_id', 'cat_estado', 'cat_estado_id', 'descripcion', '', 'Estado'); ?></div>
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpSelectDeTbl('cat_municipio_id', 'cat_municipio', 'cat_municipio_id', 'descripcion', $controlador_obj->getDatoVistaValor('and_estado'), 'Municipio'); ?></div>
					</div>
					<h4>Datos de autentificación</h4>
					<div class="row">
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpTexto('usuario', "Usuario"); ?></div>
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpContrasenia('clave', "Contraseña", array("value"=>"")); ?></div>
					</div>
					<h4>Permisos</h4>
					<div class="row">
						<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpSelectDeTbl('cat_grupo_id', 'cat_grupo', 'cat_grupo_id', 'tit_corto', '', 'Grupo'); ?></div>
						<div class="col-md-6">
							<label>Estatus activo</label>
							<?php echo $controlador_obj->frm_al3->cmpCheckbox('activo', 'El estatus del usuario es activo') ?>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="btn-group float-right">
						<?php if($controlador_obj->tienePermiso('ae-usuario')){?>
						<button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Guardar</button>
						<?php }?>
					</div>
				</div>
			</form>
		</div><!-- /.card -->
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6">
						<h3 class="card-title">Permisos del grupo </h3>
					</div>
					<div class="col-md-6">
						<div class="btn-group float-right">
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="tbl_permisos" class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">Permiso</th>
							<th scope="col">Descripción</th>
							<th scope="col">Tipo</th>
							<th scope="col">Orden</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($controlador_obj->getArrTabla() as $arr_det_gpo){ ?>
						<tr>
							<td><?php echo $arr_det_gpo['cp_tit_corto']; ?></td>
							<td><?php echo $arr_det_gpo['cp_descripcion']; ?></td>
							<td><?php echo $arr_det_gpo['cp_tipo_desc']; ?></td>
							<td><?php echo $arr_det_gpo['cp_orden']; ?></td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

