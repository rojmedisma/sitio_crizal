<!-- Inicia Footer para Desarrolladro -->
<footer class="main-footer">
	<h3>Sección exclusiva para rol de Desarrollador</h3>
	<p class="small text-danger">Si ves esta sección, favor de notificar al administrador del sistema. Gracias!</p>
	<?php if(isset($controlador_obj->frm_al3)){?>
	<div class="form-group">
		<label>Arreglo con la descripción de los atributos de todos los campos usados en la forma actual </label>
		<textarea class="form-control" rows="2" style="color: white;background-color: darkslategrey;"><?php echo $controlador_obj->frm_al3->imprimeArrCmpAtrib(); ?></textarea>
	</div>
	<?php }?>
	<?php if(strtolower($controlador_obj->getControlador()) == 'cuestforma'){?>
	<div class="form-group">
		<label>Arreglo arr_modulos </label>
		<textarea class="form-control" rows="2" style="color: white;background-color: darkslategrey;"><?php echo $controlador_obj->imprimeArrModulos(); ?></textarea>
	</div>
	<?php }?>
	<?php if(method_exists($controlador_obj, "getArrParam")){?>
	<div class="form-group">
		<label>Arreglo arr_param </label>
		<textarea class="form-control" rows="2" style="color: white;background-color: darkslategrey;"><?php echo json_encode($controlador_obj->getArrParam()); ?></textarea>
	</div>
	<?php }?>
	<?php if(method_exists($controlador_obj, "getArrPermisos")){?>
	<div class="form-group">
		<label>Arreglo arr_permisos </label>
		<textarea class="form-control" rows="2" style="color: white;background-color: darkslategrey;"><?php echo json_encode($controlador_obj->getArrPermisos()); ?></textarea>
	</div>
	<?php }?>
</footer><!-- Termina Footer para Desarrolladro -->
