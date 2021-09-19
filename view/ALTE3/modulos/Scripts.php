<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/library/AdminLTE_3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/library/AdminLTE_3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="/library/AdminLTE_3/plugins/select2/js/select2.full.min.js"></script>
<?php if($controlador_obj->getUsarLibVista()){?>
<!-- DataTables -->
<script src="/library/AdminLTE_3/plugins/datatables/jquery.dataTables.js"></script>
<script src="/library/AdminLTE_3/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<?php }?>
<?php if($controlador_obj->getConMenuLateralFijo()){?>
<!-- overlayScrollbars -->
<script src="/library/AdminLTE_3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<?php }?>
<?php if($controlador_obj->getUsarLibToastr()){?>
<!-- Toastr: Para las alertas -->
<script src="/library/AdminLTE_3/plugins/toastr/toastr.min.js"></script>
<?php }?>
<?php if($controlador_obj->getUsarLibFileInput()){?>
<!-- bs-custom-file-input -->
<script src="/library/AdminLTE_3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<?php }?>
<?php if($controlador_obj->getUsarLibForma()){?>
<!-- Select2 -->
<script src="/library/AdminLTE_3/plugins/select2/js/select2.full.min.js"></script>
<!-- jQuery Numeric -->
<script src="/library/AdminLTE/plugins/jQuery/jquery.numeric.min.js"></script>
<!-- date-range-picker -->
<script src="/library/AdminLTE_3/plugins/daterangepicker/daterangepicker.js"></script>
<?php }?>
<!-- AdminLTE App -->
<script src="/library/AdminLTE_3/dist/js/adminlte.min.js"></script>
<!-- Principal -->
<script src="/<?php echo DIR_LOCAL; ?>/assets/js/Principal.js"></script>
<?php if($controlador_obj->getUsarLibForma()){?>
<!-- assets -->
<script src="/<?php echo DIR_LOCAL; ?>/assets/js/Forma.js"></script>
	
<script type="text/javascript">
	var a_toastr_success = <?php echo json_encode($controlador_obj->getSesionArrToastrAlertasDeTipo("success")); ?>;
	var a_toastr_warning = <?php echo json_encode($controlador_obj->getSesionArrToastrAlertasDeTipo("warning")); ?>;
	var a_toastr_info = <?php echo json_encode($controlador_obj->getSesionArrToastrAlertasDeTipo("info")); ?>;
	var v_es_nuevo = '<?php echo intval($controlador_obj->getEsNuevo()); ?>';
	//jsShowWindowLoad("Cargando");
	$(document).ready(function(){
		Forma.activaCmpEventos();
		Forma.activaPreGuardado('frm_cuest');
	});
</script>
<?php }?>
