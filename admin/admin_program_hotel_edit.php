<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs_hotels SET 
							hotel_name = :hotel_name,
							hotel_city = :hotel_city,
							hotel_catego = :hotel_catego
							WHERE hotel_id = :hotel_id");
							
	$stmt->execute(array(':hotel_name' => $_POST['e_hotel_name'],
						 ':hotel_city' => $_POST['e_hotel_city'],
						 ':hotel_catego' => $_POST['e_hotel_catego'],
						 ':hotel_id' => $_POST['e_hotel_id']));
	
	/* display results */
	
	$prog_id = $_POST['e_hotel_program'];

	include 'admin_program_hotels_disp.php';
	
?>