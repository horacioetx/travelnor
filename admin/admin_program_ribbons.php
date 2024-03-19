<?php

	//include config
	
	require_once('includes/config.php');
	
	// if not logged in redirect to login page
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	// define page title
	
	$title = "Catálogo de Sellos";	
		
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

			<div class="col">
				 
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">		
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">								
							<li class="breadcrumb-item"><a href="home">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Catálogo de Sellos</li>
						</ol>
					</nav>							
				</div>
			
				<!-- action buttons and total members -->
	
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#imgupload">Agregar Sello</button>

				<div id="disp_ribbons">
				
					<?php include ("admin_program_ribbons_disp.php"); ?>		

				</div>
					
			</div>	
			
			<!-- footer -->	
					
			<?php include ("footer.php"); ?>	
				
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
								<input type="hidden" id="target_id" name="target_id" value="ribbon">
							</div>
						</div>
					</div>
						
					</div>	
				</div>				
			</div>			
		</div>

		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
		
		<script type="text/javascript">
			$(document).ready(function () {
				$('#sidebarCollapse').on('click', function () {
					$('#sidebar').toggleClass('active');
				});
			});
		</script>
		
		<!-- update val for target_id according what button call the delete function 
		
		<script>
			$('#imgupload').on('show.bs.modal', function (event) {
				var myVal = $(event.relatedTarget).data('val');
				$(this).find("#target_id").val(myVal);
			});
		</script>-->
		
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