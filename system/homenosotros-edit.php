<?php 
	session_start();
  include 'layout/header.php';
	require_once "controller/helpers.php";
	if(!isset($_POST)){		
		header("Location:home.php");
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
				<h2 class="title">Editando Nosotros - Page Home</h2>
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
						$datos = obtenerdatos($con, "homenosotros", $id);
						if(!empty($datos) && mysqli_num_rows($datos) >= 1):
							while($dato = mysqli_fetch_assoc($datos)):		
					?>					
					<form action="models/updates/uphomenosotros.php" class="box-formulario" enctype="multipart/form-data" method="post">
						<div class="w100 container-wrap mg-bt10">
							<div class="box-input">
								<label for="nombre">Titulo : </label>	
								<input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
								<!-- <input class="w100" type="text" name="nombre" value="<?php //echo $dato['nombre']; ?>"> -->
								<input class="w100 " type="text" name="en_titulo" value="<?=$dato['en_titulo']?>">
								<input class="w100 " type="text" name="es_titulo" value="<?=$dato['es_titulo']?>">
							</div>
							<div class="box-input">
								<label for="nombre">Sub Titulo: </label>	
								<input class="w100 " type="text" name="en_subtitulo" value="<?=$dato['en_subtitulo']?>">
								<input class="w100 " type="text" name="es_subtitulo" value="<?=$dato['es_subtitulo']?>">
							</div>
							<div class="box-input">
								<label for="descripcion">Descripción: </label>
								<textarea class="w100" name="en_descripcion" rows="3" ><?=$dato['en_descripcion']?></textarea>		
								<textarea class="w100" name="es_descripcion" rows="3" ><?=$dato['es_descripcion']?></textarea>								
							</div>
							<div class="box-input">								
								<label for="">Cambiar Imagen:</label>								
								<hr class="w100 mg-bt10">							
								<input class="w100" type="hidden" name="imagen_existente" value="<?php echo $dato['imagen']; ?>">
								<img src="../assets/img/home/<?php echo $dato['imagen'] ?>" alt="">
								<input class="w100" type="file" name="imagen" >
							</div>							
						</div>						
						<input type="submit" value="Actualizar Datos" class="btn2 btn-azul" name="editar" >				
						
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