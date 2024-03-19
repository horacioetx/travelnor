<?php

    /* user_profile.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

    /* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' Perfil de Usuario';	
	else	
		$title = 'Perfil de Usuario';

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
						<li class="breadcrumb-item">Perfil de Usuario</li>			
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">

                        <h5><strong>Perfil de Usuario</strong></h5>			
                        
                            <div class="row dash-row mt-4">	     
                                
                                <div class="col">	

                                    <div id="display">

                                        <?php include 'user_profile_disp.php'; ?>
                                        
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>		

				</main>
				
			</div>
			
		</div>		

		<!-- MODALS -->

        <!-- Edit modal -->
        
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
            <div class="modal-dialog" role="document">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar Tarifa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form id="form_edit_rate" method="post" action="admin" autocomplete="off">	
                    
                        <div class="modal-body">	

                            <div class="form-row">								
                                <div class="col">
                                    <label for="e_program_rate_catego" class="col-form-label">Categoria : </label>
                                    <select class="custom-select mr-sm-2" id="e_program_rate_catego" name="e_program_rate_catego">
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

                            <div class="form-row">								
                                <div class="col">
                                    <label for="e_program_rates_rate" class="col-form-label">Tarifa :</label>
                                    <input type="number" id="e_program_rates_rate" name="e_program_rates_rate" step="0.01" class="form-control" value="0">
                                </div>
                            </div>	
                            
                            <div class="form-row">
                                <div class="col">
                                    <label for="e_program_rates_feature" class="col-form-label">Destacado :</label>
                                    <select class="custom-select mr-sm-2" id="e_program_rates_feature" name="e_program_rates_feature">
                                        <option value="0" class="text-danger">Tarifa NO Destacada</option>
                                        <option value="1" class="text-success">Tarifa Destacada</option>
                                    </select>
                                </div>
                            </div>							
                            
                            <div class="form-row">								
                                <div class="col">
                                    <label for="e_program_rates_note" class="col-form-label">Notas :</label>
                                    <textarea class="form-control" id="e_program_rates_note" name="e_program_rates_note" rows="5"></textarea>
                                </div>
                            </div>	
                            
                            <div class="modal-footer">
                            
                                <input type="hidden" id="e_program_rates_id" name="e_program_rates_id" value="">
                                <input type="hidden" id="e_program_rates_program" name="e_program_rates_program" value="">
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
		
		<!-- populate edit form -->
		
		<script>		
			$(document).ready(function(){ 				
				$(document).on('click', '.edit_data', function(){  
					var rate_id = $(this).attr("id");  
					$.ajax({  
						url:"fetch_rate.php",  
						method:"POST",  
						data:{rate_id:rate_id},  
						dataType:"json",  
						success:function(data){  
							$('#e_program_rate_catego').val(data.program_rate_catego);  
							$('#e_program_rates_rate').val(data.program_rates_rate);  
							$('#e_program_rates_feature').val(data.program_rates_feature);  
							$('#e_program_rates_note').val(data.program_rates_note); 
							$('#e_program_rates_program').val(data.program_rates_program); 
							$('#e_program_rates_id').val(data.program_rates_id);  
							$('#edit_iti').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		 
		<!-- send edit form -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_rate']").submit(function(){
				$.ajax({
					url : 'admin_program_rate_edit.php',
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

    </body>
	
</html>