<h4>Sección A</h4>
<h4 class="text-success">Título: Opciones expandibles</h4>
<?php echo $controlador_obj->getHTMLInfoLink('info_sec_2_cpp', 'Acerca de', 'En esta sección se muestran diferentes formas de desplegar preguntas'); ?>
<h5 class="text-info">Subtítulo: [Ejemplo de formato de texto para subtítulos]</h5>
<div class="row pl-3">
	<div class="col-md-12">
		<label>1. Pregunta ramificada.</label>
		<p class="small">Ejemplo de pregunta con secciones ocultas que se despliegan hasta que se selecciona la opción principal. El enramado puede tener tantos niveles como sean requeridos, considerando la limitación en cuanto a la resolución de la pantalla promedio.</p>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r1', 'Opción 1');?>
				<div class="row pl-3" id="div_agr_p1r1_sub">
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r1_1', 'Opción 1.1');?>
						<div class="row pl-3" id="div_agr_p1r1_1_sub">
							<div class="col-md-2">
								<?php echo $controlador_obj->frm_al3->cmpNum('agr_p1r1_1_has', 2, 'Campo numérico');?>
							</div>
							<div class="col-md-6">
								<label>Campo de tipo select</label>
								<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Información" data-id_info="#div_info_agr_p2"><i class="fas fa-info"></i></button>
								<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p2r1_1', 'agr_p2');?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r1_2', 'Opción 1.2');?>
						<div class="row pl-3" id="div_agr_p1r1_2_sub">
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r1_2_1', 'Opción 1.2.1');?>
								<div class="row pl-3" id="div_agr_p1r1_2_1_sub">
									<div class="col-md-2">
										<?php echo $controlador_obj->frm_al3->cmpNum('agr_p1r1_2_1_has', 2, 'Campo numérico');?>
									</div>
									<div class="col-md-6">
										<label>Campo de tipo select</label>
										<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Información" data-id_info="#div_info_agr_p2"><i class="fas fa-info"></i></button>
										<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p2r1_2_1', 'agr_p2');?>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r1_2_2', 'Opción 1.2.2');?>
								<div class="row pl-3" id="div_agr_p1r1_2_2_sub">
									<div class="col-md-2">
										<?php echo $controlador_obj->frm_al3->cmpNum('agr_p1r1_2_2_has', 2, 'Campo numérico');?>
									</div>
									<div class="col-md-6">
										<label>Campo de tipo select</label>
										<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Información" data-id_info="#div_info_agr_p2"><i class="fas fa-info"></i></button>
										<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p2r1_2_2', 'agr_p2');?>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r1_2_3', 'Opción 1.2.3');?>
								<div class="row pl-3" id="div_agr_p1r1_2_3_sub">
									<div class="col-md-2">
										<?php echo $controlador_obj->frm_al3->cmpNum('agr_p1r1_2_3_has', 2, 'Campo numérico');?>
									</div>
									<div class="col-md-6">
										<label>Campo de tipo select</label>
										<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Información" data-id_info="#div_info_agr_p2"><i class="fas fa-info"></i></button>
										<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p2r1_2_3', 'agr_p2');?>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_agr_p1r1_2_N'); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_agr_p1r1_N'); ?>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r2', 'Opción 2');?>
				<div class="row pl-3" id="div_agr_p1r2_sub">
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r2_1', 'Opción 2.1');?>
						<div class="row pl-3" id="div_agr_p1r2_1_sub">
							<div class="col-md-2">
								<?php echo $controlador_obj->frm_al3->cmpNum('agr_p1r2_1_has', 2, 'Campo numérico');?>
							</div>
							<div class="col-md-6">
								<label>Campo de tipo select</label>
								<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Información" data-id_info="#div_info_agr_p2"><i class="fas fa-info"></i></button>
								<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p2r2_1', 'agr_p2');?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r2_2', 'Opción 2.2');?>
						<div class="row pl-3" id="div_agr_p1r2_2_sub">
							<div class="col-md-2">
								<?php echo $controlador_obj->frm_al3->cmpNum('agr_p1r2_2_has', 2, 'Campo numérico');?>
							</div>
							<div class="col-md-6">
								<label>Campo de tipo select</label>
								<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Información" data-id_info="#div_info_agr_p2"><i class="fas fa-info"></i></button>
								<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p2r2_2', 'agr_p2');?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p1r2_3', 'Opción 2.3');?>
						<div class="row pl-3" id="div_agr_p1r2_3_sub">
							<div class="col-md-2">
								<?php echo $controlador_obj->frm_al3->cmpNum('agr_p1r2_3_has', 2, 'Campo numérico');?>
							</div>
							<div class="col-md-6">
								<label>Campo de tipo select</label>
								<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Información" data-id_info="#div_info_agr_p2"><i class="fas fa-info"></i></button>
								<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p2r2_3', 'agr_p2');?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_agr_p1r2_N'); ?>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_agr_p1rN'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>2. Pregunta con habilitación de renglones</label>
		<p class="small">Ejemplo de pregunta dividida en renglones que se habilitan al seleccionar la opción de la primera columna</p>
		<div class="row pl-3">
			<div class="col-md-4"><label>Aplica renglón</label></div>
			<div class="col-md-2"><label>Cantidad 1</label></div>
			<div class="col-md-2"><label>Unidad de Medida</label></div>
			<div class="col-md-2"><label>Cantidad 2</label></div>
			<div class="col-md-2"><label>Unidad de Medida</label></div>
		</div>
		<?php foreach($controlador_obj->getArrCmpLlave('agr_p5rN_tipo') as $i=>$llave_val){?>
		<div class="row pl-3">
			<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p5r'.$i.'_tipo', $llave_val);?></div>
			<div class="col-md-2" id="<?php echo 'div_agr_p5r'.$i.'_cantidad' ?>"><?php echo $controlador_obj->frm_al3->cmpNum('agr_p5r'.$i.'_cantidad', 2);?></div>
			<div class="col-md-2"><?php echo $controlador_obj->getCmpLlaveVal('agr_p5rN_um', $i); ?></div>
			<div class="col-md-2" id="<?php echo 'div_agr_p5r'.$i.'_sup' ?>"><?php echo $controlador_obj->frm_al3->cmpNum('agr_p5r'.$i.'_sup', 2);?></div>
			<div class="col-md-2"><p>Hectáreas</p></div>
		</div>
		<?php }?>
		<div class="row pl-3">
			<div class="col-md-6"><?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p5r10_tipo', 'No aplica');?></div>
			<div class="col-md-2"></div>
			<div class="col-md-2"></div>
		</div>
		<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_agr_p5'); ?>
	</div>
</div>


<div class="row pl-3">
	<div class="col-md-12">
		<label>3. Continuidad de opciones entre preguntas.</label>
		<p class="small">Modalidad para dividir en dos preguntas un bloque de campos o sub-preguntas que tienen continuidad, pero su estructura de llenado es distinta. Además permite desplegar en la segunda pregunta (pregunta 4), aquellos módulos seleccionados en los campos checkbox de la primera columna de la pregunta 3.</p>
		<div class="row pl-3">
			<div class="col-md-6"><label>Pregunta</label></div>
			<div class="col-md-2"><label>Cantidad 1</label></div>
			<div class="col-md-2"><label>Cantidad 2</label></div>
		</div>
		<?php foreach($controlador_obj->getArrCmpLlave('tipo_cultivo') as $i=>$llave_val){?>
		<div class="row pl-3">
			<div class="col-md-6"><?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p3r'.$i.'_cultivo', $llave_val);?></div>
			<div class="col-md-2" id="<?php echo 'div_agr_p3r'.$i.'_cantidad' ?>"><?php echo $controlador_obj->frm_al3->cmpNum('agr_p3r'.$i.'_cantidad', 2);?></div>
			<div class="col-md-2" id="<?php echo 'div_agr_p3r'.$i.'_sup' ?>"><?php echo $controlador_obj->frm_al3->cmpNum('agr_p3r'.$i.'_sup', 2);?></div>
		</div>
			<?php if($i==7 || $i==16){?>
			<div class="row pl-3">
				<div class="col-md-6"><?php echo $controlador_obj->frm_al3->cmpTexto('agr_p3r'.$i.'_cultivo_esp', 'Especificar') ?></div>
			</div>
			<?php }?>
		<?php }?>
		<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_agr_p3'); ?>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>4. Continuación de la pregunta 3</label>
		<p class="small">
			Secciones desplegadas a partir de lo seleccionado en la pregunta 2
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Opciones de manejo" data-id_info="#div_info_agr_p7_n1"><i class="fas fa-info"></i></button>
		</p>
		
		<?php for($i=1; $i<=4; $i++){?>
		<div class="row pl-3" id="<?php echo 'div_agr_p7r'.$i ?>">
			<div class="col-md-12">
				<span>Para la opción: </span>
				<label><?php echo $controlador_obj->getCmpLlaveVal('tipo_cultivo', $i); ?></label>
				<div class="row pl-3">
					<div class="col-md-6">
						<label>Detalle</label>
						<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Formas de manejo de los residuos de la parcela" data-id_info="#div_info_agr_p7_n2"><i class="fas fa-info"></i></button>
					</div>
					<div class="col-md-2">
						<label>Porcentaje</label>
						<p class="small">Debe sumar 100%</p>
					</div>
				</div>
				<?php for($j=1; $j<=5; $j++){?>
				<div class="row pl-3">
					<div class="col-md-6"><?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p7r'.$i.'_'.$j.'_pago', $controlador_obj->getCmpLlaveVal('agr_p7_pago', $j));?></div>
					<div class="col-md-2"><?php echo $controlador_obj->frm_al3->cmpNum('agr_p7r'.$i.'_'.$j.'_prop', 0);?></div>
				</div>
				<?php }?>
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_agr_p7r'.$i); ?>
				<div class="row pl-3">
					<div class="col-md-6"><?php echo $controlador_obj->frm_al3->cmpTexto('agr_p7r'.$i.'_10_pago_esp', '') ?></div>
				</div>
				<div class="row pl-3">
					<div class="col-md-6 float-end" style="text-align: right;">Total</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpOculto('agr_p7r'.$i.'_tot', $controlador_obj->getCampoValor('agr_p7r'.$i.'_tot'));?>
						<div id="<?php echo 'div_agr_p7r'.$i.'_tot';?>" style="text-align: right;"><?php echo $controlador_obj->getCampoValor('agr_p7r'.$i.'_tot'); ?></div>
						<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_agr_p7r'.$i.'_tot'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>5. ¿Desplegar renglones de opciones?</label>
		<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p10_aplico', 'no_si');?>
		<div class="row pl-3" id="div_agr_p10_sub">
			<div class="col-md-12">
				<span class="small">Marque todas las opciones que apliquen.</span>
				<div class="row pl-3">
					<div class="col-md-2">
						<label>Aplica renglón</label>
					</div>
					<div class="col-md-3">
						<label>Descripción</label>
					</div>
					<div class="col-md-1">
						<label>Cantidad 1</label>
					</div>
					<div class="col-md-1">
						<label>Cantidad 2</label>
					</div>
					<div class="col-md-2">
						<label>Unidad de Medida</label>
					</div>
					<div class="col-md-1">
						<label>Cantidad 3</label>
					</div>
					<div class="col-md-2">
						<label>Unidad de Medida</label>
					</div>
				</div>
				<?php foreach($controlador_obj->getArrCmpLlave('agr_p10_aq') as $i=>$llave_val){?>
				<div class="row pl-3">
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpCheckbox('agr_p10r'.$i.'_t_ag', $llave_val);?>
					</div>
					<div class="col-md-3">
						<?php echo $controlador_obj->frm_al3->cmpTexto('agr_p10r'.$i.'_nom') ?>
					</div>
					<div class="col-md-1">
						<?php echo $controlador_obj->frm_al3->cmpNum('agr_p10r'.$i.'_sup', 2) ?>
					</div>
					<div class="col-md-1">
						<?php echo $controlador_obj->frm_al3->cmpNum('agr_p10r'.$i.'_cant', 2) ?>
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p10r'.$i.'_um', 'agr_p10_um');?>
					</div>
					<div class="col-md-1">
						<?php echo $controlador_obj->frm_al3->cmpNum('agr_p10r'.$i.'_n_vez', 0) ?>
					</div>
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('agr_p10r'.$i.'_met', 'agr_p10_met');?>
					</div>
				</div>
				<?php }?>
				<div class="row pl-3">
					<div class="col-md-2">
						<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_agr_p10'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row pl-3">
	<div class="col-md-12">
		<?php echo $controlador_obj->frm_al3->cmpTextArea('agr_comentarios', 'Cuadro de texto') ?>
	</div>
</div>
<!-- Elementos div contenedores de la información a mostrar en las ventanas modal informativas -->
<div id="div_info_agr_p2" style="display:none">
	<p></p>
	<ul>
		<li><strong>Phasellus imperdiet orci eget enim rutrum.</strong> Cras egestas libero ac eros pharetra vulputate a ac libero.</li>
		<li><strong>Suspendisse lacinia velit at nunc venenatis.</strong> Donec id diam eu est molestie iaculis.</li>
		<li><strong>Nam tincidunt urna volutpat porta porttitor.</strong> Praesent mollis leo malesuada tellus ultrices fermentum.</li>
		<li><strong>Nunc viverra turpis eget risus feugiat</strong> Pellentesque vel magna laoreet, pellentesque tellus sed, suscipit turpis.</li>
		<li><strong>Ut eu nulla et mi tincidunt faucibus</strong> Integer interdum mauris ut elit scelerisque, vel consectetur ex interdum.</li>
	</ul>
</div>
<div id="div_info_agr_p7_n1" style="display:none">
	<p>Ventanas de ayuda para mostrar información más detalla respecto a la pregunta o alguna de sus secciones:</p>
</div>
<div id="div_info_agr_p7_n2" style="display:none">
	<p>Por favor considere las siguientes definiciones de los métodos de manejo:</p>
	<ul>
		<li><strong>Nunc viverra turpis eget risus feugiat</strong> Pellentesque vel magna laoreet, pellentesque tellus sed, suscipit turpis.</li>
		<li><strong>Suspendisse lacinia velit at nunc venenatis</strong> Donec id diam eu est molestie iaculis.</li>
		<li><strong>Phasellus imperdiet orci eget enim rutrum</strong> Cras egestas libero ac eros pharetra vulputate a ac libero.</li>
		<li><strong>Ut eu nulla et mi tincidunt faucibus</strong> Integer interdum mauris ut elit scelerisque, vel consectetur ex interdum.</li>
		<li><strong>Nam tincidunt urna volutpat porta porttitor</strong> Praesent mollis leo malesuada tellus ultrices fermentum.</li>
	</ul>
</div>
<div id="div_info_agr_p8" style="display:none">
	<p>Hay muchos tipos de fertilizantes o abonos. Aquí se ofrece una lista de algunos que son comunes. La N se refiere a nitrógeno, la P a fósforo, y la K a potasio.</p>
	<p>Si usted no sabe o no recuerda qué fertilizante aplicó, puede seleccionar la casilla de “otro” y mencionar que no sabe. Ojalá sea posible que sí recuerde cuánto aplicó.</p>
</div>
