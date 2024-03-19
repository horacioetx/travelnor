<?php

	// include config
	
	require_once('includes/config.php');
	
	// if not logged in redirect to login page 
	
	if(!$user->is_logged_in()){ header('Location: index.php'); } 

	// define upload path according to call
	
	/* if call is for logo uploads */
	
	if (($_POST['idimg'] == "lg") or ($_POST['idimg'] == "sm"))
		$upload_path = "images/logos/"; 
	
	
	


	/* start routine to upload */

	if ($_FILES["file"]["name"] != '') {
		
		$test = explode('.', $_FILES["file"]["name"]);		
		$ext = end($test);
		$name = rand(100, 999) . '.' . $ext;		
		$location = $upload_path . $name; 
		
		move_uploaded_file($_FILES["file"]["tmp_name"], $location);
		
		// UPDATE TABLES IN DB WITH NEW UPLOADED FILE 
		
		/* update table with uploaded image file for logo large and refresh corrsponding div */		
		
		if (($_POST['idimg'] == "lg") or ($_POST['idimg'] == "sm")) {
		
			/* update data on db */
			
			$webid = 1;							
			
			if ($_POST['idimg'] == "lg") {
			
				$stmt= $db->prepare("UPDATE website_settings SET ws_logo_lg = :ws_logo_lg WHERE ws_id = :ws_id");		

				$stmt->bindParam(':ws_logo_lg', $name);	
				$stmt->bindParam(':ws_id', $webid); 

				$stmt->execute();	

			}
			
			if ($_POST['idimg'] == "sm") {
			
				$stmt= $db->prepare("UPDATE website_settings SET ws_logo_sm = :ws_logo_sm WHERE ws_id = :ws_id");		

				$stmt->bindParam(':ws_logo_sm', $name);	
				$stmt->bindParam(':ws_id', $webid); 

				$stmt->execute();	
	
			}
			
			/* refresh div retrieving data from db */		

			$stmtx = $db->prepare("SELECT ws_logo_lg, ws_logo_sm FROM website_settings WHERE ws_id = :ws_id"); 			
			$stmtx->bindParam(':ws_id', $webid);	
			$stmtx->execute(); 
			
			$wsrows = $stmtx->fetch();	
			
			if ($wsrows['ws_logo_lg'] <> "")
				$imglglg = $wsrows['ws_logo_lg'];
			else
				$imglglg = "empty";
			
			if ($wsrows['ws_logo_sm'] <> "")
				$imglgsm = $wsrows['ws_logo_sm'];
			else
				$imglgsm = "empty";	
			
			include('includes_2/logo_buttons.php');

		}
		
		
		
		
		
		
		
		
		
		
		
	}




	
	
?>