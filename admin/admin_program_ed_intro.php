<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs SET 
							program_intro = :program_intro
							WHERE program_id = :program_id");
							
	$stmt->execute(array(':program_intro' => $_POST['e_program_intro'],
						 ':program_id' => $_POST['e_program_id2']));
	
	/* display results */

	echo $_POST['e_program_intro'];
	
?>