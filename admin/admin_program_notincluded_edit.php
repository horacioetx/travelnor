<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
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