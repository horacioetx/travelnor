<?php



?>

<!doctype html>
<html lang="en">

	<head>
	
		<!-- Required meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">		
		
		<meta property="og:url" content="https://www.travelnor.com" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="Travelnor - Viajes a medida y de empresa" />
		<meta property="og:site_name" content="Travelnor" />
		<meta property="og:image" content="https://www.travelnor.com/images/travelnor_link_sm.jpg" />
		<meta name="description" content="Nuestros 20 años de experiencia nos permiten asesorar y confeccionar viajes a medida para cada viajero. Los mejores destinos a los mejores precios."/>
		
		<title>TRAVELNOR - Viajes a medida y de empresa</title>

		<!-- Bootstrap CSS -->
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<!-- google fonts -->
		
		<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&family=Tinos:ital,wght@1,700&display=swap" rel="stylesheet">
		
		<!-- CSS -->
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">		
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />		
		<link rel="stylesheet" href="css/custom.css">
		
		<!-- favicon -->
		
		<link rel="apple-touch-icon" sizes="180x180" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/logos/favicon.png">	

		<!-- Global site tag (gtag.js) - Google Analytics -->
		
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-159923449-2"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-159923449-2');
		</script>
		
	</head>
	
	<body>
	
		<div class="container">			
			
			<!-- header -->			
			
			<?php include('navbar.php') ?>
			
			<!-- main content -->
			
			<main id="contents">				
		
				<div id="carouselExampleIndicators" class="carousel slide pt-2" data-ride="carousel" data-interval="10000">
				
					<!-- news ticker -->
					
					<a href="#_" data-toggle="modal" data-target="#news" style="outline:0;">				
						<div style="width:100%; height:25px; color:#fff; background-color:#E03C31; text-align:center;">
							<strong>Información actualizada COVID-19 y recomendaciones de viaje</strong>		
						</div>						
					</a>
					
					<!-- end news ticker -->
				
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
					</ol>
					
					<div class="carousel-inner">
					
						<div class="carousel-item active">
							<img class="d-block w-100" src="images/carousel/BannerGrecia.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="images/carousel/BannerPareja.jpg" alt="Second slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="images/carousel/BannerAeropuerto.jpg" alt="Third slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="images/carousel/Banner Estudios.jpg" alt="Fourth slide">
						</div>
						
					</div>					
					
				</div>

				<div class="container mt-5">		

					<h1 class="text-center mb-4 pt-5 font-italic txt-navy">Nuestro Valor</h1>
				
					<p class="text-center mx-lg-5 px-lg-5">
						20 años son los que Travelnor lleva ofreciendo a sus clientes servicios de asesoramiento y viajes con un alto valor añadido. Durante todo este tiempo hemos adquirido experiencia en diferentes áreas del sector turístico. Los viajes de empresas y la gestión de estudios en el extranjero son algunas de nuestras especialidades. Sin duda, nuestro mayor distintivo es la organización de tus vacaciones o luna de miel, donde ponemos en práctica todo nuestro conocimiento para crear viajes personalizados. Con esta idea hemos lanzado una marca exclusiva de grandes viajes llamada Cucoa con la que formaremos una gran familia de viajeros únicos.<br /><br />La confianza de nuestros clientes es el mayor éxito de Travelnor. Vosotros sois la razón por la que hemos podido perdurar durante todo este tiempo. Esperamos sigáis confiando con nuestra profesionalidad y cariño durante 20 años más.
					</p>
					
					<div class="row text-center mt-5 pt-5">
					
						<div class="container">
						
							<h4 class="text-center mt-2 mb-4 txt-magenta">VENTE CON NOSOTROS</h4>
						
							<div class="row">
							
								<div class="col-lg-4 col-sm-12 d-flex justify-content-center mt-3">	
						
									<div class="card shadow border-0">
									
										<h3 class="card-header text-left txt-white bg-navy">Comunitat Valenciana</h3>
										<img class="card-img-top" src="images/programs/PromoCostaBlanca-min.jpg" alt="Card image cap">
										<h5 class="card-title m-3 text-left txt-magenta"><strong>Bono viaje hasta 600€<br></strong>2020 -2021</h5>
										<p class="card-text m-3 text-left">Turisme de la Comunitat Valenciana ha puesto en marcha un programa que distribuirá un bono descuento para viajar por la Comunitat.</p>
										
										<div class="modal-footer border-top-0">
											<a href="programs_pdf/Comunitat Val.pdf" target="_blank"><button type="button" class="btn btn-next" data-dismiss="modal"><span aria-hidden="true">&gt;</span></button></a>
										</div>
										
									</div>

								</div>	
									
								<div class="col-lg-4 col-sm-12 d-flex justify-content-center mt-3">	
							
									<div class="card shadow border-0">
									
										<h3 class="card-header text-left txt-white bg-navy">Paradores</h3>
										<img class="card-img-top" src="images/programs/PromoParadores-min.jpg" alt="Card image cap">
										<h5 class="card-title m-3 text-left txt-magenta"><strong>Desde 60€<br></strong>Otoño 2020</h5>
										<p class="card-text m-3 text-left">Disfruta de las ofertas que ha lanzado Paradores para este Otoño y descubre sus magníficos edificios y localizaciones únicas.</p>
										
										<div class="modal-footer border-top-0">
											<a href="programs_pdf/Paradores.pdf" target="_blank"><button type="button" class="btn btn-next" data-dismiss="modal"><span aria-hidden="true">&gt;</span></button></a>
										</div>
										
									</div>
								
								</div>	
									
								<div class="col-lg-4 col-sm-12 d-flex justify-content-center mt-3">
							
									<div class="card shadow border-0">
									
										<h3 class="card-header text-left txt-white bg-navy">Camino de Santiago</h3>
										<img class="card-img-top" src="images/programs/PromoCaminoSantiago-min.jpg" alt="Card image cap">
										<h5 class="card-title m-3 text-left txt-magenta"><strong>Cotización individual<br></strong>2020- 2021</h5>
										<p class="card-text m-3 text-left">Te organizamos el Camino de Santiago de forma cómoda y personalizada, alojándote en hotelitos con encanto y transporte de equipaje entre etapas.</p>
										
										<div class="modal-footer border-top-0">
											<a href="programs_pdf/Camino de Santiago.pdf" target="_blank"><button type="button" class="btn btn-next" data-dismiss="modal"><span aria-hidden="true">&gt;</span></button></a>
										</div>
										
									</div>
									
								</div>
								
							</div>

						</div>

					</div>							
				
					<div class="container mt-5 pt-5">
					
						<h1 class="text-center mt-3 mb-4 font-italic txt-navy">Servicio a Empresas</h1>
						
						<div class="row">	
							<div class="col-lg-3 col-md-2 col-sm-1">
							
							</div>
							<div class="col-lg-6 col-md-8 col-sm-10">
								<p class="text-center">Nuestra agencia asesora y ofrece herramientas a las a empresas para hacer más eficientes sus viajes. Nuestra acreditación IATA nos permite la reserva y emisión de billetes de las aerolíneas más importantes del mundo.<br />Además estas tienen a su disposición todos nuestros servicios y un teléfono exclusivo de asistencia 24 horas.</p>
							</div>
							<div class="col-lg-3 col-md-2 col-sm-1">
							
							</div>
						
						</div>						
						
						<div class="row">
						
							<div class="col text-center">					
								<a href="business" class="txt-magenta">Descubre Más</a>
							</div>
						
						</div>				
						
					</div>					
					
					<div class="container mt-5 mb-5 text-center">
						<img src="images/Boletos 24.png" class="img-fluid mx-auto mb-3" alt="..." width="600">
					</div>
				
				</div>
				
				<a href="https://www.cucoa.com" target="_blank"><img src="images/banners_cucoa/Banner Secundario Cucoa 1.jpg" class="img-fluid mt-5 mb-3" alt="Responsive image"></a>
				
				<div class="jumbotron mt-5 py-4 bg-navy text-light">
					
						<div class="row">
						
							<div class="col-lg-4 col-sm-12 text-center">
							
								<img src="images/Planeta.png" width="100" class="ml-lg-0 ml-sm-5" alt="Responsive image">
							
							</div>
							
							<div class="col-lg-8 col-sm-12">		
					
								<h3 class="ml-lg-3">¿Cuál te gustaría que fuera tu próximo destino?</h3>
								
								<form style="width:80%;">
									<div class="input-group mx-sm-3 mb-2">
										<input type="text" class="form-control rounded" id="travelto" placeholder="EL MUNDO ES TUYO">
										<span class="input-group-btn ml-2">
											<button type="submit" class="btn bg-magenta mb-2">Allá Voy</button>
										</span>
									</div>
								</form>

							</div>			
							
						</div>
							
					
				</div>

			</main>			
			
			<!-- footer -->			
			
			<?php include('footer.php') ?>

		</div>		
		
		<!-- modals -->
		
		<div class="modal fade" id="news" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:15000 !important;">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">

					<div class="modal-body">
				  
						<h5 class="modal-title w-100" id="exampleModalLabel">
							<div class="alert alert-danger w-100 text-center" role="alert">
								Información actualizada COVID-19 y recomendaciones de viaje  
							</div>
						</h5>
				  
						<div class="container text-center" style="padding-top:20px;">
						
							<img src="images/logos/LogoTravelnor2020 Cucoa Circulo.png" class="img-fluid pt-2 mb-2" style="width:50%; height:auto;" alt="Travelnor / Cucoa">							
							<img src="images/Covid.jpg" class="img-fluid pt-2" style="width:60%; height:auto;" alt="Covid19">
						
						</div>
				  
						<p class="px-5 mt-5" style="font-size:16px;">Los viajes están atravesando una difícil situación a causa de la pandemia del COVID-19 y las restricciones que los gobiernos han implementado a nivel mundial.<br />En Travelnor-Cucoa continuamos operativos tramitando reservas, cambios y cancelaciones, al mismo tiempo que nos mantenemos informados respecto cualquier actualización que afecte al turismo o transporte de viajeros. De esta forma tenemos la capacidad de informar y proteger con precisión a nuestros clientes.<br />Disponemos de productos como villas, apartamentos o autocaravanas que permiten a las familias disfrutar de unas merecidas vacaciones al mismo tiempo que se cumplen con las recomendaciones de bioseguridad.<br />Nuestra agencia cuenta con la acreditación IATA ( International Air Transport Association ), esta organización dispone de una pagina web en la que se pueden consultar las restricciones actualizadas que cada país tiene implementadas respecto al transito de viajeros.<br /><br /><a href="https://www.iatatravelcentre.com/international-travel-document-news/1580226297.htm" target="_blank">https://www.iatatravelcentre.com/international-travel-document-news/1580226297.htm </a> <br /><br />Tengamos presente que esta situación es temporal y que en un futuro próximo regresaremos a la normalidad, donde el viajar volverá a formar parte de nuestra cotidianidad. Travelnor- Cucoa ha reflexionado durante este tiempo acerca del sector de los viajes. Nuestra conclusión nos ha proporcionado una nueva visión de los cambios que debemos de aplicar para contribuir a la mejora de la salud de nuestro planeta. Por eso hemos decidido trabajar en nuevos itinerarios sostenibles y destinos menos masificados, que muy pronto compartiremos con vosotros.<br /><br />Muchos ánimos y mucha salud.</p> 
					
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
					
				</div>
			</div>
		</div>

		<!-- Optional JavaScript -->
		
		
		
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	
		<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
		<script>
				window.cookieconsent.initialise({
					"palette": {
						"popup": {
							"background": "#002554"
						},
						"button": {
							"background": "#dddddd",
							"text-decoration": "none"
						},
						"a:hover": {
							"color": "#fff"
						}
					},
					"content": {
						"message": "travelnor.com utiliza cookies propias y de terceros para mejorar su experiencia al navegar por nuestro sitio web. Puede obtener más información en nuestra",
						"dismiss": "Aceptar",
						"link": "<a href='legal2' style='color:#fff !important; text-decoration:underline;'>Política de Cookies</a>"
					}
				});
		</script>	
	
	</body>
	
</html>