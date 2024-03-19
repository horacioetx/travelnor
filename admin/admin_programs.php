<?php

	//include config
	
	require_once('includes/config.php');
	
	// if not logged in redirect to login page
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	// define page title
	
	$title = "Directorio de Programas";	

	/* edit row */
	
	if($_POST['editar'] == "edit") {

		/* update row */
		
		$stmt = $db->prepare('INSERT INTO dir_programs (program_code, program_name, program_classif, program_classif2, program_status) VALUES (:program_code, :program_name, :program_classif, :program_classif2, :program_status)');
								
		$stmt->bindParam(':program_code', $_POST['program_code']);
		$stmt->bindParam(':program_name', $_POST['program_name']);
		$stmt->bindParam(':program_classif', $_POST['program_classif']);
		$stmt->bindParam(':program_classif2', $_POST['program_classif2']);
		$stmt->bindParam(':program_status', $_POST['program_status']);
	
		$stmt->execute();							

	}
	
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

			<div class="col">
				 
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">		
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">								
							<li class="breadcrumb-item"><a href="home">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Directorio de Programas</li>
						</ol>
					</nav>							
				</div>
			
				<!-- action buttons and total members -->
	
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#new_prog">Agregar Programa</button>

				<?php
				
					$stmt = $db->prepare('SELECT program_id, program_status, program_name, program_code FROM dir_programs ORDER BY program_status, program_name');
					$stmt->execute();	
					
					// check if there are members
					
					$numitems = $stmt->rowCount();
					
					if ($numitems == 0) {
					
						echo '<div class="alert alert-danger mt-5" role="alert">';
							echo 'Esta tabla está vacia!';
						echo '</div>';		
					
					} else {
						
						$output = "";
						$cont1 = 0;
						
						while ($rrows = $stmt->fetch(PDO::FETCH_ASSOC)) {	
						
							$cont1++;

							/* check attendance */
							
							if ($rrows['program_status'] == 0)
								$disp_status = '<span style="color:green;">Activo</span>';
							elseif ($rrows['program_status'] == 1)
								$disp_status = '<span style="color:red;">Inactivo</span>';
							else
								$disp_status = "";
							
							/* links to edit and delete */
							
							$view = '<td style="text-align: center;"><form method="post" action="admin_program_view"><input type="submit" name="additi" value="Ver" class="btn btn-success btn-sm delete_data"><input type="hidden" name="progid" value="' . $rrows['program_id'] . '"></form></td>';
							
							$output .= '<tr>';
								$output .= '<td><strong>' . str_replace("<br />", " ", $rrows['program_name']) . '</strong></td><td style="text-align: center;">' . $rrows['program_code'] . '</td><td style="text-align: center;">' . $disp_status . '</td>' . $view;
							$output .= '</tr>';

						}
						
						echo '<p class="text-right">Total Programas : ' . $cont1 . '</p>';
						
						echo '<table id="table_list" class="table table-bordered table-hover">';
							echo '<thead class="thead-dark">';
								echo '<tr><th scope="col">Nombre del Programa</th><th scope="col" style="text-align: center;">Código</th><th scope="col" style="text-align: center;">Status</th><th scope="col" style="text-align: center;">Ver</th></tr>';
							echo '</thead>';
							echo '<tbody>';						
								echo $output;							
							echo '</tbody>';						
						echo '</table>';
							
					}
				
				?>
					
			</div>	
			
			<!-- footer -->	
					
			<?php include ("footer.php"); ?>	
				
		</div>	
		
		<!-- MODALS -->
		
		<!-- Add new program modal -->
		
		<div class="modal fade" id="new_prog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Programa</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_new_prog" method="post">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="program_name" class="col-form-label">Nombre de Programa:</label>
									<input type="text" id="program_name" name="program_name" class="form-control" value="" >
								</div>
							</div>
							 
							<div class="form-row">								
								<div class="col">
									<label for="program_code" class="col-form-label">Código:</label>
									<input type="text" id="program_code" name="program_code" class="form-control" value="">
								</div>
							</div>						
						
							<div class="form-row">
								<div class="col">
									<label for="program_status" class="col-form-label">Status:</label>
									<select class="custom-select mr-sm-2" id="program_status" name="program_status">
										<option disabled selected>Selecciona...</option>
										<option value="0">Programa Activo</option>
										<option value="1">Programa Inactivo</option>
									</select>
								</div>
							</div>

							<div class="form-row">
								<div class="col">
									<label for="program_classif" class="col-form-label">Clasificación 1:</label>
									<select class="custom-select mr-sm-2" id="program_classif" name="program_classif">
										<option disabled selected>Selecciona...</option>
										<option value="AF">Africa</option>
										<option value="AM">América</option>
										<option value="AS">Asia</option>
										<option value="EU">Europa</option>
										<option value="MO">Medio Oriente</option>
										<option value="AM">Oceanía</option>
										<option value="PA">Paraísos</option>
										<option value="VM">Vuelta al Mundo</option>
									 </select>
								</div>
							</div>
							
							<div class="form-row">
								<div class="col">
									<label for="program_classif2" class="col-form-label">Clasificación 2:</label>
									<select class="custom-select mr-sm-2" id="program_classif2" name="program_classif2">
										<option disabled selected>Selecciona...</option>
										<option value="AF">Africa</option>
										<option value="AM">América</option>
										<option value="AS">Asia</option>
										<option value="EU">Europa</option>
										<option value="MO">Medio Oriente</option>
										<option value="AM">Oceanía</option>
										<option value="PA">Paraísos</option>
										<option value="VM">Vuelta al Mundo</option>
									 </select>
								</div>
							</div>
							
							<div class="modal-footer">
							
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
		
		<!-- datatables -->		
		
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>		
		
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
		
		<script type="text/javascript">
			$(document).ready(function () {
				$('#sidebarCollapse').on('click', function () {
					$('#sidebar').toggleClass('active');
				});
			});
		</script>
		
		<script>
			$(document).ready(function() {
				$('#table_list').DataTable();
			});
		</script>
		
		<script>
			$('#table_list').DataTable({
				language: {	search: "", searchPlaceholder: "Buscar...",
							sLengthMenu: "Mostrar _MENU_"},
			});
		</script>

	</body>
	
</html>