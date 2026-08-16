<?php include('layout/header.php'); ?>

<body>
	<!-------------- INICIO DE PAGINA -------------->
	<main class="main">
		<?php include('layout/navbar.php'); ?>

		<section class="sponsor-banner">
			<div class="flex align-center center">
				<div class="box-texto">
					<h2 class="title">Haz crecer a tu equipo</h2>
					<p class="texto">Aplica ahora y lleva tu equipo al siguiente nivel con nuestro patrocinio.</p>
				</div>
			</div>
		</section>

		<section class="sponsor-formulario">
			<div class="box-formulario">
				<?php if (isset($_SESSION['completado'])): ?>
						<div class="alerta-exito">
							<?= $_SESSION['completado'] ?>
						</div>
					<?php elseif (isset($_SESSION['fallo'])): ?>
						<div class="alerta-error">
							<?= $_SESSION['fallo'] ?>
						</div>
					<?php endif; ?>
				<div class="box-texto">
					<h2 class="title">Unico y personalizado</h2>
					<p class="texto">Ingresa los siguientes datos</p>
				</div>
				<hr>
				<form action="system/models/add/addsponsor.php" class="formulario" enctype="multipart/form-data" method="post">
					<div class="w100 container-wrap flex-col">
						<?php if (isset($_SESSION['usuario'])): ?>
							<div class="box-input">
								<label for="nombre">Name Teams: </label>
								<input class="w100 " type="hidden" name="idusuario" value="<?php echo $_SESSION['usuario']['id']?> ">
								<input class="w100 " type="text" name="nombre" value="" required>
							</div>
							<div class="box-input">
								<label for="league">League Teams: </label>
								<input class="w100 " type="text" name="liga" value="" required>
							</div>
						<?php else : ?>
							<div class="box-input">
								<label for="nombre">Name Teams: </label>
								<input class="w100 " type="text" name="nombre" value="" required>
							</div>
							<div class="box-input">
								<label for="capitan">Capitán / Coach: </label>
								<input class="w100 " type="text" name="capitan" value="" required>
							</div>
							<div class="box-input">
								<label for="league">League Teams: </label>
								<input class="w100 " type="text" name="liga" value="" required>
							</div>
							<div class="box-input">
								<label for="email">Email: </label>
								<input class="w100 " type="text" name="correo" value="" required>
							</div>
							<div class="box-input">
								<label for="telefono">Teléfono: </label>
								<input class="w100 " type="number" name="telefono" value="" required>
							</div>
						<?php endif ?>
					</div>
					<input type="submit" value="Solicitar sponsor" class="btn w100 btn-verde">					
				</form>
			</div>
		</section>
	</main>
	<?php include('layout/footer.php'); ?>

</body>

</html>