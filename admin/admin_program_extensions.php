<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */
	
	$prog_id = $_REQUEST['progid'];
	
	/* retrieve config vars */
	
	$stmt_conf1 = $db->prepare('SELECT web1_path_img_ribbons FROM config');	
	$stmt_conf1->execute();
	$row_conf1 = $stmt_conf1->fetch(PDO::FETCH_ASSOC);	
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT program_name FROM dir_programs WHERE program_id = :program_id');	
	$stmt->execute(array(':program_id' => $prog_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$maxdays = 40;
	
	/* define page title */
	
	$title = str_replace("<br />", " ", $rrows['program_name']);
	$active_page = 6;

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
							<li class="breadcrumb-item"><a href="admin_program_view?progid=<?php echo $prog_id; ?>"><?php echo $title; ?></a></li>
							<li class="breadcrumb-item active" aria-current="page">Extensiones</a></li>
						</ol>
					</nav>							
				</div>		
				
				<?php include("program_subnav.php"); ?>

				<div class="card">
					<div class="card-body">
						<h1 class="card-title"><?php echo str_replace("<br />", " ", $rrows['program_name']); ?></h1>
					</div>
				</div>

				<!-- display extension info -->
				
				<span id="disp_extension">
				
					<?php include 'admin_program_extensions_disp.php'; ?>	
				
				</span>						

			</div>	
			
			<!-- footer -->	
					
			<?php include ("footer.php"); ?>	
				
		</div>				
		
		<!-- MODALS -->		
		
		<!-- Add new extension -->
		
		<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Extensión</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_add" method="post" action="admin">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="ext_name">Nombre de Extensión :</label>
									<input type="text" id="ext_name" name="ext_name" class="form-control" value="">
								</div>
							</div>		

							<div class="form-row">								
								<div class="col">
									<label for="ext_nites" class="col-form-label">No. de Noches : </label>
									<select class="custom-select mr-sm-2" id="ext_nites" name="ext_nites" required>
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
									<label for="ext_status" class="col-form-label">Status :</label>
									<select class="custom-select mr-sm-2" id="ext_status" name="ext_status">
										<option value="0" class="text-success">Activo</option>
										<option value="1" class="text-danger">Inactivo</option>
									</select>
								</div>
							</div>
							
							<div class="modal-footer">
							
								<input type="hidden" id="ext_prog_id" name="ext_prog_id" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="add" name="add" value="add">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>
		
		<!-- modal to edit extension general Info -->
		
		<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Información General de Extensión</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_edit" method="post" autocomplete="off">						
						<div class="modal-body">
						
							<div class="form-row">								
								<div class="col">
									<label for="e_ext_name">Nombre de Extensión :</label>
									<input type="text" id="e_ext_name" name="e_ext_name" class="form-control" value="">
								</div>
							</div>		

							<div class="form-row">								
								<div class="col">
									<label for="e_ext_nites" class="col-form-label">No. de Noches : </label>
									<select class="custom-select mr-sm-2" id="e_ext_nites" name="e_ext_nites" required>
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
									<label for="e_ext_hotel">Hotel :</label>
									<input type="text" id="e_ext_hotel" name="e_ext_hotel" class="form-control" value="">
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="e_ext_cost">Precio :</label>
									<input type="text" id="e_ext_cost" name="e_ext_cost" class="form-control" value="">
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="e_ext_notes" class="col-form-label">Notas :</label>
									<textarea class="form-control" id="e_ext_notes" name="e_ext_notes" rows="5"></textarea>
								</div>
							</div>	

							<div class="form-row">
								<div class="col">
									<label for="e_ext_status" class="col-form-label">Status :</label>
									<select class="custom-select mr-sm-2" id="e_ext_status" name="e_ext_status">
										<option value="0" class="text-success">Activo</option>
										<option value="1" class="text-danger">Inactivo</option>
									</select>
								</div>
							</div>
						
							<div class="modal-footer">							
								<input type="hidden" id="e_ext_id" name="e_ext_id" value="">
								<input type="hidden" id="e_prog_id" name="e_prog_id" value="<?php echo $prog_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar0" name="editar0" value="edit">Guardar</button>
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

		<!-- jQuery first, Popper.js, Bootstrap JS -->

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
		
		<!-- Send add form -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_add']").submit(function(){
				$.ajax({
					url : 'admin_program_extensions_add.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#disp_extension").html(data);
						$('#new').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>

		<!-- Edit extension gral info -->
		
		<script>		
			$(document).ready(function(){  
				$(document).on('click', '.edit_ext', function(){  
					var id = $(this).attr("id");  		
					$.ajax({  
						url:"fetch_ext.php",  
						method:"POST",  
						data:{id:id},  
						dataType:"json",  
						success:function(data){  
							$('#e_ext_name').val(data.ext_name);
							$('#e_ext_nites').val(data.ext_nites); 
							$('#e_ext_cost').val(data.ext_cost);
							$('#e_ext_notes').val(data.ext_notes);
							$('#e_ext_hotel').val(data.ext_hotel); 							
							$('#e_ext_status').val(data.ext_status);
							$('#e_ext_id').val(data.ext_id);							
							$('#edit').modal('show');  
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
					url : 'admin_program_extensions_edit.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#disp_extension").html(data);
						$('#edit').modal('hide');  
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
					var target_id = "ext";
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
							$("#disp_extension").html(response);														
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
										$("#disp_extension").html(response);										
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