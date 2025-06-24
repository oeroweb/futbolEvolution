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
				<h2 class="title">Editando Fixture - Página Ligas</h2>
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
									
					<form action="models/add/addfixture.php" class="box-formulario" enctype="multipart/form-data" method="post">
						<div class="w100 container-wrap mg-bt10" >
							<div class="box-input">
								<label for="nombre">Titulo: </label>	
								<input type="hidden" name="ligaid" value="<?php echo $id?>">
								<input class="w100 " type="text" name="en_titulo" placeholder="Enter title">
								<input class="w100 " type="text" name="es_titulo" placeholder="Ingresa titulo">
							</div>
							<div class="box-input">
								<label for="descripcion">Descripción: </label>					
								<textarea class="w100" name="en_descripcion" rows="3" placeholder="Enter description"></textarea>		
								<textarea class="w100" name="es_descripcion" rows="3" placeholder="Ingresa descripción"></textarea>							
							</div>							
							<div class="box-input">
								<label for="">Añadir archivo:</label>
								<hr class="w100 mg-bt10">
								<input type="file" name="archivo" accept="application/pdf">
							</div>							
						</div>						
						<input type="submit" value="Guardar" class="btn2 btn-azul">						
					</form>	
					
				</div>
			</div>	
			
			<?php borrarErrores(); ?>		
		</div>
		</section>
	<?php include 'layout/footer.php'; ?>
</div>
</main>
