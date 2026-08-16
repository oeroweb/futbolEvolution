<?php
include 'layout/header.php';
require_once "controller/helpers.php";
if (!isset($_POST)) {
	header("Location:home.php");
} else {
	$id = $_GET['id'];
}
?>

<body>
	<?php require "layout/navbar.php"; ?>
	<div class="grid-container">
		<?php require "layout/aside.php"; ?>

		<div class="container-main">
			<div class="center">
				<h2 class="title">Editando Datos Generales</h2>
				<div class="box-retorno">
					<a href="javascript:history.back()" title="Atras" class="flex align-center">
						<img src="../assets/img/ico/arrow_back.svg" class="img-ico">Volver
					</a>
				</div>

				<div class="container-wrap w100">
					<?php
					$datos = obtenerdatos($con, "globales", $id);
					if (!empty($datos) && mysqli_num_rows($datos) >= 1):
						while ($dato = mysqli_fetch_assoc($datos)):
					?>
							<form action="models/updates/updatosglobales.php" class="box-formulario" enctype="multipart/form-data" method="post">
								<div class="w100 container-wrap mg-bt10">
									<div class="box-input">
										<label for="descripcion">Descripción: </label>
										<input class="w100 " type="text" name="id" value="<?= $dato['id'] ?>" hidden>
										<input class="w100 " type="text" name="descripcion" placeholder="intro description" value="<?= $dato['descripcion'] ?>">
									</div>
									<div class="box-input">
										<label for="correo">Correo: </label>
										<input class="w100 " type="email" name="correo" placeholder="intro email" value="<?= $dato['correo'] ?>">
									</div>
									<div class="box-input">
										<label for="telefono">Teléfono: </label>
										<input class="w100 " type="text" name="telefono" placeholder="intro phone" value="<?= $dato['telefono'] ?>">
									</div>
									<div class="box-input">
										<label for="descripcion">Url Global: </label>
										<input class="w100 " type="text" name="url_global" placeholder="intro url" value="<?= $dato['url_global'] ?>">
									</div>
									<div class="box-input">
										<label for="descripcion">Url Facebook: </label>
										<input class="w100 " type="text" name="url_facebook" placeholder="intro url" value="<?= $dato['url_facebook'] ?>">
									</div>
									<div class="box-input">
										<label for="descripcion">Url Instagram: </label>
										<input class="w100 " type="text" name="url_instagram" placeholder="intro url" value="<?= $dato['url_instagram'] ?>">
									</div>
									<div class="box-input">
										<label for="descripcion">Url YouTube: </label>
										<input class="w100 " type="text" name="url_youtube" placeholder="intro url" value="<?= $dato['url_youtube'] ?>">
									</div>
									
								</div>
								<input type="submit" value="Actualizar Datos" class="btn2 btn-azul" name="editarfase">

							</form>
					<?php
						endwhile;
					endif;
					?>
				</div>

			</div>
			<!-- center -->
			<!-- <a class="btn" href="contenedor.php"> Inicio</a>		 -->
			<!-- <a class="btn" href="javascript:history.back()">Atrás</a>	 -->
			<?php borrarErrores(); ?>
		</div>
		</section>
		<?php include 'layout/footer.php'; ?>
	</div>
	</main>