<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */	
	
	
	
	if ($_POST['program_cap_id'] == 1) {

		$stmt = $db->prepare("UPDATE dir_programs SET 
								program_banner_cap1 = :caption
								WHERE program_id = :program_id");
							
	} elseif ($_POST['program_cap_id'] == 2) {
		
		$stmt = $db->prepare("UPDATE dir_programs SET 
								program_banner_cap2 = :caption
								WHERE program_id = :program_id");		
		
	} elseif ($_POST['program_cap_id'] == 3) {
		
		$stmt = $db->prepare("UPDATE dir_programs SET 
								program_banner_cap3 = :caption
								WHERE program_id = :program_id");		
		
	} elseif ($_POST['program_cap_id'] == 4) {
		
		$stmt = $db->prepare("UPDATE dir_programs SET 
								program_banner_cap4 = :caption
								WHERE program_id = :program_id");		
		
	}
							
	$stmt->execute(array(':caption' => $_POST['program_banner_cap'],
						 ':program_id' => $_POST['program_cap']));
	
	/* proceed to buld display */
	
	$prog_id = $_POST['program_cap'];
	
	/* retrieve info from table */
		
	$stmt = $db->prepare('SELECT * FROM dir_programs WHERE program_id = :program_id');	
	$stmt->execute(array(':program_id' => $prog_id));

	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

	/* refresh div */

	include "admin_program_view_disp_imgcar.php";
	
?>