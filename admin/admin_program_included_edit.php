<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

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