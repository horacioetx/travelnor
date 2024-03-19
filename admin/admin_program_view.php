<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */
	
	$prog_id = $_REQUEST['progid'];
	
	/* retrieve config vars */
	
	$stmt_conf1 = $db->prepare('SELECT web1_path_img_ribbons, web1_path_img_thumb, web1_path_img_carrusel FROM config');	
	$stmt_conf1->execute();
	$row_conf1 = $stmt_conf1->fetch(PDO::FETCH_ASSOC);	
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT * FROM dir_programs WHERE program_id = :program_id');	
	$stmt->execute(array(':program_id' => $prog_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* format some vars */
	
	if ($rrows['program_status'] == 0)	
		$status = '<span class="text-success">Activo</span>';
	else
		$status = '<span class="text-danger">Inactivo</span>';
	
	if ($rrows['program_feature'] == 0)	
		$feature = '<span class="text-secondary">No Destacado</span>';
	else
		$feature = '<span class="text-success">Destacado</span>';
	
	$maxdays = 100;
	
	/* define page title */
	
	$title = str_replace("<br />", " ", $rrows['program_name']);
	$active_page = 1;

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
		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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

			<div class="col mb-5">
				 
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">	
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">								
							<li class="breadcrumb-item"><a href="home">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="admin_programs">Directorio de Programas</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
						</ol>
					</nav>							
				</div>
					
				<?php include("program_subnav.php"); ?>
		
				<div id="general_info">
				
					<?php include 'admin_program_general_info_disp.php'; ?>				
				
				</div>
					
				<!-- titles and subtitles -->			

				<div class="row mt-3">
					<div class="col-9">	
						<div class="card">
							<div class="card-header">Título<input type="button" name="edit3" id="edit3" value="Editar" class="btn btn-info btn-sm edit_data3 float-right"></div>
							<div class="card-body text-justify">
								<span id="subtitle"><?php echo $rrows['program_subtitle'];?></span>
							</div>
						</div>
					</div>
				</div>	
						
				<div class="row mt-3">	
					<div class="col-9">	
						<div class="card">
							<div class="card-header">Subtítulo<input type="button" name="edit4" id="edit4" value="Editar" class="btn btn-info btn-sm edit_data4 float-right"></div>
							<div class="card-body text-justify">
								<span id="subtitle2"><?php echo $rrows['program_subtitle2'];?></span>
							</div>
						</div>
					</div>
				</div>					
					
				<!-- Thumb image and highlighted texts -->
				
				<span id="thumbimg">
				
					<?php include 'admin_program_view_disp_thumb.php'; ?>	
				
				</span>

				<!-- Carrusel images -->

				<div id="cardis">
				
					<?php include 'admin_program_view_disp_imgcar.php'; ?>	
					
				</div>
	
				<!-- Maps -->
				
				<div id="mapdis">
				
					<?php include 'admin_program_view_disp_map.php'; ?>	
					
				</div>								

			</div>	
			
			<!-- footer -->	
					
			<?php include ("footer.php"); ?>	
				
		</div>
		
		<!-- MODALS -->
		
		<!-- modal to edit General Info -->
		
		<div class="modal fade" id="edit_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Información General</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_edit_general" method="post" autocomplete="off">						
						<div class="modal-body">						
							<div class="form-row">								
								<div class="col">
									<label for="e_program_name">Nombre del Programa :</label>
									<input type="text" id="e_program_name" name="e_program_name" class="form-control" value="">
								</div>
							</div>							
							<div class="form-row">								
								<div class="col mt-2">
									<label for="e_program_code">Código Interno :</label>
									<input type="text" id="e_program_code" name="e_program_code" class="form-control" value="">
								</div>
							</div>							
							<div class="form-row">								
								<div class="col">
									<label for="e_program_duration" class="col-form-label">Duración : </label>
									<select class="custom-select mr-sm-2" id="e_program_duration" name="e_program_duration" required>
										<?php
											for ($i=1; $i<=$maxdays; $i++) {
												echo '<option>' . $i . '</option>';
											}
										?>
									</select>
								</div>
							</div>		

							<div class="form-row">
								<div class="col">
									<label for="e_program_feature" class="col-form-label">Destacado :</label>
									<select class="custom-select mr-sm-2" id="e_program_feature" name="e_program_feature">
										<option value="0" class="text-success">No Destacado</option>
										<option value="1" class="text-danger">Desatacado en Home Page</option>
									</select>
								</div>
							</div>		

							<div class="form-row">
								<div class="col">
									<label for="e_program_order" class="col-form-label">Orden de Despliegue :</label>
									<select class="custom-select mr-sm-2" id="e_program_order" name="e_program_order">
										<?php
											for ($i=0; $i<=999; $i++) {
												echo '<option value="' . $i . '" class="text-success">' . $i . '</option>';
											}										
										?>
									</select>
								</div>
							</div>	

							
							<div class="form-row">
								<div class="col">
									<label for="e_program_status" class="col-form-label">Status :</label>
									<select class="custom-select mr-sm-2" id="e_program_status" name="e_program_status">
										<option value="0" class="text-success">Activo</option>
										<option value="1" class="text-danger">Inactivo</option>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="col">
									<label for="e_program_classif" class="col-form-label">Clasificación 1:</label>
									<select class="custom-select mr-sm-2" id="e_program_classif" name="e_program_classif">
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
									<label for="e_program_classif2" class="col-form-label">Clasificación 2:</label>
									<select class="custom-select mr-sm-2" id="e_program_classif2" name="e_program_classif2">
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
								<input type="hidden" id="e_program_id0" name="e_program_id0" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar0" name="editar0" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>
						</div>								
					</form>	
				</div>				
			</div>			
		</div>

		<!-- modal to edit Highlights -->
		
		<div class="modal fade" id="edit_high" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Highlights</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_edit_high" method="post" autocomplete="off">						
						<div class="modal-body">						
							<div class="form-row">								
								<div class="col">
									<label for="e_program_highlights">Highlights :</label>
									<textarea class="form-control" id="e_program_highlights" name="e_program_highlights" rows="5"></textarea>
								</div>
							</div>							
							<div class="modal-footer">							
								<input type="hidden" id="e_program_id" name="e_program_id" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar1" name="editar1" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>
						</div>								
					</form>	
				</div>				
			</div>			
		</div>
		
		<!-- modal to edit Intro -->
		
		<div class="modal fade" id="edit_intro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Introducción</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_edit_intro" method="post" autocomplete="off">						
						<div class="modal-body">						
							<div class="form-row">								
								<div class="col">
									<label for="e_program_intro">Introducción :</label>
									<textarea class="form-control" id="e_program_intro" name="e_program_intro" rows="5"></textarea>
								</div>
							</div>							
							<div class="modal-footer">							
								<input type="hidden" id="e_program_id2" name="e_program_id2" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar2" name="editar2" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>
						</div>								
					</form>	
				</div>				
			</div>			
		</div>
		
		<!-- modal to edit Subtitle 1 (title) -->
		
		<div class="modal fade" id="edit_subtitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Título</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_edit_subtitle" method="post" autocomplete="off">						
						<div class="modal-body">						
							<div class="form-row">								
								<div class="col">
									<label for="e_program_subtitle">Título :</label>
									<input type="text" id="e_program_subtitle" name="e_program_subtitle" class="form-control" value="">
								</div>
							</div>							
							<div class="modal-footer">							
								<input type="hidden" id="e_program_id3" name="e_program_id3" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar3" name="editar3" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>
						</div>								
					</form>	
				</div>				
			</div>			
		</div>
		
		<!-- modal to edit Subtitle 2 -->
		
		<div class="modal fade" id="edit_subtitle2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Subtítulo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_edit_subtitle2" method="post" autocomplete="off">						
						<div class="modal-body">						
							<div class="form-row">								
								<div class="col">
									<label for="e_program_subtitle2">Subítulo :</label>
									<input type="text" id="e_program_subtitle2" name="e_program_subtitle2" class="form-control" value="">
								</div>
							</div>							
							<div class="modal-footer">							
								<input type="hidden" id="e_program_id4" name="e_program_id4" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar4" name="editar4" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
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
						<h5 class="modal-title" id="exampleModalLabel">Subir Imágenes</h5>
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
								<input type="hidden" id="target_id" name="target_id" value="">
							</div>
						</div>
					</div>
						
					</div>	
				</div>				
			</div>			
		</div>
		
		<!-- modal to select ribbon in an image carusel -->
		
		<div class="modal fade" id="edit_ribbon" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Selección de Sello</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
	  
					<div class="modal-body">	
						<!-- Wrapper for slides -->
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">								
							
								<?php	

									echo '<div class="carousel-item active">';
										echo '<a data-prg-id="' . $prog_id . '" data-rib-id="0" href="javascript:void(0)" title="Sin cintillo" class="assig_ribbon"><img class="d-block w-100" src="' . $row_conf1['web1_path_img_ribbons'] . 'empty_ribbon.png" alt="Sin Cintillo">';
									echo '</div>';								
							
									$stmt_rib = $db->prepare('SELECT * FROM dir_ribbons');	
									$stmt_rib->execute();									
									
									while ($rowrib = $stmt_rib->fetch(PDO::FETCH_ASSOC)) {	
											
										echo '<div class="carousel-item">';
											echo '<a data-prg-id="' . $prog_id . '" data-rib-id="' . $rowrib['ribbon_id'] . '" href="javascript:void(0)" title="Elegir este cintillo" class="assig_ribbon"><img class="d-block w-100" src="' . $row_conf1['web1_path_img_ribbons'] . $rowrib['ribbon_file'] . '"></a>';
										echo '</div>';

									}								
								
								?>
								
							</div>
							
							<a class="carousel-control-prev mr-3" href="#carouselExampleControls" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"><</span>
								<span class="sr-only">Previous</span>
							</a>
							
							<a class="carousel-control-next ml-3" href="#carouselExampleControls" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true">></span>
								<span class="sr-only">Next</span>
							</a>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<!-- modal to edit carusel captions -->
		
		<div class="modal fade" id="edit_caption" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Pie de Imágen</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_edit_caption" method="post" autocomplete="off">						
						<div class="modal-body">						
							<div class="form-row">								
								<div class="col">
									<label for="program_banner_cap">Pie :</label>
									<input type="text" id="program_banner_cap" name="program_banner_cap" class="form-control" value="">
								</div>
							</div>							
							<div class="modal-footer">							
								<input type="hidden" id="program_cap" name="program_cap" value="<?php echo $prog_id; ?>">
								<input type="hidden" id="program_cap_id" name="program_cap_id" value="">
								<button type="submit" class="btn btn-primary" id="editar_cap" name="editar_cap" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>
						</div>								
					</form>	
				</div>				
			</div>			
		</div>

		<!-- jQuery, Popper.js, Bootstrap JS -->

		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>		
		
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

		<!-- update val for target_id according what button call the delete function -->
		
		<script>
			$('#imgupload').on('show.bs.modal', function (event) {
				var myVal = $(event.relatedTarget).data('val');
				$(this).find("#target_id").val(myVal);
			});
		</script>
		
		<!-- Edit General Info -->

		<script>		
			$(document).ready(function(){  
				$('#edit0').click(function() {
					$('#edit0').val("Editar");
					$('#form_edit_general')[0].reset();
				});
				$(document).on('click', '.edit_data0', function(){  
					var prg_id = <?php echo $prog_id; ?>;  
					$.ajax({  
						url:"fetch_0.php",  
						method:"POST",  
						data:{prg_id:prg_id},  
						dataType:"json",  
						success:function(data){  
							$('#e_program_name').val(data.program_name);  
							$('#e_program_code').val(data.program_code);  
							$('#e_program_duration').val(data.program_duration);  
							$('#e_program_feature').val(data.program_feature); 
							$('#e_program_order').val(data.program_order); 	
							$('#e_program_classif').val(data.program_classif); 
							$('#e_program_classif2').val(data.program_classif2); 							
							$('#e_program_status').val(data.program_status);  								
							$('#edit_general').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- Send General Info -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_general']").submit(function(){
				$.ajax({
					url : 'admin_program_ed_general_info.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#general_info").html(data);
						$('#edit_general').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>
		
		<!-- select ribbon -->
		
		<script>
			$(document).on('click', '.assig_ribbon', function(e){
				e.preventDefault();
				var prg_id = <?php echo $prog_id; ?>; 
				var rib_id = $(this).attr('data-rib-id');
				var form_data = new FormData();                  
				form_data.append('prg_id', prg_id);
				form_data.append('rib_id', rib_id);				
				$.ajax({  
					type: 'POST',
					url:"admin_program_select_ribbon.php",  
					contentType: false,
					processData: false,
					data: form_data,
					success:function(data){  
						$("#general_info").html(data);
						$('#edit_ribbon').modal('hide');  
					}  
				});  
			});			
		</script>

		<!-- Edit Highlights -->
		
		<script>		
			$(document).ready(function(){  
				$('#edit1').click(function() {
					$('#edit1').val("Editar");
					$('#form_edit_high')[0].reset();
				});
				$(document).on('click', '.edit_data1', function(){  
					var prg_id = <?php echo $prog_id; ?>;  
					$.ajax({  
						url:"fetch_2.php",  
						method:"POST",  
						data:{prg_id:prg_id},  
						dataType:"json",  
						success:function(data){  
							$('#e_program_highlights').val(data.program_highlights);  
							$('#edit_high').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- Send Edit Highlights -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_high']").submit(function(){
				$.ajax({
					url : 'admin_program_ed_highlights.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#highlights").html(data);
						$('#edit_high').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>
		
		<!-- Edit Intro -->
		
		<script>		
			$(document).ready(function(){  
				$('#edit2').click(function() {
					$('#edit2').val("Editar");
					$('#form_edit_intro')[0].reset();
				});
				$(document).on('click', '.edit_data2', function(){  
					var prg_id = <?php echo $prog_id; ?>;  
					$.ajax({  
						url:"fetch_3.php",  
						method:"POST",  
						data:{prg_id:prg_id},  
						dataType:"json",  
						success:function(data){  
							$('#e_program_intro').val(data.program_intro);  
							$('#edit_intro').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- Send Edit Intro -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_intro']").submit(function(){
				$.ajax({
					url : 'admin_program_ed_intro.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#intro").html(data);
						$('#edit_intro').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>
		
		<!-- Edit Subtitle 1 -->
		
		<script>		
			$(document).ready(function(){  
				$('#edit3').click(function() {
					$('#edit3').val("Editar");
					$('#form_edit_subtitle')[0].reset();
				});
				$(document).on('click', '.edit_data3', function(){  
					var prg_id = <?php echo $prog_id; ?>;  
					$.ajax({  
						url:"fetch_4.php",  
						method:"POST",  
						data:{prg_id:prg_id},  
						dataType:"json",  
						success:function(data){  
							$('#e_program_subtitle').val(data.program_subtitle);  
							$('#edit_subtitle').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- Send Edit Subtitle 1 -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_subtitle']").submit(function(){
				$.ajax({
					url : 'admin_program_ed_subtitle1.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#subtitle").html(data);
						$('#edit_subtitle').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>

		<!-- Edit Subtitle 2 -->
		
		<script>		
			$(document).ready(function(){  
				$('#edit4').click(function() {
					$('#edit4').val("Editar");
					$('#form_edit_subtitle2')[0].reset();
				});
				$(document).on('click', '.edit_data4', function(){  
					var prg_id = <?php echo $prog_id; ?>;  
					$.ajax({  
						url:"fetch_5.php",  
						method:"POST",  
						data:{prg_id:prg_id},  
						dataType:"json",  
						success:function(data){  
							$('#e_program_subtitle2').val(data.program_subtitle2);  
							$('#edit_subtitle2').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- Send Edit Subtitle 2 -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_subtitle2']").submit(function(){
				$.ajax({
					url : 'admin_program_ed_subtitle2.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#subtitle2").html(data);
						$('#edit_subtitle2').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
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
					var program_id = <?php echo $prog_id; ?>;
					var form_data = new FormData();                  
					form_data.append('file', file_obj);
					form_data.append('program_id', program_id);
					form_data.append('target_id', target_id);
					$.ajax({
						type: 'POST',
						url: 'upload_web_images.php',
						contentType: false,
						processData: false,
						data: form_data,
						success:function(response) {	
							if (target_id === "thumb") {
								$("#thumbimg").html(response);														
							} else if (target_id === "map") {
								$("#mapdis").html(response);	
							} else {						
								$("#cardis").html(response);									
							}	
							$('#imgupload').modal('hide'); 
						}
					});
				}
			}
		</script>
		
		<!-- Edit carusel CAPTIONS -->
		
		<script>		
			$(document).ready(function(){  
				$('#caped').click(function() {
					$('#caped').val("Editar");
					$('#form_edit_caption')[0].reset();
				});
				$(document).on('click', '.edit_data_caption', function(){  
					var capid = $(this).attr("capid");
					var prog_id = <?php echo $prog_id; ?>;
					$.ajax({  
						type: 'POST',
						url:"fetch_capt.php",  
						data: "capid=" + capid + "&prog_id=" + prog_id,  
						success:function(data){ 
							$('#program_cap_id').val(capid); 
							$('#program_banner_cap').val(data); 
							$('#edit_caption').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- Send form for carusel CAPTIONS -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_caption']").submit(function(){
				$.ajax({
					url : 'admin_program_ed_captions.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#cardis").html(data);
						$('#edit_caption').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>

		<!-- delete image function -->

		<script type="application/javascript">
			$(document).ready(function($){
				$(document).on('click', '.delete_image', function(e){
					e.preventDefault();
					var rowid = $(this).attr('data-row-id');
					var rowprg = <?php echo $prog_id; ?>;
					var roworg = $(this).attr('data-org');
					var dataString = 'rowid=' + rowid + '&roworg=' + roworg + '&rowprg=' + rowprg;					
					var parent = $("#"+rowid);					
					bootbox.dialog({
						message: "<div class='alert alert-danger' role='alert'>Estas seguro que quieres eliminar esta imagen?</div>",
						title: "<i class='fas fa-trash-alt'></i> Eliminar Imagen!",
						buttons: {
							success: {
								label: "No",
								className: "btn-success",
								callback: function() {
									$('.bootbox').modal('hide');
								}
							},
							danger: {
								label: "Eliminar",
								className: "btn-danger",
								callback: function() {
									$.ajax({
										type: 'POST',
										url: 'delete_records.php',
										data: dataString,
									})
									.done(function(response){										
										if (roworg === "thumbimage") {
											$("#thumbimg").html(response);
										} else if (roworg === "mapimage") {
											$("#mapdis").html(response);
										} else {						
											$("#cardis").html(response);								
										}										
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