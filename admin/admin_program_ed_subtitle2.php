<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* fetch data */
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs SET 
							program_subtitle2 = :program_subtitle2
							WHERE program_id = :program_id");
							
	$stmt->execute(array(':program_subtitle2' => $_POST['e_program_subtitle2'],
						 ':program_id' => $_POST['e_program_id4']));
	
	/* display results */

	echo $_POST['e_program_subtitle2'];
	
?>