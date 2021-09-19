<h3>Permisos</h3>
<div class="card card-primary card-outline card-outline-tabs">
	<div class="card-header p-0 border-bottom-0">
		<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link<?php echo $controlador_obj->getDatoVistaValor('activa_gen'); ?>" href="<?php echo define_controlador('catfrmgpo', 'cat_grupo', false, array('cat_grupo_id'=>$controlador_obj->getDatoVistaValor('cat_grupo_id'), 'ver_vista'=>'general'))?>">Por grupo</a>
			</li>
			<li class="nav-item">
				<a class="nav-link<?php echo $controlador_obj->getDatoVistaValor('activa_cuest'); ?>" href="<?php echo define_controlador('catfrmgpo', 'cat_grupo', false, array('cat_grupo_id'=>$controlador_obj->getDatoVistaValor('cat_grupo_id'), 'ver_vista'=>'cuestionario'))?>">Por grupo - cuestionario</a>
			</li>
		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content">
			<div class="tab-pane fade show active" >
				<div class="row">
					<?php if($controlador_obj->getDatoVistaValor('ver_vista')=='cuestionario'){ ?>
					<div class="col-md-12">
						<?php echo $controlador_obj->getHTMLAvisoCuestCorrector(); ?>
					</div>
					<div class="col-md-7">
						<form name="frm_sel" role="form" method="post" action="<?php echo define_controlador('catfrmgpo', 'cat_grupo'); ?>">
							<?php 
							echo $controlador_obj->frm_sel->cmpOculto('cat_grupo_id', $controlador_obj->getDatoVistaValor('cat_grupo_id'));
							echo $controlador_obj->frm_sel->cmpOculto('ver_vista', $controlador_obj->getDatoVistaValor('ver_vista'));
							echo $controlador_obj->frm_sel->cmpSelectDeTbl('cat_cuestionario_id', 'cat_cuestionario', 'cat_cuestionario_id', 'descripcion', '', 'Seleccionar cuestionario');
							?>
						</form>
					</div>
					<?php }?>
					<div class="col-md-12">
						<table id="tbl_permisos" class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">Activar</th>
									<th scope="col">Nombre</th>
									<th scope="col">Descripción</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($controlador_obj->getArrTabla() as $arr_tbl_det){ ?>
								<tr>
									<td title="<?php echo $arr_tbl_det['cat_permiso_cve']; ?>"><?php echo html_entity_decode($arr_tbl_det['html_btn_activo']); ?></td>
									<td><?php echo $arr_tbl_det['tit_corto']; ?></td>
									<td><?php echo $arr_tbl_det['descripcion']?></td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div><!-- ./tab-pane fade show -->
		</div><!-- ./tab-content -->
		
	</div>
</div>

