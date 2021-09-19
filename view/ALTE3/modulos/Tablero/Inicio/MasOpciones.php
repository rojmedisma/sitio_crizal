<?php if($controlador_obj->tienePermiso('al-indicadores')){?>
<a href="<?php echo define_controlador('catfrmgen', 'indicadores')?>" class="btn btn-app">
	<i class="fas fa-layer-group"></i> Indicadores
</a>
<?php }?>
<?php if($controlador_obj->tienePermiso('al-log')){?>
<a href="<?php echo define_controlador('catvistagen', 'log')?>" class="btn btn-app">
	<i class="fas fa-clipboard-check"></i> Registros de log
</a>
<?php }?>
<a href="<?php echo "/".DIR_LOCAL."/assets/doc/Manual_usuario.pdf"?>" target="new" class="btn btn-app">
	<i class="fas fa-file-pdf"></i> Manual de usuario
</a>
<?php if($controlador_obj->tienePermiso('ver-doc-cod')){?>
<a href="<?php echo "/".DIR_DOC_COD."/html/index.html"?>" target="new" class="btn btn-app">
	<i class="fas fa-code"></i> Documentación de código fuente
</a>
<?php }?>