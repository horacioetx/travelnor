<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs SET 
							program_highlights = :program_highlights
							WHERE program_id = :program_id");
							
	$stmt->execute(array(':program_highlights' => $_POST['e_program_highlights'],
						 ':program_id' => $_POST['e_program_id']));
	
	/* display results */

	echo $_POST['e_program_highlights'];
	
?>