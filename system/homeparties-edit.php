<?php 
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
				<h2 class="title">Editando Banner - Page Home</h2>
				<div class="box-retorno">
					<a href="javascript:history.back()" title="Atras" class="flex align-center">
						<img src="../assets/img/ico/arrow_back.svg" class="img-ico">Volver 
					</a>
				</div>			
				
				<div class="container-wrap w100">					
					<?php 
						$datos = obtenerdatosActivos($con, "homepartidos", '');
						if(!empty($datos) && mysqli_num_rows($datos) >= 1):
							while($dato = mysqli_fetch_assoc($datos)):		
					?>					
					<form action="models/updates/uphomeparties.php" class="box-formulario" enctype="multipart/form-data" method="post">
						<div class="w100 container-wrap mg-bt10">
							<div class="box-input">
								<label for="nombre">Titulo: </label>	
								<input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
								<input class="w100 " type="text" name="en_titulo" value="<?=$dato['en_titulo']?>">
								<input class="w100 " type="text" name="es_titulo" value="<?=$dato['es_titulo']?>">
							</div>
							<div class="box-input">
								<label for="descripcion">Descripción: </label>						
								<input class="w100 " type="text" name="en_descripcion" value="<?=$dato['en_descripcion']?>">
								<input class="w100 " type="text" name="es_descripcion" value="<?=$dato['es_descripcion']?>">
							</div>													
						</div>						
						<input type="submit" value="Actualizar Datos" class="btn2 btn-azul">
						
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