<form name="frm_cat" role="form" method="post" action="<?php echo define_controlador('guardar', 'cultivo'); ?>">
	<?= $controlador_obj->frm_crizal->cmpOculto('cultivo_id', $controlador_obj->getCampoValor('cultivo_id')); ?>
	<?= $controlador_obj->frm_crizal->cmpOculto('cat_usuario_id', $controlador_obj->getCampoValor('cat_usuario_id')); ?>
	<?php echo $controlador_obj->getHTMLCamposOcultosBase(); ?>
	<div class="row">
		<div class="col-md-4"><?php echo $controlador_obj->frm_crizal->cmpSelectDeTbl('cat_cultivo_id', 'cat_cultivo', 'cat_cultivo_id', 'descripcion', '', 'Variedad'); ?></div>
	</div>
	<div class="row">
		<div class="col-md-4"><?php echo $controlador_obj->frm_crizal->cmpSelectDeSubCat('semilla_origen', 'semilla_origen', 'Origen de la semilla'); ?></div>
		<div class="col-md-4"><?php echo $controlador_obj->frm_crizal->cmpSelectDeSubCat('produc_metodo', 'produc_metodo', 'Forma de producción'); ?></div>
		<div class="col-md-6">
			<label>Uso de insumos</label>
			<ul class="mb-0 ml-2">
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('insumo_1', 'Cal') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('insumo_2', 'Fertilizante químico') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('insumo_3', 'Fertilizantes orgánicos') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('insumo_4', 'Herbicida químico') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('insumo_5', 'Otros insumos orgánicos') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('insumo_6', 'Pastilla post-cosecha') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('insumo_7', 'Plaguicida químico') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('insumo_8', 'No aplica') ?>
			</ul>
		</div>
		<div class="col-md-6">
			<label>Certificaciones</label>
			<ul class="mb-0 ml-2">
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('certifica_1', 'Orgánico') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('certifica_2', 'Libre de OGM') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('certifica_3', 'CAP Certificación Orgánica Participativa') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('certifica_4', 'Exámen de aflatoxinas') ?>
			</ul>
		</div>
		<?php
		$cls_col_cmp = 'col-9';
		$cls_col_um = 'col-3';
		?>
		<div class="col-md-12">
			<label>Características medidas del grano</label>
			<div class="row ml-3">
				<div class="col-md-4">
					<label>Grado de humedad</label>
					<div class="row">
						<div class="<?= $cls_col_cmp; ?>">
							<?= $controlador_obj->frm_crizal->cmpNum('grano_humedad', 2); ?>
						</div>
						<div class="<?= $cls_col_um; ?>">
							<span>%</span>
						</div>
					</div>
				</div><!-- Grado de humedad -->
				<div class="col-md-4">
					<label>Densidad</label>
					<div class="row">
						<div class="<?= $cls_col_cmp; ?>">
							<?= $controlador_obj->frm_crizal->cmpNum('grano_densidad', 2); ?>
						</div>
						<div class="<?= $cls_col_um; ?>">
							<span>kg/hL</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<label>Impurezas</label>
					<div class="row">
						<div class="<?= $cls_col_cmp; ?>">
							<?= $controlador_obj->frm_crizal->cmpNum('grano_impureza', 2); ?>
						</div>
						<div class="<?= $cls_col_um; ?>">
							<span>%</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<label>Daños por calor</label>
					<div class="row">
						<div class="<?= $cls_col_cmp; ?>">
							<?= $controlador_obj->frm_crizal->cmpNum('grano_danio_calor', 2); ?>
						</div>
						<div class="<?= $cls_col_um; ?>">
							<span>%</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<label>Suma de daños</label>
					<div class="row">
						<div class="<?= $cls_col_cmp; ?>">
							<?= $controlador_obj->frm_crizal->cmpNum('grano_danios_suma', 2); ?>
						</div>
						<div class="<?= $cls_col_um; ?>">
							<span>%</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<label>Granos quebrados</label>
					<div class="row">
						<div class="<?= $cls_col_cmp; ?>">
							<?= $controlador_obj->frm_crizal->cmpNum('grano_quebrado', 2); ?>
						</div>
						<div class="<?= $cls_col_um; ?>">
							<span>%</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<h6>Servicios incluidos</h6>
	<div class="row">
		<div class="col-md-6">
			<label>Al cultivo</label>
			<ul class="mb-0 ml-2">
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_cult_1', 'Desgrane artesanal') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_cult_2', 'Desgrane con máquina') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_cult_3', 'Cribado o tamizado') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_cult_4', 'Pesado') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_cult_5', 'Encostalado (costales de 60kg)') ?>
			</ul>
		</div>
		<div class="col-md-6">
			<label>En la entrega</label>
			<ul class="mb-0 ml-2">
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_entrega_1', 'Cuenta con servicio de transporte') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_entrega_2', 'Entrega a pie de milpa') ?>
			</ul>
		</div>
		<div class="col-md-6">
			<label>Para su traslado</label>
			<ul class="mb-0 ml-2">
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_trasla_1', 'Transporte sin maniobra') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_trasla_2', 'Transporte con maniobra') ?>
				<?= $controlador_obj->frm_crizal->cmpCheckboxLista('inclu_serv_trasla_3', 'Estiba') ?>
			</ul>
		</div>
	</div>
	<!-- Begin Submit button -->
	<div class="col-md-12 mt-3">
		<button class="butn" type="submit"><span>Guardar</span></button>
	</div>
	<!-- End Submit button -->
</form>