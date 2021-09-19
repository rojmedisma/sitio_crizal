<div class="card card-default card-outline">
	<div class="card-header">
		<h3 class="card-title">Cuestionarios</h3>
	</div>
	<div class="card-body">
		<?php include_once 'Inicio/Cuestionarios.php';?>
	</div>
</div><!-- /.card -->
<?php if($controlador_obj->tienePermiso('al-usuario') || $controlador_obj->tienePermiso('al-grupo')){ ?>
<div class="card card-default card-outline">
	<div class="card-header">
		<h3 class="card-title">Catálogos</h3>
	</div>
	<div class="card-body">
		<?php include_once 'Inicio/Catalogos.php';?>
	</div>
</div><!-- /.card -->
<?php }?>

<div class="card card-default card-outline">
	<div class="card-header">
		<h3 class="card-title">Más opciones</h3>
	</div>
	<div class="card-body">
		<?php include_once 'Inicio/MasOpciones.php';?>
	</div>
</div><!-- /.card -->