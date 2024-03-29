<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs_extensions SET 
							ext_name = :ext_name,
							ext_nites = :ext_nites,
							ext_cost = :ext_cost,
							ext_notes = :ext_notes,
							ext_hotel = :ext_hotel,
							ext_status = :ext_status
							WHERE ext_id = :ext_id");
						 
	$stmt->execute(array(':ext_name' => $_POST['e_ext_name'],
						 ':ext_nites' => $_POST['e_ext_nites'],
						 ':ext_cost' => $_POST['e_ext_cost'],
						 ':ext_notes' => $_POST['e_ext_notes'],
						 ':ext_hotel' => $_POST['e_ext_hotel'],
						 ':ext_status' => $_POST['e_ext_status'],
						 ':ext_id' => $_POST['e_ext_id']));
	
	/* display results */
	
	$prog_id = $_POST['e_prog_id'];

	include 'admin_program_extensions_disp.php';
	
?>