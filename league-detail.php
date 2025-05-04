<?php include('layout/header.php');
if (!isset($_GET)) {
	header("Location:game.php");
} else {
	$id = $_GET['id'];
}
?>

<body>
	<!-------------- INICIO DE PAGINA -------------->
	<main class="main">
		<?php include('layout/navbar.php'); ?>

		<section class="league-banner">
			<div class="boxoverlay">
				<?php
				$datos = detalleLigas($con, $id);
				if (!empty($datos) && mysqli_num_rows($datos) >= 1):
					while ($dato = mysqli_fetch_assoc($datos)):
				?>
						<div class="flex align-center center relative">
							<div class="box-texto">
								<h2 class="title"><?= $dato['en_nombre'] ?></h2>
								<p class="texto"><?= $dato['en_descripcion'] ?></p>
							</div>
							<div class="box-botones">
								<a href="" class="btn btn-outline">Free player libre</a>
								<a href="" class="btn btn-verde">Register team</a>
							</div>
						</div>
				<?php
					endwhile;
				endif; ?>
			</div>
		</section>

		<section class="home-partidos">
			<div class="flex align-center center h100">
				<div class="box-container-texto">
					<div class="box-texto">
						<h2 class="title">Star Football League</h2>
						<p class="texto"> Lorem ipsum dolor sit amet, onsectetur adipiscing elit.</p>
					</div>
				</div>
				<div class="flex box-container-card">
					<div class="box-card">
						<div class="title">Star Football League</div>
						<div class="date">Miercoles 7 de marzo, 2025</div>
						<div class="box-resultados">
							<div class="flex-col justify-center item-resultado">
								<img src="assets/img/home/equipo1.png" class="img-logo" alt="">
								<p class="texto">Silver Titans</p>
							</div>
							<div class="item-resultado">
								01: 01
							</div>
							<div class="flex-col item-resultado">
								<img src="assets/img/home/equipo2.png" class="img-logo" alt="">
								<p class="texto">Sport Friend</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="league-position">
			<div class="center">
				<?php
				$datos = detalleLigas($con, $id);
				if (!empty($datos) && mysqli_num_rows($datos) >= 1):
					while ($dato = mysqli_fetch_assoc($datos)):
				?>
						<div class="box-texto">
							<p class="subtitle"><strong>Tabla de posiciones</strong> </p>
							<h2 class="title"><?= $dato['en_nombre'] ?></h2>
							<p class="texto"><?= $dato['en_descripcion'] ?></p>
						</div>
				<?php
					endwhile;
				endif; ?>

				<div class="box-tabla table-hidden">
					<div class="box-header tb-position">
						<div class="item-header">Club</div>
						<div class="item-header">PJ</div>
						<div class="item-header">G</div>
						<div class="item-header">E</div>
						<div class="item-header">P</div>
						<div class="item-header">GF</div>
						<div class="item-header">GC</div>
						<div class="item-header">DG</div>
						<div class="item-header bold">Pts</div>
					</div>
					<?php
					$datos = obtenerligatablaposiciones($con, $id);
					if (!empty($datos) && mysqli_num_rows($datos) >= 1):
						while ($dato = mysqli_fetch_assoc($datos)):
					?>
							<div class="box-body tb-position">
								<div class="item-body">
									<img src="assets/img/equipos/<?= $dato['imagen'] ?>" alt="logo de " class="img-logo">
									<p><?= $dato['nombre'] ?></p>
								</div>
								<div class="item-body"><?= $dato['pj'] ?></div>
								<div class="item-body"><?= $dato['g'] ?></div>
								<div class="item-body"><?= $dato['e'] ?></div>
								<div class="item-body"><?= $dato['p'] ?></div>
								<div class="item-body"><?= $dato['gf'] ?></div>
								<div class="item-body"><?= $dato['gc'] ?></div>
								<div class="item-body"><?= $dato['dg'] ?></div>
								<div class="item-body"><?= $dato['pts'] ?></div>
							</div>
					<?php
						endwhile;
					endif; ?>
				</div>

				<div class="accordion">
					<div class="header-accordion" id="button-position">
						<span>Ver tabla</span>
						<img src="assets/img/ico/arrow_down.svg" class="img-ico">
					</div>
					<div class="box-tabla tabla-accordion" id="accordion-position">
						<div class="box-header tb-position">
							<div class="item-header">Club</div>
							<div class="item-header">PJ</div>
							<div class="item-header">G</div>
							<div class="item-header">E</div>
							<div class="item-header">P</div>
							<div class="item-header">GF</div>
							<div class="item-header">GC</div>
							<div class="item-header">DG</div>
							<div class="item-header bold">Pts</div>
						</div>
						<?php
						$datos = obtenerligatablaposiciones($con, $id);
						if (!empty($datos) && mysqli_num_rows($datos) >= 1):
							while ($dato = mysqli_fetch_assoc($datos)):
						?>
								<div class="box-body tb-position">
									<div class="item-body">
										<img src="assets/img/equipos/<?= $dato['imagen'] ?>" alt="logo de " class="img-logo">
										<p><?= $dato['nombre'] ?></p>
									</div>
									<div class="item-body"><?= $dato['pj'] ?></div>
									<div class="item-body"><?= $dato['g'] ?></div>
									<div class="item-body"><?= $dato['e'] ?></div>
									<div class="item-body"><?= $dato['p'] ?></div>
									<div class="item-body"><?= $dato['gf'] ?></div>
									<div class="item-body"><?= $dato['gc'] ?></div>
									<div class="item-body"><?= $dato['dg'] ?></div>
									<div class="item-body"><?= $dato['pts'] ?></div>
								</div>
						<?php
							endwhile;
						endif; ?>
					</div>
				</div>
			</div>
		</section>

		<section class="league-feature">
			<div class="center">
				<?php
				$datos = selectalldatos($con, 'ligasfixture');
				if (!empty($datos) && mysqli_num_rows($datos) >= 1):
					while ($dato = mysqli_fetch_assoc($datos)):
				?>
						<div class="box-texto">
							<h2 class="title"><?= $dato['en_titulo'] ?></h2>
							<p class="texto"><?= $dato['en_descripcion'] ?></p>
						</div>
				<?php
					endwhile;
				endif; ?>
				<div class="box-tabla table-hidden">
					<div class="box-header tb-fixture">
						<div class="item-header">Equipo A</div>
						<div class="item-header"></div>
						<div class="item-header">Equipo B</div>
					</div>
					<?php
					$datos = obtenerdatosActivos($con, 'ligas_tb_fixture ', $id);
					if (!empty($datos) && mysqli_num_rows($datos) >= 1):
						while ($dato = mysqli_fetch_assoc($datos)):
					?>
							<div class="box-body tb-fixture">
								<?php
								$equipos = obtenerdatosString($con, 'equipos ', $dato['equipo_id_a']);
								if (!empty($equipos) && mysqli_num_rows($equipos) >= 1):
									while ($equipo = mysqli_fetch_assoc($equipos)):
								?>
										<div class="item-body">
											<img src="assets/img/equipos/<?= $equipo['imagen'] ?>" alt="logo de " class="img-logo">
											<p><?= $equipo['nombre'] ?></p>
										</div>
								<?php
									endwhile;
								endif; ?>
								<div class="item-body justify-center bold"><?= $dato['resultados'] ?></div>
								<?php
								$equipos = obtenerdatosString($con, 'equipos ', $dato['equipo_id_b']);
								if (!empty($equipos) && mysqli_num_rows($equipos) >= 1):
									while ($equipo = mysqli_fetch_assoc($equipos)):
								?>
										<div class="item-body">
											<img src="assets/img/equipos/<?= $equipo['imagen'] ?>" alt="logo de " class="img-logo">
											<p><?= $equipo['nombre'] ?></p>
										</div>
								<?php
									endwhile;
								endif; ?>
							</div>
					<?php
						endwhile;
					endif; ?>
				</div>

				<div class="accordion">
					<div class="header-accordion" id="button-fixture">
						<span>Ver fixture</span>
						<img src="assets/img/ico/arrow_down.svg" class="img-ico">
					</div>
					<div class="box-tabla tabla-accordion" id="accordion-fixture">
						<div class="box-header tb-fixture">
							<div class="item-header">Equipo A</div>
							<div class="item-header"></div>
							<div class="item-header">Equipo B</div>
						</div>
						<?php
						$datos = obtenerdatosActivos($con, 'ligas_tb_fixture ', $id);
						if (!empty($datos) && mysqli_num_rows($datos) >= 1):
							while ($dato = mysqli_fetch_assoc($datos)):
						?>
								<div class="box-body tb-fixture">
									<?php
									$equipos = obtenerdatosString($con, 'equipos ', $dato['equipo_id_a']);
									if (!empty($equipos) && mysqli_num_rows($equipos) >= 1):
										while ($equipo = mysqli_fetch_assoc($equipos)):
									?>
											<div class="item-body">
												<img src="assets/img/equipos/<?= $equipo['imagen'] ?>" alt="logo de " class="img-logo">
												<p><?= $equipo['nombre'] ?></p>
											</div>
									<?php
										endwhile;
									endif; ?>
									<div class="item-body justify-center bold"><?= $dato['resultados'] ?></div>
									<?php
									$equipos = obtenerdatosString($con, 'equipos ', $dato['equipo_id_b']);
									if (!empty($equipos) && mysqli_num_rows($equipos) >= 1):
										while ($equipo = mysqli_fetch_assoc($equipos)):
									?>
											<div class="item-body">
												<img src="assets/img/equipos/<?= $equipo['imagen'] ?>" alt="logo de " class="img-logo">
												<p><?= $equipo['nombre'] ?></p>
											</div>
									<?php
										endwhile;
									endif; ?>
								</div>
						<?php
							endwhile;
						endif; ?>
					</div>
				</div>
				<div class="box-botones">
					<a href="documentos/fixture.pdf" class="btn btn-outline-verde" target="_blank">Download fixture</a>
				</div>
			</div>
		</section>

		<section class="league-contacto">
			<div class="boxoverlay">
				<div class="center">
					<?php
					$datos = selectalldatos($con, 'ligascontacto');
					if (!empty($datos) && mysqli_num_rows($datos) >= 1):
						while ($dato = mysqli_fetch_assoc($datos)):
					?>
							<div class="box-texto">
								<h2 class="title"><?= $dato['en_titulo'] ?></h2>
								<p class="texto"><?= $dato['en_descripcion'] ?></p>
							</div>
					<?php
						endwhile;
					endif; ?>
					<a href="#" class="btn btn-outline" target="_blank">Contact advisor</a>
				</div>
			</div>
		</section>
	</main>
	<?php include('layout/footer.php'); ?>

</body>

</html>