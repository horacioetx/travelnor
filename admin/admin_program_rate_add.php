<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

	/* receive vars */
		
	$stmt = $db->prepare('INSERT dir_programs_rates (program_rate_catego, program_rates_rate, program_rates_feature, program_rates_note, program_rates_program) VALUES (:program_rate_catego, :program_rates_rate, :program_rates_feature, :program_rates_note, :program_rates_program)');
							
	$stmt->execute(array(':program_rate_catego' => $_POST['program_rate_catego'],
						 ':program_rates_rate' => $_POST['program_rates_rate'],
						 ':program_rates_feature' => $_POST['program_rates_feature'],
						 ':program_rates_note' => $_POST['program_rates_note'],
						 ':program_rates_program' => $_POST['program_rates_program']));
	
	/* display results */
	
	$prog_id = $_POST['program_rates_program'];

	include 'admin_program_rates_disp.php';