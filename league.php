<?php include('layout/header.php'); ?>

<body>
	<!-------------- INICIO DE PAGINA -------------->
	<main class="main">
		<?php include('layout/navbar.php'); ?>

		<section class="league-banner">
			<?php
			$datos = selectalldatos($con, "ligasBannerTop");
			if (!empty($datos) && mysqli_num_rows($datos) >= 1):
				while ($dato = mysqli_fetch_assoc($datos)):
			?>
					<img src="assets/img/ligas/<?php echo $dato['imagen'] ?>" class="img-hover">
					<div class="boxoverlay">
						<div class="flex align-center center">
							<div class="box-texto">
								<h2 class="title"><?= $dato['en_titulo'] ?></h2>
								<p class="texto"><?= $dato['en_descripcion'] ?></p>
							</div>
						</div>
					</div>
			<?php
				endwhile;
			endif; ?>
		</section>
		<section class="game-container-grid" id="partidos">
			<div class="center">
				<div class="box-texto">
					<p class="subtitle">
						<img src="assets/img/ico/partidos_black.png" alt="">
						Conoce las ligas que estan activas
					</p>
					<p class="texto">Lorem ipsum dolor sit amet, onsectetur adipiscing elit. Nulla curadipiscing elit.Lorem ipsum dolor sit amet, onsectetur adipiscing elit. Nulla curadipiscing elit.</p>
				</div>
				<div class="container-grid">
					<?php
					$datos = listaLigas($con, 2);
					if (!empty($datos) && mysqli_num_rows($datos) >= 1):
						while ($dato = mysqli_fetch_assoc($datos)):
							$newFecha = formatearFecha($dato['fecha_liga']);
					?>
							<div class="card-partido">
								<a href="league-detail.php?id=<?= $dato['id'] ?>">
									<img src="assets/img/ligas/<?= $dato['imagen'] ?>" class="image-card" alt="">
									<div class="box-precio">
										<div class="texto"><?= $dato['en_nombre'] ?></div>
									</div>
									<div class="box-texto">
										<p class="texto"><?= $dato['en_direccion'] ?></p>
										<p class="texto-icon"> <img src="assets/img/ico/calendar.png"><span><?= $newFecha ?></span> </p>
									</div>
								</a>
							</div>
					<?php
						endwhile;
					endif; ?>
				</div>

			</div>
		</section>
	</main>
	<?php include('layout/footer.php'); ?>

</body>

</html>