<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs_extrainfo SET 
							prog_ext_descrip = :prog_ext_descrip
							WHERE prog_ext_id = :prog_ext_id");
						 
	$stmt->execute(array(':prog_ext_descrip' => $_POST['e_prog_ext_descrip'],
						 ':prog_ext_id' => $_POST['e_prog_ext_id']));
	
	/* display results */
	
	$prog_id = $_POST['e_prog_ext_prog'];

	include 'admin_program_extrainfo_disp.php';
	
?>