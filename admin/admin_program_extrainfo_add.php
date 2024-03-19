<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

	/* receive vars */	
	
	$stmt = $db->prepare('INSERT dir_programs_extrainfo (prog_ext_prog, prog_ext_descrip) VALUES (:prog_ext_prog, :prog_ext_descrip)');
							
	$stmt->execute(array(':prog_ext_prog' => $_POST['prog_ext_prog'],
						 ':prog_ext_descrip' => $_POST['prog_ext_descrip']));
	
	/* display results */
	
	$prog_id = $_POST['prog_ext_prog'];

	include 'admin_program_extrainfo_disp.php';

?>