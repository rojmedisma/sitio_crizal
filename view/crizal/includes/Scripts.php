<!-- jquery -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/jquery.min.js"></script>
<!-- popper js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/popper.min.js"></script>
<!-- bootstrap -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/bootstrap.min.js"></script>
<!-- navigation -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/nav-menu.js"></script>
<!-- serch -->
<script src="<?php echo DIR_PLANTILLA; ?>/search/search.js"></script>
<!-- tab -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/easy.responsive.tabs.js"></script>
<!-- owl carousel -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/owl.carousel.js"></script>
<!-- jquery.counterup.min -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/jquery.counterup.min.js"></script>
<!-- stellar js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/jquery.stellar.min.js"></script>
<!-- waypoints js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/waypoints.min.js"></script>
<!-- countdown js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/countdown.js"></script>
<!-- jquery.magnific-popup js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/jquery.magnific-popup.min.js"></script>
<!-- isotope.pkgd.min js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/isotope.pkgd.min.js"></script>
<!--  chart js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/chart.min.js"></script>
<!-- thumbs js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/owl.carousel.thumbs.js"></script>
<!-- animated js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/animated-headline.js"></script>
<!--  clipboard js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/clipboard.min.js"></script>
<!--  prism js -->
<script src="<?php echo DIR_PLANTILLA; ?>/js/prism.js"></script>
<!-- custom scripts -->
<script src="/<?php echo DIR_LOCAL; ?>/assets/js/crizal/main.js"></script>
<!-- Librería principal con funciones básicas -->
<script src="/<?php echo DIR_LOCAL; ?>/assets/js/Principal.js"></script>

<?php if($controlador_obj->getUsarLibForma()){ ?>
	<!-- Select2 -->
	<!-- <script src="/library/AdminLTE_3/plugins/select2/js/select2.full.min.js"></script> -->
	<!-- jQuery Numeric -->
	<!-- <script src="/library/AdminLTE/plugins/jQuery/jquery.numeric.min.js"></script> -->

	<!-- date-range-picker -->
	<!-- <script src="/library/AdminLTE_3/plugins/daterangepicker/daterangepicker.js"></script> -->
	<!-- assets -->
	<script src="/<?php echo DIR_LOCAL; ?>/assets/js/crizal/Forma.js"></script>

	<script type="text/javascript">
		var v_dir_img = '/<?php echo DIR_LOCAL; ?>/img/';
		var v_dir_layout = '/<?php echo DIR_LOCAL; ?>/view/crizal/layout/';
		$(document).ready(function () {
			Forma.activaCmpEventos();
		});
	</script>
	<?php
}?>
