<?php

	// include config
	
	require_once('includes/config.php');
	
	// if not logged in redirect to login page 
	
	if(!$user->is_logged_in()){ header('Location: index.php'); } 

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
				$stmt->bindParam(':ws_id', $_POST['ws_id']); 
				
	$stmt->execute();	



?>