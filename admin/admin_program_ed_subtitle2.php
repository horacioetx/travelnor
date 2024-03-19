<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs SET 
							program_subtitle2 = :program_subtitle2
							WHERE program_id = :program_id");
							
	$stmt->execute(array(':program_subtitle2' => $_POST['e_program_subtitle2'],
						 ':program_id' => $_POST['e_program_id4']));
	
	/* display results */

	echo $_POST['e_program_subtitle2'];
	
?>