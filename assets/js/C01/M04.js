/**
 * Función IIFE para el módulo actual
 * @type 
 */
var Modulo = function(){
	function para_pes_p2(){
		for (var i = 1; i <=22; i++) {
			on_change_chk_sel_desbloquear('pes_p2r'+i, ['#fg_pes_p2r'+i+'_cant'], true, false, '#div_an_pes_p2');
		}
		on_change_chk_sel_mostrar('pes_p2r22', ['#div_pes_p2r22_sub'], true, false, '#div_an_pes_p2');
	}
	function para_pes_p3(){
		for (var i = 1; i <=4; i++) {
			on_change_chk_sel_desbloquear('pes_p3r'+i+'_z', [], true, false, '#div_an_pes_p3r1');
		}
	}
	function para_pes_p4(){
		mostrar_opc_sel_no_si($("select[name='pes_p4']"), ['#div_pes_p4_sub']);
		$("select[name='pes_p4']").on('change', function(){
			mostrar_opc_sel_no_si($(this), ['#div_pes_p4_sub']);
		});
	}
	function para_pes_p6(){
		mostrar_opc_sel_no_si($("select[name='pes_p6_ref']"), ['#div_pes_p6_ref_sub']);
		$("select[name='pes_p6_ref']").on('change', function(){
			mostrar_opc_sel_no_si($(this), ['#div_pes_p6_ref_sub']);
			on_change_chk_sel_mostrar('pes_p6r9', ['#div_pes_p6r9_sub']);
		});
		for (var i = 1; i <=8; i++) {
			on_change_chk_sel_desbloquear('pes_p6r'+i, [], true, false, '#div_an_pes_p6');
		}
		on_change_chk_sel_mostrar('pes_p6r9', ['#div_pes_p6r9_sub'], true, false, '#div_an_pes_p6');
	}
	function para_pes_p7(){
		var a_fg_pes_p7 = [];
		var x = 0;
		for (var i = 0; i <=5; i++) {
			a_fg_pes_p7[x++] = '#fg_pes_p7r'+i+'_ener';
			a_fg_pes_p7[x++] = '#fg_pes_p7r'+i+'_cant';
		}
		on_change_chk_sel_bloquear('pes_p7r6_ener', a_fg_pes_p7, true, false, '#div_an_pes_p7');
		for (var i = 0; i <=5; i++) {
			on_change_chk_sel_desbloquear('pes_p7r'+i+'_ener', ['#fg_pes_p7r'+i+'_cant'], true, false, '#div_an_pes_p7');
		}
	}
	function para_pes_p8(){
		for (var i = 1; i <=12; i++) {
			on_change_chk_sel_desbloquear('pes_p8r'+i, [], true, false, '#div_an_pes_p8');
		}
		on_change_chk_sel_mostrar('pes_p8r12', ['#fg_pes_p8r12_esp']);
	}
	
	return {
		activar:function(){
			para_pes_p2();
			para_pes_p3();
			para_pes_p4();
			para_pes_p6();
			para_pes_p7();
			para_pes_p8();
		}
	};
}();

