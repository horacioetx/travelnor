<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs_rates SET 
							program_rate_catego = :program_rate_catego,
							program_rates_rate = :program_rates_rate,
							program_rates_feature = :program_rates_feature,
							program_rates_note = :program_rates_note
							WHERE program_rates_id = :program_rates_id");
						 
	$stmt->execute(array(':program_rate_catego' => $_POST['e_program_rate_catego'],
						 ':program_rates_rate' => $_POST['e_program_rates_rate'],
						 ':program_rates_feature' => $_POST['e_program_rates_feature'],
						 ':program_rates_note' => $_POST['e_program_rates_note'],
						 ':program_rates_id' => $_POST['e_program_rates_id']));
	
	/* display results */
	
	$prog_id = $_POST['e_program_rates_program'];

	include 'admin_program_rates_disp.php';
	
?>