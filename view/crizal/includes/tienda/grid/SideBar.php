<div class="side-bar">
	<div class="widget">
		<div id="accordion" class="accordion-style2">
			<?php foreach($controlador_obj->arr_obj_rs_filtros as $filtro_cve => $arr_det): ?>
				<!-- Por variedad Inicio -->
				
				<div class="card">
					<div class="card-header" id="headingOne">
						<h5 class="mb-0">
							<button class="btn btn-link" data-toggle="collapse" data-target="#coll_<?= $filtro_cve ?>" aria-expanded="true" aria-controls="coll_variedad"> <?= $arr_det['tit'] ?></button>
						</h5>
					</div>
					<div id="coll_<?= $filtro_cve ?>" class="collapse<?= $arr_det['collapse'] ?>" aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							<?php $ob_rs = $arr_det['ob_rs'] ?>
							<?php if($ob_rs->num_rows): ?>
								<ul class="mb-0">
									<li><a href="<?= define_controlador('tienda', 'grid') ?>">[Todas]</a></li>
									<?php while ($o_det = $ob_rs->fetch_object()): ?>
										<?php if(isset($arr_det['cmp_id_nom']) && isset($arr_det['cmp_id_val'])): ?>
											<?php $a_css_class = ($arr_det['cmp_id_val'] == $o_det->filtro_id) ? 'font-weight-600' : '' ?>
											<li><a class="<?= $a_css_class; ?>" href="<?= define_controlador('tienda', 'grid', false, array($arr_det['cmp_id_nom'] => $o_det->filtro_id)) ?>"><?= $o_det->filtro_desc ?></a></li>
										<?php endif; ?>
									<?php endwhile; ?>
								</ul>
							<?php else: ?>
								<span>No hay categorías</span>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<!-- Por variedad Fin -->
			<?php endforeach; ?>

		</div>
	</div>
	<div class="widget">
		<div class="widget-title">
			<h5>Certificaciones</h5>
		</div>
		<ul class="mb-0 ml-2">
			<li class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="cert1">
				<label class="custom-control-label text-left" for="cert1">Orgánico</label>
			</li>
			<li class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="cert2">
				<label class="custom-control-label text-left" for="cert2">Libre de OGM</label>
			</li>
			<li class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="cert3">
				<label class="custom-control-label text-left" for="cert3">CAP Certificación Orgánica Participativa</label>
			</li>
			<li class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="cert4">
				<label class="custom-control-label text-left" for="cert4">Exámen de aflatoxinas</label>
			</li>
		</ul>
	</div>
	

	
</div>