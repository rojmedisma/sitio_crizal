var VistaPermiso = function(){
	function borrar(event){
		if(!confirm("¿Desea borrar el registro?")){
			event.preventDefault();
		}
	}
	function de_prod_edo(o_this){
		$("#fg_cat_municipio_id").hide();
		//$("#div_spinner_mpo").show();
		$.ajax({
			url:"index.php?controlador=cuestcat&accion=imprime_municipios",
			data:"cat_estado_id="+o_this.val(),
			cache:false,
			dataType:"html",
			success:function(result){
				$("#cat_municipio_id").html(result);
				//$("#prod_loc").html("");
				$("#fg_cat_municipio_id").show();
				//$("#div_spinner_mpo").hide();
			},
			error:function(result){
				alert("Error interno. Revisar mensaje en consola web y notificar al administrador del sistema.");
				console.log(result);
			}
		});
	}
	return{
		activar:function(){
			$('#tbl_permisos').DataTable({
				"order": [[ 0, "desc" ]],
				"searching": false,
				"language": {
					"lengthMenu": "Mostrar _MENU_ registros por página",
					"zeroRecords": "Ningún registro encontrado",
					"info": "Mostrando página _PAGE_ de _PAGES_",
					"infoFiltered": "(filtrado de _MAX_ total de registros)",
					"search": "Buscar",
					"paginate": {
						"first": "Primera",
						"last": "Última",
						"next": "Siguiente",
						"previous": "Previo"
					},
				}
			});
			$(".frm_borrar").submit(function(event){
				borrar(event);
			});
			$("select[name='cat_estado_id']").on("change", function(){
				de_prod_edo($(this));
			});
		}
	}
}();