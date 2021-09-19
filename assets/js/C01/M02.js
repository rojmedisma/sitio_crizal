/**
 * Función IIFE para el módulo actual
 * Módulo Agrícola con cat_cuest_modulo_id = 2
 * @type 
 */
var Modulo = function(){
	var v_rp3 = 4, v_rp7=5;
	function para_agr_p1(){
		on_change_chk_sel_mostrar_sub("agr_p1r1", "#div_an_agr_p1rN");
		on_change_chk_sel_mostrar_sub("agr_p1r1_1", "#div_an_agr_p1r1_N");
		on_change_chk_sel_mostrar_sub("agr_p1r1_2", "#div_an_agr_p1r1_N");
		on_change_chk_sel_mostrar_sub("agr_p1r1_2_1", "#div_an_agr_p1r1_2_N");
		on_change_chk_sel_mostrar_sub("agr_p1r1_2_2", "#div_an_agr_p1r1_2_N");
		on_change_chk_sel_mostrar_sub("agr_p1r1_2_3", "#div_an_agr_p1r1_2_N");
		on_change_chk_sel_mostrar_sub("agr_p1r2", "#div_an_agr_p1rN");
		on_change_chk_sel_mostrar_sub("agr_p1r2_1", "#div_an_agr_p1r2_N");
		on_change_chk_sel_mostrar_sub("agr_p1r2_2", "#div_an_agr_p1r2_N");
		on_change_chk_sel_mostrar_sub("agr_p1r2_3", "#div_an_agr_p1r2_N");
	}
	function para_agr_p3(){
		para_agr_p3rN_cultivo();
		mostrar_en_p7();
		
	}
	function para_agr_p3rN_cultivo(){
		for (var i = 1; i <= v_rp3; i++) {
			on_change_chk_sel_desbloquear("agr_p3r"+i+"_cultivo", ["#div_agr_p3r"+i+"_cantidad","#div_agr_p3r"+i+"_sup"], true, false, "#div_an_agr_p3");
		}
		on_change_chk_sel_mostrar("agr_p3r7_cultivo", ["#fg_agr_p3r7_cultivo_esp"]);
		on_change_chk_sel_mostrar("agr_p3r"+v_rp3+"_cultivo", ["#fg_agr_p3r"+v_rp3+"_cultivo_esp"]);
	}
	function mostrar_en_p7(){
		for (var i = 1; i <= v_rp3; i++) {
			on_change_chk_mostrar_p7(i, 'agr_p3r'+i+'_cultivo', ['#div_agr_p7r'+i]);
		}
	}
	
	
	/**
	 * Variante de la función "on_change_chk_sel_mostrar" para desplegar las opciones de la pregunta 7
	 * @param {type} v_cmp_chk
	 * @param {type} a_selector
	 * @returns {undefined}
	 */
	function on_change_chk_mostrar_p7(i, v_cmp_chk, a_selector){
		mostrarSecciones($("input[name='"+v_cmp_chk+"']").is(':checked'), a_selector);
		mostrarSecciones($("input[name='agr_p7r"+i+"_10_pago']").is(':checked'), ["#fg_agr_p7r"+i+"_10_pago_esp"]);
		$("input[name='"+v_cmp_chk+"']").on('change', function(){
			mostrarSecciones($(this).is(':checked'), a_selector);
			para_agr_p7();
		});
		$("input[name='agr_p7r"+i+"_10_pago']").on('change', function(){
			mostrarSecciones($(this).is(':checked'), ["#fg_agr_p7r"+i+"_10_pago_esp"]);
		});
	}
	function para_agr_p5rN_tipo(){
		var a_agr_p5rN = [];
		var x = 0;
		for (var i = 1; i <= 5; i++) {
			a_agr_p5rN[x++] = '#fg_agr_p5r'+i+'_tipo';
			a_agr_p5rN[x++] = '#fg_agr_p5r'+i+'_cantidad';
			a_agr_p5rN[x++] = '#fg_agr_p5r'+i+'_sup';
		}
		//Se debe de llamar primero esta función antes, de lo contrario el resto de código deja de funcionar
		on_change_chk_sel_bloquear('agr_p5r10_tipo', a_agr_p5rN);
		
		for (var i = 1; i <= 5; i++) {
			on_change_chk_sel_desbloquear("agr_p5r"+i+"_tipo", ['#div_agr_p5r'+i+'_cantidad','#div_agr_p5r'+i+'_sup'], true, false, "#div_an_agr_p5");
		}
		on_change_chk_sel_desbloquear("agr_p5r10_tipo", [], true, false, "#div_an_agr_p5");
	}
	
	function para_agr_p7(){
		for (var i = 1; i <= v_rp3; i++) {
			var a_cmps_suma = [];
			for (var j = 1; j <= v_rp7; j++) {
				a_cmps_suma[j-1]= "agr_p7r"+i+"_"+j+"_prop";
			}
			for (var j = 1; j <= v_rp7; j++) {
				on_change_chk_sel_desbloquear('agr_p7r'+i+'_'+j+'_pago', ['#fg_agr_p7r'+i+'_'+j+'_prop'], true, true, "#div_an_agr_p7r"+i);
				on_change_cmp_suma('agr_p7r'+i+'_'+j+'_prop', a_cmps_suma, 'agr_p7r'+i+'_tot', 'div_agr_p7r'+i+'_tot', '#div_an_agr_p7r'+i+'_tot');
			}
		}
	}
	function para_agr_p8(){
		agr_p8_sel($("select[name='agr_p8_aplico']"));
		$("select[name='agr_p8_aplico']").on('change', function(){
			agr_p8_sel($(this));
		});
		on_change_chk_sel_bloquear('agr_p8r15_m_ap_nose', ['#fg_agr_p8r15_m_ap_frec']);
		
	}
	
	function para_agr_p10(){
		agr_p10_sel($("select[name='agr_p10_aplico']"));
		$("select[name='agr_p10_aplico']").on('change', function(){
			agr_p10_sel($(this));
		});
	}
	function agr_p10_sel(o_cmp_sel){
		var v_mostrar = (parseInt(o_cmp_sel.val())!==2)? false : true;
		mostrarSecciones(v_mostrar, ['#div_agr_p10_sub'], true, true);
		
		on_change_chk_sel_desbloquear('agr_p10r1_t_ag', ['#fg_agr_p10r1_nom', '#fg_agr_p10r1_sup', '#fg_agr_p10r1_cant', '#fg_agr_p10r1_um', '#fg_agr_p10r1_n_vez', '#fg_agr_p10r1_met'], true, false, "#div_an_agr_p10");
		on_change_chk_sel_desbloquear('agr_p10r2_t_ag', ['#fg_agr_p10r2_nom', '#fg_agr_p10r2_sup', '#fg_agr_p10r2_cant', '#fg_agr_p10r2_um', '#fg_agr_p10r2_n_vez', '#fg_agr_p10r2_met'], true, false, "#div_an_agr_p10");
		on_change_chk_sel_desbloquear('agr_p10r3_t_ag', ['#fg_agr_p10r3_nom', '#fg_agr_p10r3_sup', '#fg_agr_p10r3_cant', '#fg_agr_p10r3_um', '#fg_agr_p10r3_n_vez', '#fg_agr_p10r3_met'], true, false, "#div_an_agr_p10");
	}
	return {
		activar:function(){
			para_agr_p1();
			para_agr_p3();
			para_agr_p5rN_tipo();
			para_agr_p7();
			para_agr_p10();
		}
	};
}();