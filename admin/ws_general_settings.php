<?php

	//include config
	
	require_once('includes/config.php');
	
	//if not logged in redirect to login page
	
	if(!$user->is_logged_in()){ header('Location: login.php'); } 	
	
	/* if general setting form is sent, proceed to update table */
	
	if (isset($_POST['submitgf'])) {	
	
		$webid = 1;		

		/* proceed to update table */

		$stmt= $db->prepare("UPDATE website_settings SET 
									ws_url = :ws_url ,
									ws_contact_street = :ws_contact_street,
									ws_contact_city = :ws_contact_city,
									ws_contact_pcode = :ws_contact_pcode,
									ws_contact_country = :ws_contact_country,
									ws_contact_email = :ws_contact_email,
									ws_contact_phone1 = :ws_contact_phone1,
									ws_contact_phone2 = :ws_contact_phone2							
							WHERE ws_id = :ws_id");		

					$stmt->bindParam(':ws_url', $_POST['ws_url']);	
					$stmt->bindParam(':ws_contact_street', $_POST['ws_contact_street']); 
					$stmt->bindParam(':ws_contact_city', $_POST['ws_contact_city']);	
					$stmt->bindParam(':ws_contact_pcode', $_POST['ws_contact_pcode']); 
					$stmt->bindParam(':ws_contact_country', $_POST['ws_contact_country']);	
					$stmt->bindParam(':ws_contact_email', $_POST['ws_contact_email']); 
					$stmt->bindParam(':ws_contact_phone1', $_POST['ws_contact_phone1']);	
					$stmt->bindParam(':ws_contact_phone2', $_POST['ws_contact_phone2']); 
					$stmt->bindParam(':ws_id', $webid); 
					
		$stmt->execute();		
		
		$msg = "General information saved succsefully";
	
	}

	//retrieve system config info
	
	$stmt = $db->prepare("SELECT company_name FROM config LIMIT 1"); 
	$stmt->execute(); 
	$conr = $stmt->fetch();
	
	$title = $conr['company_name'] . " - Website General Settings";	

	/* load contry list */
	
	include ("includes_2/country_list.inc");
	
	/* retrieve data from db */
	
	$stmt = $db->prepare("SELECT * FROM website_settings LIMIT 1"); 
	$stmt->execute(); 
	$wsrows = $stmt->fetch();	
	
	if ($wsrows['ws_logo_lg'] <> "")
		$imglglg = $wsrows['ws_logo_lg'];
	else
		$imglglg = "empty";
	
	if ($wsrows['ws_logo_sm'] <> "")
		$imglgsm = $wsrows['ws_logo_sm'];
	else
		$imglgsm = "empty";

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
					<span class="breadcrumb-item active">General Settings</span>
				</nav>
			</div><!-- br-pageheader -->
		  
			<div class="br-pagetitle">
				<i class="icon ion-ios-gear-outline"></i>
				<div>
					<h4>Website General Settings</h4>
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
					
					<form id="form_general" method="post" data-parsley-validate>

						<div class="form-layout form-layout-1">
						
							<div class="row mg-b-25">
							
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label">Website URL: <span class="tx-danger">*</span></label>
										<input class="form-control" type="text" name="ws_url" value="<?php echo $wsrows['ws_url']; ?>" placeholder="Enter website URL" required>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label">Website Contact Street: <span class="tx-danger">*</span></label>
										<input class="form-control" type="text" name="ws_contact_street" value="<?php echo $wsrows['ws_contact_street']; ?>" placeholder="Enter Website Contact Street" required>
									</div>
								</div>
								
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label">Website Contact City: <span class="tx-danger">*</span></label>
										<input class="form-control" type="text" name="ws_contact_city" value="<?php echo $wsrows['ws_contact_city']; ?>" placeholder="Enter Website Contact City" required>
									</div>
								</div>
								
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label">Website Contact Postal Code/Zip Code: <span class="tx-danger">*</span></label>
										<input class="form-control" type="text" name="ws_contact_pcode" value="<?php echo $wsrows['ws_contact_pcode']; ?>" placeholder="Enter ontact Postal Code/Zip Code" required>
									</div>
								</div>
								
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label">Website Contact Country: <span class="tx-danger">*</span></label>
										<select class="form-control select2" name="ws_contact_counrty" data-placeholder="Choose Country" required> 
											<option label="Choose country"></option>
											<?php
												foreach ($countries as $country_code => $country){
													$selected = ($wsrows['ws_contact_counrty'] === $country_code) ? ' selected="selected"' : '';
													echo '<option value="', $country_code, '"', $selected, '>', $country, '</option>';
												}
											?>										
										</select>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label">Website Contact Email Address: <span class="tx-danger">*</span></label>
										<input class="form-control" type="text" name="ws_contact_email" value="<?php echo $wsrows['ws_contact_email']; ?>" placeholder="Enter email address" required>
									</div>
								</div>
								
								<div class="col-lg-4">
									<div class="form-group">
									  <label class="form-control-label">Telephone 1: </label>
									  <input class="form-control" type="text" name="ws_contact_phone1" value="<?php echo $wsrows['ws_contact_phone1']; ?>" placeholder="Enter Telephone 1">
									</div>
								</div>
								
								<div class="col-lg-4">
									<div class="form-group">
									  <label class="form-control-label">Telephone 2: </label>
									  <input class="form-control" type="text" name="ws_contact_phone2" value="<?php echo $wsrows['ws_contact_phone2']; ?>" placeholder="Enter Telephone 2">
									</div>
								</div>
								
								<div class="col-lg-8">
									<div class="form-group mg-b-10-force">
									  <label class="form-control-label">Website Pages Footer: </label>
									  <input class="form-control" type="text" name="ws_footer" value="<?php echo $wsrows['ws_footer']; ?>" placeholder="Website Pages Footer">
									</div>
								</div>

							</div><!-- row -->

							<div class="form-layout-footer">
								<button type="submit" name="submitgf" class="btn btn-primary">Submit From</button>
							</div><!-- form-layout-footer -->
							
						</div><!-- form-layout -->
				
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
