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
				<h2 class="title">Editando Banner Contacto - Página Ligas</h2>
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

				<div class="container-wrap w100">					
					<?php 
						$datos = selectalldatos($con, "ligascontacto");
						if(!empty($datos) && mysqli_num_rows($datos) >= 1):
							while($dato = mysqli_fetch_assoc($datos)):		
					?>					
					<form action="models/updates/upleaguecontacto.php" class="box-formulario" enctype="multipart/form-data" method="post">
						<div class="w100 container-wrap mg-bt10" >
							<div class="box-input">
								<label for="nombre">Titulo del Banner: </label>	
								<input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
								<input class="w100 " type="text" name="en_titulo" value="<?=$dato['en_titulo']?>">
								<input class="w100 " type="text" name="es_titulo" value="<?=$dato['es_titulo']?>">
							</div>
							<div class="box-input">
								<label for="descripcion">Descripción: </label>						
								<textarea class="w100" name="en_descripcion" rows="5" ><?=$dato['en_descripcion']?></textarea>		
								<textarea class="w100" name="es_descripcion" rows="5" ><?=$dato['es_descripcion']?></textarea>							
							</div>											
						</div>						
						<input type="submit" value="Actualizar Datos" class="btn2 btn-azul" name="editarfase" >						
					</form>	
					<?php 
						endwhile;
					endif;
					?>				
				</div>
			</div>	
			
			<?php borrarErrores(); ?>		
		</div>
		</section>
	<?php include 'layout/footer.php'; ?>
</div>
</main>

<script>

	const input = document.querySelector("form .inputnombre"), 
	maxlength = input.getAttribute("maxlength"),
	counter = document.querySelector("form .counterNombre"), 
	textarea = document.querySelector("form .textdescripcion"), 
  maxlengtharea = textarea.getAttribute("maxlength"),
	counterarea = document.querySelector("form .counterDescripcion"); 

  input.onkeyup = () =>{
    counter.innerText = maxlength - input.value.length;
  }
  textarea.onkeyup = () =>{
    counterarea.innerText = maxlengtharea - textarea.value.length;
  }
</script>