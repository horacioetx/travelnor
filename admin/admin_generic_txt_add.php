<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

	/* receive vars */	
	
	$stmt = $db->prepare('INSERT dir_programs_gt (gt_section, gt_txt) VALUES (:gt_section, :gt_txt)');
							
	$stmt->execute(array(':gt_section' => $_POST['gt_section'],
						 ':gt_txt' => $_POST['gt_txt']));
	
	/* display results */

    if ($_POST['gt_section'] == 0)
	    include 'admin_generic_txt_rates.php';
    elseif ($_POST['gt_section'] == 1)
        include 'admin_generic_txt_hotels.php';
    elseif ($_POST['gt_section'] == 2)
        include 'admin_generic_txt_extensions.php';

?>