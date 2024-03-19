<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* fetch data */	
	
	$stmt = $db->prepare("UPDATE dir_programs SET 
							program_highlights = :program_highlights
							WHERE program_id = :program_id");
							
	$stmt->execute(array(':program_highlights' => $_POST['e_program_highlights'],
						 ':program_id' => $_POST['e_program_id']));
	
	/* display results */

	echo $_POST['e_program_highlights'];
	
?>