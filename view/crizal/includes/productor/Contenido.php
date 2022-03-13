<section class="box-hover">
	<div class="container">
		<div class="section-heading">
			<h3>Consulta de variedades de cultivos</h3>
		</div>
		<div class="row position-relative">
			<div class="col-12">
				<div class="mb-3">
					<a href="<?=define_controlador("prodcultivo", "inicio"); ?>"  class="btn btn-outline-dark">Nueva variedad</a>
				</div>

			</div>
			<div class="col-12">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Opciones</th>
							<th>Nombre</th>
							<th>Origen</th>
							<th>Forma de produccion</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($controlador_obj->getArrTabla() as $cultivo_id => $arr_tbl_det): ?>
							<tr>
								<td>
									<a href="<?= define_controlador('prodcultivo', 'inicio', false, array('cultivo_id'=>$cultivo_id))?>" type="button" class="btn btn-outline-dark">Abrir</a>
									<a href="#" type="button" class="btn btn-outline-danger">Borrar</a>
								</td>
								<td><?= $arr_tbl_det['cat_cultivo_id_desc']; ?></td>
								<td><?= $arr_tbl_det['semilla_origen_desc']; ?></td>
								<td><?= $arr_tbl_det['produc_metodo_desc']; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>