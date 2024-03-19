<?php

    /* admin_program_includes.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

    /* receive vars */
	
	$prog_id = $_REQUEST['progid'];
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT program_name FROM dir_programs WHERE program_id = :program_id');	
	$stmt->execute(array(':program_id' => $prog_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

    /* page title */
	
	if (isset($conrow['company_name']))	
        $title = $conrow['company_name'] . ' - ' . str_replace("<br />", " ", $rrows['program_name']);
    else	
        $title = str_replace("<br />", " ", $rrows['program_name']);

    $active_page = 5;

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
                                    </div>
                                </div>
                                
                                <!-- display tabs -->

                                <ul class="nav nav-tabs mt-3" id="Tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active text-dark" id="home-tab" data-toggle="tab" href="#inclusions" role="tab" aria-controls="inclusions" aria-selected="true"><strong>Inclusiones</strong></a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-dark" id="profile-tab" data-toggle="tab" href="#exclusions" role="tab" aria-controls="exclusions" aria-selected="false"><strong>Exclusiones</strong></a>
                                    </li>
                                </ul>
                        
                                <div class="tab-content border p-3 bg-light" id="TabContent">
                                
                                    <!-- display INCLUSIONS -->
                                
                                    <div class="tab-pane fade show active" id="inclusions" role="tabpanel" aria-labelledby="home-tab">
                        
                                        <!-- action buttons and total members -->

                                        <button type="button" class="btn btn-success btn-sm mt-3" data-toggle="modal" data-target="#new">Agregar Inclusión</button>

                                        <div id="table_rate">

                                            <?php include 'admin_program_includes_disp.php'; ?>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- display ESCLUSIONS -->
                                    
                                    <div class="tab-pane fade show" id="exclusions" role="tabpanel" aria-labelledby="home-tab">
                        
                                        <!-- action buttons and total members -->

                                        <button type="button" class="btn btn-success btn-sm mt-3" data-toggle="modal" data-target="#new2">Agregar Exclusión</button>

                                        <div id="table_rate2">

                                            <?php include 'admin_program_notincludes_disp.php'; ?>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>

                            </div>
                        </div>

                    </div>		

				</main>
				
			</div>
			
		</div>		

		<!-- MODALS -->

        <!-- Add new INCLUSION -->
		
		<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
            <div class="modal-dialog" role="document">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Agregar Inclusión</h5>
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
                                <button type="submit" class="btn btn-primary btn-sm" id="editar" name="editar" value="add">Guardar</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar Inclusión</h5>
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
                                <button type="submit" class="btn btn-primary btn-sm" id="editar" name="editar" value="edit">Guardar</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Agregar Exclusión</h5>
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
                                <button type="submit" class="btn btn-primary btn-sm" id="editar" name="editar" value="add">Guardar</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar Inclusión</h5>
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
                                <button type="submit" class="btn btn-primary btn-sm" id="editar2" name="editar2" value="edit">Guardar</button>
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