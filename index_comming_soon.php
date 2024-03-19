<?php


?>

<!doctype html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

		<!-- Video CSS -->
		
		<link rel="stylesheet" href="css/home_video.css">
		
		<!-- Gallery with filetring category CSS -->
		
		<link rel="stylesheet" href="css/gallery_filtering_catego.css">

		<title>Hello, world!</title>
		
	</head>
	
	<body>
	
		<!-- navbar -->
	
		<nav class="navbar navbar-expand-lg sticky-top navbar-light ">
			<a class="navbar-brand" href="#">Navbar</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</nav>
		
		<!-- carousel -->
		
		<div class="bd-example">
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="images/carousel/img1.png" class="d-block w-100" alt="...">
						<div class="carousel-caption d-none d-md-block">
							<h5>First slide label</h5>
							<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
						</div>
					</div>
					<div class="carousel-item">
						<img src="images/carousel/img1.png" class="d-block w-100" alt="...">
						<div class="carousel-caption d-none d-md-block">
							<h5>Second slide label</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
					</div>
					<div class="carousel-item">
						<img src="images/carousel/img1.png" class="d-block w-100" alt="...">
						<div class="carousel-caption d-none d-md-block">
							<h5>Third slide label</h5>
							<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
						</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		
		<!-- header video -->
		
		<header>
			<div class="overlay"></div>
			<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
				<!-- <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4"> -->
				<source src="video/home_video.mp4" type="video/mp4"> 
			</video>
			<div class="container h-100">
				<div class="d-flex h-100 text-center align-items-center">
					<div class="w-100 text-white">
						<h1 class="display-3">Video Header</h1>
						<p class="lead mb-0">With HTML5 Video and Bootstrap 4</p>
					</div>
				</div>
			</div>
		</header>		
		
		<!-- gallery with filtering -->		
		
		<div class="container bootstrap snippet">
		
			<h1 class="text-center section-title">Our Portfolio</h1>
			<hr>
			
			<section id="portfolio" class="gray-bg padding-top-bottom">   
			
				<div class="container bootstrap snippet">
				
					<!--==== Portfolio Filters ====-->
					
					<div class="categories">
						<ul>
							<li class="active">
								<a href="#_" data-filter="*">All Categories</a>
							</li>
							<li>
								<a href="#_" data-filter=".web-design">Web Design</a>
							</li>
							<li>
								<a href="#_" data-filter=".apps">Apps</a>
							</li>
							<li>
								<a href="#_" data-filter=".psd">PSD</a>
							</li>
						</ul>
					</div>
					
					<!-- ======= Portfolio items ===-->
					
					<div class="projects-container scrollimation in">
						<div class="row">
							<article class="col-md-4 col-sm-6 portfolio-item web-design apps psd">
								<div class="portfolio-thumb in">
									<a href="#" class="main-link">
										<img class="img-responsive img-center" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
										<h2 class="project-title">Billing</h2>
										<span class="overlay-mask"></span>
									</a>
									<a class="enlarge cboxElement" href="#" title="Bills Project"><i class="fa fa-expand fa-fw"></i></a>
									<a class="link" href="#"><i class="fa fa-eye fa-fw"></i></a>
								</div>
							</article>

							<article class="col-md-4 col-sm-6 portfolio-item apps">
								<div class="portfolio-thumb in">
									<a href="#" class="main-link">
										<img class="img-responsive img-center" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="">
										<h2 class="project-title">Augmented Tourist</h2>
										<span class="overlay-mask"></span>
									</a>
									<a class="link centered" href=""><i class="fa fa-eye fa-fw"></i></a>
								</div>
							</article>
							
							<article class="col-md-4 col-sm-6 portfolio-item web-design psd">
								<div class="portfolio-thumb in">
									<a href="#" class="main-link">
										<img class="img-responsive img-center" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
										<h2 class="project-title">Get Colored</h2>
										<span class="overlay-mask"></span>
									</a>
									<a class="enlarge centered cboxElement" href="#" title="Get Colored"><i class="fa fa-expand fa-fw"></i></a>
								</div>
							</article>
							
							<article class="col-md-4 col-sm-6 portfolio-item apps">
								<div class="portfolio-thumb in">
									<a href="#" class="main-link">
										<img class="img-responsive img-center" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="">
										<h2 class="project-title">Holiday Selector</h2>
										<span class="overlay-mask"></span>
									</a>
									<a class="enlarge cboxElement" href="#" title="Holiday Selector"><i class="fa fa-expand fa-fw"></i></a>
									<a class="link" href="#"><i class="fa fa-eye fa-fw"></i></a>
								</div>
							</article>
							
							<article class="col-md-4 col-sm-6 portfolio-item web-design psd">
								<div class="portfolio-thumb in">
									<a href="#" class="main-link">
										<img class="img-responsive img-center" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
										<h2 class="project-title">Scavenger Hunt</h2>
										<span class="overlay-mask"></span>
									</a>
									<a class="enlarge cboxElement" href="#" title="Scavenger Hunt"><i class="fa fa-expand fa-fw"></i></a>
									<a class="link" href="#"><i class="fa fa-eye fa-fw"></i></a>
								</div>
							</article>
							
							<article class="col-md-4 col-sm-6 portfolio-item web-design apps">
								<div class="portfolio-thumb in">
									<a href="#" class="main-link">
										<img class="img-responsive img-center" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="">
										<h2 class="project-title">Sonor</h2>
										<span class="overlay-mask"></span>
									</a>
									<a class="enlarge cboxElement" href="#" title="Sonor"><i class="fa fa-expand fa-fw"></i></a>
									<a class="link" href="#"><i class="fa fa-eye fa-fw"></i></a>
								</div>
							</article>
						</div>
					</div>
					
				</div>	
				
			</section>
			
		</div>	
		
		
		
		
		
		
	
		<h1>Hello, world!</h1>

		
		

		
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
		<!-- Optional JavaScript -->
		
		<script type="text/javascript">
			$(function(){
				$('.categories a').click(function(e){
					$('.categories ul li').removeClass('active');
					$(this).parent('li').addClass('active');
					var itemSelected = $(this).attr('data-filter');
					$('.portfolio-item').each(function(){
						if (itemSelected == '*'){
							$(this).removeClass('filtered').removeClass('selected');
							return;
						} else if($(this).is(itemSelected)){
							$(this).removeClass('filtered').addClass('selected');
						} else{
							$(this).removeClass('selected').addClass('filtered');
						}
					});
				});
			});
		</script>
	
	
	
	</body>
	
</html>