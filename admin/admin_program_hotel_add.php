<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */
	
	
	$stmt = $db->prepare('INSERT dir_programs_hotels (hotel_name, hotel_city, hotel_catego, hotel_prog) VALUES (:hotel_name, :hotel_city, :hotel_catego, :hotel_prog)');
							
	$stmt->execute(array(':hotel_name' => $_POST['hotel_name'],
						 ':hotel_city' => $_POST['hotel_city'],
						 ':hotel_catego' => $_POST['hotel_catego'],
						 ':hotel_prog' => $_POST['hotel_prog']));
	
	/* display results */
	
	$prog_id = $_POST['hotel_prog'];

	include 'admin_program_hotels_disp.php';