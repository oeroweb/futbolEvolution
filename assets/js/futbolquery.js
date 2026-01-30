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
		$("#modal4").addClass("hidden");
		$("#modal4").removeClass("mostrar");
		$("#modal5").addClass("hidden");
		$("#modal5").removeClass("mostrar");
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
	});

	$(".btn-perfil2").click(function(){
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

	$("#btn-login3").click(function(){
		$("#modal4").addClass("hidden");
		$("#modal4").removeClass("mostrar");
		$("#modal").addClass("mostrar");
		$("#modal").removeClass("hidden");
		$("body").addClass("overflow");
	});

	$("#btn-contacto").click(function(){
		$("#modal3").removeClass("hidden");
		$("#modal3").addClass("mostrar");
		let idServicio = $("#idServicio").val();
		
		localStorage.setItem("servicio", idServicio);
		getStorage();
		$("body").addClass("overflow");
	});
	
	$("#btn-contacto-1").click(function(){
		$("#modal3").removeClass("hidden");
		$("#modal3").addClass("mostrar");
		let idServicio = $("#idServicio-1").val();
		
		localStorage.setItem("servicio", idServicio);
		getStorage();
		$("body").addClass("overflow");
	});
	
	$("#btn-contacto-2").click(function(){
		$("#modal3").removeClass("hidden");
		$("#modal3").addClass("mostrar");
		let idServicio = $("#idServicio-2").val();
		
		localStorage.setItem("servicio", idServicio);
		getStorage();
		$("body").addClass("overflow");
	});
	
	$("#btn-contacto-3").click(function(){
		$("#modal3").removeClass("hidden");
		$("#modal3").addClass("mostrar");
		let idServicio = $("#idServicio-3").val();
		localStorage.setItem("servicio", idServicio);
		getStorage();
		$("body").addClass("overflow");
	});

	function getStorage() {
		if(localStorage.getItem('servicio')){
    	let servicioStorage = localStorage.getItem('servicio')
			$("#idservicio").val(servicioStorage);

			let ligaStorage =  localStorage.getItem('liga');
			$(".idliga").val(ligaStorage);
		}
	}
	
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
		$(this).removeClass("btn");
		$(this).addClass('hidden');
		$("#step-2").addClass("grid");
		$("#step-2").removeClass("hidden");
		$("#step-1").addClass("hidden");
		$("#step-1").removeClass("grid");
		$("#btn-back").removeClass("hidden");
		$("#btn-back").addClass("btn");
		$("#btn-submit").addClass('btn');
		$("#btn-submit").removeClass('hidden');
	});

	$("#btn-back").click(function(){		
		$(this).removeClass("btn");
		$(this).addClass('hidden');		
		$("#step-1").addClass("grid");
		$("#step-1").removeClass("hidden");
		$("#step-2").addClass("hidden");
		$("#step-2").removeClass("grid");
		$("#btn-step").addClass("btn");
		$("#btn-step").removeClass("hidden");
		$("#btn-submit").addClass('hidden');
		$("#btn-submit").removeClass('btn');
	});

	$("#btn-free-player").click(function(){
		$("#modal4").addClass("mostrar");
		let idLiga = $("#idLigaSeleccion").val();		
		localStorage.setItem("liga", idLiga);
		
		getStorage();
		$("body").addClass("overflow");
	});

	$("#btn-team-player").click(function(){
		$("#modal5").addClass("mostrar");
		let idLiga = $("#idLigaSeleccion").val();
		console.log(idLiga);
		localStorage.setItem("liga", idLiga);
		
		getStorage();
		$("body").addClass("overflow");
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

	$('.owl-carousel').owlCarousel({
		loop:true,
		margin:10,	
		nav:true,
		autoplay:true,
		autoplayTimeout:1500,
		autoplayHoverPause:true,
		responsive:{
			0:{
					items:1
			},			
		}
	});

	$(".owl-prev").html('<span class="btn-owl"><i class="fas fa-angle-left"></i> </span>');
	$(".owl-next").html('<span class="btn-owl"><i class="fas fa-angle-right"></i> </span>');
	
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