<?php if($controlador_obj->getDatoVistaValor('ver_aviso')){?>
<div class="alert alert-warning alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h5><i class="icon fas fa-exclamation-triangle"></i> Aviso</h5>
		<?php foreach($controlador_obj->getArrAvisos() as $aviso){
			echo "<p>".$aviso."</p>";
		}?>
</div>
<?php }elseif($controlador_obj->getAccion()=='validar'){?>
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h5><i class="icon fas fa-check"></i> Éxito</h5>
	<p>No se encontró ningún problema en la muestra pre-cargada</p>
</div>
<?php }elseif($controlador_obj->getAccion()=='integrar'){?>
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h5><i class="icon fas fa-check"></i> Éxito</h5>
	<p>Se crearon cuestionarios a partir de los registros pre-cargados </p>
</div>
<?php } ?>

