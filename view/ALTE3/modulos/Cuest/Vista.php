<!-- Default box -->
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6">
				<h3 class="card-title"><?php echo $controlador_obj->getDatoVistaValor('cat_cuestionario_desc'); ?></h3>
			</div>
			<div class="col-md-6">
				<?php if($controlador_obj->tienePermiso('exportar')){?>
				<div class="dropdown dropleft float-right pl-1">
					<button type="button" class="btn btn-secondary dropdown-toggle  btn-sm" data-toggle="dropdown">
						Exportar...
					</button>
					<div class="dropdown-menu">
						<form class="d-inline frm_exp_xls" action="<?php echo define_controlador("cuestcat", "exportar_xls")?>" method="post">
							<?php echo $controlador_obj->getHTMLCamposOcultosBase()?>
							<input type="hidden" name="cat_cuestionario_id" value="<?php echo $controlador_obj->getCatCuestionarioId()?>" >
							<button type="submit" class="dropdown-item"><i class="fas fa-file-excel"></i> En formato Excel</button>
						</form>
						<form class="d-inline frm_exp_csv" action="<?php echo define_controlador("cuestcat", "exportar_csv")?>" method="post">
							<?php echo $controlador_obj->getHTMLCamposOcultosBase()?>
							<input type="hidden" name="cat_cuestionario_id" value="<?php echo $controlador_obj->getCatCuestionarioId()?>" >
							<button type="submit" class="dropdown-item"><i class="fas fa-file-csv"></i> En formato CSV</button>
						</form>
					</div>
				</div>
				<?php }?>
				<?php if($controlador_obj->tienePermiso('escritura') && $controlador_obj->tienePermiso("nuevo_cuest")){?>
				<div class="btn-group float-right">
					<a href="<?php echo define_controlador("cuestforma", "inicio", false, array("cat_cuestionario_id"=>$controlador_obj->getCatCuestionarioId()))?>" class="btn btn-info btn-sm"><i class="fa fa-fw fa-file"></i> Alta cuestionario</a>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table id="vista_cuest" class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">Opciones</th>
					<th scope="col">Id Cuestionario</th>
					<th scope="col">Usuario</th>
					<th scope="col">Estado</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Estatus</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($controlador_obj->getArrTblCuestionario() as $arr_det_cuest){ ?>
				<tr>
					<td><?php echo $controlador_obj->getHTMLBotones($arr_det_cuest["cuestionario_id"]); ?></td>
					<td><?php echo $arr_det_cuest["cuestionario_id"]; ?></td>
					<td><?php echo $arr_det_cuest["autor_usuario"]; ?></td>
					<td><?php echo $arr_det_cuest["prod_edo_desc"]; ?></td>
					<td><?php echo $arr_det_cuest["creacion_fecha"]; ?></td>
					<td><?php echo $controlador_obj->getHTMLColEstatus($arr_det_cuest["estatus_cuest"], $arr_det_cuest["estatus_cuest_desc"]); ?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<!-- /.card-footer-->
</div>
<!-- /.card -->

