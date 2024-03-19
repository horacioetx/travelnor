<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_subcontacts SET 
							subcontact_name = :subcontact_name,
							subcontact_lastname = :subcontact_lastname,
							subcontact_alias = :subcontact_alias,
							subcontact_phone = :subcontact_phone,
							subcontact_email = :subcontact_email,
							subcontact_dob = :subcontact_dob,							
							subcontact_nationality = :subcontact_nationality,							
							subcontact_dni = :subcontact_dni,
							subcontact_dni_exp = :subcontact_dni_exp,
							subcontact_pass_num = :subcontact_pass_num,
							subcontact_pass_exp = :subcontact_pass_exp,
							subcontact_notes = :subcontact_notes,
							subcontact_newsletter1 = :subcontact_newsletter1,
							subcontact_newsletter2 = :subcontact_newsletter2							
							WHERE subcontact_id = :subcontact_id");						 
						 
	$stmt->bindParam(':subcontact_name', $_POST['xsubcontact_name']);
	$stmt->bindParam(':subcontact_lastname', $_POST['xsubcontact_lastname']);
	$stmt->bindParam(':subcontact_alias', $_POST['xsubcontact_alias']);				
	$stmt->bindParam(':subcontact_phone', $_POST['xsubcontact_phone']);
	$stmt->bindParam(':subcontact_email', $_POST['xsubcontact_email']);
	$stmt->bindParam(':subcontact_dob', $_POST['xsubcontact_dob']);	
	$stmt->bindParam(':subcontact_nationality', $_POST['xsubcontact_nationality']);	
	$stmt->bindParam(':subcontact_dni', $_POST['xsubcontact_dni']);
	$stmt->bindParam(':subcontact_dni_exp', $_POST['xsubcontact_dni_exp']);
	$stmt->bindParam(':subcontact_pass_num', $_POST['xsubcontact_pass_num']);
	$stmt->bindParam(':subcontact_pass_exp', $_POST['xsubcontact_pass_exp']);
	$stmt->bindParam(':subcontact_notes', $_POST['xsubcontact_notes']);	
	$stmt->bindParam(':subcontact_newsletter1', $_POST['xsubcontact_newsletter1']);
	$stmt->bindParam(':subcontact_newsletter2', $_POST['xsubcontact_newsletter2']);		
	$stmt->bindParam(':subcontact_id', $_POST['xsubcontact_id']);
	
	$stmt->execute();	
	
	/* proceed to build display */
	
	$_REQUEST['contact_id'] = $_POST['contact_id4'];
	$ctc_type = "CLI";
	
	$stmt = $db->prepare('SELECT * FROM dir_contacts WHERE contact_id = :contact_id');	
	$stmt->execute(array(':contact_id' => $_REQUEST['contact_id']));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

	include 'dir_contacts_specific_disp.php';	
	
?>