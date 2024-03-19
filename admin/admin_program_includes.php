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
	$active_page = 5;

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
							<li class="breadcrumb-item active" aria-current="page">Inclusiones</a></li>
						</ol>
					</nav>							
				</div>		
				
				<?php include("program_subnav.php"); ?>

				<div class="card">
					<div class="card-body">
						<h1 class="card-title"><?php echo str_replace("<br />", " ", $rrows['program_name']); ?></h1>
					</div>
				</div>
		
				<ul class="nav nav-tabs mt-3" id="Tab" role="tablist">
					<li class="nav-item bg-light" role="presentation">
						<a class="nav-link active text-dark" id="home-tab" data-toggle="tab" href="#inclusions" role="tab" aria-controls="inclusions" aria-selected="true">Inclusiones</a>
					</li>
					<li class="nav-item bg-light" role="presentation">
						<a class="nav-link text-dark" id="profile-tab" data-toggle="tab" href="#exclusions" role="tab" aria-controls="exclusions" aria-selected="false">Exclusiones</a>
					</li>
				</ul>
		
				<div class="tab-content border p-3 bg-light" id="TabContent">
				
					<!-- display INCLUSIONS -->
				
					<div class="tab-pane fade show active" id="inclusions" role="tabpanel" aria-labelledby="home-tab">
		
						<!-- action buttons and total members -->

						<button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#new">Agregar Inclusión</button>

						<div id="table_rate">

							<?php include 'admin_program_includes_disp.php'; ?>
							
						</div>
						
					</div>
					
					<!-- display ESCLUSIONS -->
					
					<div class="tab-pane fade show" id="exclusions" role="tabpanel" aria-labelledby="home-tab">
		
						<!-- action buttons and total members -->

						<button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#new2">Agregar Exclusión</button>

						<div id="table_rate2">

							<?php include 'admin_program_notincludes_disp.php'; ?>
							
						</div>
						
					</div>
					
				</div>
					
			</div>	
			
			<!-- footer -->	
					
			<?php include ("footer.php"); ?>	
				
		</div>			
		
		<!-- MODALS -->		
		
		<!-- Add new INCLUSION -->
		
		<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Inclusión</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_add" method="post" action="admin">	
					
						<div class="modal-body">								

							<div class="form-row">								
								<div class="col">
									<label for="prog_inc_descrip" class="col-form-label">Descripción :</label>
									<textarea class="form-control" id="prog_inc_descrip" name="prog_inc_descrip" rows="5"></textarea>
								</div>
							</div>	
							
							<div class="form-row">
								<div class="col">
									<label for="prog_inc_type" class="col-form-label">Tipo :</label>
									<select class="custom-select mr-sm-2" id="prog_inc_type" name="prog_inc_type">
										<option value="0" class="text-danger">Regular</option>
										<option value="1" class="text-success">Especial</option>
									</select>
								</div>
							</div>

							<div class="modal-footer">
							
								<input type="hidden" id="prog_inc_prog" name="prog_inc_prog" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar" name="editar" value="add">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>		
		
		<!-- Edit INCLUSION -->
		
		<div class="modal fade" id="edit_iti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Inclusión</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_edit" method="post" autocomplete="off">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="e_prog_inc_descrip" class="col-form-label">Descripción :</label>
									<textarea class="form-control" id="e_prog_inc_descrip" name="e_prog_inc_descrip" rows="5"></textarea>
								</div>
							</div>	
							
							<div class="form-row">
								<div class="col">
									<label for="e_prog_inc_type" class="col-form-label">Tipo :</label>
									<select class="custom-select mr-sm-2" id="e_prog_inc_type" name="e_prog_inc_type">
										<option value="0" class="text-danger">Regular</option>
										<option value="1" class="text-success">Especial</option>
									</select>
								</div>
							</div>	
							
							<div class="modal-footer">
							
								<input type="hidden" id="e_prog_inc_id" name="e_prog_inc_id" value="">
								<input type="hidden" id="e_prog_inc_prog" name="e_prog_inc_prog" value="">
								<button type="submit" class="btn btn-primary" id="editar" name="editar" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>
		
		<!-- Add new EXCLUSION -->
		
		<div class="modal fade" id="new2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Exclusión</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_add2" method="post" action="admin">	
					
						<div class="modal-body">								

							<div class="form-row">								
								<div class="col">
									<label for="prog_exc_descrip" class="col-form-label">Descripción :</label>
									<textarea class="form-control" id="prog_exc_descrip" name="prog_exc_descrip" rows="5"></textarea>
								</div>
							</div>	

							<div class="modal-footer">
							
								<input type="hidden" id="prog_exc_prog" name="prog_exc_prog" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar" name="editar" value="add">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>
		
		<!-- Edit EXCLUSION -->
		
		<div class="modal fade" id="edit_iti2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Inclusión</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_edit2" method="post" autocomplete="off">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="e_prog_exc_descrip" class="col-form-label">Descripción :</label>
									<textarea class="form-control" id="e_prog_exc_descrip" name="e_prog_exc_descrip" rows="5"></textarea>
								</div>
							</div>	
							
							<div class="modal-footer">
							
								<input type="hidden" id="e_prog_exc_id" name="e_prog_exc_id" value="">
								<input type="hidden" id="e_prog_exc_prog" name="e_prog_exc_prog" value="">
								<button type="submit" class="btn btn-primary" id="editar2" name="editar2" value="edit">Guardar</button>
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
		
		<!-- sends form add -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_add']").submit(function(){
				$.ajax({
					url : 'admin_program_included_add.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#table_rate").html(data);
						$('#new').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>
		
		<!-- populate form_edit -->
		
		<script>		
			$(document).ready(function(){  
				$(document).on('click', '.edit_data', function(){  
					var id = $(this).attr("id");  
					$.ajax({  
						url:"fetch_included.php",  
						method:"POST",  
						data:{id:id},  
						dataType:"json",  
						success:function(data){  
							$('#e_prog_inc_descrip').val(data.prog_inc_descrip);  
							$('#e_prog_inc_type').val(data.prog_inc_type);  
							$('#e_prog_inc_id').val(data.prog_inc_id);  
							$('#e_prog_inc_prog').val(data.prog_inc_prog); 
							$('#edit_iti').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>		
		 
		<!-- send form_edit -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit']").submit(function(){
				$.ajax({
					url : 'admin_program_included_edit.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#table_rate").html(data);
						$('#edit_iti').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>
		
		<!-- sends form add2 -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_add2']").submit(function(){
				$.ajax({
					url : 'admin_program_notincluded_add.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#table_rate2").html(data);
						$('#new2').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>
		
		<!-- populate form_edit2 -->
		
		<script>		
			$(document).ready(function(){  
				$('#edit2').click(function() {
					$('#edit2').val("edit");
					$('#form_edit2')[0].reset();
				});
				$(document).on('click', '.edit_data2', function(){  
					var id = $(this).attr("id");  
					$.ajax({  
						url:"fetch_notincluded.php",  
						method:"POST",  
						data:{id:id},  
						dataType:"json",  
						success:function(data){  
							$('#e_prog_exc_descrip').val(data.prog_inc_descrip);  
							$('#e_prog_exc_id').val(data.prog_inc_id);  
							$('#e_prog_exc_prog').val(data.prog_inc_prog); 
							$('#edit_iti2').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- send form_edit2 -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit2']").submit(function(){
				$.ajax({
					url : 'admin_program_notincluded_edit.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#table_rate2").html(data);
						$('#edit_iti2').modal('hide');  
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
										if (roworg === "included") {									
											$("#table_rate").html(response);	
										} else if (roworg === "notincluded") {										
											$("#table_rate2").html(response);	
										}										
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