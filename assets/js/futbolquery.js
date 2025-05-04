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

	$("#btn-login").click(function(){
		$("#modal").addClass("mostrar");
		$("#modal").removeClass("hidden");
		$("body").addClass("overflow");
	});

	$("#btn-perfil").click(function(){
		$(".sub-perfil").addClass("flex");
		$(".sub-perfil").removeClass("hidden");
	});

	$("#btn-perfil2").click(function(){
		$("#modal2").addClass("mostrar");
		$("#modal2").removeClass("hidden");
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