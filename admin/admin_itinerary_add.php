<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
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
	