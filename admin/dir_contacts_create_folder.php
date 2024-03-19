<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }

	/*** create folders in cloud for contacts ***/
		
	/* check for duplicate names */
	
	$stmt = $db->prepare('SELECT fold_name FROM dir_contacts_folders WHERE fold_name = :fold_name');	
	$stmt->execute(array(':fold_name' => $_POST['fold_name']));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);	
	
	$numitems = $stmt->rowCount();
	
	$extraname = "";	
	
	if ($numitems > 0)		
		$extraname = (string)($numitems + 1); // in case name is repeated, adds an extra characters to make it different		
	
	$newname = $_POST['fold_name'] . $extraname;

	$stmt = $db->prepare('INSERT INTO dir_contacts_folders (fold_contact, fold_name) VALUES (:fold_contact, :fold_name)');
		
	$stmt->bindParam(':fold_contact', $_POST['fold_contact']);
	$stmt->bindParam(':fold_name', $newname);
	
	$stmt->execute();
	
	/* refresh div */
	
	$stmt = $db->prepare('SELECT * FROM dir_contacts WHERE contact_id = :contact_id');	
	$stmt->execute(array(':contact_id' => $_POST['fold_contact']));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$contact_id = $_POST['fold_contact'];
	
	include 'dir_contacts_cloud.php';

?>