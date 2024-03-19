<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_programs_gt SET 
							gt_section = :gt_section,
							gt_txt = :gt_txt
							WHERE gt_id = :gt_id");
						 
	$stmt->execute(array(':gt_section' => $_POST['e_gt_section'],
						 ':gt_txt' => $_POST['e_gt_txt'],
						 ':gt_id' => $_POST['e_gt_id']));
	
	/* display results */
	
	/* display results */

    if ($_POST['e_gt_section'] == 0)
	    include 'admin_generic_txt_rates.php';
    elseif ($_POST['e_gt_section'] == 1)
        include 'admin_generic_txt_hotels.php';
    elseif ($_POST['e_gt_section'] == 2)
        include 'admin_generic_txt_extensions.php';
	
?>