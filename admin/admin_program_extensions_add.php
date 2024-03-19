<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare('INSERT dir_programs_extensions (ext_program, ext_name, ext_nites, ext_status) VALUES (:ext_program, :ext_name, :ext_nites, :ext_status)');
							
	$stmt->execute(array(':ext_program' => $_POST['ext_prog_id'],
						 ':ext_name' => $_POST['ext_name'],
						 ':ext_nites' => $_POST['ext_nites'],
						 ':ext_status' => $_POST['ext_status']));
	
	/* display results */
	
	$prog_id = $_POST['ext_prog_id'];

	include 'admin_program_extensions_disp.php';