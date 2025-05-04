<?php include('layout/header.php'); ?>  
<body>
  <!-------------- INICIO DE PAGINA -------------->
  <main class="main">    
    <?php include('layout/navbar.php'); ?>		
		<section class="game-banner">
			<div class="boxoverlay">
				<div class="flex align-center center">
					<?php 
						$datos = selectalldatos($con, "partidosbanner");
						if(!empty($datos) && mysqli_num_rows($datos) >= 1):
							while($dato = mysqli_fetch_assoc($datos)):		
					?>		
					<div class="box-texto">
						<h2 class="title"><?=$dato['en_titulo']?></h2>
						<p class="texto"> <?=$dato['en_descripcion']?></p>
					</div>
					<?php 
						endwhile;
					endif; ?>			
				</div>
			</div>
		</section>
		
		<section class="game-container-grid" id="partidos">
			<div class="center">
				<div class="box-filtros container-nowrap space-between">
					<p class="texto">Búsqueda por filtros</p>
					<div class="container-iconos">
						<img src="assets/img/ico/calendar.png" class="icon-filter" alt="icono calendario">
						<img src="assets/img/ico/location.png" class="icon-filter" alt="icono ubicación">
						<img src="assets/img/ico/user_black.png" class="icon-filter" alt="icono usuario">
					</div>
				</div>
				<hr>
				<div class="container-grid">
					<?php 
						$datos = listaPartidos($con, 2);
						$formato1 = 'd/m/Y';
						if(!empty($datos) && mysqli_num_rows($datos) >= 1):
							while($dato = mysqli_fetch_assoc($datos)):	
							$newFecha = formatearFecha($dato['fecha_partido'], $formato1);
					?>	
					<div class="card-partido">
						<a href="game-detail.php?id=<?=$dato['id']?>">
							<img src="assets/img/partidos/<?=$dato['imagen1']?>" class="image-card" alt="">
							<div class="flex space-between">
								<div class="box-texto">
									<h2 class="title"><?=$dato['en_nombre']?></h2>
									<p class="texto"><?=$dato['en_direccion']?></p>
									<p class="texto-count">9/<?=$dato['total_jugadores']?> SPOTS FILLED</p>
									<p class="texto-icon"><img src="assets/img/ico/user_black.png"><span><?=$dato['genero']?></span> </p>
									<p class="texto-icon"> <img src="assets/img/ico/calendar.png"><span><?=$newFecha?></span> </p>
									<p class="texto-icon"><img src="assets/img/ico/clock.png"><span><?=$dato['hora']?> |  <?=$dato['nombreCantidad']?></span> </p>
								</div>						
								<div class="box-precio">
									<div class="texto">$<?=$dato['costo']?></div>
								</div>
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

