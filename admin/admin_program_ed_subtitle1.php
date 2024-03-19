<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* fetch data */
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs SET 
							program_subtitle = :program_subtitle
							WHERE program_id = :program_id");
							
	$stmt->execute(array(':program_subtitle' => $_POST['e_program_subtitle'],
						 ':program_id' => $_POST['e_program_id3']));
	
	/* display results */

	echo $_POST['e_program_subtitle'];
	
?>