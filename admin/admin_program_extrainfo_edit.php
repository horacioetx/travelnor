<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

	/* fetch data */
	
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