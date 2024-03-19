<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs_included SET 
							prog_inc_descrip = :prog_inc_descrip,
							prog_inc_type = :prog_inc_type
							WHERE prog_inc_id = :prog_inc_id");
						 
	$stmt->execute(array(':prog_inc_descrip' => $_POST['e_prog_inc_descrip'],
						 ':prog_inc_type' => $_POST['e_prog_inc_type'],
						 ':prog_inc_id' => $_POST['e_prog_inc_id']));
	
	/* display results */
	
	$prog_id = $_POST['e_prog_inc_prog'];

	include 'admin_program_includes_disp.php';
	
?>