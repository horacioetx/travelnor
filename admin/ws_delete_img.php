<?php

	// include config
	
	require_once('includes/config.php');
	
	// if not logged in redirect to login page 
	
	if(!$user->is_logged_in()){ header('Location: index.php'); } 
	
	/* get image id to delete */

	// define upload path according to call

	/* if call is for logo uploads */
	
	if (($_POST['delid'] == "lolg") or ($_POST['delid'] == "losm")) {
		
		$webid = 1;	
		$name = "";
		
		/* retrieve name of image files to delete via FTP */	

		$stmtx = $db->prepare("SELECT ws_logo_lg, ws_logo_sm FROM website_settings WHERE ws_id = :ws_id"); 			
		$stmtx->bindParam(':ws_id', $webid);	
		$stmtx->execute(); 		
		$wsrows = $stmtx->fetch();	

		$upload_path = "/images/logos/"; 
		
		/* update data on db */		
	
		if ($_POST['delid'] == "lolg") {
			
			$imgdel = $upload_path . $wsrows['ws_logo_lg'];
			
			$stmt= $db->prepare("UPDATE website_settings SET ws_logo_lg = :ws_logo_lg WHERE ws_id = :ws_id");		

			$stmt->bindParam(':ws_logo_lg', $name);	
			$stmt->bindParam(':ws_id', $webid); 

			$stmt->execute();	

		}
		
		if ($_POST['delid'] == "losm") {
			
			$imgdel = $upload_path . $wsrows['ws_logo_sm'];
			
			$stmt= $db->prepare("UPDATE website_settings SET ws_logo_sm = :ws_logo_sm WHERE ws_id = :ws_id");		

			$stmt->bindParam(':ws_logo_sm', $name);	
			$stmt->bindParam(':ws_id', $webid); 

			$stmt->execute();	

		}
		
		/** delete files via FTP **/

		/* connect and login to FTP server to delete file from server */
				
		$ftp_username = "travelnor2@nddinfosystems.com";
		$ftp_userpass = "TlQr;#9t.n?8";
	
		$ftp_server = "ftp.nddinfosystems.com";
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

		/*  try to delete file */
		
		if (ftp_delete($ftp_conn, $imgdel)) {
			$delmsg = $file . " succesfully deleted from server";
		} else {
			$delmsg = "Could not delete " . $file . " from server";
		}

		/* close connection */
		
		ftp_close($ftp_conn);

		/*** refresh div retrieving data from db ***/	

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



?>