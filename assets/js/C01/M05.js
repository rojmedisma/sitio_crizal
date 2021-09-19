/**
 * Función IIFE para el módulo actual
 * @type 
 */
var Modulo = function(){
	function para_acu_p1(){
		for (var i = 0; i <=4; i++) {
			on_change_chk_sel_desbloquear('acu_p1r'+i+'_tipo', ['#fg_acu_p1r'+i+'_sup'], true, false, '#div_an_acu_p1');
		}
	}
	function para_acu_p2(){
		for (var i = 0; i <=15; i++) {
			on_change_chk_p2('acu_p2r'+i+'_especie', ['#fg_acu_p2r'+i+'_tec','#fg_acu_p2r'+i+'_prod'], true, false, '#div_an_acu_p2');
		}
		on_change_chk_sel_mostrar("acu_p2r15_especie", ["#fg_acu_p2r15_especie_esp"]);
	}
	function on_change_chk_p2(v_cmp_chk, a_selector, v_limpiar_y_bloquear=true, v_con_evento_change=false, v_nom_div_alerta=""){
		limpiarCamposDentroDe(!$("input[name='"+v_cmp_chk+"']").is(':checked'), a_selector);
		mostrar_p3_p4();
		$("input[name='"+v_cmp_chk+"']").on('change', function(){
			limpiarCamposDentroDe(!$(this).is(':checked'), a_selector, v_limpiar_y_bloquear, v_con_evento_change);
			quitar_alerta_de_div(v_nom_div_alerta);
			mostrar_p3_p4();
		});
	}
	function mostrar_p3_p4(){
		//Arreglo con las especies ostión, abulón, almejas, atún, robalo huachinango y jurel. Opciones para ocultar pregunta 3 y 4
		var a_opc_esp_ocul = ['acu_p2r1_especie', 'acu_p2r2_especie', 'acu_p2r3_especie', 'acu_p2r10_especie', 'acu_p2r11_especie', 'acu_p2r12_especie', 'acu_p2r13_especie'];
		var v_mostrar = true;
		a_opc_esp_ocul.forEach(function(v_cmp_chk){
			if($("input[name='"+v_cmp_chk+"']").is(':checked')){
				v_mostrar = false;
			}
		});
		mostrarSecciones(v_mostrar, ['#div_acu_p3', '#div_acu_p4']);
	}
	
	function para_acu_p3(){
		mostrar_opc_sel_no_si($("select[name='acu_p3']"), ['#div_acu_p3_sub']);
		$("select[name='acu_p3']").on('change', function(){
			mostrar_opc_sel_no_si($(this), ['#div_acu_p3_sub']);
		});
	}
	function para_acu_p4(){
		mostrar_opc_sel_no_si($("select[name='acu_p4']"), ['#div_acu_p4_sub']);
		$("select[name='acu_p4']").on('change', function(){
			mostrar_opc_sel_no_si($(this), ['#div_acu_p4_sub']);
		});
	}
	function para_acu_p5(){
		mostrar_opc_sel_no_si($("select[name='acu_p5']"), ['#div_acu_p5_sub']);
		$("select[name='acu_p5']").on('change', function(){
			mostrar_opc_sel_no_si($(this), ['#div_acu_p5_sub']);
			on_change_chk_sel_mostrar('acu_p5r9_ref', ['#div_acu_p5r9_ref_sub']);
		});
		for (var i = 0; i <=8; i++) {
			on_change_chk_sel_desbloquear('acu_p5r'+i+'_ref', [], true, false, '#div_an_acu_p5');
		}
		on_change_chk_sel_mostrar('acu_p5r9_ref', ['#div_acu_p5r9_ref_sub'], true, false, '#div_an_acu_p5');
	}
	function para_acu_p6(){
		var a_fg_acu_p6 = [];
		var x = 0;
		for (var i = 0; i <=4; i++) {
			a_fg_acu_p6[x++] = '#fg_acu_p6r'+i+'_tipo';
			a_fg_acu_p6[x++] = '#fg_acu_p6r'+i+'_cat';
			a_fg_acu_p6[x++] = '#fg_acu_p6r'+i+'_sup';
		}
		on_change_chk_sel_bloquear('acu_p6r5_tipo', a_fg_acu_p6, true, false, '#div_an_acu_p6');
		for (var i = 0; i <=4; i++) {
			on_change_chk_sel_desbloquear('acu_p6r'+i+'_tipo', ['#fg_acu_p6r'+i+'_cat','#fg_acu_p6r'+i+'_sup'], true, false, '#div_an_acu_p6');
		}
	}
	function para_acu_p7(){
		for (var i = 0; i <=11; i++) {
			on_change_chk_sel_desbloquear('acu_p7r'+i, [], true, false, '#div_an_acu_p7');
		}
		on_change_chk_sel_mostrar('acu_p7r12', ['#div_acu_p7r12_esp'], true, false, '#div_an_acu_p7');
	}
	return {
		activar:function(){
			para_acu_p1();
			para_acu_p2();
			para_acu_p3();
			para_acu_p4();
			para_acu_p5();
			para_acu_p6();
			para_acu_p7();
		}
	};
}();

