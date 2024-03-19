<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_contacts SET 
							contact_name = :contact_name,
							contact_lastname = :contact_lastname,
							contact_alias = :contact_alias,
							contact_classif0 = :contact_classif0,
							contact_classif1 = :contact_classif1,
							contact_classif2 = :contact_classif2,
							contact_address1 = :contact_address1,
							contact_address2 = :contact_address2,
							contact_city = :contact_city,
							contact_pc = :contact_pc,
							contact_country = :contact_country,
							contact_phone = :contact_phone,
							contact_fax = :contact_fax,
							contact_email = :contact_email,							
							contact_dob = :contact_dob,							
							contact_nationality = :contact_nationality,							
							contact_dni = :contact_dni,
							contact_dni_exp = :contact_dni_exp,
							contact_pass_num = :contact_pass_num,
							contact_pass_exp = :contact_pass_exp,							
							contact_newsletter1 = :contact_newsletter1,
							contact_newsletter2 = :contact_newsletter2							
							WHERE contact_id = :contact_id");						 
						 
	$stmt->bindParam(':contact_name', $_POST['contact_name']);
	$stmt->bindParam(':contact_lastname', $_POST['contact_lastname']);
	$stmt->bindParam(':contact_alias', $_POST['contact_alias']);
	$stmt->bindParam(':contact_classif0', $_POST['contact_classif0']);
	$stmt->bindParam(':contact_classif1', $_POST['contact_classif1']);
	$stmt->bindParam(':contact_classif2', $_POST['contact_classif2']);
	$stmt->bindParam(':contact_address1', $_POST['contact_address1']);
	$stmt->bindParam(':contact_address2', $_POST['contact_address2']);
	$stmt->bindParam(':contact_city', $_POST['contact_city']);	
	$stmt->bindParam(':contact_pc', $_POST['contact_pc']);	
	$stmt->bindParam(':contact_country', $_POST['contact_country']);			
	$stmt->bindParam(':contact_phone', $_POST['contact_phone']);
	$stmt->bindParam(':contact_fax', $_POST['contact_fax']);
	$stmt->bindParam(':contact_email', $_POST['contact_email']);	
	$stmt->bindParam(':contact_dob', $_POST['contact_dob']);
	$stmt->bindParam(':contact_nationality', $_POST['contact_nationality']);	
	$stmt->bindParam(':contact_dni', $_POST['contact_dni']);
	$stmt->bindParam(':contact_dni_exp', $_POST['contact_dni_exp']);
	$stmt->bindParam(':contact_pass_num', $_POST['contact_pass_num']);
	$stmt->bindParam(':contact_pass_exp', $_POST['contact_pass_exp']);	
	$stmt->bindParam(':contact_newsletter1', $_POST['contact_newsletter1']);
	$stmt->bindParam(':contact_newsletter2', $_POST['contact_newsletter2']);
	$stmt->bindParam(':contact_id', $_POST['contact_id']);	
	
	$stmt->execute();							 
	
	/* proceed to buld display */
	
	$contact_id = $_POST['contact_id'];
	$ctc_type = "CLI";
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT * FROM dir_contacts WHERE contact_id = :contact_id');	
	$stmt->execute(array(':contact_id' => $contact_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* format some vars */
	
	/* display results */
	
	include 'dir_contacts_general_info_disp.php';
	
?>