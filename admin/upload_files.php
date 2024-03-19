<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }	

	/* upload routine */

	$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
	 
	if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
	  echo "false";
	  return;
	}
	 
	if (!file_exists('uploads')) {
	  mkdir('uploads', 0777);
	}
	 
	move_uploaded_file($_FILES['file']['tmp_name'], 'contacts_files/' . $_FILES['file']['name']);

	/* update contacts_folders_docs */
	
	$stmt = $db->prepare('INSERT INTO dir_contacts_folders_docs (doc_folder, doc_name) VALUES (:doc_folder, :doc_name)');
		
	$stmt->bindParam(':doc_folder', $_POST['folid']);
	$stmt->bindParam(':doc_name', $_FILES['file']['name']);

	$stmt->execute();	

	/* refresh div */
	
	include "dir_contacts_cloud_disp.php";
	
?>

