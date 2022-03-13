<div class="row">
	<div class="col-md-12 mb-3">
		<button class="butn btn-sm" type="button" data-toggle="modal" data-target="#mdl_inventario"><span>Alta registro de inventario</span></button>
	</div>
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<colgroup>
					<col style="width:180px">
				</colgroup>
				<thead>
					<tr>
						<th>Opciones</th>
						<th>Fecha disponibilidad</th>
						<th>Cantidad</th>
						<th>Unidad de medida</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($controlador_obj->getArrTabla() as $cult_inventario_id => $arr_tbl_det): ?>
						<tr>
							<td>
								<button type="button" class="btn btn-outline-dark btn-sm btn_abrir" data-cult_inventario_id="<?= $cult_inventario_id ?>" ><i class="fas fa-pencil-alt"></i> Abrir</button>
								<?= $controlador_obj->getHTMLBtnBorrarInv($cult_inventario_id); ?>
							</td>
							<td><?php echo $arr_tbl_det['fecha_disponibilidad'] ?></td>
							<td><?php echo $arr_tbl_det['cantidad'] ?></td>
							<td><?php echo $arr_tbl_det['cantidad_um_desc'] ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdl_inventario" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Registro de inventario</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form id="frm_inventario" role="form" method="post" action="<?php echo define_controlador('guardar', 'cult_inventario') ?>" enctype="multipart/form-data">
				<?php echo $controlador_obj->frm_crizal->cmpOculto('cultivo_id', $controlador_obj->getDatoVistaValor('cultivo_id')); ?>
				<?php echo $controlador_obj->frm_crizal->cmpOculto('cult_inventario_id', $controlador_obj->getDatoVistaValor('cult_inventario_id')); ?>
				<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<?php echo $controlador_obj->frm_crizal->cmpFecha('fecha_disponibilidad', 'Fecha en que estará disponible para venta'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<?php echo $controlador_obj->frm_crizal->cmpNum('cantidad', 2, 'Cantidad'); ?>
						</div>
						<div class="col-md-6">
							<?php echo $controlador_obj->frm_crizal->cmpSelectDeSubCat('cantidad_um', 'cantidad_um', 'Origen de la semilla'); ?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="butn" data-dismiss="modal"><span>Cerrar</span></button>
					<button type="submit" class="butn" id="btn_adjuntar"><span>Guardar</span></button>
				</div>
			</form>
		</div>
	</div>
</div>