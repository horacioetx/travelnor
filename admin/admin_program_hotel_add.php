<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare('INSERT dir_programs_hotels (hotel_name, hotel_city, hotel_catego, hotel_prog) VALUES (:hotel_name, :hotel_city, :hotel_catego, :hotel_prog)');
							
	$stmt->execute(array(':hotel_name' => $_POST['hotel_name'],
						 ':hotel_city' => $_POST['hotel_city'],
						 ':hotel_catego' => $_POST['hotel_catego'],
						 ':hotel_prog' => $_POST['hotel_prog']));
	
	/* display results */
	
	$prog_id = $_POST['hotel_prog'];

	include 'admin_program_hotels_disp.php';