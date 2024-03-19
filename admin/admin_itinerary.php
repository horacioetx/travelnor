<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */
	
	$prog_id = $_REQUEST['progid'];
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT program_name, program_duration FROM dir_programs WHERE program_id = :program_id');	
	$stmt->execute(array(':program_id' => $prog_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* define page title */
	
	$title = str_replace("<br />", " ", $rrows['program_name']);
	$active_page = 2;

?>

<!DOCTYPE html>
<html lang="en">

	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- favicon -->
		
		<link rel="apple-touch-icon" sizes="180x180" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/logos/favicon.png">	
		
		<!-- Bootstrap CSS -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/379421e620.js" crossorigin="anonymous"></script>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i|Playfair+Display&display=swap" rel="stylesheet">

		<!-- custom CSS -->

		<link href="css/styles.css" rel="stylesheet">

		<title><?php echo $title; ?></title>
		
	</head>
	
	<body>
	
		<!-- top navbar -->
		
		<?php include ("navbar.php"); ?>	
		
		<!-- sidebar and main content -->
		
		<div class="row" id="body-row">			
			
			<?php include ("navbar_side.php"); ?>			

			<div class="col mb-5">
				 
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">		
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">								
							<li class="breadcrumb-item"><a href="home">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="admin_programs">Directorio de Programas</a></li>
							<li class="breadcrumb-item"><a href="admin_program_view?progid=<?php echo $prog_id; ?>"><?php echo $title; ?></a></li>
							<li class="breadcrumb-item active" aria-current="page">Itinerario</a></li>
						</ol>
					</nav>							
				</div>
	
				<?php include("program_subnav.php"); ?>

				<div class="card">
					<div class="card-body">
						<h1 class="card-title"><?php echo str_replace("<br />", " ", $rrows['program_name']); ?></h1>
					</div>
				</div>
			
				<!-- action buttons and total members -->

				<button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#new_iti">Agregar Día a Itinerario</button>

				<div id="table_itinerary">

					<?php include 'admin_itinerary_disp.php'; ?>
					
				</div>
					
			</div>	
			
			<!-- footer -->	
					
			<?php include ("footer.php"); ?>	
				
		</div>		
		
		<!-- MODALS -->		
		
		<!-- Add new day to itinerary -->
		
		<div class="modal fade" id="new_iti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar día a Itinerario</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_add_iti" method="post" action="admin">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="iti_prog_day" class="col-form-label">Día : </label>
									<select class="custom-select mr-sm-2" id="iti_prog_day" name="iti_prog_day" required>
										<?php
											for ($i=1; $i<=$rrows['program_duration']; $i++) {
												echo '<option>' . $i . '</option>';
											}
										?>
									</select>
								</div>
							</div>												
						
							<div class="form-row">
								<div class="col">
									<label for="iti_prog_day_back" class="col-form-label">Mismo día que el anterior:</label>
									<select class="custom-select mr-sm-2" id="iti_prog_day_back" name="iti_prog_day_back" required>
										<option disabled selected>Selecciona...</option>
										<option value="0">Nuevo Día</option>
										<option value="1">Mismo Día</option>
									</select>
								</div>
							</div>
							
							<div class="form-row">								
								<div class="col">
									<label for="iti_prog_title" class="col-form-label">Titulo del día :</label>
									<input type="text" id="iti_prog_title" name="iti_prog_title" class="form-control" value="" required>
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="iti_prog_description" class="col-form-label">Descripción de actividades :</label>
									<textarea class="form-control" id="iti_prog_description" name="iti_prog_description" rows="5" required></textarea>
								</div>
							</div>							
							<div class="modal-footer">
							
								<input type="hidden" id="iti_prog_id" name="iti_prog_id" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar" name="editar" value="add">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>		
		
		<!-- Edit program modal -->
		
		<div class="modal fade" id="edit_iti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar día en Itinerario</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_edit_iti" method="post" action="admin" autocomplete="off">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="e_iti_prog_day" class="col-form-label">Día : </label>
									<select class="custom-select mr-sm-2" id="e_iti_prog_day" name="e_iti_prog_day" required>
										<?php
											for ($i=1; $i<=$rrows['program_duration']; $i++) {
												echo '<option>' . $i . '</option>';
											}
										?>
									</select>
								</div>
							</div>												
						
							<div class="form-row">
								<div class="col">
									<label for="e_iti_prog_day_back" class="col-form-label">Mismo día que el anterior:</label>
									<select class="custom-select mr-sm-2" id="e_iti_prog_day_back" name="e_iti_prog_day_back" required>
										<option value="0" class="text-success">Nuevo día</option>
										<option value="1" class="text-danger">Igual que el día anterior</option>
									</select>
								</div>
							</div>
							
							<div class="form-row">								
								<div class="col">
									<label for="e_iti_prog_title" class="col-form-label">Titulo del día :</label>
									<input type="text" id="e_iti_prog_title" name="e_iti_prog_title" class="form-control" value="" required>
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="e_iti_prog_description" class="col-form-label">Descripción de actividades :</label>
									<textarea class="form-control" id="e_iti_prog_description" name="e_iti_prog_description" rows="5" required></textarea>
								</div>
							</div>							
							<div class="modal-footer">
							
								<input type="hidden" id="e_iti_id" name="e_iti_id" value="">
								<input type="hidden" id="e_iti_prog_id" name="e_iti_prog_id" value="">
								<button type="submit" class="btn btn-primary" id="editar" name="editar" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>

		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>	
		
		<!-- Optional JavaScript -->
		
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
		
		<!-- sends add form -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_add_iti']").submit(function(){
				$.ajax({
					url : 'admin_itinerary_add.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#table_itinerary").html(data);
						$('#new_iti').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>
		
		<!-- populate edit form -->
		
		<script>		
			$(document).ready(function(){  
				$(document).on('click', '.edit_data', function(){  
					var iti_id = $(this).attr("id");  
					$.ajax({  
						url:"fetch.php",  
						method:"POST",  
						data:{iti_id:iti_id},  
						dataType:"json",  
						success:function(data){  
							$('#e_iti_prog_day').val(data.iti_prog_day);  
							$('#e_iti_prog_day_back').val(data.iti_prog_day_back);  
							$('#e_iti_prog_title').val(data.iti_prog_title);  
							$('#e_iti_prog_description').val(data.iti_prog_description); 
							$('#e_iti_prog_id').val(data.iti_prog_id);  								
							$('#e_iti_id').val(data.iti_id);  							
							$('#edit_iti').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		 
		<!-- send edit form -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_iti']").submit(function(){
				$.ajax({
					url : 'admin_itinerary_edit.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#table_itinerary").html(data);
						$('#edit_iti').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>
		
		<!-- delete items -->

		<script type="application/javascript">
			$(document).ready(function($){
				$(document).on('click', '.delete_data', function(e){
					e.preventDefault();
					var rowid = $(this).attr('data-row-id');
					var roworg = $(this).attr('data-org');
					var rowprg = <?php echo $prog_id; ?>;					
					var dataString = 'rowid=' + rowid + '&roworg=' + roworg + '&rowprg=' + rowprg;					
					var parent = $("#"+rowid);					
					bootbox.dialog({
						message: "<div class='alert alert-danger' role='alert'>Estas seguro que quieres eliminar este item?</div>",
						title: "<i class='fas fa-trash-alt'></i> Eliminar Item!",
						buttons: {
							success: {
								label: "No",
								className: "btn-success",
								callback: function() {
									$('.bootbox').modal('hide');
								}
							},
							danger: {
								label: "Eliminar",
								className: "btn-danger",
								callback: function() {
									$.ajax({
										type: 'POST',
										url: 'delete_records.php',
										data: dataString,
									})
									.done(function(response){	
										$("#table_itinerary").html(response);	
										bootbox.alert('<div class="alert alert-success" role="alert">Item eliminado satisfactoriamente!</div>');										
									})
									.fail(function(){
										bootbox.alert('Error. No se pudo eliminar item');
									})
								}
							}
						}
					});
				});
			});
		</script>

	</body>
	
</html>