/**
 * Funciones generales
 */

/**
 * Redirecciona al control especificado, se llega a llamar por la función php define_controlador
 * @param v_forma	Nombre de la forma con al que se hace el submit
 * @param v_controlador	Nombre del controlador
 * @param v_accion	Nombre de la acción
 * @param v_url_arg	Argumentos adicionales
 * @param v_campo_x_arg	Bandera que define si los argumentos adicionales se almacenan dentro de los campos previamente declarados dentro de la forma v_forma
 * @returns
 */
function f_ir_a_controlador(v_forma, v_controlador, v_accion, v_url_arg, v_campo_x_arg){
	v_url_arg = (typeof v_url_arg == "undefined")? "" : v_url_arg;
	
	if(v_campo_x_arg){
		//Se asignan en la forma v_forma los campos definidos en el argumento v_url_arg
		f_asigna_arg_url_en_campos(v_forma, v_url_arg);
		v_url_arg="";	//Se limpia para que ya no se mande por argumento (Esto es solo por la parte visual, ya que en lo funcional no afecta si se deja el valor debido a quien manda es el valor en el campo)
	}
											   
	document.forms.namedItem(v_forma).action = "index.php?controlador="+v_controlador+"&accion="+v_accion+v_url_arg;
	document.forms.namedItem(v_forma).submit();
}

/**
 * 
 * @param v_controlador
 * @param v_accion
 * @param v_url_arg
 * @param v_target
 * @returns
 */
function f_ir_a_otra_ventana(v_ruta, v_target){
	v_target = (v_target=='')? '_new' : v_target;
	window.open(v_ruta, v_target);
}


/**
 * Oculta secciones completas
 * @param slide {boolean} Si se quiere ocultar o mostrar la sección
 * @param patron {string} Puede ser un #id, .class o una expresión regular
 */
function ocultar_secciones(slide, patron){
	if(slide){
		$(patron).slideUp("slow");
	}else{
		$(patron).slideDown("slow");
	}
}
/**
 * Bloquea y limpia una lista de campos
 * @param bloquea {boolean} 
 * @param campos
 */
function bloqueaCampos(bloquea, campos, limpiar){
	if (limpiar === undefined){
		limpiar = true;
	}
	
	$.each(campos, function(index, campo){
		if($("#"+campo).length > 0){
			if(bloquea && limpiar){
				if($("#"+campo).is(":checkbox")) {
					$("#"+campo).attr("checked", false);
				}else{
					$("#"+campo).val("");
				}
			}
			
			$("#"+campo).attr("disabled", bloquea);
			
			
			$("#"+campo).change();
			
			if($("#"+campo).is(":text")) {
				$("#"+campo).keyup();
			}
			
		}else{
			var msg = "Se esta intentado "+
						"bloquear el campo \""+campo+"\" "+
						"que no existe en esta forma.";
			
			alert(msg);
		}
	});
}
/**
 * Regresa el valor de cualquier campo de la forma actual
 * @param id {string} Identificador del campo
 * @param return_num {boolean} Si queremos que el valor sea devuelto como número
 *        detault false
 * @returns {mixed}
 */
function getValueForm(id, return_num){
	var value = "";
	
	if($("#"+id).is(":checkbox")){
		value = ($("#"+id).is(':checked'))?"1":"";
	}else{
		value = $("#"+id).val();
	}

	if(value === null){
		value = "";
	}

	return_num = (return_num === undefined)?false:return_num;

	if(return_num){
		if(value === ""){
			value = 0;
		}else{
			value = parseFloat(value);
		}
	}

	return value;
}
/**
 * Abre en una ventana nueva la redirección al control especificado
 * @param v_controlador	Nombre del controlador
 * @param v_accion	Nombre de la acción
 * @param v_url_arg	Más argumentos dentro del URL, si es necesario
 * @param v_target	Atributo Target o nombre de la ventana
 * @returns
 */
function f_ventana_ir_a_controlador(v_controlador, v_accion, v_url_arg, v_target){
	v_target = (v_target=='')? '_new' : v_target;
	window.open("index.php?controlador="+v_controlador+"&accion="+v_accion+v_url_arg, v_target);
}

/**
 * A partir de un argumento url se obtienen los campos y su valor que se asignan a los campos que se deben encontrar en la forma definida
 * @param v_forma	Nombre de la forma donde se encuentran los campos
 * @param v_url_arg	Argumento URL que contiene el nombre de campo y valor
 * @returns
 */
function f_asigna_arg_url_en_campos(v_forma, v_url_arg) {
    var sURLVariables = v_url_arg.split('&'),sParameterName,i, v_forma, v_cmp_nom, v_cmp_val, o_cmp_asig;
    
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if(sParameterName[0]!="" && sParameterName[1] !== undefined){
        	try{
        		v_cmp_nom = sParameterName[0];
            	v_cmp_val = decodeURIComponent(sParameterName[1]);
            	o_cmp_asig = document.getElementById(v_forma).elements.namedItem(v_cmp_nom);
            	if(o_cmp_asig === null){
            		alert("Campo ["+v_cmp_nom+"] no definido en la forma ["+v_forma+"]");
            	}else{
            		o_cmp_asig.value = v_cmp_val;
            	}
        	}catch(e){
        		alert("Error interno: ["+e.message+"]");
    			console.log(e);
        	}
        	
        	
        }
                
    }
};

/**
 * Limpia todos los campos contenidos dentro del selector o selectores definidos el argumento tipo arreglo a_selector
 * @param {bool} v_aplicar	Condición si se va a aplicar la limpieza o no. En caso contrario, si la bandera v_limpiar_y_bloquear es verdadera, se desbloquean los campos únicamente
 * @param {array} a_selector	Arreglo con los textos para identificar la sección o div a limpiar, ejemplo:  con el id (#[nombre]) o la clase (.[nombre])
 * @param {bool} v_limpiar_y_bloquear	Bandera que indica si además de limpiar se va a hacer bloqueo de campos. Default es true.
 * @param {bool} v_con_evento_change	Bandera para permitir ejecutar el evento change despues de hacer la limpieza de campos. NOTA: Se recomienda usar sólo para ocultamiento enraizados
 */
function limpiarCamposDentroDe(v_aplicar, a_selector, v_limpiar_y_bloquear=true, v_con_evento_change=false){
	if(a_selector.length){
		a_selector.forEach(function(v_selector){
			limpiarCamposEnDOM(v_aplicar, $(v_selector), v_limpiar_y_bloquear, v_con_evento_change);
		});
	}
}
/**

 */

/**
 * Limpia todos los campos contenidos dentro del objeto tipo DOM o_DOM
 * @param {bool} v_aplicar	Condición si se va a aplicar la limpieza o no. En caso contrario, si la bandera v_limpiar_y_bloquear es verdadera, se desbloquean los campos únicamente
 * @param {Object} o_DOM	Objeto tipo DOM
 * @param {bool} v_limpiar_y_bloquear	Bandera que indica si además de limpiar se va a hacer bloqueo de campos. Default es true. 
 * @param {bool} v_con_evento_change	Bandera para permitir ejecutar el evento change despues de hacer la limpieza de campos. NOTA: Se recomienda usar sólo para ocultamiento enraizados
 */
function limpiarCamposEnDOM(v_aplicar, o_DOM, v_limpiar_y_bloquear=true, v_con_evento_change=false){
	if(o_DOM.length){
		o_DOM.each(function(){
			//var o_input = $(this).find("input");
			var o_input = $(this).find("input");	//Todos los campos input
			var o_select = $(this).find("select");	//Todos los campos select
			var o_textarea = $(this).find("textarea");	//Todos los campos textarea
			//Para campos input
			if(o_input.length){
				o_input.each(function(){
					if($(this).attr('type') === 'checkbox' || $(this).attr('type') === 'radio'){
						if(v_aplicar){
							$(this).prop( "checked", false );
						}
					}else{
						if(v_aplicar){
							$(this).val("");
						}
					}
					if(v_con_evento_change){
						$(this).change();
					}
				});

				//Si además de aplicar limpieza se apliva bloqueo...
				if(v_limpiar_y_bloquear){
					o_input.attr("disabled", v_aplicar);
				}
				
				
			}
			//Para campos textarea
			if(o_textarea.length){
				if(v_aplicar){
					o_textarea.val("");
				}
				//Si además de aplicar limpieza se apliva bloqueo...
				if(v_limpiar_y_bloquear){
					o_textarea.attr("disabled", v_aplicar);
				}
			}
			//Para campos select
			if(o_select.length){
				var o_select2 = $(this).find("select[class~='select2']");

				if(o_select2.length){
					if(v_aplicar){
						//El widget Select2 no permite limpiar los campos select, debido a eso, primero se debe destruir antes de limpiar el campo
						o_select2.select2('destroy');
					}else{
						//Se vuelve a revertir habilitando de nuevo el widget Select2
						o_select2.select2();
					}
				}
				if(v_aplicar){
					o_select.val("");
				}
				//Si además de aplicar limpieza se apliva bloqueo...
				if(v_limpiar_y_bloquear){
					o_select.attr("disabled", v_aplicar);
				}else{
					//Si no se va a bloquear, se vuelve a habilitar el widget Select2
					if(o_select2.length){
						o_select2.select2();
					}
				}
			}
		});
	}
}


/**
 * Manda llamar a la función ocultarSecciones, invirtiendo la condición v_aplica
 * @param {bool} v_aplicar	Condición si se va a aplicar la limpieza o no. En caso contrario, si la bandera v_limpiar_y_bloquear es verdadera, se desbloquean los campos únicamente
 * @param {array} a_selector	Arreglo con los textos para identificar la sección o div a limpiar, ejemplo:  con el id (#[nombre]) o la clase (.[nombre])
 * @param {type} v_limpiar_campos	Bandera que indica si además de limpiar se va a hacer bloqueo de campos. Default es true. 
 * @param {bool} v_con_evento_change	Bandera para permitir ejecutar el evento change despues de hacer la limpieza de campos. NOTA: Se recomienda usar sólo para ocultamiento enraizados
 * @returns {undefined}
 */
function mostrarSecciones(v_aplicar, a_selector, v_limpiar_campos = true, v_con_evento_change=false){
	ocultarSecciones(!v_aplicar, a_selector, v_limpiar_campos, v_con_evento_change);
}

/**

 */


/**
 * Limpia y oculta todos los campos contenidos dentro del selector o selectores definidos el argumento tipo arreglo a_selector
 * @param {bool} v_aplicar	Condición si se va a aplicar la limpieza o no. En caso contrario, si la bandera v_limpiar_y_bloquear es verdadera, se desbloquean los campos únicamente
 * @param {array} a_selector	Arreglo con los textos para identificar la sección o div a limpiar, ejemplo:  con el id (#[nombre]) o la clase (.[nombre])
 * @param {bool} v_limpiar_campos	Bandera que indica si además de limpiar se va a hacer bloqueo de campos. Default es true. 
 * @param {bool} v_con_evento_change	Bandera para permitir ejecutar el evento change despues de hacer la limpieza de campos. NOTA: Se recomienda usar sólo para ocultamiento enraizados
 * @returns {undefined}
 */
function ocultarSecciones(v_aplicar, a_selector, v_limpiar_campos = true, v_con_evento_change=false){
	if(a_selector.length){
		a_selector.forEach(function(v_selector){
			ocultarDOM(v_aplicar, $(v_selector), v_limpiar_campos, v_con_evento_change);
		});
	}
}
/**

 */

/**
 * Limpia y oculta todos los campos contenidos dentro del objeto DOM definido en el argumento o_DOM
 * @param {bool} v_aplicar
 * @param {Object} o_DOM
 * @param {bool} v_limpiar_y_bloquear
 * @param {bool} v_con_evento_change	Bandera para permitir ejecutar el evento change despues de hacer la limpieza de campos. NOTA: Se recomienda usar sólo para ocultamiento enraizados
 * @returns {undefined}
 */
function ocultarDOM(v_aplicar, o_DOM, v_limpiar_y_bloquear = true, v_con_evento_change=false){
	if(o_DOM.length){
		limpiarCamposEnDOM(v_aplicar, o_DOM, v_limpiar_y_bloquear, v_con_evento_change);
		o_DOM.each(function(){
			if(v_aplicar){
				$(this).hide(200);
			}else{
				$(this).show(200);
			}
		});
		
	}
}
function get_op_suma(a_campos_sumar){
	var v_res = 0;
	
	if(Array.isArray(a_campos_sumar)){
		a_campos_sumar.forEach(function(v_cmp_id_nom){
			var v_cmp_val = getValueForm(v_cmp_id_nom, true);
			if(!isNaN(v_cmp_val)){
				v_res += v_cmp_val;
			}
		});
	}
	return v_res;
}



/**
* Función que realiza el llamado al evento onChange para el campo checkbox, además de ejecutarse por primera vez en cada carga.
* Hace el llamado a la función mostrarSecciones, dependiendo del campo checkbox mandado en el argumento
* @param {string} v_cmp_chk	Campo checkbox que define el el valor para el argumento v_aplicar de la función mostrarSecciones
* @param {array} a_selector	Arreglo con los textos para identificar la sección o div a limpiar, ejemplo:  con el id (#[nombre]) o la clase (.[nombre])
* @param {bool} v_limpiar_campos	Bandera que indica si además de limpiar se va a hacer bloqueo de campos. Default es true. 
* @param {bool} v_con_evento_change	Bandera para permitir ejecutar el evento change despues de hacer la limpieza de campos. NOTA: Se recomienda usar sólo para ocultamiento enraizados
*/
function on_change_chk_sel_mostrar(v_cmp_chk, a_selector, v_limpiar_campos=true, v_con_evento_change=false, v_nom_div_alerta=""){
   mostrarSecciones($("input[name='"+v_cmp_chk+"']").is(':checked'), a_selector, v_limpiar_campos, v_con_evento_change);
   $("input[name='"+v_cmp_chk+"']").on('change', function(){
	   mostrarSecciones($(this).is(':checked'), a_selector, v_limpiar_campos, v_con_evento_change);
	   quitar_alerta_de_div(v_nom_div_alerta);
   });
}

/**
 * Si el campo check se selecciona, desbloquea el contenido dentro de los selectores definidos en el argumento a_selector
 * @param {string} v_cmp_chk	Nombre del campo check que define si se oculta o no las secciones definidas en a_selector
 * @param {array} a_selector	Arreglo con los textos para identificar la sección o div a limpiar, ejemplo:  con el id (#[nombre]) o la clase (.[nombre])
 * @param {bool} v_limpiar_y_bloquear	Bandera que indica si además de limpiar se va a hacer bloqueo de campos. Default es true.
 * @param {bool} v_con_evento_change	Bandera para permitir ejecutar el evento change despues de hacer la limpieza de campos. NOTA: Se recomienda usar sólo para ocultamiento enraizados
 * @param {string} v_nom_div_alerta	Id nombre del elemento div que contiene el mensaje de alerta que se desea limpiar
 * @returns {undefined}
 */
function on_change_chk_sel_desbloquear(v_cmp_chk, a_selector, v_limpiar_y_bloquear=true, v_con_evento_change=false, v_nom_div_alerta=""){
   limpiarCamposDentroDe(!$("input[name='"+v_cmp_chk+"']").is(':checked'), a_selector);
   $("input[name='"+v_cmp_chk+"']").on('change', function(){
	   limpiarCamposDentroDe(!$(this).is(':checked'), a_selector, v_limpiar_y_bloquear, v_con_evento_change);
	   quitar_alerta_de_div(v_nom_div_alerta);
   });
}
/**
 * Si el campo check se selecciona, bloquea el contenido dentro de los selectores definidos en el argumento a_selector
 * @param {string} v_cmp_chk	Nombre del campo check que define si se oculta o no las secciones definidas en a_selector
 * @param {array} a_selector	Arreglo con los textos para identificar la sección o div a limpiar, ejemplo:  con el id (#[nombre]) o la clase (.[nombre])
 * @param {bool} v_limpiar_y_bloquear	Bandera que indica si además de limpiar se va a hacer bloqueo de campos. Default es true.
 * @param {bool} v_con_evento_change	Bandera para permitir ejecutar el evento change despues de hacer la limpieza de campos. NOTA: Se recomienda usar sólo para ocultamiento enraizados
 * @param {string} v_nom_div_alerta	Nombre del div que contiene el mensaje de alerta que se desea limpiar
 * @returns {undefined}
 */
function on_change_chk_sel_bloquear(v_cmp_chk, a_selector, v_limpiar_y_bloquear=true, v_con_evento_change=false, v_nom_div_alerta=""){
	//console.log("Jala para "+v_cmp_chk);
	limpiarCamposDentroDe($("input[name='"+v_cmp_chk+"']").is(':checked'), a_selector);
	$("input[name='"+v_cmp_chk+"']").on('change', function(){
		limpiarCamposDentroDe($(this).is(':checked'), a_selector, v_limpiar_y_bloquear, v_con_evento_change);
		quitar_alerta_de_div(v_nom_div_alerta);
	});
}
/**
 * 
 * @param {string} v_nom_cmp
 * @param {string} v_nom_div_alerta
 * @returns {undefined}
 */
function on_change_chk_sel_mostrar_sub(v_nom_cmp, v_nom_div_alerta=""){
   chk_sel_mostrar_sub($("input[name='"+v_nom_cmp+"']"), ["#div_"+v_nom_cmp+"_sub"]);
   $("input[name='"+v_nom_cmp+"']").on('change', function(){
		   chk_sel_mostrar_sub($(this), ["#div_"+v_nom_cmp+"_sub"]);
		   quitar_alerta_de_div(v_nom_div_alerta);
   });
}
/**
* Función que realiza el llamado al evento onChange para el campo definido en el argumento v_cmp_change y realizar la operación suma con los campos definidos por su Id en el arreglo argumento a_cmps_suma
* @param {type} v_cmp_change	Nombre del campo al que se le declara el evento on_change y poder ejecutar la operación de suma
* @param {type} a_cmps_suma	Arreglo con los nombres de los campos que se van a sumar
* @param {type} v_cmp_set_res	Nombre del campo donde se asignará el resultado de la suma
* @param {type} v_html_set_res	Elemento HTML donde se asignará el resultado
*/
function on_change_cmp_suma(v_cmp_change, a_cmps_suma, v_cmp_set_res, v_html_set_res="", v_nom_div_alerta=""){
   $("input[name='"+v_cmp_change+"']").on('change', function(){
	   var v_resultado = get_op_suma(a_cmps_suma);
	   $("input[name='"+v_cmp_set_res+"']").val(v_resultado);
	   if(v_html_set_res!==""){
		   $("#"+v_html_set_res).html(v_resultado);
	   }
	   quitar_alerta_de_div(v_nom_div_alerta);
   });
}
/**
* Ejecuta la función  "mostrarSecciones" con la bandera v_con_evento_change activada.
* Al ejecutarse de esta forma "mostrarSecciones", hereda el argunmento hasta la función "limpiarCamposEnDOM" en donde permite llamar al evento change en todos los campos implicados, 
* desencadenado así, todas las funciones de esos campos, de la misma forma como si fueran seleccionadas manualmente.
* AVISO. Mandar llamar esta función sólo en aquellos casos que sí se requiera dicho desencadenamiento, debido a la redundancia de llamado de funciones
* donde inclusive puede llegar a generar un redundancia infinita y saturación de la memoria.
* @param {objet} o_this
* @param {array} a_selector
*/
function chk_sel_mostrar_sub(o_this, a_selector){
   if(o_this.is(':checked')){
	   mostrarSecciones(true, a_selector, true, true);
   }else{
	   mostrarSecciones(false, a_selector);

   }
}
/**
* Ejecuta la función mostrarSecciones para campos select cuya sentencia se cumple cuando su valor es igual a 2.
* @param {object} o_this	Objeto del campo select
* @param {array} a_selector	Arreglo con los textos para identificar la sección o div a limpiar, ejemplo:  con el id (#[nombre]) o la clase (.[nombre])
* @param {bool} v_limpiar_campos	Bandera que indica si además de limpiar se va a hacer bloqueo de campos. Default es true. 
* @param {bool} v_con_evento_change	Bandera para permitir ejecutar el evento change despues de hacer la limpieza de campos. NOTA: Se recomienda usar sólo para ocultamiento enraizados
*/
function mostrar_opc_sel_no_si(o_this, a_selector, v_limpiar_campos = true, v_con_evento_change=false){
   var v_mostrar = (parseInt(o_this.val()) === 2);
   mostrarSecciones(v_mostrar, a_selector, v_limpiar_campos = true, v_con_evento_change=false);
}

/**
 * Remueve el div de bloqueo creado con jsShowWindowLoad()
 */
function jsRemoveWindowLoad() {
    // eliminamos el div que bloquea pantalla
    $("#WindowLoad").remove();
 
}
/**
 * Crea una div que bloquea toda la pantalla. Util para cuando se ejecuta un query pesado
 * @param {string} mensaje
 */
function jsShowWindowLoad(mensaje) {
    //eliminamos si existe un div ya bloqueando
    jsRemoveWindowLoad();
 
    //si no enviamos mensaje se pondra este por defecto
    if (mensaje === undefined) mensaje = "Procesando la información&amp;lt;br&amp;gt;Espere por favor";
 
    //centrar imagen gif
    height = 20;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;
 
    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;
 
    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto/2 - parseInt(height)/2;//Se utiliza en el margen superior, para centrar
 
   //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div><div class='spinner-border' role='status'><span class='sr-only'>Cargando...</span></div></div>";
 
        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);
 
        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"
 
        //asignamos el div que bloquea
        $("#WindowLoad").append(input);
 
        //asignamos el foco y ocultamos el input text
        $("#focusInput").focus();
        $("#focusInput").hide();
 
        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);
 
}
/**
 * Para los elementos div usados para desplegar alertas que no están asignadas a un campo, esta función quita el mensaje de alerta
 * @param {string} v_nom_div	Id del elemento div que se quiere quitar el mensaje
 */
function quitar_alerta_de_div(v_nom_div){
	if(v_nom_div!==""){
		$(v_nom_div).find("span.help-block").html("");
	}
}