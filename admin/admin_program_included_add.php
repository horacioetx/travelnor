<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

	/* receive vars */	
	
	$stmt = $db->prepare('INSERT dir_programs_included (prog_inc_prog, prog_inc_type, prog_inc_descrip) VALUES (:prog_inc_prog, :prog_inc_type, :prog_inc_descrip)');
							
	$stmt->execute(array(':prog_inc_prog' => $_POST['prog_inc_prog'],
						 ':prog_inc_type' => $_POST['prog_inc_type'],
						 ':prog_inc_descrip' => $_POST['prog_inc_descrip']));
	
	/* display results */
	
	$prog_id = $_POST['prog_inc_prog'];

	include 'admin_program_includes_disp.php';