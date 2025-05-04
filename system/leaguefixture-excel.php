<?php 
  include 'layout/header.php';
	require_once "controller/helpers.php";
	if(!isset($_POST)){		
		header("Location:admin-cursos.php");
	}else{
		$id = $_GET['id'];	
	}
?>

<body>
	<?php require "layout/navbar.php"; ?>
  <div class="grid-container">
    <?php require "layout/aside.php"; ?>
    
    <div class="container-main">
			<div class="center">				
				<h2 class="title">Añadir Fixture - Página Ligas</h2>
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
							<input type="hidden" id="idliga" value="<?php echo $id ?>">
							<input class="w100" type="file" name="file" accept=".xlsx, .xls" id="txt_file">
						</div>
						<div class="flex">
							<button class="btn2 btn-azul mg-r10" onclick="CargarExcel()">Mostrar datos del Excel</button>
							<button class="btn-azul hidden" onclick="RegistrarExcel()" id="btn-guardar">Guardar Datos</button>
						</div>											
					</form>						
				</div>
				<div class="w100" id="div_table"></div>	
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
		}
		var formData = new FormData();
		var files = $("#txt_file")[0].files[0];
		formData.append('archivoexcel', files);
		
		$.ajax({
			url: 'models/add/import_fixture.php',
			type: 'post',
			data: formData,
			contentType: false,
			processData: false,
			success: function(resp){
				$("#div_table").html(resp);
				$("#btn-guardar").removeClass("hidden");
				$("#btn-guardar").addClass("btn2");
			}
		})
		return false;
	};

	function RegistrarExcel(){
		var contador = 0;
		var arreglo_equipo_a = new Array;
		var arreglo_resultado = new Array;
		var arreglo_equipo_b = new Array;
		

		$("#dt_listaEventos tbody#tbody_tabla_detalle tr").each(function(){
			arreglo_equipo_a.push($(this).find('td').eq(0).text());
			arreglo_resultado.push($(this).find('td').eq(1).text());
			arreglo_equipo_b.push($(this).find('td').eq(2).text());			
			contador++;
		});

		if(contador == 0){
			$("#info").html("<div class='alerta-error'>La tabla tiene que tener al menos 1 registro.</div>");
			return;
		}

		var equipo_a = arreglo_equipo_a.toString();
		var resultados = arreglo_resultado.toString();
		var equipo_b = arreglo_equipo_b.toString();		
		var idLiga = $("#idliga").val();

		$.ajax({
			url: 'models/add/addLeagueFixture.php',
			type: 'post',
			data:{
				equipo_a: equipo_a,
				resultados: resultados,
				equipo_b: equipo_b,				
				idLiga: idLiga,
			}
		}).done(function(resp){	
			console.log(resp);
			if(resp == 1){
				$("#info").html("<div class='alerta-exito'>Se guardaron los datos de forma correcta.</div>");
				setTimeout(() => {
					location.href ="http://localhost/pagfutbolevolution/system/league.php";					
					// location.href ="https://acreditacions.com/system/league.php";
				}, 2000);
			return;
			} else {
				$("#info").html("<div class='alerta-error'>Hubo un error; por favor volver a intentar.</div>");
			}
		});

		
	}

</script>