<?php

    /* admin_generic_txt.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

    /* page title */
	
	if (isset($conrow['company_name']))	
        $title = $conrow['company_name'] . ' - ' . str_replace("<br />", " ", $rrows['program_name']);
    else	
        $title = str_replace("<br />", " ", $rrows['program_name']);

    $active_page = "GT1";

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
						<li class="breadcrumb-item aria-current="page"">Textos Genéricos</li>
					
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">

                        <h5><strong>Textos Genericos (TG)</strong></h5>		

                        <div class="row dash-row mt-4">						
                            <div class="col">

                                <div class="container-fluid border-top border-bottom pl-0 pt-3 pb-0 mb-4">
                                    <div class="alert alert-primary" role="alert"> Los textos genéricos (TG) aparecen en todos los programas de viaje activos al final de los textos particulares de cada uno de ellos en las secciones de Tarifas y Hoteles. </div>
                                </div>

                                <!-- display tabs -->

                                <ul class="nav nav-tabs mt-3" id="Tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active text-dark" id="home-tab" data-toggle="tab" href="#tarifas" role="tab" aria-controls="tarifas" aria-selected="true"><strong>TG Tarifas</strong></a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-dark" id="profile-tab" data-toggle="tab" href="#hoteles" role="tab" aria-controls="hoteles" aria-selected="false"><strong>TG Hoteles</strong></a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-dark" id="profile-tab" data-toggle="tab" href="#extensiones" role="tab" aria-controls="hoteles" aria-selected="false"><strong>TG Extensiones</strong></a>
                                    </li>
                                </ul>
                        
                                <div class="tab-content border p-3 bg-light" id="TabContent">

                                <button type="button" class="btn btn-success btn-sm mt-3" data-toggle="modal" data-target="#new">Agregar TG</button>
                                
                                    <!-- display GT in rates -->
                                
                                    <div class="tab-pane fade show active" id="tarifas" role="tabpanel" aria-labelledby="home-tab">

                                        <div id="table_rate">

                                            <?php include 'admin_generic_txt_rates.php'; ?>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- display GT in hotels -->
                                    
                                    <div class="tab-pane fade show" id="hoteles" role="tabpanel" aria-labelledby="home-tab">
                        
                                        <div id="table_hotel">

                                            <?php include 'admin_generic_txt_hotels.php'; ?>
                                            
                                        </div>
                                        
                                    </div>

                                    <!-- display GT in hotels -->
                                    
                                    <div class="tab-pane fade show" id="extensiones" role="tabpanel" aria-labelledby="home-tab">
                        
                                        <div id="table_extension">

                                            <?php include 'admin_generic_txt_extensions.php'; ?>
                                            
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

        <!-- Add new GT -->
		
		<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
            <div class="modal-dialog" role="document">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Agregar Texto Genérico</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form id="form_add" method="post" action="admin">	
                    
                        <div class="modal-body">								

                            <div class="form-row">								
                                <div class="col">
                                    <label for="gt_txt" class="col-form-label">Texto :</label>
                                    <textarea class="form-control" id="gt_txt" name="gt_txt" rows="5"></textarea>
                                </div>
                            </div>	
                            
                            <div class="form-row">
                                <div class="col">
                                    <label for="gt_section" class="col-form-label">Sección :</label>
                                    <select class="custom-select mr-sm-2" id="gt_section" name="gt_section">
                                        <option value="0" >Tarifas</option>
                                        <option value="1" >Hoteles</option>
                                        <option value="2" >Extensión</option>
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
        
        <!-- Edit GT in RATES -->
        
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
            <div class="modal-dialog" role="document">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar Texto Genérico</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form id="form_edit" method="post" autocomplete="off">	
                    
                        <div class="modal-body">	

                            <div class="form-row">								
                                <div class="col">
                                    <label for="e_gt_txt" class="col-form-label">Texto :</label>
                                    <textarea class="form-control" id="e_gt_txt" name="e_gt_txt" rows="5"></textarea>
                                </div>
                            </div>	

                            <div class="modal-footer">
                            
                                <input type="hidden" id="e_gt_section" name="e_gt_section" value="">    
                                <input type="hidden" id="e_gt_id" name="e_gt_id" value="">
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

        <!-- sends form add -->
		
		<script>
			$(document).ready(function(){
			    $("form[id='form_add']").submit(function(){
                    var org = $("#gt_section").val();
                    $.ajax({
                        url : 'admin_generic_txt_add.php',
                        type : 'POST',
                        data : $(this).serialize(),
                        success : function(response){
                            if (org === "0") {
								$("#table_rate").html(response);														
							} else if (org === "1") {
								$("#table_hotel").html(response);	
							} else if (org === "2") {						
								$("#table_extension").html(response);									
							}
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
						url:"fetch_gt.php",  
						method:"POST",  
						data:{id:id},  
						dataType:"json",  
						success:function(data){  
							$('#e_gt_section').val(data.gt_section);  
							$('#e_gt_txt').val(data.gt_txt);
                            $('#e_gt_id').val(data.gt_id);    
							$('#edit').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>		
		 
		<!-- send form_edit -->
		
		<script>
			$(document).ready(function(){
			    $("form[id='form_edit']").submit(function(){
                    var org = $("#e_gt_section").val();
                    $.ajax({
                        url : 'admin_generic_txt_edit.php',
                        type : 'POST',
                        data : $(this).serialize(),
                        success : function(response){
                            if (org === "0") {
								$("#table_rate").html(response);														
							} else if (org === "1") {
								$("#table_hotel").html(response);	
							} else if (org === "2") {						
								$("#table_extension").html(response);									
							}	
                            $('#edit').modal('hide');  
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
										if (roworg === "gentxt_rate") {									
											$("#table_rate").html(response);	
										} else if (roworg === "gentxt_hotel") {										
											$("#table_hotel").html(response);	
										} else if (roworg === "gentxt_extension"){
                                            $("#table_extension").html(response);
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