<?php

	/* legal 1 */
	
	require_once('includes/config.php');
	
	$title = "Política de Privacidad";

?>

<!doctype html>
<html lang="en">

	<head>
	
		<!-- Required meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<!-- google fonts -->
		
		<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&family=Tinos:ital,wght@1,700&display=swap" rel="stylesheet">
		
		<!-- Font awesome CSS -->
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/custom.css">
		
		<!-- favicon -->
		
		<link rel="apple-touch-icon" sizes="180x180" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/logos/favicon.png">

		<title>Travelnor - Política de Privacidad</title>
		
	</head>
	
	<body>
	
		<div class="container">			
			
			<!-- header -->			
			
			<?php include('navbar.php') ?>
			
			<!-- main content -->
			
			<main id="contents">
			
				<img src="images/banners_pages/Banner20A.jpg" class="img-fluid pt-2" alt="Nuestros Servicios">
			
				<div class="container mt-5 mb-5">		
				
					<h1 class="text-center mb-4 pt-5 font-italic txt-navy">Política de Privacidad</h1>
				
					<?php 
				
						// open config table

						$stmt = $db->query('SELECT web1_legal1 FROM config');
						$legal = $stmt->fetch();

						echo $legal['web1_legal1'];

					?>
					
				</div>

			</main>
			
			<img src="images/Cenefa AirMail.jpg" class="img-fluid pt-2 mb-0" alt="Nuestros Servicios">
			
			<!-- footer -->			
			
			<?php include('footer.php') ?>

		</div>

		<!-- Optional JavaScript -->
		
		
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	</body>
	
</html>