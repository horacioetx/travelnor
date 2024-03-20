<?php
	
	/* admin_web_tickers.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' Configuración General Website';	
	else	
		$title = 'Configuración Notificaciones/Avisos';
		
	$active_page = "C2";

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
						<li class="breadcrumb-item active" aria-current="page">Configuración Notificaciones/Avisos</li>
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">
						
						<?php include("admin_web_config_subnavbar.php"); ?>

						<div class="row mt-4">	
						
							<div class="col-12">
						
								<div class="card easion-card">
								
									<div class="card-header d-flex justify-content-between align-items-center">
										<div class="easion-card-title"> Cintillo de Notificaciones/Alertas </div>
										<button type="button" name="edit0" id="edit0" value="Edit" class="btn btn-info btn-sm edit_data0 float-right"><i class="fas fa-pencil-alt"></i></button>
									</div>
									
									<div class="card-body">	

										<div class="row">

                                            <div class="col-12 col-md-2 text-right">
                                                <p class="card-title">Status :</p>
                                            </div>
                                                											
                                            <?php

                                                /* define ticker status */

                                                if ($conrow['ticker_active'] == 0)
                                                    $status = '<span class="text-danger"><strong>Inactivo</strong></span>';
                                                else
                                                    $status = '<span class="text-success"><strong>Activo</strong></sapn>';

                                            ?>

                                            <div class="col-12 col-md-10">
												<p class="card-title"><span class="text-info"><?php echo $status; ?></span></p>                                            
                                            </div>

                                        </div>

                                        <div class="row mt-3">
											<div class="col-12 col-md-2 text-right">
												<p class="card-title">Mensaje Vínculo :</p>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <div class="alert alert-warning" role="alert"><?php echo $conrow['ticker_txt']; ?></div>
											</div>
										</div>

                                        <div class="row">
											<div class="col-12 col-md-2 text-right">
												<p class="card-title">Mensaje Principal :</p>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <div class="alert alert-secondary " role="alert"><?php echo $conrow['ticker_txt_main']; ?></div>
											</div>
										</div>

                                        <div class="row">

                                            <div class="col-12 col-md-2 text-right">
												<p class="card-title">Imágen :</p>
                                            </div>

											<div class="col-12 col-md-6">

                                                <?php 

                                                    /* display thumb image */
                                
                                                    if ($conrow['ticker_img'] == "") {
				
                                                        echo '<div class="card easion-card">';
                                                            echo '<div class="card-header d-flex justify-content-between align-items-center">';
                                                                echo '<div><strong>Imagen Cintillo</strong></div>';
                                                                echo '<div><a href="#" class="btn btn-info btn-sm float-right mt-1 mt-1" data-val="thumb" data-toggle="modal" data-target="#imgupload"><i class="fas fa-upload"></i></a></div>';
                                                            echo '</div>';
                                                            echo '<div class="card-body align-items-center d-flex justify-content-center">';
                                                                echo '<span><i class="fas fa-camera fa-5x text-secondary"></i></span>';
                                                            echo '</div>';
                                                        echo '</div>';	
                                                        
                                                    } else {
					
                                                        echo '<div class="card easion-card">';			
                                                            echo '<div class="card-header d-flex justify-content-between align-items-center">';
                                                                echo '<div><strong>Imagen Cintillo</strong></div>';
                                                                echo '<div><a data-org="ticker" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right mt-1"><i class="fas fa-trash-alt"></i></a></div>';
                                                            echo '</div>';
                                                            echo '<div class="card-body">';	
                                                                echo '<img src="../images/ticker/' . $conrow['ticker_img'] . '" class="img-fluid rounded mx-auto d-block" alt="' . $conrow['ticker_img'] . '">';	
                                                            echo '</div>';	
                                                        echo '</div>';	

                                                    }

                                                ?>

                                            </div>
										</div>

									</div>
									
								</div>
							
							</div>
						
						</div>	

                        <!-- cookies notification -->

                        <div class="row">	
						
							<div class="col-12">
						
								<div class="card easion-card">
								
									<div class="card-header d-flex justify-content-between align-items-center">
										<div class="easion-card-title"> Alerta de Cookies </div>
										<button type="button" name="edit1" id="edit1" value="Edit" class="btn btn-info btn-sm edit_data1 float-right"><i class="fas fa-pencil-alt"></i></button>
									</div>
									
									<div class="card-body">

                                        <div class="row">

                                            <div class="col-12 col-md-2 text-right">
                                                <p class="card-title">Aviso sobre Cookies :</p>
                                            </div>

                                            <div class="col-12 col-md-10">
                                                <div class="alert alert-secondary " role="alert"><?php echo $conrow['cookies_txt']; ?></div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-12 col-md-2 text-right">
                                                <p class="card-title">Vínculo de Políticas de Cookies :</p>
                                            </div>

                                            <div class="col-12 col-md-10">
                                                <div class="alert alert-secondary " role="alert"><?php echo $conrow['cookies_link']; ?></div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-12 col-md-2 text-right">
                                                <p class="card-title">Texto en Botón de Aceptación :</p>
                                            </div>

                                            <div class="col-12 col-md-10">
                                                <div class="alert alert-secondary " role="alert"><?php echo $conrow['cookies_button_txt']; ?></div>
                                            </div>

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

        <!-- modal to edit ticker -->
		
		<div class="modal fade" id="edit_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog modal-lg" role="document">			
				<div class="modal-content">	

					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar Cintillo de Notificaciones</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>	
								
					<form id="form_edit" method="post" autocomplete="off">						
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="ticker_txt" class="col-form-label">Mensaje Vínculo :</label>
									<input type="text" id="ticker_txt" name="ticker_txt" class="form-control" value="<?php echo $conrow['ticker_txt']; ?>">
								</div>
							</div>	

                            <div class="form-row mt-3">								
								<div class="col">
                                    <label for="ticker_txt_main" class="col-form-label">Mensaje Principal :</label>
                                    <textarea class="form-control" id="ticker_txt_main" name="ticker_txt_main" rows="5"><?php echo $conrow['ticker_txt_main']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-row mt-3">	
                                <div class="col">
                                    <label for="ticker_active" class="col-form-label mt-1">Status : </label>
                                    <select class="custom-select mr-sm-2" id="ticker_active" name="ticker_active" >
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                    </select>
                                </div>
                            </div>

							<div class="modal-footer mt-4">		
								<button type="submit" class="btn btn-primary btn-sm" id="editar0" name="editar0" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>						
							</div>

						</div>								
					</form>	

				</div>				
			</div>			
		</div>

        <!-- modal to upload images for carrusel & thumb -->		
		
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
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-upload mr-3"></i>Subir Imagens</h5>
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
								<input type="hidden" id="target_id" name="target_id" value="ticker">
							</div>
						</div>
					</div>
						
					</div>	
				</div>				
			</div>			
		</div>

        <!-- modal to edit cookies notice -->
		
		<div class="modal fade" id="edit_cookies" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog modal-lg" role="document">			
				<div class="modal-content">	

					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar Aviso de Cookies</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>	
								
					<form id="form_edit_cookies" method="post" autocomplete="off">						
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="cookies_txt" class="col-form-label">Aviso de Cookies :</label>
									<input type="text" id="cookies_txt" name="cookies_txt" class="form-control" value="<?php echo $conrow['cookies_txt']; ?>">
								</div>
							</div>

                            <div class="form-row mt-3">								
								<div class="col">
									<label for="cookies_link" class="col-form-label">Vínculo de Políticas de Cookies :</label>
									<input type="text" id="cookies_link" name="cookies_link" class="form-control" value="<?php echo $conrow['cookies_link']; ?>">
								</div>
							</div>

                            <div class="form-row mt-3">								
								<div class="col">
									<label for="cookies_button_txt" class="col-form-label">Texto en Botón de Aceptación :</label>
									<input type="text" id="cookies_button_txt" name="cookies_button_txt" class="form-control" value="<?php echo $conrow['cookies_button_txt']; ?>">
								</div>
							</div>

							<div class="modal-footer mt-4">		
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
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
                height : "400"
            });
        </script>

		<!-- Edit info -->

		<script>		
			$(document).ready(function(){  
				$('#edit0').click(function() {
					$('#edit0').val("Editar");
					$('#form_edit')[0].reset();
				});
				$(document).on('click', '.edit_data0', function(){  
					$.ajax({  
						url:"fetch_config.php",  
						method:"POST",  
						dataType:"json",  
						success:function(data){  
							$('#ticker_active').val(data.ticker_active);							
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
					$.ajax({
						url : 'admin_web_tickers_ed.php',
						type : 'POST',
						data : $(this).serialize(),
						dataType:"json",  
						success : function(data){	
							if (data.msgstat === 1) {
								$("#e_errmsg").html(data.msg);														
							} else {
								window.location='admin_web_tickers.php' 								
							}	
						}
					});
					return false;
				});
			});			
		</script>

        <!-- Edit cookies info -->

		<script>		
			$(document).ready(function(){  
				$('#edit1').click(function() {
					$('#edit1').val("Editar");
					$('#form_edit_cookies')[0].reset();
				});
				$(document).on('click', '.edit_data1', function(){  
					$.ajax({  
						url:"fetch_config.php",  
						method:"POST",  
						dataType:"json",  
						success:function(data){  
							$('#edit_cookies').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>

		<!-- send edit form -->
		
		<script>		
			$(document).ready(function(){
				$("form[id='form_edit_cookies']").submit(function(){
					$.ajax({
						url : 'admin_web_cookies_ed.php',
						type : 'POST',
						data : $(this).serialize(),
						dataType:"json",  
						success : function(data){	
							if (data.msgstat === 1) {
								$("#e_errmsg").html(data.msg);														
							} else {
								window.location='admin_web_tickers.php' 								
							}	
						}
					});
					return false;
				});
			});			
		</script>
        
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
					var target_id = $("#target_id").val();
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
							window.location='admin_web_tickers.php' 	
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
                    var roworg = $(this).attr('data-org');
                    var dataString = 'roworg=' + roworg;				
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
                                        window.location='admin_web_tickers.php';				
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