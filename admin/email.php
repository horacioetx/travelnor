<?php

	/* email.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

	/* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' - Email';	
	else	
		$title = 'Email';

?>

<!DOCTYPE html>
<html lang="en">

	<head>
  
		<!-- meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $title; ?></title>
		
		<!-- favicon -->
		


		<!-- fonts -->
		
		<link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

		<!-- js -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.js"></script>		
		
		<!-- Custom CSS -->		
		
		<link rel="stylesheet" href="css/easion.css">	

		<!-- title -->
		
		<title><?php echo $title; ?></title>

	</head>
	
	<body>
	
		<div class="dash">
		
			<!-- navbar -->

			<?php include ("navbar.php"); ?>

			<!-- center body -->
			
			<div class="dash-app">
			
				<!-- header bar -->
				
				<?php include ("header_bar.php"); ?>
				
				<!-- breadcrumb -->
				
				<nav class="bg-light" aria-label="breadcrumb">
					<ol class="breadcrumb">								
						<li class="breadcrumb-item"><a href="home">Dashboard</a></li>
						<li class="breadcrumb-item active" aria-current="page">Email</li>						
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content p-0 m-0">
				
					<div class="container-fluid p-0 m-0">	

						<iframe src="https://nddinfosystems.com/ndd_webmail.php" style="width: 100%; height: 800px; border: 0; margin-top:-10px;"></iframe>
					
					</div>	
						
				</main>
				
			</div>			

		</div>

		<!-- js -->

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		
		<!-- custom js -->
		
		<script src="js/easion.js"></script>
		
	</body>
	
</html>