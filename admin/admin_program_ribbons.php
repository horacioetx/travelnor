<?php

    /* admin_program_ribbons.php */

    /* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* define page title */
	
	$title = "Directorio de Sellos";

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
                        <li class="breadcrumb-item active" aria-current="page">Directorio de Sellos</li>
                    </ol>
                </nav>		

                <!-- main content -->	

                <main class="dash-content">
                    
                    <div class="container-fluid">
                    
                        <h5><strong>Directorio de Sellos</strong></h5>			
                        
                        <div class="row dash-row mt-4">							
                    
                            <div class="col">								
                    
                                <div class="container-fluid border-top border-bottom pl-0 py-3 mb-4">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#imgupload">Agregar Sello</button>
                                </div>

                                <div id="disp_ribbons">
                    
                                    <?php include ("admin_program_ribbons_disp.php"); ?>		

                                </div>

                            </div>

                        </div>	

                    </div>

                </main>

            </div>

            <!-- MODALS -->
		
            <!-- modal to upload ribbon images -->		
            
            <style>
                #drop_file_zone {
                    background-color: #EEE; 
                    border: #999 5px dashed;
                    width: 100%; 
                    height: auto;
                    padding: 8px;
                    font-size: 16px;
                }
                #drag_upload_file {
                width:50%;
                margin:0 auto;
                }
                #drag_upload_file p {
                text-align: center;
                }
                #drag_upload_file #selectfile {
                display: none;
                }
            </style>
            
            <div class="modal fade" id="imgupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
                <div class="modal-dialog" role="document">			
                    <div class="modal-content">				
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-upload mr-3"></i>Subir Imágenes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>					
                        <div class="modal-body">	
                            <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false" class="mt-4">
                                <div id="drag_upload_file">
                                    <p>Drop file here</p>
                                    <p>or</p>
                                    <p><input type="button" value="Select File" onclick="file_explorer()"></p>
                                    <input type="file" id="selectfile">
                                    <input type="hidden" id="target_id" name="target_id" value="ribbon">
                                </div>
                            </div>
                        </div>
                            
                        </div>	
                    </div>				
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

        <!-- upload images -->

		<script type="text/javascript">
			var fileobj;
			function upload_file(e) {
				e.preventDefault();
				fileobj = e.dataTransfer.files[0];
				ajax_file_upload(fileobj);
			}
			function file_explorer() {
				document.getElementById('selectfile').click();
				document.getElementById('selectfile').onchange = function() {
					fileobj = document.getElementById('selectfile').files[0];
					ajax_file_upload(fileobj);
				};
			}
			function ajax_file_upload(file_obj) {
				if(file_obj != undefined) {
					var target_id = 'ribbon';
					var form_data = new FormData();                  
					form_data.append('file', file_obj);
					form_data.append('target_id', target_id);
					$.ajax({
						type: 'POST',
						url: 'upload_web_images.php',
						contentType: false,
						processData: false,
						data: form_data,
						success:function(response) {	
							$("#disp_ribbons").html(response);
							$('#imgupload').modal('hide'); 
						}
					});
				}
			}
		</script>
		
		<!-- delete image function -->

		<script type="application/javascript">
			$(document).ready(function($){
				$(document).on('click', '.delete_image', function(e){
					e.preventDefault();
					var rowid = $(this).attr('data-row-id');
					var roworg = $(this).attr('data-org');
					var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
					bootbox.dialog({
						message: "<div class='alert alert-danger text-center' role='alert'><strong>Estas seguro que quieres eliminar esta imagen?</strong></div>",
						title: "<i class='fas fa-trash-alt text-danger'></i> Eliminar Imagen!",
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
										$("#disp_ribbons").html(response);										
										bootbox.alert('<div class="alert alert-success" role="alert">Imagen eliminada satisfactoriamente!</div>');										
									})
									.fail(function(){
										bootbox.alert('Error. No se pudo eliminar imagen');
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