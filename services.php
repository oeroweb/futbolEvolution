<?php include('layout/header.php'); ?>  
<body>
  <!-------------- INICIO DE PAGINA -------------->
  <main class="main">    
    <?php include('layout/navbar.php'); ?> 
		
		<section class="services-banner">
			<div class="boxoverlay">
				<div class="flex align-center center">
					<?php
						$datos = selectalldatos($con, "serviciosbanner");
						if (!empty($datos) && mysqli_num_rows($datos) >= 1):
							while ($dato = mysqli_fetch_assoc($datos)):
						?>
					<div class="box-texto">
						<h2 class="title"><?= $dato['en_titulo'] ?></h2>
						<p class="texto"> <?= $dato['en_descripcion'] ?></p>
						<a href="documentos/servicios.pdf" target="_blank" class="btn btn-verde">Download services</a>
					</div>
					<?php
							endwhile;
						endif; ?>			
				</div>
			</div>
		</section>
		<section class="box-servicies">
			<?php
				$datos = obtenerTodosDatosActivos($con, "servicios");
				if (!empty($datos) && mysqli_num_rows($datos) >= 1):
					while ($dato = mysqli_fetch_assoc($datos)):
				?>
			<div class="box-image-service">
				<img src="assets/img/services/<?= $dato['imagen'] ?>" class="img-service" alt="Imagen de servicio <?= $dato['en_titulo'] ?>">
				<div class="boxoverlay">
					<div class="box-texto center">
						<div class="col1">
							<h2 class="title"><?= $dato['en_titulo'] ?></h2>
						</div>
						<div class="col2">
							<h2 class="subtitle"><?= $dato['en_subtitulo'] ?></h2>
							<p class="texto"> <?= $dato['en_descripcion'] ?></p>
							<div class="box-botones">
								<a href="documentos/<?= $dato['archivo'] ?>" class="btn btn-verde">Download services</a>
								<a href="#" class="btn btn-outline-verde" id="btn-contacto">Contact</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
					endwhile;
				endif; ?>	
		</section>
  </main>
	<?php include('layout/footer.php'); ?>	
    
</body>
</html>

