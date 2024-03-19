<?php

	//include config
	
	require_once('includes/config.php');
	
	// if not logged in redirect to login page
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	//define page title
	
	$title = "Dashboard";
	
	// count rows in db tables
	
	$stmt = $db->prepare('SELECT contact_id FROM dir_contacts');
	$stmt->execute();	
	$num_contacts = $stmt->rowCount();
	
	$stmt = $db->prepare('SELECT subcontact_id FROM dir_subcontacts');
	$stmt->execute();	
	$num_subcontacts = $stmt->rowCount();
	
	$stmt = $db->prepare('SELECT program_id FROM dir_programs');
	$stmt->execute();	
	$num_programs = $stmt->rowCount();
	
	$status = 0;
	$stmt = $db->prepare('SELECT program_id FROM dir_programs WHERE program_status = :program_status');
	$stmt->bindParam(':program_status', $status);
	$stmt->execute();	
	$num_act_programs = $stmt->rowCount();

?>

<!doctype html>
<html lang="en">

	<head>
	
		<!-- meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- favicon -->
		
		<link rel="apple-touch-icon" sizes="180x180" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/logos/favicon.png">	

		<!-- Bootstrap and misc vendor CSS -->
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/379421e620.js" crossorigin="anonymous"></script>
		
		<!-- custom CSS -->
		
		<link href="css/styles.css" rel="stylesheet">

		<title>Travelnor ERP</title>
		
	</head>
	
	<body>
    
		<!-- top navbar -->
		
		<?php include ("navbar.php"); ?>			
		
		<!-- sidebar and main content -->
		
		<div class="container-fluid">
		
			<div class="row" id="body-row">			
				
				<?php include ("navbar_side.php"); ?>			

				<div class="col">
					
					<div class="container-fluid">				
			
						<div class="row mt-5">
							<div class="col-sm-4">
								<div class="card">
									<div class="row no-gutters">
										<div class="col-md-4 text-center pt-3">
											<i class="fas fa-id-card fa-5x text-danger"></i>
										</div>
										<div class="col-md-8 text-center">
											<div class="card-body">
												<h5 class="card-title">Contactos</h5>
												<h3 class="card-text"><?php echo $num_contacts; ?></h3>											
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="card">
									<div class="row no-gutters">
										<div class="col-md-4 text-center pt-3">
											<i class="far fa-address-book fa-5x text-warning"></i>
										</div>
										<div class="col-md-8 text-center">
											<div class="card-body">
												<h5 class="card-title">Sub Contactos</h5>
												<h3 class="card-text"><?php echo $num_subcontacts; ?></h3>											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row mt-3">
							<div class="col-sm-4">
								<div class="card">
									<div class="row no-gutters">
										<div class="col-md-4 text-center pt-3">
											<i class="fas fa-suitcase-rolling fa-5x text-secondary"></i>
										</div>
										<div class="col-md-8 text-center">
											<div class="card-body">
												<h5 class="card-title">Total Programas</h5>
												<h3 class="card-text"><?php echo $num_programs; ?></h3>											
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="card">
									<div class="row no-gutters">
										<div class="col-md-4 text-center pt-3">
											<i class="fas fa-suitcase-rolling fa-5x text-success"></i>
										</div>
										<div class="col-md-8 text-center">
											<div class="card-body">
												<h5 class="card-title">Programas Activos</h5>
												<h3 class="card-text"><?php echo $num_act_programs; ?></h3>											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>		

				</div>	
				
				<!-- footer -->	
						
				<?php include ("footer.php"); ?>	
					
			</div>
			
		</div>

		<!-- Optional JavaScript -->
		
		<!-- jQuery first, Popper.js, Bootstrap JS -->
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 
		<!-- Menu Toggle Script -->
		
		<script>
			$('#body-row .collapse').collapse('hide');
			$('#collapse-icon').addClass('fa-angle-double-left');
			$('[data-toggle=sidebar-colapse]').click(function() {
				SidebarCollapse();
			});
			function SidebarCollapse () {
				$('.menu-collapsed').toggleClass('d-none');
				$('.sidebar-submenu').toggleClass('d-none');
				$('.submenu-icon').toggleClass('d-none');
				$('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
				var SeparatorTitle = $('.sidebar-separator-title');
				if ( SeparatorTitle.hasClass('d-flex') ) {
					SeparatorTitle.removeClass('d-flex');
				} else {
					SeparatorTitle.addClass('d-flex');
				}				
				$('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
			}		
		</script>
		
	</body>
	
</html>