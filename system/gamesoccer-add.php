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
				<h2 class="title">Añadir Nuevo Partido - Página Partidos</h2>
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

				<div class="container-wrap w100">
					<form action="models/add/addgamesoccer.php" class="box-formulario" enctype="multipart/form-data" method="post">
						<div class="w100 container-wrap mg-bt10">
							<div class="box-input">
								<label for='local'>ID</label>
								<?php
									$datos = selectalldatos($con, "detallepartido");
									if (!empty($datos) && mysqli_num_rows($datos) >= 1):
										$cantidad = mysqli_num_rows($datos);
										$cantidadNueva = $cantidad + 1;
										$nuevoId = formatearId($cantidadNueva, 'P');
								?>
									<input type="text" name="id" value="<?= $nuevoId ?>" readonly>
								<?php endif; ?>
							</div>
							<div class="box-input">
								<label for='local'>Local o Sede:</label>
								<select name="idlocal" class="w100">
									<option>Select an option</option>
									<?php
									$partidos = selectDatosEstado($con, "partidoslocales", 2);
									if (!empty($partidos) && mysqli_num_rows($partidos) >= 1):
										while ($partido = mysqli_fetch_assoc($partidos)):
									?>
											<option value="<?= $partido['id'] ?>"><?= $partido['en_nombre'] ?></option>
									<?php endwhile;
									endif; ?>
								</select>
							</div>
							<div class="box-input">
								<label for="nombre">Fecha del partido: </label>
								<input class="" type="date" name="fecha" value="<?= date("Y-m-d") ?>">
							</div>
							<div class="box-input">
								<label for="descripcion">Genero: </label>
								<select name="genero" class="w100">
									<option>Select an option</option>
									<option value="Female">Femenino</option>
									<option value="Male">Masculino</option>
									<option value="Mixto">Mixto</option>
								</select>
							</div>
							<div class="box-input">
								<label for="nombre">Hora: </label>
								<input type="time" name="hora" >
							</div>
							<div class="box-input">
								<label for="nombre">Costo $: </label>
								<input type="number" name="costo" >
							</div>
							<div class="box-input">
								<label for="nombre">Total de jugadores: </label>
								<input type="number" min="4" name="total_jugadores" >
							</div>
							<div class="box-input">
								<label for="nombre">Cantidad de Equipos: </label>
								<input type="number" min="2" name="total_equipos" >
							</div>							
							<div class="box-input">
								<label for="descripcion">Nivel de Juego: </label>
								<select name="nivel" class="w100">
									<option value="Advanced">Advanced</option>
									<option value="Middle">Middle</option>
									<option value="Basic">Basic</option>
								</select>
							</div>
							<label for="nombre">Beneficios del partido: </label>
							<div class="box-beneficios-partidos">
								<div class="box-input align-center">
									<img src="../assets/img/partidos/beneficio1.png">
									<input type="checkbox" name="beneficio1" value="2"><label>Beneficio 1</label>
								</div>
								<div class="box-input align-center">
									<img src="../assets/img/partidos/beneficio2.png">
									<input type="checkbox" name="beneficio2" value="2"><label>Beneficio 2</label>
								</div>
								<div class="box-input align-center">
									<img src="../assets/img/partidos/beneficio3.png">
									<input type="checkbox" name="beneficio3" value="2"><label>Beneficio 3</label>
								</div>
								<div class="box-input align-center">
									<img src="../assets/img/partidos/beneficio4.png">
									<input type="checkbox" name="beneficio4" value="2"><label>Beneficio 4</label>
								</div>
								<div class="box-input align-center">
									<img src="../assets/img/partidos/beneficio5.png">
									<input type="checkbox" name="beneficio5" value="2"><label>Beneficio 5</label>
								</div>
							</div>
						</div>
						<input type="submit" value="Guardar" class="btn2 btn-azul" name="editar">
					</form>
				</div>
			</div>
			<?php borrarErrores(); ?>
		</div>
		</section>
		<?php include 'layout/footer.php'; ?>
	</div>
	</main>