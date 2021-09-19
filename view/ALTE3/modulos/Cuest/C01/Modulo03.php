<h4>Sección B</h4>
<h4 class="text-success">Sección con preguntas más extensas y complejas</h4>
<?php echo $controlador_obj->getHTMLInfoLink('info_sec_2_cpp', 'Acerca de', 'En esta sección podrán ver más ejemplos de preguntas. La funcionalidad es muy similar a la descrita y explicada en las secciones  Principal y Sección A. La principal diferencia es que se hace con opciones de pregunta más extensas y complejas'); ?>
<h5 class="text-info">Aquí los ejemplos con otras variantes de preguntas</h5>
<div class="row pl-3">
	<div class="col-md-12">
		<label>1. Habilitación de sub-secciones.</label>
		<?php for($i=1; $i<=6; $i++){?>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p2r'.$i.'_especie', $controlador_obj->getCmpLlaveVal('pec_especie_g1', $i));?>
				<div id="<?php echo 'div_pec_p2r'.$i.'_especie_sub'; ?>">
					<div class="row pl-3">
						<div class="col-md-7">
							<label>Para la especie 1</label>
							<div class="row">
								<div class="col-md-8">
									<label>Productos</label>
								</div>
								<div class="col-md-4">
									<label>Col 1. numérica</label>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<label>Col 2. numérica</label>
						</div>
						<div class="col-md-3">
							<label>Opciones</label>
							<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Productividad" data-id_info="#div_info_pec_p2"><i class="fas fa-info"></i></button>
						</div>
					</div>
					<?php foreach($controlador_obj->getArrCmpLlave('pec_hato_e'.$i) as $j=>$llave_val){?>
					<div class="row pl-3">
						<div class="col-md-7">
							<div class="row">
								<div class="col-md-8">
									<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p2r'.$i.'_'.$j.'_hato', $llave_val);?>
								</div>
								<div class="col-md-4">
									<?php echo $controlador_obj->frm_al3->cmpNum('pec_p2r'.$i.'_'.$j.'_cabe', 2);?>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<?php echo $controlador_obj->frm_al3->cmpNum('pec_p2r'.$i.'_'.$j.'_peso', 2);?>
						</div>
						<div class="col-md-3">
							<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p2r'.$i.'_'.$j.'_prod', 'pec_p2_e'.$i) ?>
							<?php if($i==2){
								echo $controlador_obj->frm_al3->cmpNum('pec_p2r'.$i.'_'.$j.'_prod_d', 0, 'Días de ordeña al año');
							}
							?>
						</div>
					</div>
					<?php }?>
					<div class="row pl-3">
						<div class="col-md-12">
							<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p2r'.$i.'_hato'); ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php }?>
		<?php for($i=7; $i<=15; $i++){?>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p2r'.$i.'_especie', $controlador_obj->getCmpLlaveVal('pec_especie_g2', $i));?>
				<div id="<?php echo 'div_pec_p2r'.$i.'_especie_sub'; ?>">
					<div class="row pl-3">
						<div class="col-md-3">
						<?php 
						if($i==15){
							echo $controlador_obj->frm_al3->cmpTexto('pec_p2r15_especie_esp', 'Especificar');
						}
						?>
						</div>
					</div>
					<div class="row pl-3">
						<div class="col-md-2">
							<label>Cabezas</label>
						</div>
						<div class="col-md-2">
							<label>Peso promedio (kilogramos/cabeza)</label>
						</div>
						<div class="col-md-3">
							<label>Productividad</label>
						</div>
					</div>
					<div class="row pl-3">
						<div class="col-md-2">
							<?php echo $controlador_obj->frm_al3->cmpNum('pec_p2r'.$i.'_cabe', 2);?>
						</div>
						<div class="col-md-2">
							<?php echo $controlador_obj->frm_al3->cmpNum('pec_p2r'.$i.'_peso', 2);?>
						</div>
						<div class="col-md-3">
							<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p2r'.$i.'_prod', 'pec_p2_e7_15') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p2'); ?>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>2. Habilitación de renglones</label>
		<div class="row pl-3">
			<div class="col-md-4">
				<label>Aplica renglón</label>
			</div>
			<div class="col-md-1">
				<label>Cantidad</label>
			</div>
			<div class="col-md-2">
				<label>Unidad de medida</label>
			</div>
			<div class="col-md-1">
				<label>Cantidad</label>
			</div>
			<div class="col-md-2">
				<label>Unidad de medida</label>
			</div>
		</div>
		<?php for($i=1; $i<=10; $i++){?>
		<div class="row pl-3">
			<div class="col-md-4">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p3r'.$i.'_t_ene', $controlador_obj->getCmpLlaveVal('pec_t_ene', $i));?>
			</div>
			<?php if($i!=10){?>
			<div class="col-md-1">
				<?php echo $controlador_obj->frm_al3->cmpNum('pec_p3r'.$i.'_cant', 2);?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->getCmpLlaveVal('pec_p3_um', $i); ?>
			</div>
			<div class="col-md-1">
				<?php echo $controlador_obj->frm_al3->cmpNum('pec_p3r'.$i.'_sup', 2);?>
			</div>
			<div class="col-md-2">
				<p>Hectáreas</p>
			</div>
			<?php }?>
		</div>
		<?php }?>
		<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p3'); ?>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>4. ¿En qué actividades o equipos consume energía para su producción pecuaria?</label>
		<span class="small">Por favor seleccione todas las opciones que apliquen de la siguiente lista</span>
		<?php for($i=1; $i<=13; $i++){?>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p4r'.$i, $controlador_obj->getCmpLlaveVal('pec_p4', $i));?>
			</div>
		</div>
		<?php }?>
		<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p4'); ?>
		<div class="row pl-3">
			<div class="col-md-3">
				<?php echo $controlador_obj->frm_al3->cmpTexto('pec_p4r13_esp', 'Especificar'); ?>
			</div>
		</div>
	</div>
</div>
<h5 class="text-info">Fermentación entérica</h5>
<div class="row pl-3" id="div_pec_p5">
	<div class="col-md-12">
		<label>5. Alimentación del hato</label>
		<div class="row pl-3" id="div_pec_p5_sec_A">
			<div class="col-md-12">
				<label>¿Dónde se alimentan?</label>
			</div>
			<?php for($i=1; $i<=4; $i++){?>
			<div class="col-md-12" >
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r'.$i.'_donde', $controlador_obj->getCmpLlaveVal('pec_p5_donde', $i));?>
				<div id="<?php echo 'div_pec_p5r'.$i.'_donde_sub'; ?>">
					<?php if($i==4){?>
					<div class="row pl-3">
						<div class="col-md-6">
							<?php echo $controlador_obj->frm_al3->cmpTexto('pec_p5r'.$i.'_donde_esp', 'Especificar'); ?>
						</div>
					</div>
					<?php }?>
					<div class="row pl-3">
						<div class="col-md-6">
							<label>¿Qué alimento consume principalmente el ganado según la temporada?</label>
							<div class="row">
								<div class="col-md-6">
									<label>Lluvias</label>
								</div>
								<div class="col-md-6">
									<label>Secas</label>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<label>¿Cuál es el porcentaje de forraje en la dieta en todo el año?</label>
						</div>
					</div>
					<div class="row pl-3">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p5r'.$i.'_lluvia', 'pec_p5_lluv') ?>
								</div>
								<div class="col-md-6">
									<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p5r'.$i.'_secas', 'pec_p5_sec') ?>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p5r'.$i.'_dieta', 'pec_p5_diet') ?>
						</div>
					</div>
				</div>	
			</div>
			<?php }?>
			<div class="col-md-12" >
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p5_a'); ?>
			</div>
		</div><!-- /#div_pec_p5_sec_A -->
		<div class="row pl-3" id="div_pec_p5_sec_B">
			<div class="col-md-12">
				<label>Por favor, de las siguientes opciones, seleccione las aplicables a su unidad de producción:</label>
				<div class="row pl-3">
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r4', 'Las hembras en gestación están estabuladas durante último trimestre');?>
					</div>
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r5', 'Los animales pastorean');?>
						<div class="row pl-3" id="div_pec_p5r5_sub">
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r5_1', 'En terreno plano');?>
							</div>
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r5_2', 'En lomas suaves');?>
							</div>
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r5_3', 'En lomeríos');?>
							</div>
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r5_4', 'En terreno montañoso');?>
							</div>
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r5_5', 'En tierras bajas o cercanas al nivel del mar');?>
							</div>
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r5_6', 'Otro');?>
							</div>
							<div class="col-md-4">
								<?php echo $controlador_obj->frm_al3->cmpTexto('pec_p5r5_6_esp', 'Especificar'); ?>
							</div>
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p5r5'); ?>
							</div>
							<div class="col-md-12">
								<div class="row pl-3">
									<div class="col-md-6">
										<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p5r5_3_1', 'pec_p5r5_3_1', '¿Qué distancia promedio caminan los animales durante un día?') ?>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p5r6', 'Los animales comen en su corral o establo');?>
					</div>
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p5_b'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3" id="div_pec_p6">
	<div class="col-md-12">
		<div id="div_pec_p6_tit">
			<label>6. ¿Cuál es su producción promedio diaria de leche?</label>
			<div class="row pl-3">
				<div class="col-md-3">
					<label></label>
				</div>
				<div class="col-md-2">
					<label>Producción de leche (Litros leche/día)</label>
				</div>
			</div>
		</div>
		<?php for($i=1; $i<=4; $i++){?>
		<div class="row pl-3" id="<?php echo 'div_pec_p6r'.$i; ?>">
			<div class="col-md-3">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p6r'.$i.'_espe', $controlador_obj->getCmpLlaveVal('pec_p6_espe', $i));?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('pec_p6r'.$i.'_prod', 2) ?>
			</div>
		</div>
		<?php }?>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p6'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3" id="div_pec_p7">
	<div class="col-md-12">
		<div id="div_pec_p7_tit">
			<label>7. ¿Qué porcentaje de las hembras en el hato tienen crías durante el año y cuántas  crías tienen en promedio?</label>
			<div class="row pl-3">
				<div class="col-md-3">
					<label></label>
				</div>
				<div class="col-md-2">
					<label>Porcentaje de las hembras que pasa por gestación (que tiene crías)</label>
				</div>
				<div class="col-md-2">
					<label>Número promedio de crías por hembra</label>
				</div>
			</div>
		</div>
		<?php for($i=1; $i<=8; $i++){?>
		<div class="row pl-3" id="<?php echo 'div_pec_p7r'.$i; ?>">
			<div class="col-md-3">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p7r'.$i.'_espe', $controlador_obj->getCmpLlaveVal('pec_p7_espe', $i));?>
			</div>
			<div class="col-md-1">
				<?php echo $controlador_obj->frm_al3->cmpNum('pec_p7r'.$i.'_porc', 0) ?>
			</div>
			<div class="col-md-1">
				<p>%</p>
			</div>
			<?php if($i>=4){?>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('pec_p7r'.$i.'_crias', 0) ?>
			</div>
			<?php }?>
		</div>
		<?php }?>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p7'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3" id="div_pec_p8">
	<div class="col-md-12">
		<label>8. ¿Cuál es la edad de destete de las crías en el hato?</label>
		<div class="row pl-3">
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('pec_p8', 0) ?>
			</div>
			<div class="col-md-2">
				meses
			</div>
		</div>
	</div>
</div>
<div class="row pl-3" id="div_pec_p9">
	<div class="col-md-12">
		<label>9. ¿Cuál es su producción anual de lana? (ya seca, antes de limpiarla)</label>
		<div class="row pl-3">
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('pec_p9', 0) ?>
			</div>
			<div class="col-md-2">
				kilogramos/año
			</div>
		</div>
	</div>
</div>
<div class="row pl-3" id="div_pec_p10">
	<div class="col-md-12">
		<div id="div_pec_p10_tit">
			<label>10. ¿Cuánto tiempo trabajan sus animales haciendo tracción?</label>
			<div class="row pl-3">
				<div class="col-md-4">
					<label></label>
				</div>
				<div class="col-md-2">
					<label>Horas al día</label>
				</div>
				<div class="col-md-2">
					<label>Días en el año</label>
				</div>
			</div>
		</div>
		<?php for($i=1; $i<=3; $i++){?>
		<div class="row pl-3" id="<?php echo 'div_pec_p10r'.$i; ?>">
			<div class="col-md-4">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p10r'.$i.'_espe', $controlador_obj->getCmpLlaveVal('pec_10_espe', $i));?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('pec_p10r'.$i.'_h_dia', 0) ?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('pec_p10r'.$i.'_d_anio', 0) ?>
			</div>
		</div>
		<?php }?>
		<div class="row pl-3" id="div_pec_p10r4">
			<div class="col-md-4">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p10r4_espe', $controlador_obj->getCmpLlaveVal('pec_10_espe', 4));?>
			</div>
		</div>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p10'); ?>
			</div>
		</div>
	</div>
</div>
<h5 class="text-info">Manejo de excretas</h5>
<div class="row pl-3">
	<div class="col-md-12">
		<label>11. ¿Cómo maneja las excretas de su hato?</label>
		<div class="row pl-3">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<label>Método de manejo</label>
						<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Método de manejo" data-id_info="#div_info_pec_p11"><i class="fas fa-info"></i></button>
					</div>
					<div class="col-md-3">
						<label>Porcentaje de las excretas</label>
						<p class="small">(debe sumar 100%)</p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r1', 'Laguna anaeróbica descubierta');?>
				<div class="row" id="div_pec_p11r1_sub">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r1_porc', 0) ?>
					</div>
					<div class="col-md-1">
						<p>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r2', 'Almacenamiento en líquido debajo del piso de confinamiento de los animales');?>
				<div id="div_pec_p11r2_sub">
					<div class="row">
						<div class="col-md-3">
							<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p11r2_p', 'pec_p11r2_p');?>
						</div>
						<div class="col-md-2">
							<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r2_porc', 0) ?>
						</div>
						<div class="col-md-1">
							<p>%</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r3', 'Camas profundas para bovinos y porcinos');?>
				<div id="div_pec_p11r3_sub">
					<div class="row">
						<div class="col-md-3">
							<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p11r3_p', 'pec_p11r3_p');?>
						</div>
						<div class="col-md-2">
							<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r3_porc', 0) ?>
						</div>
						<div class="col-md-1">
							<p>%</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r4', 'Almacenamiento sólido del orden de meses');?>
				<div id="div_pec_p11r4_sub">
					<div class="row">
						<div class="col-md-3">
							<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p11r4_p', 'pec_p11r4_p');?>
						</div>
						<div class="col-md-2">
							<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r4_porc', 0) ?>
						</div>
						<div class="col-md-1">
							<p>%</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r5', 'Lote seco que se remueve periódicamente');?>
				<div class="row" id="div_pec_p11r5_sub">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r5_porc', 0) ?>
					</div>
					<div class="col-md-1">
						<p>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r6', 'Dispersión diaria en campo');?>
				<div class="row" id="div_pec_p11r6_sub">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r6_porc', 0) ?>
					</div>
					<div class="col-md-1">
						<p>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r7', 'Composteo');?>
				<div id="div_pec_p11r7_sub">
					<div class="row">
						<div class="col-md-3">
							<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p11r7_p', 'pec_p11r7_p');?>
						</div>
						<div class="col-md-2">
							<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r7_porc', 0) ?>
						</div>
						<div class="col-md-1">
							<p>%</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r8', 'Sin manejo, se quedan en campo: Pastizal/ Agostadero/ Potrero');?>
				<div class="row" id="div_pec_p11r8_sub">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r8_porc', 0) ?>
					</div>
					<div class="col-md-1">
						<p>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r9', 'Cama de excretas de aves de corral que se limpia entre ciclos productivos');?>
				<div class="row" id="div_pec_p11r9_sub">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r9_porc', 0) ?>
					</div>
					<div class="col-md-1">
						<p>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r10', 'Tratamiento aeróbico');?>
				<div class="row" id="div_pec_p11r10_sub">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r10_porc', 0) ?>
					</div>
					<div class="col-md-1">
						<p>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r11', 'Quemado como combustible');?>
				<div class="row" id="div_pec_p11r11_sub">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r11_porc', 0) ?>
					</div>
					<div class="col-md-1">
						<p>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pec_p11r12', 'Digestor anaerobio');?>
				<div id="div_pec_p11r12_sub">
					<div class="row">
						<div class="col-md-3">
							<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p11r12_p', 'pec_p11r12_p');?>
						</div>
						<div class="col-md-2">
							<?php echo $controlador_obj->frm_al3->cmpNum('pec_p11r12_porc', 0) ?>
						</div>
						<div class="col-md-1">
							<p>%</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p11'); ?>
			</div>
			<div class="col-md-12">
				<div class="row pl-3">
					<div class="col-md-3"  style="text-align: right;">
						Total
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpOculto('pec_p11_tot', $controlador_obj->getCampoValor('pec_p11_tot')) ?>
						<div id="<?php echo 'div_pec_p11_tot';?>" style="text-align: right;"><?php echo $controlador_obj->getCampoValor('pec_p11_tot')?></div>
						<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pec_p11_tot'); ?>
					</div>
					<div class="col-md-1">
						<p>%</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>12. Por favor indique las principales especies o nombres de árboles en su unidad de producción, su número, el diámetro del tronco a una altura de 1.5m y, si es posible, la altura promedio o los años que tiene cada especie en su predio.</label>
		<p class="small">Solo para el caso de forma de producción silvopastoril o agrosilvopastoril.</p>
		<div class="row pl-3">
			<div class="col-md-4"><label>Especies</label></div>
			<div class="col-md-1"><label>Número de árboles</label></div>
			<div class="col-md-1"><label>Diámetro</label></div>
			<div class="col-md-2"><label>Unidad de medida</label></div>
			<div class="col-md-1"><label>Altura o edad</label></div>
			<div class="col-md-2"><label>Unidad de medida</label></div>
		</div>
		<?php for($i=1; $i<=6; $i++){?>
		<?php if($i==6){?>
		<div class="row pl-3">
			<div class="col-md-4">Otros: ¿cuáles?</div>
		</div>
		<?php }?>
		<div class="row pl-3">
			<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpTexto('pec_p12r'.$i.'_especie'); ?></div>
			<div class="col-md-1"><?php echo $controlador_obj->frm_al3->cmpNum('pec_p12r'.$i.'_num', 0); ?></div>
			<div class="col-md-1"><?php echo $controlador_obj->frm_al3->cmpNum('pec_p12r'.$i.'_diam', 2); ?></div>
			<div class="col-md-2"><p>Centímetros</p></div>
			<div class="col-md-1"><?php echo $controlador_obj->frm_al3->cmpNum('pec_p12r'.$i.'_altu', 2); ?></div>
			<div class="col-md-2"><?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pec_p12r'.$i.'_um', 'pec_p12_um');?></div>
		</div>
		<?php }?>
		<div class="row pl-3">
			<p class="small">Nota: por favor, considere que, si su producción es silvopastoril o agrosilvopastoril, se le ruega que complete la sección “agricultura” de este cuestionario, en caso de que no lo haya hecho ya. ¡Muchas gracias!</p>
		</div>
	</div>
</div>

<div class="row pl-3">
	<div class="col-md-12">
		<?php echo $controlador_obj->frm_al3->cmpTextArea('pec_comentarios', 'Observaciones/Comentarios para la sección actual') ?>
	</div>
</div>
<div id="div_info_pec_p2" style="display:none">
	<p>El valor de productividad es un aproximado. Por favor seleccione la opción que sea más cercana a su situación particular.</p>
</div>
<div id="div_info_pec_p11" style="display:none">
	<ul>
		<li><strong>Laguna anaerobia descubierta:</strong> es un tipo de sistema de almacenamiento en líquido diseñado para combinar los procesos de estabilización y almacenamiento de las excretas. El agua flotante de la superficie puede ser reutilizada para operaciones de enjuague o para irrigación de campos.</li>
		<li><strong>Almacenamiento en líquido debajo del sitio de confinamiento:</strong> se refiere a la recolección y almacenamiento con poca o ninguna agua agregada, típicamente debajo de un piso de rejilla, generalmente por períodos menores a un año. Las excretas se pueden bombear fuera del almacenamiento a un tanque secundario o se pueden almacenar y aplicar directamente a los campos. </li>
		<li><strong>Cama profunda:</strong> a medida que las excretas se acumulan, se agrega material orgánico continuamente para absorber la humedad durante un ciclo de producción y posiblemente hasta por 6 a 12 meses. Este sistema de manejo también se conoce como “en lechos” y puede combinarse con el de lote seco. Hay periodos en que los que los animales son parte del sistema de manejo y mezclan activamente las excretas, y períodos en los que no se toca la cama.</li>
		<li>
			<strong>Almacenamiento sólido:</strong> las excretas se almacenan por un periodo típico del orden de meses en forma de pilas.
			<ul>
				<li>Puede hacerse así por la adición de material para formar camas en los corrales y por la pérdida de humedad por evaporación.</li>
				<li>Otra manera es similar al anterior, pero la pila se cubre con plástico para reducir la superficie expuesta al ambiente y/o se compacta para aumentar la densidad y reducir el espacio libre, lleno de aire, entre el material. </li>
				<li>También hay almacenamiento sólido con agentes de aglutinamiento, donde las excretas se mezclan con materiales especiales para darle soporte estructural. Esto permite la aeración natural en la pila, promoviendo su descomposición. El material puede ser residuo de cultivos, como esquilmos, hojarasca, paja, etc.</li>
				<li>Y hay almacenamiento sólido con aditivos, donde se añaden sustancias específicas para reducir emisiones gaseosas. La adición de atapulgita, diciandiamida e incluso composta madura han demostrado la reducción de emisiones de N2O. Asimismo, la adición de fosfoyeso reduce las emisiones de CH4.</li>
			</ul>
		</li>
		<li><strong>Lote seco:</strong> ocurre en un espacio de confinamiento abierto pavimentado o no, sin cubierta vegetativa. Este sistema no requiere que se añada material adicional para controlar la humedad. Las excretas pueden removerse periódicamente y aplicarse a los campos de cultivo.</li>
		<li><strong>Dispersión diaria:</strong> como rutina, las excretas se retiran de las instalaciones de confinamiento y se dispersan en campos de cultivo o de pastizal en un lapso de alrededor de 24 horas desde la excreción.</li>
		<li><strong>Composteo:</strong> se trata de la descomposición de las excretas en condiciones aerobias. Puede hacerse por diferentes métodos: en contenedor con aireación forzada utilizando alguna especie de soplador, o ser de pasiva según la corriente de aire natural.</li>
		<li><strong>Sin manejo:</strong> las excretas se quedan en el  Pastizal/ Agostadero/ Potrero dispersas según el movimiento de los animales, no se manejan.</li>
		<li><strong>Camas de excretas de aves de corral:</strong> se deja durante todo el ciclo de producción y se limpia entre ciclos.</li>
		<li><strong>Tratamiento aeróbico:</strong> las excretas se tratan con aireación natural o forzada. La aireación natural se limita a estanques y sistemas de humedales aerobios y facultativos y se debe principalmente a la fotosíntesis. Por lo tanto, estos sistemas generalmente se vuelven anóxicos durante los períodos sin luz solar.</li>
		<li><strong>Quema como combustible:</strong> las excretas y orina que los animales dejan en los pastos se seca con el sol y el ambiente, y posteriormente se colecta y se usa como combustible.</li>
		<li><strong>Digestor anaerobio:</strong> se utiliza para producir biogás. Pueden ser sistemas de alta calidad y bajos en fugas, o con alto nivel de fugas. El biogás se captura y se utiliza como combustible, o se quema.</li>		
	</ul>
</div>