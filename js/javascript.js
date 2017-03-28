/**************************************************

	ARCHIVO DE FUNCIONES JAVASCRIPT

***************************************************/


//FUNCION PARA MOSTRAR EL CALENDARIO DESPLEGABLE DEL FORMULARIO EN CASTELLANO
		 $.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '< Ant',
		 nextText: 'Sig >',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 dateFormat: 'dd/mm/yy',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
		 };

		//LLAMADA A LA FUNCION DE LA CREACION DEL CALENDARIO CON FECHA FIJADA EN LA ACTUAL Y A UN MAXIMO DE 2 AÑOS 
		$(function () {
			$.datepicker.setDefaults($.datepicker.regional["es"]);
				$("#fecha-fin").datepicker({
				minDate: "+0D",
				maxDate: "+24M"
				});
		});	

/*****************************************************************************************************************************************************/
	
	//FUNCION TABLA ACORDEON
	$(function() {
      $(".fila-proyecto tr:first-child").show();
      $(".fila-proyecto tr:not(.acordeon)").hide();
      

      $(".fila-proyecto tr.acordeon").click(function(){
          $(this).nextAll("tr").fadeToggle(250);
      }); //.eq(0).trigger('click'); //para ejecutar automaticamente al cargar la vista de las pujas
     });