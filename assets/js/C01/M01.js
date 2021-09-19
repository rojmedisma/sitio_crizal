/**
 * Función IIFE para el módulo actual
 * @type 
 */
var Modulo = function(){
	function modal_es_nuevo(){
		if (typeof v_es_nuevo !== 'undefined' && parseInt(v_es_nuevo)===1) {
			$("#mdl_bienvenido").modal("show");
		}
	}
	
	function de_prod_tipo(o_this){
		mostrarSecciones(parseInt(o_this.val())===1, ["#div_prod_curp"]);
		mostrarSecciones(parseInt(o_this.val())===2, ["#div_prod_rfc"]);
	}
	function de_prod_edo(o_this){
		$("#fg_prod_mpo").hide();
		$("#div_spinner_mpo").show();
		$.ajax({
			url:"index.php?controlador=cuestcat&accion=imprime_municipios",
			data:"cat_estado_id="+o_this.val(),
			cache:false,
			dataType:"html",
			success:function(result){
				$("#prod_mpo").html(result);
				$("#prod_loc").html("");
				$("#fg_prod_mpo").show();
				$("#div_spinner_mpo").hide();
			},
			error:function(result){
				alert("Error interno. Revisar mensaje en consola web y notificar al administrador del sistema.");
				console.log(result);
			}
		});
	}
	function de_prod_mpo(o_this){
		$("#fg_prod_loc").hide();
		$("#div_spinner_loc").show();
		$.ajax({
			url:"index.php?controlador=cuestcat&accion=imprime_localidades",
			data:"cat_municipio_id="+o_this.val(),
			cache:false,
			dataType:"html",
			success:function(result){
				$("#prod_loc").html(result);
				$("#fg_prod_loc").show();
				$("#div_spinner_loc").hide();
			},
			error:function(result){
				alert("Error interno. Revisar mensaje en consola web y notificar al administrador del sistema.");
				console.log(result);
			}
		});
	}
	function adjuntar(e){
		e.preventDefault();
		
		var formData = new FormData(document.getElementById("frm_adjunto"));
		formData.append("controlador", "adjuntoajax");
		formData.append("accion", "adjuntar");
		$.ajax({
			url: "index.php",
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		}).done(function(res){
			$("#div_adjunta_cont").html(res);
			$('#mdl_adjuntar').modal('hide');
			//Se vuelve a generar el evento, debido a que se pierde
			$("#btn_borrar_adj").on("click", function(){
				adjunto_borrar();
			});
		});
		 
		 
	}
	function adjunto_borrar(){
		
		var v_prod_geo_adjunto_id = $("input[name='prod_geo_adjunto_id']").val();
		console.log("v_prod_geo_adjunto_id: "+v_prod_geo_adjunto_id);
		$.ajax({
			url: "index.php?controlador=adjuntoajax&accion=borrar&adjunto_id="+v_prod_geo_adjunto_id,
			type: "post",
			dataType: "html",
			cache: false,
			contentType: false,
			processData: false
		}).done(function(res){
			$("#div_adjunta_cont").html(res);
		});
	}
	return {
		activar:function(){
			bsCustomFileInput.init();
			modal_es_nuevo();
			
			//2. Clave de identificación del productor
			de_prod_tipo($("select[name='prod_tipo']"));
			$("select[name='prod_tipo']").on("change", function(){
				de_prod_tipo($(this));
			});
			//3. Ubicación de la unidad de producción
			$("select[name='prod_edo']").on("change", function(){
				de_prod_edo($(this));
			});
			$("select[name='prod_mpo']").on("change", function(){
				de_prod_mpo($(this));
			});
			$("#frm_adjunto").on("submit", function(e){
				adjuntar(e);
			});
			$("#btn_borrar_adj").on("click", function(){
				adjunto_borrar();
			})
		}
	};
}();