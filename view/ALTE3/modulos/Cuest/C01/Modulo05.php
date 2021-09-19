<h4>SECCIÓN II. Caracterización de las prácticas productivas</h4>
<h4 class="text-success">Sector acuacultura</h4>
<?php echo $controlador_obj->getHTMLInfoLink('info_sec_2_cpp', 'Acerca de', 'Para cada uno de los sectores aplicables a su caso, a continuación, se le pide responder sobre las características de su unidad de producción. Las respuestas se utilizarán para estimar el nivel de emisiones de gases que contribuyen al cambio climático con fines de diagnóstico. Se le pide que responda con la verdad.'); ?>
<h5 class="text-info">Caracterización – actividad acuícola</h5>

<div class="row pl-3">
	<div class="col-md-12">
		<label>1. Por favor indique qué tipos de acuacultura realiza y en qué superficie</label>
		<div class="row pl-3">
			<div class="col-md-3">
				<label>Tipo</label>
			</div>
			<div class="col-md-2">
				<label>Superficie (hectáreas)</label>
			</div>
		</div>
		<?php for($i=1; $i<=4; $i++){?>
		<div class="row pl-3">
			<div class="col-md-3">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('acu_p1r'.$i.'_tipo', $controlador_obj->getCmpLlaveVal('acu_p1_tipo', $i));?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('acu_p1r'.$i.'_sup', 2); ?>
			</div>
		</div>
		<?php }?>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_acu_p1'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>2. ¿Qué especies cultiva bajo qué tecnología y cuál es su producción anual?</label>
		<div class="row pl-3">
			<div class="col-md-3">
				<label>Especie</label>
			</div>
			<div class="col-md-2">
				<label>Tecnología</label>
				<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Tecnología" data-id_info="#div_info_acu_p2"><i class="fas fa-info"></i></button>
			</div>
			<div class="col-md-2">
				<label>Producción</label>
			</div>
			<div class="col-md-2">
				<label>Unidad de medida</label>
			</div>
		</div>
		<?php for($i=1; $i<=15; $i++){?>
		<div class="row pl-3">
			<div class="col-md-3">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('acu_p2r'.$i.'_especie', $controlador_obj->getCmpLlaveVal('acu_p2_especie', $i));?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('acu_p2r'.$i.'_tec', 'acu_p2_tec') ?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('acu_p2r'.$i.'_prod', 2) ?>
			</div>
			<div class="col-md-2">
				<p>Toneladas/año</p>
			</div>
		</div>
			<?php if($i==15){?>
			<div class="row pl-3">
				<div class="col-md-3"><?php echo $controlador_obj->frm_al3->cmpTexto('acu_p2r'.$i.'_especie_esp', 'Especificar') ?></div>
			</div>
			<?php }?>
		<?php }?>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_acu_p2'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3" id="div_acu_p3">
	<div class="col-md-4">
		<label>3. Aplica fertilizante en su estanque</label>
		<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('acu_p3', 'no_si') ?>
		<div class="row pl-3" id="div_acu_p3_sub">
			<div class="col-md-8">
				<?php echo $controlador_obj->frm_al3->cmpNum('acu_p3_cant', 2, '¿Qué cantidad?'); ?>
			</div>
			<div class="col-md-4">
				<label></label>
				<p>kilogramos N/hectárea</p>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3" id="div_acu_p4">
	<div class="col-md-12">
		<label>4. Aplica cal en su estanque</label>
		<div class="row">
			<div class="col-md-4">
				<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('acu_p4', 'no_si') ?>
			</div>
		</div>
		<div class="row pl-3" id="div_acu_p4_sub">
			<div class="col-md-4">
				<?php echo $controlador_obj->frm_al3->cmpTexto('acu_p4_comp', '¿Qué compuesto con cal específicamente?'); ?>
			</div>
			<div class="col-md-5">
				<label>¿Qué cantidad?</label>
				<div class="row">
					<div class="col-md-4">
						<?php echo $controlador_obj->frm_al3->cmpNum('acu_p4_cant', 2); ?>
					</div>
					<div class="col-md-6">
						<p>kilogramos/hectárea</p>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>5. ¿Refrigera o congela el producto que produce?</label>
		<div class="row">
			<div class="col-md-4">
				<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('acu_p5', 'acu_p5') ?>
			</div>
		</div>
		<div id="div_acu_p5_sub">
			<div class="row pl-3">
				<div class="col-md-12">
					<p>Por favor responda</p>
				</div>
				<div class="col-md-4">
					<label>¿En qué año compro sus equipos de enfriamiento (refrigerador/ congelador)?</label>
				</div>
				<div class="col-md-4">
					<label>
						¿Cuál es la capacidad de sus equipos de enfriamiento?
						<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Capacidad" data-id_info="#div_info_acu_p5"><i class="fas fa-info"></i></button>
					</label>
					
				</div>
				<div class="col-md-4">
					<label>¿Qué refrigerante utiliza?</label>
				</div>
			</div>
			<div class="row pl-3">
				<div class="col-md-4">
					<?php echo $controlador_obj->frm_al3->cmpNum('acu_p5_anio', 0); ?>
				</div>
				<div class="col-md-2">
					<?php echo $controlador_obj->frm_al3->cmpNum('acu_p5_cap', 0); ?>
				</div>
				<div class="col-md-2">
					<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('acu_p5_cap_um', 'pes_p6_um'); ?>
				</div>
				<div class="col-md-4">
					<?php
					echo $controlador_obj->frm_al3->cmpCheckbox('acu_p5r1_ref', 'No sé');
					echo $controlador_obj->frm_al3->cmpCheckbox('acu_p5r2_ref', 'R404A');
					echo $controlador_obj->frm_al3->cmpCheckbox('acu_p5r3_ref', 'R507A');
					echo $controlador_obj->frm_al3->cmpCheckbox('acu_p5r4_ref', 'HFC134a');
					echo $controlador_obj->frm_al3->cmpCheckbox('acu_p5r5_ref', 'HCFC22');
					echo $controlador_obj->frm_al3->cmpCheckbox('acu_p5r6_ref', 'R-290');
					echo $controlador_obj->frm_al3->cmpCheckbox('acu_p5r7_ref', 'R-744');
					echo $controlador_obj->frm_al3->cmpCheckbox('acu_p5r8_ref', 'R-600a');
					echo $controlador_obj->frm_al3->cmpCheckbox('acu_p5r9_ref', 'Otro');
					echo $controlador_obj->frm_al3->validacionSinCmp('div_an_acu_p5');
					?>
					<div id="div_acu_p5r9_ref_sub">
						<?php echo $controlador_obj->frm_al3->cmpTexto('acu_p5r9_ref_esp', 'Especificar');?>
					</div>
				</div>
			</div>
		</div>
			
			
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>6. Por favor marque qué tipos de energía usa en la producción acuícola. En cada caso indique qué cantidad y en qué superficie de su unidad de producción.</label>
		<div class="row pl-3">
			<div class="col-md-3">
				<label>Tipo</label>
			</div>
			<div class="col-md-2">
				<label>Cantidad</label>
			</div>
			<div class="col-md-2">
				<label>Unidad de medida</label>
			</div>
			<div class="col-md-2">
				<label>Superficie</label>
			</div>
			<div class="col-md-2">
				<label>Unidad de medida</label>
			</div>
		</div>
		<?php for($i=1; $i<=5; $i++){?>
		<div class="row pl-3">
			<div class="col-md-3">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('acu_p6r'.$i.'_tipo', $controlador_obj->getCmpLlaveVal('acu_p6_tipo', $i));?>
			</div>
			<?php if($i!=5){?>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('acu_p6r'.$i.'_cat', 2); ?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->getCmpLlaveVal('acu_p6_um', $i); ?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('acu_p6r'.$i.'_sup', 2); ?>
			</div>
			<div class="col-md-2">
				<p>Hectáreas</p>
			</div>
			<?php }?>
		</div>
		<?php }?>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_acu_p6'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-6">
		<label>7. ¿En qué actividades o equipos consume energía para su producción acuícola?</label>
		<p class="small">Por favor seleccione las que apliquen de la siguiente lista</p>
		<?php
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r1', 'Aire acondicionado');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r2', 'Bombeo de agua');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r3', 'Calefacción');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r4', 'Aireación');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r5', 'Selección y/o empaque');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r6', 'Equipo de enfriamiento');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r7', 'Iluminación');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r8', 'Motores de lancha');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r9', 'Embarcación');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r10', 'Ventilación');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r11', 'Transporte');
		echo $controlador_obj->frm_al3->cmpCheckbox('acu_p7r12', 'Otro');
		echo $controlador_obj->frm_al3->validacionSinCmp('div_an_acu_p7');
		?>
		<div id="div_acu_p7r12_esp">
			<?php echo $controlador_obj->frm_al3->cmpTexto('acu_p7r12_esp', 'Especificar');?>
		</div>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>8. ¿Cómo maneja los residuos de pescado que genera?</label>
		<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('acu_p8', 'acu_p8') ?>
	</div>
</div>


<div class="row pl-3">
	<div class="col-md-12">
		<?php echo $controlador_obj->frm_al3->cmpTextArea('acu_comentarios', 'Observaciones/Comentarios para la sección actual') ?>
	</div>
</div>
<div id="div_info_acu_p2" style="display:none">
	<ul>
		<li><strong>Acuacultura extensiva:</strong> Involucra sistemas de producción con baja producción por unidad de volumen, generalmente basada en el aprovechamiento de la productividad natural o un mínimo aporte de sustancias artificiales  y un bajo nivel de tecnología e inversión muy baja por unidad de volumen cultivado.</li>
		<li><strong>Acuacultura semi-intensiva:</strong> La producción por unidad de volumen es mayor que en la extensiva. Esta requiere de aporte de alimentos y control de algunos paramentos ambientales, por lo que requiere utilizar tecnología y una mayor inversión enfocada principalmente a infraestructura y alimento.</li>
		<li><strong>Acuacultura intensiva:</strong> La producción por unidad de volumen es mucho mayor que la semi-intensiva. Es necesario el aporte de alimento, el control de distintas variables ambientales y enfermedades,  por lo tanto los costos de inversión son mucho mayores que se enfocan en alimento, infraestructura, y equipos.</li>
		<li><strong>Acuacultura hiperintensiva:</strong> La producción por unidad de volumen es la mayor en los cultivos acuícolas. Las variables son controladas en su mayoría, por lo cual se considera altamente tecnificada y un elevado  costo de operación.</li>
	</ul>	
</div>
<div id="div_info_acu_p5" style="display:none">
	<p>La capacidad de los congeladores se mide en litros. Los pequeños, de uso doméstico, son de 50 L, pero los hay de 100 y hasta más de 700 L. Por ejemplo, un congelador de 700 L mide aproximadamente 2 metros de largo, por 0.5 metros de ancho, por 0.6 metros de profundidad.</p>
</div>