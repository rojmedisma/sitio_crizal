<!-- Para MMLIndicadorVista -->
<script src="/<?php echo DIR_LOCAL; ?>/assets/js/CatGrupo.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("form[name='frm_sel'] select[name='cat_cuestionario_id']").on("change", function(){
			$("form[name='frm_sel']").submit();
		});
	});
</script>
