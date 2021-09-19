<?php if($controlador_obj->tienePermiso('al-usuario')){ ?>
<a href="<?php echo define_controlador('catvistagen', 'cat_usuario')?>" class="btn btn-app">
	<i class="fas fa-user"></i> Usuarios
</a>
<?php }?>
<?php if($controlador_obj->tienePermiso('al-grupo')){ ?>
<a href="<?php echo define_controlador('catvistagen', 'cat_grupo')?>" class="btn btn-app">
	<i class="fas fa-users"></i> Grupos
</a>
<?php }?>
