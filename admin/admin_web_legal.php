<?php
	
	/* admin_web_legal.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' Configuración Información Legal';	
	else	
		$title = 'Configuración Información Legal';
		
	$active_page = "C3";

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

		<script src="https://cdn.tiny.cloud/1/3wxbeuzkbkhiwq34v4y0lluzdqfk9xd26zr2eot7szttae8e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        
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
						<li class="breadcrumb-item active" aria-current="page">Configuración Información Legal</li>
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">
						
						<?php include("admin_web_config_subnavbar.php"); ?>

						<div class="row mt-4">	

                            <div class="col">

                                <!-- display tabs -->

								<?php

									/* retrive tab titles if they exists */

									if (isset($conrow['web1_legal1_title']))
										$tab1 = $conrow['web1_legal1_title'];
									else
										$tab1 = "Legal 1";

									if (isset($conrow['web1_legal2_title']))
										$tab2 = $conrow['web1_legal2_title'];
									else
										$tab2 = "Legal 2";

									if (isset($conrow['web1_legal3_title']))
										$tab3 = $conrow['web1_legal3_title'];
									else
										$tab3 = "Legal 3";

									if (isset($conrow['web1_legal4_title']))
										$tab4 = $conrow['web1_legal4_title'];
									else
										$tab4 = "Legal 4";

									if (isset($conrow['web1_legal5_title']))
										$tab5 = $conrow['web1_legal5_title'];
									else
										$tab5 = "Legal 5";

								?>

                                <ul class="nav nav-tabs mt-3" id="Tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active text-dark" id="tab1" data-toggle="tab" href="#legal1" role="tab" aria-controls="legal1" aria-selected="true"><strong><?php echo $tab1; ?></strong></a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-dark" id="tab2" data-toggle="tab" href="#legal2" role="tab" aria-controls="legal2" aria-selected="false"><strong><?php echo $tab2; ?></strong></a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-dark" id="tab3" data-toggle="tab" href="#legal3" role="tab" aria-controls="legal3" aria-selected="false"><strong><?php echo $tab3; ?></strong></a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-dark" id="tab4" data-toggle="tab" href="#legal4" role="tab" aria-controls="legal4" aria-selected="false"><strong><?php echo $tab4; ?></strong></a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-dark" id="tab5" data-toggle="tab" href="#legal5" role="tab" aria-controls="legal5" aria-selected="false"><strong><?php echo $tab5; ?></strong></a>
                                    </li>         
                                </ul>

                                <div class="tab-content border p-3 bg-light" id="TabContent">
                                    
                                    <!-- display LEGAL 1 -->
                                
                                    <div class="tab-pane fade show active" id="legal1" role="tabpanel" aria-labelledby="tab1">  

										<?php $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt1" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>'; ?>
										<h5 class="mt-2 mb-4"><strong><?php echo $conrow['web1_legal1_title']; ?></strong><?php echo $edit; ?></h5>  
                                        <div class="alert alert-warning " role="alert"><?php echo $conrow['web1_legal1']; ?></div>                                         

                                    </div>
                                    
                                    <!-- display LEGAL 2 -->
                                    
                                    <div class="tab-pane fade show" id="legal2" role="tabpanel" aria-labelledby="tab2">
                        
										<?php $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt2" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>'; ?>
										<h5 class="mt-2 mb-4"><strong><?php echo $conrow['web1_legal2_title']; ?></strong><?php echo $edit; ?></h5> 
										<div class="alert alert-warning " role="alert"><?php echo $conrow['web1_legal2']; ?></div> 

                                    </div>

                                    <!-- display LEGAL 3 -->
                                    
                                    <div class="tab-pane fade show" id="legal3" role="tabpanel" aria-labelledby="tab3">
                        
										<?php $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt3" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>'; ?>
										<h5 class="mt-2 mb-4"><strong><?php echo $conrow['web1_legal3_title']; ?></strong><?php echo $edit; ?></h5> 
										<div class="alert alert-warning " role="alert"><?php echo $conrow['web1_legal3']; ?></div> 

                                    </div>

                                    <!-- display LEGAL 3 -->
                                    
                                    <div class="tab-pane fade show" id="legal4" role="tabpanel" aria-labelledby="tab4">
                        
										<?php $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt4" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>'; ?>
										<h5 class="mt-2 mb-4"><strong><?php echo $conrow['web1_legal4_title']; ?></strong><?php echo $edit; ?></h5> 
										<div class="alert alert-warning " role="alert"><?php echo $conrow['web1_legal4']; ?></div> 

                                    </div>

                                    <!-- display LEGAL 3 -->
                                    
                                    <div class="tab-pane fade show" id="legal5" role="tabpanel" aria-labelledby="tab5">
                        
										<?php $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt5" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>'; ?>
										<h5 class="mt-2 mb-4"><strong><?php echo $conrow['web1_legal5_title']; ?></strong><?php echo $edit; ?></h5> 
										<div class="alert alert-warning " role="alert"><?php echo $conrow['web1_legal5']; ?></div> 

                                    </div>
                                    
                                </div>

                            </div>

                        </div>

					</div>	
					
				</main>
				
			</div>
			
		</div>

		<!-- MODALS -->

		 <!-- modal to edit legals -->
		
		 <div class="modal fade" id="edit_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog modal-lg" role="document">			
				<div class="modal-content">	

					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar Avisos Legales</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>	
								
					<form id="form_edit" method="post" autocomplete="off">						
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="legal_title" class="col-form-label">Título Aviso :</label>
									<input type="text" id="legal_title" name="legal_title" class="form-control" value="">
								</div>
							</div>	

                            <div class="form-row mt-3">								
								<div class="col">
                                    <label for="legal_txt" class="col-form-label">Texto Aviso :</label>
                                    <textarea class="form-control" id="legal_txt" name="legal_txt" rows="5"></textarea>
                                </div>
                            </div>

							<div class="modal-footer mt-4">	
								<input type="hidden" id="legal_id" name="legal_id" value="">
								<button type="submit" class="btn btn-primary btn-sm" id="editar0" name="editar0" value="edit">Guardar</button>
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

		<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
		
		<!-- custom js -->
		
		<script src="js/easion.js"></script>

		<!-- txt editor -->

		<script>
            tinymce.init({
				skin: 'oxide-dark',
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak table',                
				table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
                height : "400",
				font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Quattrocento Sans=Quattrocento Sans,sans-serif; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
			});
        </script>

		<!-- Edit info -->

		<script>		
			$(document).ready(function(){  
				$('#edit1').click(function() {
					$('#edit1').val("Editar");
					$('#form_edit')[0].reset();
				});
				$(document).on('click', '.edit_data', function(){  
					var subid = $(this).attr("subid");  
					$.ajax({  
						url:"fetch_legal.php",  
						method:"POST",  
						data:{subid:subid},  
						dataType:"json",  
						success:function(data){  
							$('#legal_title').val(data.lgl_title); 
							tinyMCE.activeEditor.setContent(data.lgl_txt);
							$('#legal_id').val(subid); 
							$('#edit_general').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>

		<!-- send edit form -->
		
		<script>		
			$(document).ready(function(){
				$("form[id='form_edit']").submit(function(){
					var subid = $("#legal_id").val();  
					$.ajax({
						url : 'admin_web_legal_ed.php',
						type : 'POST',
						data : $(this).serialize(),
						 
						success : function(response){	
							if (subid === "lgtxt1") {
								$("#legal1").html(response);														
							} else if (subid === "lgtxt2") {
								$("#legal2").html(response);	
							} else if (subid === "lgtxt3") {
								$("#legal3").html(response);	
							} else if (subid === "lgtxt4") {
								$("#legal4").html(response);	
							} else if (subid === "lgtxt5") {
								$("#legal5").html(response);	
							}	
							$('#edit_general').modal('hide');	
						}
					});
					return false;
				});
			});			
		</script>

    </body>	

</html>