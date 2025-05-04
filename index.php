<?php include('layout/header.php'); ?>  
<body>
  <!-------------- INICIO DE PAGINA -------------->
  <main class="main">    
    <?php include('layout/navbar.php'); ?>
    
  <!------ SLIDER ------>    
		<section class="slider example-1">	
			<?php 
				$Somos = obtenerTodosDatosActivos($con, "homeslider");
				if(!empty($Somos) && mysqli_num_rows($Somos) >= 1):
					while($somo = mysqli_fetch_assoc($Somos)):		
			?>	      
			<div class="relative center">
			<img class="img-list" src="assets/img/slides/<?=$somo['imagen']?>" alt="img-slider">			
				<div class="box-texto ">
					<h2 class="title"><?=$somo['en_titulo']?></h2>
					<p class="texto"><?=$somo['en_descripcion']?></p>
				</div>
				<div class="box-botones flex justify-end">
					<!-- <a href="game.php" class="btn btn-outline">Next matches</a> -->
					<a href="game.php#partidos" class="btn btn-verde">see list of matches</a>
				</div>
				<!-- <div class="box-image-number">
					<img src="assets/img/slides/1.svg" alt="imagen slider">
				</div>				 -->
			</div>
			<?php 
				endwhile;
			endif; ?>			
		</section>

		<section class="home-partidos">
			<div class="flex align-center h100 center">
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

		<section class="home-nosotros">
			<?php 
				$datos = selectalldatos($con, "homenosotros");
				if(!empty($datos) && mysqli_num_rows($datos) >= 1):
					while($dato = mysqli_fetch_assoc($datos)):		
			?>	
			<div class="container-nowrap align-center space-between center">
				<div class="box-texto">
					<h2 class="title"><?=$dato['en_titulo']?></h2>
					<h2 class="subtitle"><?=$dato['en_subtitulo']?></h2>
					<p class="texto"> <?=$dato['en_descripcion']?></p>
					<a href="game.php#partidos" class="btn btn-verde">Play a match</a>
				</div>
				<div class="box-image">
				<img class="img-list" src="assets/img/home/<?=$dato['imagen']?>" alt="imagen de partido">
				</div>
			</div>
			<?php 
				endwhile;
			endif; ?>
		</section>
		<section class="home-banner">			
			<div class="flex align-center justify-end center">
				<?php 
					$datos = selectalldatos($con, "homebanner");
					if(!empty($datos) && mysqli_num_rows($datos) >= 1):
						while($dato = mysqli_fetch_assoc($datos)):		
				?>	
				<div class="box-texto">
					<h2 class="title"><?=$dato['en_titulo']?></h2>
					<p class="texto"> <?=$dato['en_descripcion']?></p>
					<a href="league.php" class="btn btn-verde">Watch league</a>
				</div>
				<?php 
					endwhile;
				endif; ?>				
			</div>
		</section>
  </main>
	<?php include('layout/footer.php'); ?>
 
  <script>
  	$('.example-1').square1({caption: 'none',
        theme: 'light', prev_next_nav: 'none',});
		
		$(function() {
			var mySlider = $('.example-1');
			mySlider.filter_gallery({
				// auto_slide: true,
				animation : 'slide',
				transition_time: 3000,
				auto_slide_delay : 6000,
				pause_on_hover: true,
				prev_next_nav: 'outside',
			});
		});
	</script>
    
</body>
</html>