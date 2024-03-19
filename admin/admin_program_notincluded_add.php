<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

	/* receive vars */	
	
	$stmt = $db->prepare('INSERT dir_programs_notincluded (prog_inc_prog, prog_inc_descrip) VALUES (:prog_exc_prog, :prog_exc_descrip)');
							
	$stmt->execute(array(':prog_exc_prog' => $_POST['prog_exc_prog'],
						 ':prog_exc_descrip' => $_POST['prog_exc_descrip']));
	
	/* display results */
	
	$prog_id = $_POST['prog_exc_prog'];

	include 'admin_program_notincludes_disp.php';

?>