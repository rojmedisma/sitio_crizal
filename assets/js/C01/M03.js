/**
 * Función IIFE para el módulo actual
 * @type 
 */
var Modulo = function(){
	function para_pec_p2(){
		pec_p2rN_especie_sel();
		
	}
	function pec_p2rN_especie_sel(){
		//Bovinos, Bovinos leche, Ovinos, Porcinos, Aves de corral, Caprinos
		for (var i = 1; i <= 6; i++) {
			on_change_pec_p2_especie('pec_p2r'+i+'_especie', ['#div_pec_p2r'+i+'_especie_sub']);
		}
		//Conejos, Pavos, Patos, Gansos, Pilíferos, Mulas y Asnos, Equinos, Ciervos, Otro
		for (var i = 7; i <= 15; i++){
			on_change_pec_p2_especie_7_15('pec_p2r'+i+'_especie', ['#div_pec_p2r'+i+'_especie_sub']);
		}
	}
	function on_change_pec_p2_especie(v_cmp_chk, a_selector, v_limpiar_campos=true, v_con_evento_change=false){
		mostrarSecciones($("input[name='"+v_cmp_chk+"']").is(':checked'), a_selector, v_limpiar_campos, v_con_evento_change);
		mostrar_pec_p2_hato();
		mostrar_pec_p5();
		$("input[name='"+v_cmp_chk+"']").on('change', function(){
			mostrarSecciones($(this).is(':checked'), a_selector, v_limpiar_campos, v_con_evento_change);
			mostrar_pec_p2_hato();
			mostrar_pec_p5();
			quitar_alerta_de_div("#div_an_pec_p2");
		});
	}
	
	function on_change_pec_p2_especie_7_15(v_cmp_chk, a_selector, v_limpiar_campos=true, v_con_evento_change=false){
		mostrarSecciones($("input[name='"+v_cmp_chk+"']").is(':checked'), a_selector, v_limpiar_campos, v_con_evento_change);
		$("input[name='"+v_cmp_chk+"']").on('change', function(){
			mostrarSecciones($(this).is(':checked'), a_selector, v_limpiar_campos, v_con_evento_change);
			mostrar_pec_p10();
			para_pec_p10();
			quitar_alerta_de_div("#div_an_pec_p2");
		});
	}
	
	
	function mostrar_pec_p2_hato(){
		mostrar_pec_p6();
		mostrar_pec_p7();
		mostrar_pec_p8();
		mostrar_pec_p9();
		mostrar_pec_p10();
		//Bovinos
		for (var j = 1; j <= 7; j++) {
			on_change_pec_p2rN_M_hato('pec_p2r1_'+j+'_hato', ['#fg_pec_p2r1_'+j+'_cabe', '#fg_pec_p2r1_'+j+'_peso', '#fg_pec_p2r1_'+j+'_prod'], "#div_an_pec_p2r1_hato");
		}
		//Bovinos leche
		for (var j = 1; j <= 2; j++) {
			on_change_pec_p2rN_M_hato('pec_p2r2_'+j+'_hato', ['#fg_pec_p2r2_'+j+'_cabe', '#fg_pec_p2r2_'+j+'_peso', '#fg_pec_p2r2_'+j+'_prod', '#fg_pec_p2r2_'+j+'_prod_d'], "#div_an_pec_p2r2_hato");
		}
		//Ovinos
		for (var j = 1; j <= 5; j++) {
			on_change_pec_p2rN_M_hato('pec_p2r3_'+j+'_hato', ['#fg_pec_p2r3_'+j+'_cabe', '#fg_pec_p2r3_'+j+'_peso', '#fg_pec_p2r3_'+j+'_prod'], "#div_an_pec_p2r3_hato");
		}
		//Porcinos
		for (var j = 1; j <= 7; j++) {
			on_change_pec_p2rN_M_hato('pec_p2r4_'+j+'_hato', ['#fg_pec_p2r4_'+j+'_cabe', '#fg_pec_p2r4_'+j+'_peso', '#fg_pec_p2r4_'+j+'_prod'], "#div_an_pec_p2r4_hato");
		}
		//Aves de corral
		for (var j = 1; j <= 2; j++) {
			on_change_pec_p2rN_M_hato('pec_p2r5_'+j+'_hato', ['#fg_pec_p2r5_'+j+'_cabe', '#fg_pec_p2r5_'+j+'_peso', '#fg_pec_p2r5_'+j+'_prod'], "#div_an_pec_p2r5_hato");
		}
		//Caprinos
		for (var j = 1; j <= 6; j++) {
			on_change_pec_p2rN_M_hato('pec_p2r6_'+j+'_hato', ['#fg_pec_p2r6_'+j+'_cabe', '#fg_pec_p2r6_'+j+'_peso', '#fg_pec_p2r6_'+j+'_prod'], "#div_an_pec_p2r6_hato");
		}
		
	}
	
	function mostrar_pec_p5(){
		//Bovinos
		var v_pec_p2r1_especie = ($("input[name='pec_p2r1_especie']").is(':checked'))? true : false;
		//Bovinos leche
		var v_pec_p2r2_especie = ($("input[name='pec_p2r2_especie']").is(':checked'))? true : false;
		//Ovinos
		var v_pec_p2r3_especie = ($("input[name='pec_p2r3_especie']").is(':checked'))? true : false;
		//Caprinos
		var v_pec_p2r6_especie = ($("input[name='pec_p2r6_especie']").is(':checked'))? true : false;
		var ver_pec_p5 = (v_pec_p2r1_especie || v_pec_p2r2_especie || v_pec_p2r3_especie || v_pec_p2r6_especie);
		var ver_pec_p5_sec_A = (v_pec_p2r1_especie || v_pec_p2r2_especie);
		var ver_pec_p5_sec_B = (v_pec_p2r3_especie || v_pec_p2r6_especie);
		
		mostrarSecciones(ver_pec_p5, ['#div_pec_p5']);
		mostrarSecciones(ver_pec_p5_sec_A, ['#div_pec_p5_sec_A']);
		mostrarSecciones(ver_pec_p5_sec_B, ['#div_pec_p5_sec_B']);
		
	}
	
	function on_change_pec_p2rN_M_hato(v_cmp_chk, a_selector, v_nom_div_alerta){
		limpiarCamposDentroDe(!$("input[name='"+v_cmp_chk+"']").is(':checked'), a_selector);
		$("input[name='"+v_cmp_chk+"']").on('change', function(){
			limpiarCamposDentroDe(!$(this).is(':checked'), a_selector);
			mostrar_pec_p6();
			para_pec_p6();
			mostrar_pec_p7();
			para_pec_p7();
			mostrar_pec_p8();
			mostrar_pec_p9();
			mostrar_pec_p10();
			para_pec_p10();
			quitar_alerta_de_div(v_nom_div_alerta);
		});
	}
	function mostrar_pec_p6(){
		//Vacas doble propósito	
		var v_pec_p2r1_3_hato = ($("input[name='pec_p2r1_3_hato']").is(':checked'))? true : false;
		//Vacas adultas	
		var v_pec_p2r2_1_hato = ($("input[name='pec_p2r2_1_hato']").is(':checked'))? true : false;
		//Ovejas adultas en producción de crías y de lana o pelo
		var v_pec_p2r3_1_hato = ($("input[name='pec_p2r3_1_hato']").is(':checked'))? true : false;
		//Ovejas adultas lecheras
		var v_pec_p2r3_3_hato = ($("input[name='pec_p2r3_3_hato']").is(':checked'))? true : false;
		//Cabras lecheras	
		var v_pec_p2r6_1_hato = ($("input[name='pec_p2r6_1_hato']").is(':checked'))? true : false;
		var ver_pec_p6 = (v_pec_p2r1_3_hato || v_pec_p2r2_1_hato || v_pec_p2r3_1_hato || v_pec_p2r3_3_hato || v_pec_p2r6_1_hato);
		
		mostrarSecciones(ver_pec_p6, ['#div_pec_p6_tit']);	//Títulos de la pregunta
		mostrarSecciones(v_pec_p2r1_3_hato, ['#div_pec_p6r1']);	//Vacas doble propósito
		mostrarSecciones(v_pec_p2r2_1_hato, ['#div_pec_p6r2']);	//Vacas adultas
		mostrarSecciones((v_pec_p2r3_1_hato || v_pec_p2r3_3_hato), ['#div_pec_p6r3']);	//Ovejas adultas lecheras
		mostrarSecciones(v_pec_p2r6_1_hato, ['#div_pec_p6r4']);	//Cabras lecheras
		
	}
	function mostrar_pec_p7(){
		//Vacas para cría para carne
		var v_pec_p2r1_1_hato = ($("input[name='pec_p2r1_1_hato']").is(':checked'))? true : false;
		//Vacas doble propósito
		var v_pec_p2r1_3_hato = ($("input[name='pec_p2r1_3_hato']").is(':checked'))? true : false;
		//Vacas adultas
		var v_pec_p2r2_1_hato = ($("input[name='pec_p2r2_1_hato']").is(':checked'))? true : false;
		//Ovejas adultas para producción de crías
		var v_pec_p2r3_1_hato = ($("input[name='pec_p2r3_1_hato']").is(':checked'))? true : false;
		//Ovejas adultas para producción de crías y de lana o pelo
		var v_pec_p2r3_2_hato = ($("input[name='pec_p2r3_2_hato']").is(':checked'))? true : false;
		//Ovejas adultas lecheras
		//var v_pec_p2r3_3_hato = ($("input[name='pec_p2r3_3_hato']").is(':checked'))? true : false;
		//Cerdas en gestación
		var v_pec_p2r4_1_hato = ($("input[name='pec_p2r4_1_hato']").is(':checked'))? true : false;
		//Cabras lecheras
		var v_pec_p2r6_1_hato = ($("input[name='pec_p2r6_1_hato']").is(':checked'))? true : false;
		//Cabras hembras adultas para producir cabrito
		var v_pec_p2r6_2_hato = ($("input[name='pec_p2r6_2_hato']").is(':checked'))? true : false;
		//Cabras hembras adultas de reemplazo para pie de cría
		var v_pec_p2r6_3_hato = ($("input[name='pec_p2r6_3_hato']").is(':checked'))? true : false;
		
		var ver_pec_p7 = (v_pec_p2r1_1_hato || v_pec_p2r1_3_hato || v_pec_p2r2_1_hato || v_pec_p2r3_1_hato || v_pec_p2r3_2_hato || v_pec_p2r4_1_hato || v_pec_p2r6_1_hato || v_pec_p2r6_2_hato || v_pec_p2r6_3_hato);
		
		mostrarSecciones(ver_pec_p7, ['#div_pec_p7_tit']);	//Títulos de la pregunta
		mostrarSecciones(v_pec_p2r1_1_hato, ['#div_pec_p7r1']);	//Vacas para cría para carne
		mostrarSecciones(v_pec_p2r1_3_hato, ['#div_pec_p7r2']);	//Vacas doble propósito
		mostrarSecciones(v_pec_p2r2_1_hato, ['#div_pec_p7r3']);	//Vacas adultas
		mostrarSecciones(v_pec_p2r3_1_hato, ['#div_pec_p7r4']);	//Ovejas adultas para producción de crías
		mostrarSecciones(v_pec_p2r3_2_hato, ['#div_pec_p7r5']);	//Ovejas adultas para producción de crías y de lana
		mostrarSecciones(v_pec_p2r4_1_hato, ['#div_pec_p7r6']);	//Cerdas en gestación
		mostrarSecciones(v_pec_p2r6_1_hato, ['#div_pec_p7r7']);	//Cabras lecheras
		mostrarSecciones((v_pec_p2r6_2_hato || v_pec_p2r6_3_hato), ['#div_pec_p7r8']);	//Cabras adultas
	}
	function mostrar_pec_p8(){
		//Terneros antes del destete
		var v_pec_p2r1_6_hato = ($("input[name='pec_p2r1_6_hato']").is(':checked'))? true : false;
		
		mostrarSecciones(v_pec_p2r1_6_hato, ['#div_pec_p8']);
	}
	function mostrar_pec_p9(){
		//Ovejas adultas para producción de crías y de lana o pelo
		var v_pec_p2r3_2_hato = ($("input[name='pec_p2r3_2_hato']").is(':checked'))? true : false;
		mostrarSecciones(v_pec_p2r3_2_hato, ['#div_pec_p9']);
	}
	
	function mostrar_pec_p10(){
		//Bueyes para fuerza de tiro
		var v_pec_p2r1_5_hato = ($("input[name='pec_p2r1_5_hato']").is(':checked'))? true : false;
		//Mulas y Asnos
		var v_pec_p2r12_especie = ($("input[name='pec_p2r12_especie']").is(':checked'))? true : false;
		// Equinos
		var v_pec_p2r13_especie = ($("input[name='pec_p2r13_especie']").is(':checked'))? true : false;
		var ver_pec_p10 = (v_pec_p2r1_5_hato || v_pec_p2r12_especie || v_pec_p2r13_especie);
		
		mostrarSecciones(ver_pec_p10, ['#div_pec_p10_tit', '#div_pec_p10r4']);
		
		mostrarSecciones(v_pec_p2r1_5_hato, ['#div_pec_p10r1']);	//Bueyes para fuerza de tiro
		mostrarSecciones(v_pec_p2r12_especie, ['#div_pec_p10r2']);	//Mulas y Asnos
		mostrarSecciones(v_pec_p2r13_especie, ['#div_pec_p10r3']);	//Equinos
		
	}
	function para_pec_p3(){
		var a_fg_pec_p3N6_t_ene = [];
		var x = 0;
		for (var i = 1; i <= 9; i++) {
			a_fg_pec_p3N6_t_ene[x++] = '#fg_pec_p3r'+i+'_t_ene';
			a_fg_pec_p3N6_t_ene[x++] = '#fg_pec_p3r'+i+'_cant';
			a_fg_pec_p3N6_t_ene[x++] = '#fg_pec_p3r'+i+'_sup';
		}
		//Se debe de llamar primero esta función antes, de lo contrario el resto de código deja de funcionar
		on_change_chk_sel_bloquear('pec_p3r10_t_ene', a_fg_pec_p3N6_t_ene);
		
		for (var i = 1; i <= 9; i++) {
			on_change_chk_sel_desbloquear('pec_p3r'+i+'_t_ene', ['#fg_pec_p3r'+i+'_cant','#fg_pec_p3r'+i+'_sup'], true, false, '#div_an_pec_p3');
		}
		
	}
	
	function para_pec_p4(){
		for (var i = 1; i <= 12; i++) {
			on_change_chk_sel_desbloquear('pec_p4r'+i, [], true, false, '#div_an_pec_p4');	//Sólo para ocultar el mensaje de alerta
		}
		on_change_chk_sel_mostrar('pec_p4r13', ['#fg_pec_p4r13_esp'], true, false, '#div_an_pec_p4');
	}
	function para_pec_p5(){
		for (var i = 1; i <= 4; i++) {
			on_change_chk_sel_mostrar('pec_p5r'+i+'_donde', ['#div_pec_p5r'+i+'_donde_sub'], true, false, '#div_an_pec_p5_a');
		}
		for (var i = 4; i <= 6; i++) {
			on_change_chk_sel_mostrar('pec_p5r'+i, [], true, false, '#div_an_pec_p5_b');	//Sólo para ocultar el mensaje de alerta
		}
		for (var i = 1; i <= 6; i++) {
			on_change_chk_sel_mostrar('pec_p5r5_'+i, [], true, false, '#div_an_pec_p5r5');	//Sólo para ocultar el mensaje de alerta
		}
		on_change_chk_sel_mostrar('pec_p5r5_6', ['#fg_pec_p5r5_6_esp'], true, false, '#div_an_pec_p5r5');
		on_change_chk_sel_mostrar('pec_p5r5', ['#div_pec_p5r5_sub']);
	}
	function para_pec_p6(){
		for (var i = 1; i <= 4; i++) {
			on_change_chk_sel_desbloquear('pec_p6r'+i+'_espe', ['#fg_pec_p6r'+i+'_prod'], true, false, '#div_an_pec_p6');
		}
	}
	function para_pec_p7(){
		for (var i = 1; i <= 9; i++) {
			if(i<=3){
				on_change_chk_sel_desbloquear('pec_p7r'+i+'_espe', ['#fg_pec_p7r'+i+'_porc'], true, false, '#div_an_pec_p7');
			}else{
				on_change_chk_sel_desbloquear('pec_p7r'+i+'_espe', ['#fg_pec_p7r'+i+'_porc','#fg_pec_p7r'+i+'_crias'], true, false, '#div_an_pec_p7');
			}
		}
	}
	function para_pec_p10(){
		var a_fg_pec_p10r1 = [];
		var x = 0;
		for (var i = 1; i <= 3; i++) {
			a_fg_pec_p10r1[x++] = '#fg_pec_p10r'+i+'_espe';
			a_fg_pec_p10r1[x++] = '#fg_pec_p10r'+i+'_h_dia';
			a_fg_pec_p10r1[x++] = '#fg_pec_p10r'+i+'_d_anio';
		}
		//Se debe de llamar primero esta función antes, de lo contrario el resto de código deja de funcionar
		on_change_chk_sel_bloquear('pec_p10r4_espe', a_fg_pec_p10r1);
		
		for (var i = 1; i <= 3; i++) {
			on_change_chk_sel_desbloquear('pec_p10r'+i+'_espe', ['#fg_pec_p10r'+i+'_h_dia', '#fg_pec_p10r'+i+'_d_anio'], true, false, '#div_an_pec_p10');
		}
		on_change_chk_sel_desbloquear('pec_p10r4_espe', [], true, false, '#div_an_pec_p10');
	}
	function para_pec_p11(){
		for (var i = 1; i <= 12; i++) {
			on_change_pec_p11("pec_p11r"+i, ["#div_pec_p11r"+i+"_sub"]);
			quitar_alerta_en_p11('pec_p11r'+i+'_porc');
		}
		
	}
	function quitar_alerta_en_p11(v_cmp_num){
		$("input[name='"+v_cmp_num+"']").on('click', function(){
			quitar_alerta_de_div('#div_an_pec_p11_tot');
		});
	}
	function on_change_pec_p11(v_cmp_chk, a_selector, v_limpiar_campos=true, v_con_evento_change=false){
		mostrarSecciones($("input[name='"+v_cmp_chk+"']").is(':checked'), a_selector, v_limpiar_campos, v_con_evento_change);
		mostrar_pec_p11_p();
		$("input[name='"+v_cmp_chk+"']").on('change', function(){
			mostrarSecciones($(this).is(':checked'), a_selector, v_limpiar_campos, v_con_evento_change);
			mostrar_pec_p11_p();
			quitar_alerta_de_div('#div_an_pec_p11');
		});
	}
	function mostrar_pec_p11_p(){
		var x=0;
		var a_p11_cmp_sum = [];
		a_p11_cmp_sum[x++] = ['pec_p11r1_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r2_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r3_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r4_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r5_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r6_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r7_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r8_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r9_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r10_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r11_porc'];
		a_p11_cmp_sum[x++] = ['pec_p11r12_porc'];
		
		a_p11_cmp_sum.forEach(function(v_cmp_id_nom){
			on_change_cmp_suma(v_cmp_id_nom, a_p11_cmp_sum, 'pec_p11_tot', 'div_pec_p11_tot');
		});
		
	}
	return {
		activar:function(){
			para_pec_p2();
			para_pec_p3();
			para_pec_p4();
			para_pec_p5();
			para_pec_p6();
			para_pec_p7();
			para_pec_p10();
			para_pec_p11();
		}
	};
}();

