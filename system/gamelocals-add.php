<?php
include 'layout/header.php';
require_once "controller/helpers.php";
?>

<body>
	<?php require "layout/navbar.php"; ?>
	<div class="grid-container">
		<?php require "layout/aside.php"; ?>
		<div class="container-main">
			<div class="center">
				<h2 class="title">Añadir Nuevo Complejo Deportivo / Sede - Página Partidos</h2>
				<div class="box-retorno">
					<a href="javascript:history.back()" title="Atras" class="flex align-center">
						<img src="../assets/img/ico/arrow_back.svg" class="img-ico">Volver
					</a>
				</div>
				<?php if (isset($_SESSION['completado'])): ?>
					<div class="alerta-exito">
						<?= $_SESSION['completado'] ?>
					</div>
				<?php elseif (isset($_SESSION['fallo'])): ?>
					<div class="alerta-error">
						<?= $_SESSION['fallo'] ?>
					</div>
				<?php endif; ?>
				<div class="box-form">
					<form action="models/add/addgamelocals.php" class="box-formulario" enctype="multipart/form-data" method="post">
						<div class="w100 container-wrap mg-bt10">
							<div class="box-input">
								<label for="nombre">Nombre del Local/sede deportiva: </label>
								<input class="w100 " type="text" name="en_nombre" value="" required>
							</div>
							<div class="box-input">
								<label for="descripcion">Dirección: </label>
								<input class="w100 " type="text" name="en_direccion" value="" required>
							</div>
							<div class="box-galeria-partidos">
								<div class="box-input">
									<label for="">Añadir Imagen Principal:</label>
									<hr class="w100 mg-bt10">
									<input class="w100" type="file" name="imagen1" accept="image/*" required>
								</div>
								<div class="box-input">
									<label for="">Añadir Imagen 2:</label>
									<hr class="w100 mg-bt10">
									<input class="w100" type="file" name="imagen2" accept="image/*">
								</div>
								<div class="box-input">
									<label for="">Añadir Imagen 3:</label>
									<hr class="w100 mg-bt10">
									<input class="w100" type="file" name="imagen3" accept="image/*">
								</div>
								<div class="box-input">
									<label for="">Añadir Imagen 4:</label>
									<hr class="w100 mg-bt10">
									<input class="w100" type="file" name="imagen4" accept="image/*">
								</div>
							</div>
							<hr class="w100 mg-bt10">
							<div class="box-input">
								<label for="">Url Google Maps: </label>
								<input class=" " type="text" name="url_google" value="">
							</div>
							<div class="box-input">
								<label for="">Url Apple Maps: </label>
								<input class="w100 " type="text" name="url_apple" value="">
							</div>
							<div class="box-input">
									<label for="">Añadir Imagen de Mapa:</label>
									<hr class="w100 mg-bt10">
									<input class="w100" type="file" name="imagen5" accept="image/*" required>
								</div>
						</div>
						<input type="submit" value="Guardar" class="btn2 btn-azul" name="">

					</form>
				</div>
			</div>
		</div>

	</div>

	</div>

</body>

</html>