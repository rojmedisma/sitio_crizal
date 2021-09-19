<?php echo $controlador_obj->getHTMLIntroduccion(); ?>
<h4>Sección principal</h4>
<?php echo $controlador_obj->getHTMLInfoLink('info_sec_ident_p', 'Acerca de', 'Esta sección es la principal y a diferencia del resto de secciones, no  es elegible para su ocultamiento o despliege.'); ?>
<label>1. Secciones</label>
<p class="small">Seleccione las secciones a desplegar en el cuestionario.</p>
<div class="row pl-3">
	<div class="col-md-4">
		<div class="form-group">
			<?php
			echo $controlador_obj->frm_al3->cmpCheckbox('prod_sector1', 'Sección A');
			echo $controlador_obj->frm_al3->cmpCheckbox('prod_sector2', 'Sección B');
			echo $controlador_obj->frm_al3->cmpCheckbox('prod_sector3', 'Sección C');
			echo $controlador_obj->frm_al3->cmpCheckbox('prod_sector4', 'Sección D');
			echo $controlador_obj->frm_al3->validacionSinCmp('div_an_prod_sector');
			?>
		</div>
	</div>
</div>
<label>2. Despliegue de preguntas a partir de una opción seleccionada</label>
<p class="small">En este ejemplo, dependiendo del tipo de identificación, se despliega el campo respectivo para su llenado</p>
<div class="row pl-3">
	<div class="col-md-4"><?php echo $controlador_obj->frm_al3->cmpSelectDeSubCat('prod_tipo', 'prod_tipo', 'Tipo de identificación');?></div>
	<div class="col-md-4">
		<div id="div_prod_curp">
			<?php echo $controlador_obj->frm_al3->cmpTexto('prod_curp', 'CURP'); ?>
		</div>
		<div id="div_prod_rfc">
			<?php echo $controlador_obj->frm_al3->cmpTexto('prod_rfc', 'RFC'); ?>
		</div>
	</div>
</div>
<label>3. Filtrado de opciones dependientes a la opción seleccionada en el campo previo</label>
<p class="small">En este ejemplo se tienen tres campos para definir la ubicación, en donde las opciones que salen en Municipio, dependen de la opción seleccionada en Estado, y a su vez, lo mismo con las opciones de localidad con respecto al municipio.</p>
<div class="row pl-3">
	<div class="col-md-2">
		<?php echo $controlador_obj->frm_al3->cmpSelectDeTbl('prod_edo', 'cat_estado', 'cat_estado_id', 'descripcion', '', 'Estado', array("con_select2"=>true)) ?>
	</div>
	<div class="col-md-4">
		<?php echo $controlador_obj->frm_al3->cmpSelectDeTbl('prod_mpo', 'cat_municipio', 'cat_municipio_id', 'descripcion', $controlador_obj->getDatoVistaValor('and_mpo'), 'Municipio', array("con_select2"=>true)) ?>
		<div id="div_spinner_mpo" class="spinner-border spinner-border-sm" style="display: none"></div>
	</div>
	<div class="col-md-6">
		<?php echo $controlador_obj->frm_al3->cmpSelectDeTbl('prod_loc', 'cat_localidad', 'cat_localidad_id', 'descripcion', $controlador_obj->getDatoVistaValor('and_loc'), 'Localidad', array("con_select2"=>true)) ?>
		<div id="div_spinner_loc" class="spinner-border spinner-border-sm" style="display: none"></div>
	</div>
</div>
<label>4. Adjuntar archivo</label>
<p class="small">Modalidad para que en caso de ser requerido, se adjunten archivos al cuestionario</p>
<div class="row pl-3">
	<div class="col-md-12">
		<div id="div_adjunta_cont">
			<?php echo $controlador_obj->getHTMLAdjunto(); ?>
		</div>
	</div>
</div>
