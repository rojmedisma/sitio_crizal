<!DOCTYPE html>
<html>
	<head>
		<?php include_once 'modulos/EnHead.php'; ?>
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<?php include_once 'modulos/Tablero/EnMainHeader.php'; ?>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-<?php echo COLOR_ACENTUAR; ?> elevation-4">
				<?php include_once 'modulos/Tablero/EnMainSidebar.php'; ?>
			</aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<?php include_once 'modulos/EnContentHeader.php'; ?>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<?php
						switch (strtolower($controlador_obj->getControlador())){
							case 'tablero':		include_once 'modulos/Tablero/Inicio.php';	break;
							case 'cuestvista':	include_once 'modulos/Cuest/Vista.php';	break;
							case 'cuestforma':	include_once 'modulos/Cuest/Forma.php';	break;
							case 'catvistagen':	include_once 'modulos/Tablero/CatVistaGen.php';	break;
							case 'catfrmgen':
								switch (strtolower($controlador_obj->getAccion())){
									case 'cat_usuario': include_once 'modulos/Tablero/CatFrmGen/CatUsuario.php';	break;
									case 'log': include_once 'modulos/Tablero/CatFrmGen/Log.php';	break;
									case 'indicadores': include_once 'modulos/Tablero/CatFrmGen/Indicadores.php';	break;
								}
								break;
							case 'catfrmgpo':
							case 'cat_grupo': 
								include_once 'modulos/Tablero/CatFrmGen/CatGrupo.php';	break;
							case 'muestra':
								switch (strtolower($controlador_obj->getAccion())){
									case 'inicio':	include_once 'modulos/Tablero/Muestra/Vista.php'; break;
									case 'validar':
									case 'integrar':
										include_once 'modulos/Tablero/Muestra/Resultado.php'; break;
								}
								break;
										
						}
						?>
					</div>
				</section>
				<!-- /.content -->
			</div>
			<?php include_once 'modulos/ModalInfo.php';?>
			<?php include_once 'modulos/ModalAyuda.php';?>
			<?php include_once 'modulos/ModalAdjunto.php';?>
			<?php include_once 'modulos/ModalBienvenida.php';?>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				<?php include_once 'modulos/EnFooter.php'; ?>
			</footer>
			<?php
				//Se despliega footer de desarrollador
				if($controlador_obj->tienePermiso('desarrollador')){
					include_once 'modulos/FooterDesarrollador.php';
				}
			?>
			<!-- /.control-sidebar -->
		</div>
		<!-- ./wrapper -->
		
		<?php
		include_once 'modulos/Scripts.php';
		switch (strtolower($controlador_obj->getControlador())){
			case 'cuestvista':	include_once 'modulos/ScriptCuestVista.php';	break;
			case 'cuestforma':	echo $controlador_obj->getHTMLScriptCuest();	break;
			case 'catvistagen':	
			case 'muestra':
				include_once 'modulos/ScriptCatVistaGen.php';	break;
			case 'catfrmgen':
				switch (strtolower($controlador_obj->getAccion())){
					case 'cat_usuario': include_once 'modulos/ScriptCatUsr.php';	break;
				}
				break;
			case 'catfrmgpo':
				case 'cat_usuario': include_once 'modulos/ScriptCatGpo.php';	break;
		}
		?>
		
		<script type="text/javascript">
				//jsRemoveWindowLoad();
		</script>
	</body>
</html>