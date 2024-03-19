<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare('INSERT dir_programs_extensions (ext_program, ext_name, ext_nites, ext_status) VALUES (:ext_program, :ext_name, :ext_nites, :ext_status)');
							
	$stmt->execute(array(':ext_program' => $_POST['ext_prog_id'],
						 ':ext_name' => $_POST['ext_name'],
						 ':ext_nites' => $_POST['ext_nites'],
						 ':ext_status' => $_POST['ext_status']));
	
	/* display results */
	
	$prog_id = $_POST['ext_prog_id'];

	include 'admin_program_extensions_disp.php';

?>