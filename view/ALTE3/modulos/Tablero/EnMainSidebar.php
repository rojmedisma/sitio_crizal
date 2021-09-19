<!-- Brand Logo -->
<a href="<?php echo define_controlador(); ?>" class="brand-link" title="<?php echo TIT_CORTO_P1." ".TIT_CORTO; ?>">
	<span class="brand-text font-weight-light pl-3"><?php echo TIT_CORTO_P1 ?> <strong><?php echo TIT_CORTO_P2 ?></strong></span>
</a>
<!-- Sidebar -->
<div class="sidebar">
	<!-- Sidebar Menu -->
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<?php echo $controlador_obj->getHTMLTag('li_ni_sb_tablero'); ?>
			<?php echo $controlador_obj->getHTMLTag('li_ni_sb_cuest'); ?>
			<?php echo $controlador_obj->getHTMLTag('li_ni_sb_frm'); ?>
			<?php echo $controlador_obj->getHTMLTag('li_ni_sb_muestra'); ?>
			<?php echo $controlador_obj->getHTMLTag('li_ni_sb_cat'); ?>
			<?php echo $controlador_obj->getHTMLTag('li_ni_sb_conf'); ?>
		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

