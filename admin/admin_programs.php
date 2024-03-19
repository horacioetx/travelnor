<?php
	
	/* admin_programs.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' - Directorio de Viajes';	
	else	
		$title = 'Directorio de Viajes';

?>

<!doctype html>
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

		<!-- Custom CSS -->
		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">		
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
						<li class="breadcrumb-item active" aria-current="page">Directorio de Viajes</li>
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">
					
						<h5><strong>Directorio de Viajes</strong></h5>			
						
						<div class="row dash-row mt-4">							
					
							<div class="col">								
					
								<div class="container-fluid border-top border-bottom pl-0 py-3 mb-4">
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_item">Agregar Nuevo Programa</button>	
								</div>
												
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
                                            
                                            $view = '<td style="text-align:center; width:120px;"><form method="post" action="admin_program_view"><button type="submit" name="additi" value="Ver" class="btn btn-success btn-sm delete_data"><i class="fas fa-search-plus"></i></button><input type="hidden" name="progid" value="' . $rrows['program_id'] . '"></form></td>';
                                            
                                            $output .= '<tr>';
                                                $output .= '<td><strong>' . str_replace("<br />", " ", $rrows['program_name']) . '</strong></td><td style="text-align: center;">' . $rrows['program_code'] . '</td><td style="text-align: center;">' . $disp_status . '</td>' . $view;
                                            $output .= '</tr>';

                                        }                                        
             
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
							
						</div>

					</div>	
					
				</main>
				
			</div>
			
		</div>
		
		<!-- MODALS -->
		
		<!-- Add new program modal -->
		
		<div class="modal fade" id="new_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-map-marked-alt mr-3"></i>Agregar Programa</h5>
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
							
								<button type="submit" class="btn btn-primary btn-sm" id="editar" name="editar" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>

		<!-- js -->

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		
		<!-- custom js -->
		
		<script src="js/easion.js"></script>
		
		<!-- datatables -->		
		
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>	

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
		
        <!-- send form_new form -->
		
		<script>		
			$(document).ready(function(){
				$("form[id='form_new_prog']").submit(function(){
					$.ajax({
						url : 'admin_programs_add.php',
						type : 'POST',
						data : $(this).serialize(),
						dataType:"json",  
						success : function(data){	
							if (data.stat === 1) {
								$("#errmsg").html(data.msg);														
							} else {
								window.location='admin_program_view.php?progid=' + data.lastid + '&msg=' + data.msg 								
							}	
						}
					});
					return false;
				});
			});			
		</script>	
		
	</body>	

</html>