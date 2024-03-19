<?php

	/* dir_contacts_add.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* add new item routine */

	try {	
        
        $stat = 0;
	
		$stmt = $db->prepare('INSERT INTO dir_contacts (contact_name, contact_lastname, contact_alias, contact_classif0, contact_classif1, contact_classif2, contact_address1, contact_address2, contact_city, contact_pc, contact_country, contact_phone, contact_fax, contact_email, contact_dob, contact_nationality, contact_dni, contact_dni_exp, contact_pass_num, contact_pass_exp, contact_newsletter1, contact_newsletter2) VALUES (:contact_name, :contact_lastname, :contact_alias, :contact_classif0, :contact_classif1, :contact_classif2, :contact_address1, :contact_address2, :contact_city, :contact_pc, :contact_country, :contact_phone, :contact_fax, :contact_email, :contact_dob, :contact_nationality, :contact_dni, :contact_dni_exp, :contact_pass_num, :contact_pass_exp, :contact_newsletter1, :contact_newsletter2)');
		
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
	
		$stmt->execute();							

		$latest_id = $db->lastInsertId(); 
		
		$error = "Contacto Agregado!";
		
	} catch (PDOException $e) {
		
		$error = '<div class="alert alert-danger" role="alert"><strong>Error during ' . $e . '</strong></div>';
		$stat = 1;
				
	}

	/* return to dir_contacts.php */

	$result = array('stat' => $stat, 'lastid' => $latest_id, 'msg' => $error);
	
	echo json_encode($result);

?>

