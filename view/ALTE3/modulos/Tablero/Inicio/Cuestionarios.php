<?php foreach($controlador_obj->getArrCatCuestionario() as $arr_cat_cuest_det){?>
<div class="card card-body">
	<div class="row">
		<div class="col-md-5">
			<h4><?php echo $arr_cat_cuest_det['descripcion']; ?></h4>
		</div>
		<div class="col-md-7">
			<div class="btn-group">
				<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#div_intro_c<?php echo $arr_cat_cuest_det['cat_cuestionario_id']; ?>"><i class="fa fa-fw fa-info"></i> Introducción</button>
				<?php //if($controlador_obj->tienePermiso(cuest_cve($arr_cat_cuest_det['cat_cuestionario_id']).'-al')){?>
				<a class="btn btn-default" href="<?php echo define_controlador("cuestvista", "inicio", false, array("cat_cuestionario_id"=>$arr_cat_cuest_det["cat_cuestionario_id"]))?>"><i class="fa fa-fw fa-list-alt"></i> Consultar cuestionarios</a>
				<?php //}?>
				<?php if($controlador_obj->tienePermiso(cuest_cve($arr_cat_cuest_det['cat_cuestionario_id']).'-ae')){?>
				<a class="btn btn-default" href="<?php echo define_controlador("cuestforma", "inicio", false, array("cat_cuestionario_id"=>$arr_cat_cuest_det["cat_cuestionario_id"]))?>"><i class="fa fa-fw fa-file"></i> Alta cuestionario</a>
				<?php }?>
				<?php if($controlador_obj->tienePermiso(cuest_cve($arr_cat_cuest_det['cat_cuestionario_id']).'-ae-muestra')){?>
				<a class="btn btn-default" href="<?php echo define_controlador("muestra", "inicio", false, array("cat_cuestionario_id"=>$arr_cat_cuest_det["cat_cuestionario_id"]))?>"><i class="fa fa-fw fa-vial"></i> Muestra</a>
				<?php }?>
			</div>
		</div>
	</div>
	<div id="div_intro_c<?php echo $arr_cat_cuest_det['cat_cuestionario_id']; ?>" class="collapse pt-3">
		<div class="attachment-block clearfix">
			<?php echo nl2br($arr_cat_cuest_det['definicion']); ?>
		</div>
	</div>
</div>
<?php }?>
