<?php
include 'layout/header.php';
require_once "controller/helpers.php";
if (!isset($_GET)) {
	header("Location:game.php");
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
				<h2 class="title">Editando Partido - Página Partidos</h2>
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
					<?php
					$datos = detallePartido($con, $id);
					if (!empty($datos) && mysqli_num_rows($datos) >= 1):
						while ($dato = mysqli_fetch_assoc($datos)):
					?>
							<form action="models/updates/upgamesoccer.php" class="box-formulario" enctype="multipart/form-data" method="post">
								<div class="w100 container-wrap mg-bt10">
									<input type="hidden" name="id" value="<?=$id?>">
									<div class="box-input">
										<label for='local'>Local o Sede:</label>															
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
										<label for="nombre">Fecha del partido: </label>
										<input class="" type="date" name="fecha" value="<?php echo $dato['fecha_partido']?>">
									</div>
									<div class="box-input">
										<label for="descripcion">Genero: </label>
										<select name="genero" class="w100">											
											<option value="Female" <?=($dato['genero']) == "Female" ? 'selected="selected"' : '' ?>>Femenino</option>
											<option value="Male" <?=($dato['genero']) == "Male" ? 'selected="selected"' : '' ?>>Masculino</option>
											<option value="Mixto" <?=($dato['genero']) == "Mixto" ? 'selected="selected"' : '' ?>>Mixto</option>											
										</select>		
									</div>
									<div class="box-input">
										<label for="nombre">Hora: </label>
										<input class="" type="time" name="hora" value="<?=$dato['hora']?>">
									</div>
									<div class="box-input">
										<label for="nombre">Costo $: </label>
										<input class="" type="text" name="costo" value="<?=$dato['costo']?>">
									</div>
									<div class="box-input">
										<label for="nombre">Total de jugadores: </label>
										<input class="" type="text" name="total_jugadores" value="<?=$dato['total_jugadores']?>">
									</div>
									<div class="box-input">
										<label for="nombre">Total de jugadores: </label>
										<input class="" type="text" name="total_equipos" value="<?=$dato['total_equipos']?>">
									</div>									
									<div class="box-input">
										<label for="descripcion">Nivel de Juego: </label>
										<select name="nivel" class="w100">											
											<option value="Advanced" <?=($dato['en_nivel']) == "advanced" ? 'selected="selected"' : '' ?>>Advanced</option>
											<option value="Middle" <?=($dato['en_nivel']) == "middle" ? 'selected="selected"' : '' ?>>Middle</option>
											<option value="Basic" <?=($dato['en_nivel']) == "basic" ? 'selected="selected"' : '' ?>>Basic</option>											
										</select>		
									</div>								
									<label for="nombre">Beneficios del partido: </label>
									<div class="box-beneficios-partidos">
										<div class="box-input align-center">
											<img src="../assets/img/partidos/beneficio1.png">
											<input type="checkbox" <?=($dato['beneficio1']) == 2 ? 'checked' : 'empty' ?> name="beneficio1" value="2"><label>Beneficio 1</label>
										</div>
										<div class="box-input align-center">
										<img src="../assets/img/partidos/beneficio2.png">
											<input type="checkbox" <?=($dato['beneficio2']) == 2 ? 'checked' : 'empty' ?> name="beneficio2" value="2"><label>Beneficio 2</label>
										</div>
										<div class="box-input align-center">
										<img src="../assets/img/partidos/beneficio3.png">
											<input type="checkbox" <?=($dato['beneficio3']) == 2 ? 'checked' : 'empty' ?> name="beneficio3" value="2"><label>Beneficio 3</label>
										</div>
										<div class="box-input align-center">
										<img src="../assets/img/partidos/beneficio4.png">
											<input type="checkbox" <?=($dato['beneficio4']) == 2 ? 'checked' : 'empty' ?> name="beneficio4" value="2"><label>Beneficio 4</label>
										</div>
										<div class="box-input align-center">
										<img src="../assets/img/partidos/beneficio5.png">
											<input type="checkbox" <?=($dato['beneficio5']) == 2 ? 'checked' : 'empty' ?> name="beneficio5" value="2"><label>Beneficio 5</label>
										</div>
									</div>
								</div>
								<input type="submit" value="Actualizar Datos" class="btn2 btn-azul" name="editar">

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
		
	</div>
	</main>