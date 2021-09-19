var FrmInventario = function(){
	function para_veh_marca(o_this){
		$.ajax({
			url:"index.php?controlador=ajax&accion=imprime_veh_modelo",
			data:"cat_veh_marca_id="+o_this.val(),
			cache:false,
			dataType:"html",
			success:function(result){
				$("#veh_modelo").html(result);
			},
			error:function(result){
				alert("Error interno. Revisar mensaje en consola web y notificar al administrador del sistema.");
				console.log(result);
			}
		});
	}
	
	return{
		activar:function(){
			$("select[name='veh_marca']").on("change", function(){
				para_veh_marca($(this));	//comentario de prueba
			});
		}
	}
}();

