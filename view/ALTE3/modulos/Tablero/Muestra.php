<h4 class="mb-2 mt-4">Muestra: <?php echo $controlador_obj->getDatoVistaValor('cat_cuestionario_desc'); ?></h4>
<div class="card card-default card-outline">
	<div class="card-header">
		<h3 class="card-title">Registros pre-cargados</h3>
		<div class="btn-group float-right">
			<form class="d-inline" action="<?php echo define_controlador("muestra", "validar")?>" method="post">
				<?php echo $controlador_obj->getHTMLCamposOcultosBase()?>
				<input type="hidden" name="cat_cuestionario_id" value="<?php echo $controlador_obj->getCatCuestionarioId()?>" >
				<button type="submit" class="btn bg-gradient-primary btn-sm">1. Validar pre-carga</button>
			</form>
			<form class="d-inline" action="<?php echo define_controlador("muestra", "integrar")?>" method="post">
				<?php echo $controlador_obj->getHTMLCamposOcultosBase()?>
				<input type="hidden" name="cat_cuestionario_id" value="<?php echo $controlador_obj->getCatCuestionarioId()?>" >
				<button type="submit" class="btn bg-gradient-primary btn-sm">2. Crear cuestionarios</button>
			</form>
		</div>
	</div>
	<div class="card-body">
		<table id="tbl_consulta" class="table table-bordered">
			<thead>
				<tr>
					<th>Muestra Id</th>
					<th>Usuario Id</th>
					<th>Estado</th>
					<th>Municipio</th>
					<th>Localidad</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($controlador_obj->getArrTblMuestra() as $arr_det){ ?>
				<tr>
					<td><?php echo $arr_det['muestra_id']; ?></td>
					<td><?php echo $arr_det['cat_usuario_id']; ?></td>
					<td><?php echo $arr_det['prod_edo_desc']; ?></td>
					<td><?php echo $arr_det['prod_mpo_desc']; ?></td>
					<td><?php echo $arr_det['prod_loc_desc']; ?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div><!-- /.card -->
