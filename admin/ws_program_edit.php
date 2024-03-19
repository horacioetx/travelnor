<?php

	//include config
	
	require_once('includes/config.php');
	
	//if not logged in redirect to login page
	
	if(!$user->is_logged_in()){ header('Location: login.php'); } 	
	






?>

<!DOCTYPE html>
<html lang="en">

	<head>
	
		<!-- Required meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->

		<meta name="author" content="">

		<title><?php echo $title ?></title>

		<!-- vendor css -->
		
		<link href="../lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
		<link href="../lib/highlightjs/styles/github.css" rel="stylesheet">
		<link href="../lib/select2/css/select2.min.css" rel="stylesheet">
		<link href="../lib/spinkit/css/spinkit.css" rel="stylesheet">

		<!-- Bracket CSS -->
		
		<link rel="stylesheet" href="../css/bracket.css">
		<link rel="stylesheet" href="../css/bracket.oreo.css">
		<link rel="stylesheet" href="../css/style.css">
		
		<!-- jquqery -->
		
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		
		<!-- send forms to process -->

		<script>			
			$(document).ready(function(){
				$(document).on('change', '#file', function(){
					var name = document.getElementById("file").files[0].name;
					var form_data = new FormData();
					var ext = name.split('.').pop().toLowerCase();
					if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
						alert("Invalid Image File");
					}
					var oFReader = new FileReader();
					oFReader.readAsDataURL(document.getElementById("file").files[0]);
					var f = document.getElementById("file").files[0];
					var fsize = f.size||f.fileSize;
					if(fsize > 2000000) {
						alert("Image File Size is very big");
					} else {
						form_data.append("file", document.getElementById('file').files[0]);
						form_data.append("idimg", 'lg');
						$.ajax({
							url:"ws_upload_images.php",
							method:"POST",
							data: form_data,
							contentType: false,
							cache: false,
							processData: false,
							beforeSend:function(){
								$('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
							},   
							success:function(data) {
								$('#logo_buttons').html(data);
							}
						});
					}
				});
			});
		</script>	
		
		<script>			
			$(document).ready(function(){
				$(document).on('change', '#file2', function(){
					var name = document.getElementById("file2").files[0].name;
					var form_data = new FormData();
					var ext = name.split('.').pop().toLowerCase();
					if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
						alert("Invalid Image File");
					}
					var oFReader = new FileReader();
					oFReader.readAsDataURL(document.getElementById("file2").files[0]);
					var f = document.getElementById("file2").files[0];
					var fsize = f.size||f.fileSize;
					if(fsize > 2000000) {
						alert("Image File Size is very big");
					} else {
						form_data.append("file", document.getElementById('file2').files[0]);
						form_data.append("idimg", 'sm');
						$.ajax({
							url:"ws_upload_images.php",
							method:"POST",
							data: form_data,
							contentType: false,
							cache: false,
							processData: false,
							beforeSend:function(){
								$('#uploaded_image2').html("<label class='text-success'>Image Uploading...</label>");
							},   
							success:function(data) {
								$('#logo_buttons').html(data);
							}
						});
					}
				});
			});
		</script>
		
		<script>		
			$(document).ready(function(){
				$("#logo_buttons").on('click', '.delbtn', function(){
					var del_id = $(this).attr('id');
					$.ajax({
						type:'POST',
						url:'ws_delete_img.php',
						data:'delid='+del_id,
						cache: false,
						beforeSend:function(){
							$('.deleting_image').html(" Deleting...");
						},  
						success:function(data) {
							$('#logo_buttons').html(data);							
						}
					});
				});
			});
		</script>		

	</head>

	<body>
	
		<!-- left panel -->
		
		<?php include('includes_2/left_panel.php'); ?>
		
		<!-- head panel -->
		
		<?php include('includes_2/head_panel.php'); ?>
		
		<!-- head panel -->
		
		<?php include('includes_2/right_panel.php'); ?>

		<!-- main panel -->

		<div class="br-mainpanel">
		
			<div class="br-pageheader">
			
				<nav class="breadcrumb pd-0 mg-0 tx-12">
					<a class="breadcrumb-item" href="index.php">Dashboard</a>
					<a class="breadcrumb-item" href="#">Website CMS</a>
					<span class="breadcrumb-item active">Program Edit</span>
				</nav>
			</div><!-- br-pageheader -->
		  
			<div class="br-pagetitle">
				<i class="icon ion-ios-gear-outline"></i>
				<div>
					<h4>Program Edit</h4>
					<p class="mg-b-0">In this area you can configure and customize the general information of the main website.</p>
				</div>
			</div><!-- d-flex -->
			
			<?php
			
				if ($msg) {					
					
					echo '<div class="alert alert-success" role="alert">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
							echo '<span aria-hidden="true">&times;</span>';
						echo '</button>';
						echo '<strong class="d-block d-sm-inline-block-force">Well done! </strong>' . $msg;
					echo '</div>';		
			
				}
				
			?>

			<div class="br-pagebody">
			
				<div class="br-section-wrapper">				
				
					<h6 class="br-section-label">General Settings</h6>
					<p class="br-section-text">Complete the following form</p>
					
					
					
					
					
					
					<form>
					  <div class="form-group row">
						<label class="col-4 col-form-label" for="text">Código del Programa</label> 
						<div class="col-8">
						  <input id="text" name="text" type="text" required="required" class="form-control">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="text1" class="col-4 col-form-label">Nombre del Programa</label> 
						<div class="col-8">
						  <input id="text1" name="text1" type="text" class="form-control" required="required">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="text2" class="col-4 col-form-label">Número de Días</label> 
						<div class="col-8">
						  <input id="text2" name="text2" type="text" class="form-control" required="required">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="text3" class="col-4 col-form-label">Destacado</label> 
						<div class="col-8">
						  <input id="text3" name="text3" type="text" class="form-control">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="textarea" class="col-4 col-form-label">Introducción</label> 
						<div class="col-8">
						  <textarea id="textarea" name="textarea" cols="40" rows="5" class="form-control"></textarea>
						</div>
					  </div>
					  <div class="form-group row">
						<label class="col-4">Status</label> 
						<div class="col-8">
						  <div class="custom-control custom-radio custom-control-inline">
							<input name="radio" id="radio_0" type="radio" class="custom-control-input" value="0"> 
							<label for="radio_0" class="custom-control-label">Activo</label>
						  </div>
						  <div class="custom-control custom-radio custom-control-inline">
							<input name="radio" id="radio_1" type="radio" class="custom-control-input" value="1"> 
							<label for="radio_1" class="custom-control-label">Inactivo</label>
						  </div>
						</div>
					  </div> 
					  <div class="form-group row">
						<div class="offset-4 col-8">
						  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
						</div>
					  </div>
					</form>
					
					
					
					
					
					
					
					
					
					
					
					

					<br />

				</div><!-- br-section-wrapper -->
				
			</div><!-- br-pagebody -->

			<div class="br-pagebody">
			
				<div class="br-section-wrapper">						
					
					<h6 class="br-section-label">Logo Images </h6>
					<p class="br-section-text">Select and upload 1 or 2 image logos for your website</p>             

					<div class="row mg-b-25" id="logo_buttons">
					
						<?php include('includes_2/logo_buttons.php'); ?> 
					
					</div>		

					<br />

				</div><!-- br-section-wrapper -->
				
			</div><!-- br-pagebody -->
			
			
			
			
			<div class="br-pagebody">
			
				<div class="br-section-wrapper">						
					
					<h6 class="br-section-label">Social Media </h6>
					<p class="br-section-text">Select and upload 1 or 2 image logos for your website</p>     
					
					<div class="row mg-b-25" id="logo_buttons">

						<div class="col">	
						
							<h6 class="br-section-label">Social Media to Select </h6>
							
							<form id="form_social" method="post" data-parsley-validate>

								<div class="form-layout form-layout-1">
								
									<!--Facebook-->
									<a href="" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal" data-target="#modaldemo1"><i class="fab fa-facebook-f"></i></a>

									<a class="btn-floating btn-lg btn-fb" type="button" role="button"><i class="fab fa-facebook-f"></i></a>
									<!--Twitter-->
									<a class="btn-floating btn-lg btn-tw" type="button" role="button"><i class="fab fa-twitter"></i></a>
									<!--Google +-->
									<a class="btn-floating btn-lg btn-gplus" type="button" role="button"><i class="fab fa-google-plus-g"></i></a>
									<!--Linkedin-->
									<a class="btn-floating btn-lg btn-li" type="button" role="button"><i class="fab fa-linkedin-in"></i></a>
									<!--Instagram-->
									<a class="btn-floating btn-lg btn-ins" type="button" role="button"><i class="fab fa-instagram"></i></a>
									<!--Pinterest-->
									<a class="btn-floating btn-lg btn-pin" type="button" role="button"><i class="fab fa-pinterest"></i></a>
									<!--Vkontakte-->
									<a class="btn-floating btn-lg btn-vk" type="button" role="button"><i class="fab fa-vk"></i></a>
									<!--Stack Overflow-->
									<a class="btn-floating btn-lg btn-so" type="button" role="button"><i class="fab fa-stack-overflow"></i></a>
									<!--Youtube-->
									<a class="btn-floating btn-lg btn-yt" type="button" role="button"><i class="fab fa-youtube"></i></a>
									<!--Slack-->
									<a class="btn-floating btn-lg btn-slack" type="button" role="button"><i class="fab fa-slack-hash"></i></a>
									<!--Github-->
									<a class="btn-floating btn-lg btn-git" type="button" role="button"><i class="fab fa-github"></i></a>
									<!--Comments-->
									<a class="btn-floating btn-lg btn-comm" type="button" role="button"><i class="fas fa-comments"></i></a>
									<!--Email-->
									<a class="btn-floating btn-lg btn-email" type="button" role="button"><i class="fas fa-envelope"></i></a>
									<!--Dribbble-->
									<a class="btn-floating btn-lg btn-dribbble" type="button" role="button"><i class="fab fa-dribbble"></i></a>
									<!--Reddit-->
									<a class="btn-floating btn-lg btn-reddit" type="button" role="button"><i class="fab fa-reddit-alien"></i></a>

								</div><!-- form-layout -->
						
							</form>
							
						</div>
						
						<div class="col">	
						
						
						</div>
						
					</div>

					<br />

				</div><!-- br-section-wrapper -->
				
			</div><!-- br-pagebody -->
			
			
			
			
			
			

			<!-- footer -->
		
			<?php include('includes_2/footer.php'); ?> 
			
		</div><!-- br-mainpanel -->
		
		
		<!-- MODALS -->
		
		<!-- modal for social media -->
		
		<div id="modaldemo1" class="modal fade">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content bd-0 tx-14">
					<div class="modal-header pd-y-20 pd-x-25">
						<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Message Preview</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body pd-25">
						<h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary">Why We Use Electoral College, Not Popular Vote</a></h4>
						<p class="mg-b-5">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save changes</button>
						<button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div><!-- modal-dialog -->
		</div><!-- modal -->

		
		
		
		
		
		
		
		

		<!-- js scripts -->

		<script src="../lib/jquery/jquery.min.js"></script>
		<script src="../lib/jquery-ui/ui/widgets/datepicker.js"></script>
		<script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="../lib/moment/min/moment.min.js"></script>
		<script src="../lib/peity/jquery.peity.min.js"></script>
		<script src="../lib/highlightjs/highlight.pack.min.js"></script>
		<script src="../lib/select2/js/select2.min.js"></script>
		<script src="../lib/parsleyjs/parsley.min.js"></script>
		<script src="../lib/timepicker/jquery.timepicker.min.js"></script>
		<script src="../lib/spectrum-colorpicker/spectrum.js"></script>
		<script src="../lib/jquery.maskedinput/jquery.maskedinput.js"></script>
		<script src="../lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
		<script src="../lib/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

		<script src="../js/bracket.js"></script>
		<script src="../js/tooltip-colored.js"></script>
		<script src="../js/popover-colored.js"></script>
		
		<script>
		  $(function(){
			'use strict';
			$('#selectForm').parsley();
			$('#selectForm2').parsley();
		  });
		</script>
		
	</body>
	
</html>
