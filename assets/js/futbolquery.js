$(document).ready(function(){	
	//alert('cargado');
	$('.ir-arriba').click(function(){
		// body...
		$('body, html').animate({
			scrollTop: '0px'
		}, 2000);
	});

	$(window).scroll(function(){
		if( $(this).scrollTop() > 200){
			$('.ir-arriba').slideDown(1900);
		} else{
			$('.ir-arriba').slideUp(1900); 
		}
	});

	// TOGGLE-MENU
	$(".btn-menu .fa-bars").click(function(){ 
		$(".navbar").toggleClass("left0");
	});

	$(".btn-cerrar").click(function(){
		$("#modal").addClass("hidden");
		$("#modal").removeClass("mostrar");
		$("#modal2").addClass("hidden");
		$("#modal2").removeClass("mostrar");
		$("#modal3").addClass("hidden");
		$("#modal3").removeClass("mostrar");
		$("#modal11").addClass("hidden");
		$("#modal11").removeClass("mostrar");
		$("#modal12").addClass("hidden");
		$("#modal12").removeClass("mostrar");
		$("#modal13").addClass("hidden");
		$("#modal13").removeClass("mostrar");
		$("#form_register_user")[0].reset();
		$("body").removeClass("overflow");
	});

	$(".btn-login").click(function(){
		$("#modal").addClass("mostrar");
		$("#modal").removeClass("hidden");
		$("body").addClass("overflow");
	});

	$("#btn-perfil").click(function(){
		$(".sub-perfil").addClass("flex");
		$(".sub-perfil").removeClass("hidden");
		$("body").addClass("overflow");
	});

	$("#btn-perfil2").click(function(){
		$("#modal11").addClass("mostrar");
		$("#modal11").removeClass("hidden");
		$(".sub-perfil").addClass("hidden");
		$(".sub-perfil").removeClass("flex");
		$("body").addClass("overflow");
	});
	
	$("#btn-registrate").click(function(){
		$("#modal").addClass("hidden");
		$("#modal").removeClass("mostrar");
		$("#modal2").addClass("mostrar");
		$("#modal2").removeClass("hidden");
		$("body").addClass("overflow");
	});
	
	$("#btn-login2").click(function(){
		$("#modal2").addClass("hidden");
		$("#modal2").removeClass("mostrar");
		$("#modal").addClass("mostrar");
		$("#modal").removeClass("hidden");
		$("body").addClass("overflow");
	});

	$("#btn-contacto").click(function(){		
		$("#modal3").removeClass("hidden");
		$("#modal3").addClass("mostrar");
		$("body").addClass("overflow");
	});

	
	
	$("#btn-edit-user").click(function(){
		$("#modal12").addClass("mostrar");
		$("#modal12").removeClass("hidden");
		$("#modal11").addClass("hidden");
		$("#modal11").removeClass("mostrar");
		$("body").addClass("overflow");
	});
	
	$("#btn-edit-user-habi").click(function(){
		$("#modal13").addClass("mostrar");
		$("#modal13").removeClass("hidden");
		$("#modal11").addClass("hidden");
		$("#modal11").removeClass("mostrar");
		$("body").addClass("overflow");
	});
	
	$("#btn-step").click(function(){
		$("#step-2").addClass("grid");
		$("#step-2").removeClass("hidden");
		$("#step-1").addClass("hidden");
		$("#step-1").removeClass("grid");
		$("#btn-back").removeClass("hidden");
		$("#btn-back").addClass("btn");
		$(this).removeClass("btn");
		$(this).addClass('hidden');
		$("#btn-submit").addClass('btn');
	});
	$("#btn-back").click(function(){		
		$("#step-1").addClass("grid");
		$("#step-1").removeClass("hidden");
		$("#step-2").addClass("hidden");
		$("#step-2").removeClass("grid");
		$(this).removeClass("btn");
		$(this).addClass('hidden');
		
	});

	// CERRAR ALERTAS
	$(".fa-times").click(function () {		
		$(".error").toggle("slideUp");
	});
	
	$(".fa-times").click(function () {		
		$("#alert").toggle("slideUp");
	});

	// CERRAR MODAL
	$("#closed-modal").click(function(){
		$("#modal2").fadeOut("fast");
	});

	$("#select-game").click(function(){
		$("#box-game-roster").toggleClass("open")
	});

	$("#button-position").click(function(){
		$("#accordion-position").toggleClass("open")
	});

	$("#button-fixture").click(function(){
		$("#accordion-fixture").toggleClass("open")
	});
	
});

$(document).ready(function () {
	$('.aniview').AniView(options);
	var options = {
		animateThreshold: 100,
		scrollPollInterval: 50
	}
});	

/*
var ventana_ancho = $(window).width();		
		console.log(ventana_ancho);
		if(ventana_ancho < 750){
			$(".item-menu").click(function(){			
				var submenu = $(this).find("div.submenu");
				//console.log(submenu);
				submenu.toggle("slideDown");
			});
		}
/*
 * Enlaces
 * https://programacion.net/articulo/15_librerias_de_javascript_para_hacer_efectos_de_scroll_impresionantes_1308
 * 
 * https://github.com/jjcosgrove/jquery-aniview
 * https://jjcosgrove.github.io/jquery-aniview/
*/