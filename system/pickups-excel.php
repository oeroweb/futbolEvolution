<?php 
  include 'layout/header.php';
	require_once "controller/helpers.php";	
?>

<body>
	<?php require "layout/navbar.php"; ?>
  <div class="grid-container">
    <?php require "layout/aside.php"; ?>
    
    <div class="container-main">
			<div class="center">				
				<h2 class="title">Añadir Partidos - Pickups</h2>
				<div class="box-retorno">
					<a href="javascript:history.back()" title="Atras" class="flex align-center">
						<img src="../assets/img/ico/arrow_back.svg" class="img-ico">Volver 
					</a>
				</div>
				
				<?php if(isset($_SESSION['completado'])): ?>
					<div class="alerta-exito">
						<?=$_SESSION['completado']?>  
					</div>
				<?php elseif(isset($_SESSION['fallo'])): ?>
					<div class="alerta-error">
						<?=$_SESSION['fallo']?>
					</div>
				<?php endif; ?> 
				<div class="info" id="info"></div>

				<div class="container-wrap w100">									
					<form action="" enctype="multipart/form-data" class="box-formulario" onsubmit="event.preventDefault();">
						<h2 class="title">Subir Excel</h2>												
						<div class="box-input">							
							<input class="w100" type="file" name="file" accept=".xlsx, .xls" id="txt_file">
						</div>
						<div class="flex">
							<button class="btn2 btn-azul mg-r10" id="btn-mostrar" onclick="CargarExcel()">Mostrar datos del Excel</button>
							<button class="btn-azul hidden" onclick="RegistrarExcel()" id="btn-guardar">Guardar Datos</button>
						</div>											
					</form>						
				</div>
				<div class="w100 overflowAuto" id="div_table"></div>	
			</div>	
			
			<?php borrarErrores(); ?>		
		</div>
		</section>
	<?php include 'layout/footer.php'; ?>
</div>
</main>

<script>
	function CargarExcel(){
		var excel = $("#txt_file").val();
		if(excel === ""){
			$("#info").html("<div class='alerta-error'>Tienes que seleccionar un archivo.</div>");
			return;
		} else {
			$("#info").html("");
		}

		var formData = new FormData();
		var files = $("#txt_file")[0].files[0];
		formData.append('archivoexcel', files);
		
		$.ajax({
			url: 'models/add/import_pickups.php',
			type: 'post',
			data: formData,
			contentType: false,
			processData: false,
			success: function(resp){
				$("#div_table").html(resp);
				$("#btn-guardar").removeClass("hidden");
				$("#btn-guardar").addClass("btn2");
				$("#btn-mostrar").removeClass("btn-azul");
				$("#btn-mostrar").addClass("btn-gris");
			}
		})
		return false;
	};

	function RegistrarExcel(){
		var contador = 0;
		var arreglo_columna_a = new Array;
		var arreglo_columna_b = new Array;
		var arreglo_columna_c = new Array;
		var arreglo_columna_d = new Array;
		var arreglo_columna_e = new Array;
		var arreglo_columna_f = new Array;		
		var arreglo_columna_g = new Array;		
		var arreglo_columna_h = new Array;		
		var arreglo_columna_i = new Array;		

		$("#dt_listaEventos tbody#tbody_tabla_detalle tr").each(function(){
			arreglo_columna_a.push($(this).find('td').eq(0).text());
			arreglo_columna_b.push($(this).find('td').eq(1).text());
			arreglo_columna_c.push($(this).find('td').eq(2).text());			
			arreglo_columna_d.push($(this).find('td').eq(3).text());			
			arreglo_columna_e.push($(this).find('td').eq(4).text());			
			arreglo_columna_f.push($(this).find('td').eq(5).text());			
			arreglo_columna_g.push($(this).find('td').eq(6).text());			
			arreglo_columna_h.push($(this).find('td').eq(7).text());			
			arreglo_columna_i.push($(this).find('td').eq(8).text());			
			contador++;
		});

		if(contador == 0){
			$("#info").html("<div class='alerta-error'>La tabla tiene que tener al menos 1 registro.</div>");
			return;
		}

		var columna_a = arreglo_columna_a.toString();
		var columna_b = arreglo_columna_b.toString();
		var columna_c = arreglo_columna_c.toString();		
		var columna_d = arreglo_columna_d.toString();		
		var columna_e = arreglo_columna_e.toString();		
		var columna_f = arreglo_columna_f.toString();
		var columna_g = arreglo_columna_g.toString();
		var columna_h = arreglo_columna_h.toString();
		var columna_i = arreglo_columna_i.toString();

		$.ajax({
			url: 'models/add/addLeaguePickups.php',
			type: 'post',
			data:{
				columna_a,
				columna_b,
				columna_c,
				columna_d,
				columna_e,
				columna_f,
				columna_g,
				columna_h,
				columna_i,
			}
		}).done(function(resp){	
			console.log(resp);
			if(!resp.error){
				$("#info").html("<div class='alerta-exito'>Se guardaron los datos de forma correcta.</div>");
				setTimeout(() => {
					// location.href ="http://localhost/pagfutbolevolution/system/league.php";					
					location.href ="https://futbolevolution.com/system/game.php";
				}, 2000);
			return;
			} else {
				$("#info").html("<div class='alerta-error'>Hubo un error; por favor volver a intentar.</div>");
			}
		});		
	}


</script>