/**
 * Función IIFE para el formulario de cultivo
 * @type 
 */
var FrmInventario = function(){
	return{
		activar:function(){
			formulario_faq = new formulario_modal();
			formulario_faq.on_click_btn_abrir('btn_abrir', 'ajax', 'get_arr_reg_cult_inventario', 'cult_inventario_id', 'mdl_inventario', 'frm_inventario');
			formulario_faq.on_hide_modal(["cult_inventario_id"]);
		}
	}
}();
