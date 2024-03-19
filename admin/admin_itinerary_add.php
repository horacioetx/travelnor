<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */
	
	
	$stmt = $db->prepare('INSERT programs_itineraries (iti_prog_day, iti_prog_day_back, iti_prog_title, iti_prog_description, iti_prog_id) VALUES (:iti_prog_day, :iti_prog_day_back, :iti_prog_title, :iti_prog_description, :iti_prog_id)');
							
	$stmt->execute(array(':iti_prog_day' => $_POST['iti_prog_day'],
						 ':iti_prog_day_back' => $_POST['iti_prog_day_back'],
						 ':iti_prog_title' => $_POST['iti_prog_title'],
						 ':iti_prog_description' => $_POST['iti_prog_description'],
						 ':iti_prog_id' => $_POST['iti_prog_id']));
	
	/* display results */
	
	$prog_id = $_POST['iti_prog_id'];

	include 'admin_itinerary_disp.php';
	