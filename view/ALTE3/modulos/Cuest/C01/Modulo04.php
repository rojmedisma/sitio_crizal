<h4>SECCIÓN II. Caracterización de las prácticas productivas</h4>
<h4 class="text-success">Sector pesca</h4>
<?php echo $controlador_obj->getHTMLInfoLink('info_sec_2_cpp', 'Acerca de', 'Para cada uno de los sectores aplicables a su caso, a continuación, se le pide responder sobre las características de su unidad de producción. Las respuestas se utilizarán para estimar el nivel de emisiones de gases que contribuyen al cambio climático con fines de diagnóstico. Se le pide que responda con la verdad.'); ?>
<h5 class="text-info">Caracterización – actividad pesquera</h5>
<div class="row pl-3">
	<div class="col-md-12">
		<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pes_p1', 'pes_p1', '1. Por favor indique qué tipo(s) de pesca realiza') ?>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>2. ¿Qué especies pesca y en qué cantidad en el año?</label>
		<div class="row">
			<div class="col-md-4">
				<label>Especie</label>
			</div>
			<div class="col-md-1">
				<label>Cantidad</label>
			</div>
			<div class="col-md-2">
				<label>Unidad de medida</label>
			</div>
		</div>
		<?php foreach($controlador_obj->getArrCmpLlave('pes_especies') as $i=>$llave_val){?>
		<div class="row">
			<div class="col-md-4">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pes_p2r'.$i, $llave_val);?>
			</div>
			<div class="col-md-1">
				<?php echo $controlador_obj->frm_al3->cmpNum('pes_p2r'.$i.'_cant', 2);?>
			</div>
			<div class="col-md-2">
				<p>Toneladas/año</p>
			</div>
		</div>
		<?php }?>
		<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pes_p2'); ?>
		<div class="row" id="div_pes_p2r22_sub">
			<div class="col-md-4">
				<?php echo $controlador_obj->frm_al3->cmpTexto('pes_p2r22_esp', 'Especificar'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>3. ¿En qué región marina pesca, y en qué zona?</label>
		<div class="row pl-3">
			<div class="col-md-4">
				<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pes_p3_reg', 'pes_p3_reg', 'Región') ?>
			</div>
			<div class="col-md-4">
				<label>Zona</label>
				<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Zona" data-id_info="#div_info_pes_p3"><i class="fas fa-info"></i></button>
				<?php
				echo $controlador_obj->frm_al3->cmpCheckbox('pes_p3r1_z', 'Aguas superficiales (ríos, lagos, etc)');
				echo $controlador_obj->frm_al3->cmpCheckbox('pes_p3r2_z', 'Aguas marinas interiores (desembocaduras de ríos, lagunas costeras, estuarios y bahías)');
				echo $controlador_obj->frm_al3->cmpCheckbox('pes_p3r3_z', 'Mar territorial (cerca de la costa a máximo 12 millas)');
				echo $controlador_obj->frm_al3->cmpCheckbox('pes_p3r4_z', 'Zona económica exclusiva (más lejos del mar territorial hasta 200 millas)');
				echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pes_p3r1');
				?>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-4">
		<label>4. Utiliza embarcación con motor</label>
		<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pes_p4', 'no_si') ?>
	</div>
	<div class="col-md-4" id="div_pes_p4_sub">
		<?php echo $controlador_obj->frm_al3->cmpNum('pes_p4_pot', 0, 'Por favor indique la potencia de su motor (caballos de fuerza)'); ?>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-4">
		<?php echo $controlador_obj->frm_al3->cmpNum('pes_p5', 0, '5. ¿Cuántos días al año pasa pescando?'); ?>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>6. ¿Refrigera o congela el producto que pesca?</label>
		<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pes_p6_ref', 'pes_p6_ref') ?>
		<div class="pl-3" id="div_pes_p6_ref_sub">
			<p>Por favor responda:</p>
			<div class="row">
				<div class="col-md-3">
					<label>¿En qué año compro sus equipos de enfriamiento (refrigerador/ congelador)?</label>
				</div>
				<div class="col-md-3">
					<label>¿Cuál es la capacidad de sus equipos de enfriamiento? 
						<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_info" data-txt_tit="Capacidad" data-id_info="#div_info_pes_p6"><i class="fas fa-info"></i></button>
					</label>
				</div>
				<div class="col-md-3">
					<label>¿Qué refrigerante utiliza?</label>
				</div>
			</div>
			<div class="row" >
				<div class="col-md-3">
					<?php echo $controlador_obj->frm_al3->cmpNum('pes_p6_anio', 0); ?>
				</div>
				<div class="col-md-1">
					<?php echo $controlador_obj->frm_al3->cmpNum('pes_p6_cap', 0); ?>
				</div>
				<div class="col-md-2">
					<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pes_p6_um', 'pes_p6_um'); ?>
				</div>
				<div class="col-md-3">
					<?php
					echo $controlador_obj->frm_al3->cmpCheckbox('pes_p6r1', 'No sé');
					echo $controlador_obj->frm_al3->cmpCheckbox('pes_p6r2', 'R404A');
					echo $controlador_obj->frm_al3->cmpCheckbox('pes_p6r3', 'R507A');
					echo $controlador_obj->frm_al3->cmpCheckbox('pes_p6r4', 'HFC134a');
					echo $controlador_obj->frm_al3->cmpCheckbox('pes_p6r5', 'HCFC22');
					echo $controlador_obj->frm_al3->cmpCheckbox('pes_p6r6', 'R-290');
					echo $controlador_obj->frm_al3->cmpCheckbox('pes_p6r7', 'R-744');
					echo $controlador_obj->frm_al3->cmpCheckbox('pes_p6r8', 'R-600a');
					echo $controlador_obj->frm_al3->cmpCheckbox('pes_p6r9', 'Otro');
					echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pes_p6');
					?>
					<div id="div_pes_p6r9_sub">
						<?php echo $controlador_obj->frm_al3->cmpTexto('pes_p6r9_esp', 'Especificar');?>
					</div>
				</div>
			</div>
		</div>
			
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>7. Por favor marque qué tipos de energía usa para la actividad pesquera y en cada caso indique aproximadamente la cantidad por año.</label>
		<div class="row pl-3">
			<div class="col-md-3">
				<label>Energía</label>
			</div>
			<div class="col-md-2">
				<label>Cantidad</label>
			</div>
			<div class="col-md-2">
				<label>Unidad de medida</label>
			</div>
		</div>
		<?php for($i=1; $i<=6; $i++){?>
		<div class="row pl-3">
			<div class="col-md-3">
				<?php echo $controlador_obj->frm_al3->cmpCheckbox('pes_p7r'.$i.'_ener', $controlador_obj->getCmpLlaveVal('pes_p7_ener', $i));?>
			</div>
			<?php if($i!=6){?>
			<div class="col-md-2">
				<?php echo $controlador_obj->frm_al3->cmpNum('pes_p7r'.$i.'_cant', 2); ?>
			</div>
			<div class="col-md-2">
				<?php echo $controlador_obj->getCmpLlaveVal('pes_p7_um', $i); ?>
			</div>
			<?php }?>
		</div>
		<?php }?>
		<div class="row pl-3">
			<div class="col-md-12">
				<?php echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pes_p7'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-4">
		<label>8. ¿En qué actividades o equipos consume energía para su producción pesquera?</label>
		<span class="small">Por favor seleccione todas las opciones que apliquen de la siguiente lista</span>
		<?php
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r1', 'Aire acondicionado');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r2', 'Bombeo de agua');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r3', 'Calefacción');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r4', 'Calentamiento de agua');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r5', 'Selección y/o empaque');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r6', 'Equipo de enfriamiento');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r7', 'Iluminación');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r8', 'Motores de lancha');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r9', 'Embarcación');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r10', 'Ventilación');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r11', 'Transporte');
		echo $controlador_obj->frm_al3->cmpCheckbox('pes_p8r12', 'Otro');
		echo $controlador_obj->frm_al3->cmpTexto('pes_p8r12_esp', 'Especificar');
		echo $controlador_obj->frm_al3->validacionSinCmp('div_an_pes_p8');
		?>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<label>9. ¿Cómo maneja los residuos de pescado que se generan en la producción?</label>
		<?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('pes_p9', 'pes_p9') ?>
	</div>
</div>
<div class="row pl-3">
	<div class="col-md-12">
		<?php echo $controlador_obj->frm_al3->cmpTextArea('pes_comentarios', 'Observaciones/Comentarios para la sección actual') ?>
	</div>
</div>
<div id="div_info_pes_p3" style="display:none">
	<ul>
		<li><strong>Zona económica exclusiva:</strong> Comprende la franja de mar que se mide desde el límite exterior del mar territorial hasta una distancia máxima de 200 millas náuticas (370.4 km) mar adentro, contadas a partir de la línea base desde la que se mide la anchura de éste.</li>
		<li><strong>Mar territorial:</strong> franja del mar adyacente a las costas nacionales, sean continentales o insulares, de 12 millas náuticas (22,224 m) de anchura.</li>
		<li><strong>Aguas marinas interiores:</strong> comprendidas entre las costas nacionales, tanto continentales como insulares, y el Mar Territorial (incluyen: desembocaduras o deltas de los ríos, lagunas costeras, estuarios y bahías).</li>
		<li><strong>Aguas superficiales continentales:</strong> son todas aquellas aguas quietas o corrientes en la superficie del suelo, que de forma general, proceden de las precipitaciones de cada cuenca (ríos, manantiales, arroyos; lagos, lagunas, embalses o presas)</li>
	</ul>
</div>
<div id="div_info_pes_p6" style="display:none">
	<p>La capacidad de los congeladores se mide en litros. Los pequeños, de uso doméstico, son de 50 L, pero los hay de 100 y hasta más de 700 L. Por ejemplo, un congelador de 700 L mide aproximadamente 2 metros de largo, por 0.5 metros de ancho, por 0.6 metros de profundidad.</p>
</div>