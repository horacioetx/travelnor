<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */
	
	$prog_id = $_REQUEST['progid'];
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT program_name FROM dir_programs WHERE program_id = :program_id');	
	$stmt->execute(array(':program_id' => $prog_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* define page title */
	
	$title = str_replace("<br />", " ", $rrows['program_name']);
	$active_page = 3;

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
							<li class="breadcrumb-item active" aria-current="page">Hoteles</a></li>
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

				<button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#new_iti">Agregar Hotel</button>

				<div id="table_disp">

					<?php include 'admin_program_hotels_disp.php'; ?>
					
				</div>
					
			</div>	
			
			<!-- footer -->	
					
			<?php include ("footer.php"); ?>	
				
		</div>			
		
		<!-- MODALS -->		
		
		<!-- Add new hotel -->
		
		<div class="modal fade" id="new_iti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Hotel a Programa</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_add_hotel" method="post" action="admin">	
					
						<div class="modal-body">	
						
							<div class="form-row">								
								<div class="col">
									<label for="hotel_name" class="col-form-label">Nombre del Hotel :</label>
									<input type="text" id="hotel_name" name="hotel_name" class="form-control" value="">
								</div>
							</div>	
							
							
							<div class="form-row">								
								<div class="col">
									<label for="hotel_city" class="col-form-label">Ciudad :</label>
									<input type="text" id="hotel_city" name="hotel_city" class="form-control" value="">
								</div>
							</div>	

							<div class="form-row">								
								<div class="col">
									<label for="hotel_catego" class="col-form-label">Categoria : </label>
									<select class="custom-select mr-sm-2" id="hotel_catego" name="hotel_catego">
										<?php
										
											$stmt_ct = $db->prepare('SELECT * FROM dir_hotels_categories ORDER BY cat_order');	
											$stmt_ct->execute();
											
											while ($rowcat = $stmt_ct->fetch(PDO::FETCH_ASSOC)){
												echo '<option value="' . $rowcat['cat_id'] . '">' . $rowcat['cat_name'] . '</option>';
											}
											
										?>
									</select>
								</div>
							</div>						
				
							<div class="modal-footer">
							
								<input type="hidden" id="hotel_prog" name="hotel_prog" value="<?php echo $prog_id; ?>">
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
						<h5 class="modal-title" id="exampleModalLabel">Editar Hotel</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_edit_hotel" method="post" action="admin" autocomplete="off">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="e_hotel_name" class="col-form-label">Nombre del Hotel :</label>
									<input type="text" id="e_hotel_name" name="e_hotel_name" class="form-control" value="">
								</div>
							</div>	
							
							
							<div class="form-row">								
								<div class="col">
									<label for="e_hotel_city" class="col-form-label">Ciudad :</label>
									<input type="text" id="e_hotel_city" name="e_hotel_city" class="form-control" value="">
								</div>
							</div>	

							<div class="form-row">								
								<div class="col">
									<label for="e_hotel_catego" class="col-form-label">Categoria : </label>
									<select class="custom-select mr-sm-2" id="e_hotel_catego" name="e_hotel_catego">
										<?php
										
											$stmt_ct = $db->prepare('SELECT * FROM dir_hotels_categories ORDER BY cat_order');	
											$stmt_ct->execute();
											
											while ($rowcat = $stmt_ct->fetch(PDO::FETCH_ASSOC)){
												echo '<option value="' . $rowcat['cat_id'] . '">' . $rowcat['cat_name'] . '</option>';
											}
											
										?>
									</select>
								</div>
							</div>							
							
							<div class="modal-footer">
							
								<input type="hidden" id="e_hotel_id" name="e_hotel_id" value="">
								<input type="hidden" id="e_hotel_program" name="e_hotel_program" value="">
								<button type="submit" class="btn btn-primary" id="editar" name="editar" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>

		<!-- jQuery first, Popper.js, Bootstrap JS -->
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
			  $("form[id='form_add_hotel']").submit(function(){
				$.ajax({
					url : 'admin_program_hotel_add.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#table_disp").html(data);
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
					var hotel_id = $(this).attr("id");  
					$.ajax({  
						url:"fetch_hotel.php",  
						method:"POST",  
						data:{hotel_id:hotel_id},  
						dataType:"json",  
						success:function(data){  
							$('#e_hotel_name').val(data.hotel_name);  
							$('#e_hotel_city').val(data.hotel_city);  
							$('#e_hotel_catego').val(data.hotel_catego);  
							$('#e_hotel_program').val(data.hotel_prog); 
							$('#e_hotel_id').val(data.hotel_id);  								
							$('#edit_iti').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		 
		<!-- send edit form -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_hotel']").submit(function(){
				$.ajax({
					url : 'admin_program_hotel_edit.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#table_disp").html(data);
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
										$("#table_disp").html(response);										
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