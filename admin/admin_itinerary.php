<?php

    /* admin_itinerary.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

    /* receive vars */
	
	$prog_id = $_REQUEST['progid'];
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT program_name, program_duration FROM dir_programs WHERE program_id = :program_id');	
	$stmt->execute(array(':program_id' => $prog_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* page title */
	
	if (isset($conrow['company_name']))	
        $title = $conrow['company_name'] . ' - ' . str_replace("<br />", " ", $rrows['program_name']);
    else	
        $title = str_replace("<br />", " ", $rrows['program_name']);

    $active_page = 2;

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
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		
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
						<li class="breadcrumb-item"><a href="admin_programs">Directorio de Viajes</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo str_replace('<br />', ' ', $rrows['program_name']); ?></li>						
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">

                        <div class="row">						
                            <div class="col">
                                <?php include("program_subnav.php"); ?>                                
                            </div>
                        </div>

                        <div class="row">						
                            <div class="col">

                                <div class="jumbotron jumbotron-fluid mt-4 py-2 border-top border-bottom bg-transparent">
                                    <div class="container ml-0 pl-0">
                                        <h2 class="text-dark">Programa : <span class="text-success"><?php echo str_replace("<br />", " ", $rrows['program_name']); ?></span></h2>
                                        <h5 class="text-dark">Duración : <span class="text-success"><?php echo $rrows['program_duration']; ?> días</span></h5>
                                    </div>
                                </div>
                                
                                <!-- action buttons -->

                                <button type="button" class="btn btn-success btn-sm mt-2" data-toggle="modal" data-target="#new_iti">Agregar Día a Itinerario</button>

                                <div id="table_itinerary">

                                    <?php include 'admin_itinerary_disp.php'; ?>
                                    
                                </div>

                            </div>
                        </div>

                    </div>		

				</main>
				
			</div>
			
		</div>		

		<!-- MODALS -->

        <!-- Add new day to itinerary -->
		
		<div class="modal fade" id="new_iti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Agregar día a Itinerario</h5>
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
                                <button type="submit" class="btn btn-primary btn-sm" id="editar" name="editar" value="add">Guardar</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar día en Itinerario</h5>
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
                                <button type="submit" class="btn btn-primary btn-sm" id="editar" name="editar" value="edit">Guardar</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        
                            </div>		

                        </div>	
                            
                    </form>						

                </div>
                
            </div>
            
        </div>

        <!-- js -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		
		<!-- custom js -->
		
		<script src="js/easion.js"></script>

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