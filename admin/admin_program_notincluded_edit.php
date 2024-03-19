<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs_notincluded SET 
							prog_inc_descrip = :prog_exc_descrip
							WHERE prog_inc_id = :prog_exc_id");
						 
	$stmt->execute(array(':prog_exc_descrip' => $_POST['e_prog_exc_descrip'],
						 ':prog_exc_id' => $_POST['e_prog_exc_id']));
	
	/* display results */
	
	$prog_id = $_POST['e_prog_exc_prog'];

	include 'admin_program_notincludes_disp.php';
	
?>