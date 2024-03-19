<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare('INSERT dir_programs_included (prog_inc_prog, prog_inc_type, prog_inc_descrip) VALUES (:prog_inc_prog, :prog_inc_type, :prog_inc_descrip)');
							
	$stmt->execute(array(':prog_inc_prog' => $_POST['prog_inc_prog'],
						 ':prog_inc_type' => $_POST['prog_inc_type'],
						 ':prog_inc_descrip' => $_POST['prog_inc_descrip']));
	
	/* display results */
	
	$prog_id = $_POST['prog_inc_prog'];

	include 'admin_program_includes_disp.php';