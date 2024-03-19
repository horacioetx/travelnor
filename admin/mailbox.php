<?php

	//include config
	
	require_once('includes/config.php');
	
	//if not logged in redirect to login page
	
	if(!$user->is_logged_in()){ header('Location: login.php'); } 
	
	//retrieve system config info
	
	$stmt = $db->prepare("SELECT company_name FROM config LIMIT 1"); 
	$stmt->execute(); 
	$conr = $stmt->fetch();
	
	$title = $conr['company_name'] . " - Website General Settings";	

	/* load contry list */
	
	include ("includes_2/country_list.inc");

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

		<!-- Bracket CSS -->
		
		<link rel="stylesheet" href="../css/bracket.css">
		<link rel="stylesheet" href="../css/bracket.oreo.css">
		<link rel="stylesheet" href="../css/style.css">
		
		<!-- jquqery -->
		
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	
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
		
		
		
			<iframe src="https://nddinfosystems.com/crm_webmail/" style="width: 100%; height: 800px; border: 0;"></iframe>

			<!-- footer -->
		
			<?php include('includes_2/footer.php'); ?> 
			
		</div><!-- br-mainpanel -->

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
		
		<script>
		  $(function(){
			'use strict';
			$('#selectForm').parsley();
			$('#selectForm2').parsley();
		  });
		</script>
		
	</body>
	
</html>