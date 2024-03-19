<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* fetch data */	
	
	$stmt = $db->prepare("UPDATE dir_programs SET 
							program_intro = :program_intro
							WHERE program_id = :program_id");
							
	$stmt->execute(array(':program_intro' => $_POST['e_program_intro'],
						 ':program_id' => $_POST['e_program_id2']));
	
	/* display results */

	echo $_POST['e_program_intro'];
	
?>