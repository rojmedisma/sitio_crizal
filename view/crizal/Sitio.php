<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once 'includes/EnHead.php'; ?>
	</head>
	<body>
		<!-- start page loading -->
		<div id="preloader">
			<div class="row loader">
				<div class="loader-icon"></div>
			</div>
		</div>
		<!-- end page loading -->
		<!-- start main-wrapper section -->
		<div class="main-wrapper position-inherit">
			<!-- start header section -->
			<header>
				<?php include_once 'includes/EnHeader.php'; ?>
			</header>
			<!-- end header section -->
			<?php
			if($controlador_obj->getControlador()=='principal'):
				include_once 'includes/'.$controlador_obj->getControlador().'/RevSlider.php';
			else:
				include_once 'includes/SecPageTitle.php';
			endif;
			?>
			<?php require_once 'includes/'.$controlador_obj->getControlador().'/Contenido.php';?>
			<?php require_once 'includes/Footer.php';?>
		</div>
		<!-- end main-wrapper section -->
		<!-- start scroll to top -->
		<a href="#!" class="scroll-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
		<!-- end scroll to top -->
		<!-- all js include start -->
		<?php require_once 'includes/Scripts.php';?>
		<?php require_once 'includes/'.$controlador_obj->getControlador().'/Scripts.php';?>
		<!-- all js include end -->
	</body>
</html>