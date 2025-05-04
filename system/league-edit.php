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
				<h2 class="title">Editando Ligas - Página Ligas</h2>
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
						$datos = detalleLigas($con, $id);
						if(!empty($datos) && mysqli_num_rows($datos) >= 1):
							while($dato = mysqli_fetch_assoc($datos)):		
					?>					
					<form action="models/updates/upleague.php" class="box-formulario" enctype="multipart/form-data" method="post">
						<div class="w100 container-wrap mg-bt10" >
							<div class="box-input">
								<label for="nombre">Nombre de la liga: </label>	
								<input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
								<input class="w100 " type="text" name="en_nombre" value="<?=$dato['en_nombre']?>">
								<input class="w100 " type="text" name="es_nombre" value="<?=$dato['es_nombre']?>">
							</div>
							<div class="box-input">
								<label for="nombre">Fecha de la liga: </label>
								<input class="" type="date" name="fecha" value="<?php echo $dato['fecha_liga']?>">
							</div>
							<div class="box-input">
								<label for='local'>Local o Sede</label>															
								<select name="idlocal" class="w100">
									<?php 
										$partidos = selectDatosEstado($con, "partidoslocales", 2);
										if(!empty($partidos) && mysqli_num_rows($partidos) >= 1):
											while($partido = mysqli_fetch_assoc($partidos)):		
									?>
										<option value="<?=$partido['id']?>" <?=($partido['id']) == $dato['local_id'] ? 'selected="selected"' : '' ?>><?=$partido['en_nombre']?></option>
									<?php endwhile; 
									endif; ?>
								</select>								
							</div>
							<div class="box-input">
								<label for="descripcion">Descripción: </label>						
								<textarea class="w100" name="en_descripcion" rows="3" ><?=$dato['en_descripcion']?></textarea>
								<textarea class="w100" name="es_descripcion" rows="3" ><?=$dato['es_descripcion']?></textarea>
							</div>
							<div class="box-input">
								<?php if ($dato['imagen']): ?>
									<label for="">Cambiar Imagen:</label>
									<hr class="w100 mg-bt10">
									<input type="hidden" name="imagen_existente" value="<?php echo $dato['imagen']; ?>">
									<img src="../assets/img/ligas/<?php echo $dato['imagen'] ?>" alt="">
									<input class="" type="file" name="imagen1" accept="image/*">
								</div>
								<?php else: ?>
									<div class="box-input">
										<label for="">Añadir Imagen:</label>
										<hr class="w100 mg-bt10">
										<input class="" type="file" name="imagen" accept="image/*">
									</div>
								<?php endif; ?>									
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