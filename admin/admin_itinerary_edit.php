<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */
	
	
	$stmt = $db->prepare("UPDATE programs_itineraries SET 
							iti_prog_day = :iti_prog_day,
							iti_prog_day_back = :iti_prog_day_back,
							iti_prog_title = :iti_prog_title,
							iti_prog_description = :iti_prog_description
							WHERE iti_id = :iti_id");
							
	$stmt->execute(array(':iti_prog_day' => $_POST['e_iti_prog_day'],
						 ':iti_prog_day_back' => $_POST['e_iti_prog_day_back'],
						 ':iti_prog_title' => $_POST['e_iti_prog_title'],
						 ':iti_prog_description' => $_POST['e_iti_prog_description'],
						 ':iti_id' => $_POST['e_iti_id']));
	
	/* display results */
	
	$prog_id = $_POST['e_iti_prog_id'];

	include 'admin_itinerary_disp.php';
	
?>