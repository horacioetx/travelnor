<?php
	
	/* home.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' - Dashboard';	
	else
		$title = "Dashboard";

	/* set initial values for dashboard */

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
		<title><?php echo $title; ?></title>
		
		<!-- favicon -->
		


		<!-- fonts -->
		
		<link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

		<!--  jqvmap -->

		<link href="css/jqvmap.css" media="screen" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/jquery.vmap.js"></script>
		<script type="text/javascript" src="js/maps/jquery.vmap.world.js" charset="utf-8"></script>		
		
		<!-- Custom CSS -->

		<link href="css/easion.css" rel="stylesheet" type="text/css">	
		
		<!-- js -->
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>		
		<script src="js/chart-js-config.js"></script>
		
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
				
				<!-- main content -->				
				
				<main class="dash-content">
					<div class="container-fluid">
					
						<!-- top widgets -->

						<div id="topwidgets"><?php include ("home_top_widgets.php"); ?></div>				
						
						<div class="row">   
						
							<!-- other widgets -->
							
							<div class="col-md-6">

								<div id="todolist"><?php include ("todolist.php"); ?></div>
								
							</div>
						
							<!-- graphs -->
						
							<div class="col-xl-6">
								<div class="card easion-card">
									<div class="card-header">
										<div class="easion-card-icon">
											<i class="fas fa-chart-bar"></i>
										</div>
										<div class="easion-card-title"> Bar Chart </div>
										<div class="easion-card-menu">
											<div class="dropdown show">
												<a class="easion-card-menu-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												</a>
												<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
													<a class="dropdown-item" href="#">Action</a>
													<a class="dropdown-item" href="#">Another action</a>
													<a class="dropdown-item" href="#">Something else here</a>
												</div>
											</div>
										</div>
									</div>
									<div class="card-body easion-card-body-chart">
										<canvas id="easionChartjsBar"></canvas>
										<script>
											var ctx = document.getElementById("easionChartjsBar").getContext('2d');
											var myChart = new Chart(ctx, {
												type: 'bar',
												data: {
													labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
													datasets: [{
														label: 'Blue',
														data: [12, 19, 3, 5, 2],
														backgroundColor: window.chartColors.primary,
														borderColor: 'transparent'
													}]
												},
												options: {
													legend: {
														display: false
													},
													scales: {
														yAxes: [{
															ticks: {
																beginAtZero: true
															}
														}]
													}
												}
											});
										</script>
									</div>
								</div>
							</div>

						</div>

						<!-- map -->

						<div class="row">   

							<div class="col">

								<div class="card easion-card">
									<div class="card-header">
										<div class="easion-card-icon"><i class="fas fa-map-marker-alt"></i></div>
										<div class="easion-card-title"> ¿Donde hay pasajeros hoy? </div>
										<div class="easion-card-menu">
											<div class="dropdown show">
												<a class="easion-card-menu-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
												<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
													<a class="dropdown-item" href="#">Opcion 1</a>
													<a class="dropdown-item" href="#">Opcion 1</a>
													<a class="dropdown-item" href="#">Opcion 1</a>
												</div>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div id="vmap" style="width: 75%; height: 400px; margin: 0 auto;"></div>
									</div>
								</div>

							</div>

						</div>

						
					</div>					
				</main>
				
			</div>
			
		</div>

		<!-- MODALS -->

        <!-- Add new GT -->
		
		<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
            <div class="modal-dialog" role="document">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-clipboard-list mr-3"></i>Agregar Tarea</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form id="form_add" method="post" action="admin">	
                    
                        <div class="modal-body">								

                            <div class="form-row">								
                                <div class="col">
                                    <label for="task" class="col-form-label">Tarea :</label>
                                    <input type="text" class="form-control" id="task" name="task">
                                </div>
                            </div>	
                            
                            <div class="form-row">
                                <div class="col">
                                    <label for="priority" class="col-form-label">Prioridad :</label>
                                    <select class="custom-select mr-sm-2" id="priority" name="priority">
                                        <option value="0" class="text-success">Baja</option>
                                        <option value="1" class="text-warning">Media</option>
                                        <option value="2" class="text-danger">Alta</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                            
                                <button type="submit" class="btn btn-primary btn-sm" id="editar" name="editar" value="add">Guardar</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        
                            </div>		

                        </div>	
                            
                    </form>						

                </div>
                
            </div>
            
        </div>	
		
		<!-- js -->		
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>

		<!-- custom js -->
		
		<script src="js/easion.js"></script>

		<!-- tooltips -->

		<script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
		</script>

		<!-- jqvmsap -->

		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#vmap').vectorMap(
				{ 
					map: 'world_en',
					backgroundColor: '#fff',
					borderColor: '#818181',
					borderOpacity: 0.25,
					borderWidth: 1,
					color: '#b3cce6',
					enableZoom: false,
					hoverColor: '#b3cce6',
					hoverOpacity: 0.7,
					normalizeFunction: 'polynomial',
					scaleColors: ['#C8EEFF', '#006491'],
					selectedColor: '#666666',
					selectedRegions: null,
					showTooltip: true,
					colors: {us: '#009933', es: '#009933', mx: '#009933', id: '#009933'},
					onRegionClick: function(element, code, region)
					{
						var message = 'You clicked "'
							+ region
							+ '" which has the code: '
							+ code.toUpperCase();

						alert(message);
					} 
				});
			});
		</script>

		<!-- sends form add task -->
		
		<script>
			$(document).ready(function(){
			    $("form[id='form_add']").submit(function(){
                    $.ajax({
                        url : 'todolist_add.php',
                        type : 'POST',
                        data : $(this).serialize(),
                        success : function(response){
                            $("#todolist").html(response);	
                            $('#new').modal('hide');  
                    }
                    });
                    //!This is important to stay the page without reload
                    return false;
			    });
			});		
		</script>

		<!-- mark task as completed -->
		
		<script>
			$(document).ready(function(){
			    $(document).on('click', '.task-done', function(e){
					e.preventDefault();
					var rowid = $(this).attr('data-row-id');
                    $.ajax({
                        url : 'todolist_edit.php',
                        type : 'POST',
                        data : {rowid:rowid},
                        success : function(response){
                            $("#todolist").html(response);	
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
				$(document).on('click', '.delete_item', function(e){
					e.preventDefault();
					var rowid = $(this).attr('data-row-id');
					var roworg = $(this).attr('data-org');	
					var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
					var parent = $("#"+rowid);					
					bootbox.dialog({
						message: "<div class='alert alert-danger text-center' role='alert'><strong>Estas seguro que quieres eliminar este item?</strong></div>",
						title: "<i class='fas fa-trash-alt text-danger'></i> Eliminar Item!",
						buttons: {
							success: {
								label: "No",
								className: "btn-success btn-sm",
								callback: function() {
									$('.bootbox').modal('hide');
								}
							},
							danger: {
								label: "Eliminar",
								className: "btn-danger btn-sm",
								callback: function() {
									$.ajax({
										type: 'POST',
										url: 'delete_records.php',
										data: dataString,
									})
									.done(function(response){						
										$("#todolist").html(response);							
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