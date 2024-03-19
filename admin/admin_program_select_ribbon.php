<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }	
	
	/* update ribbon in program */
	
	$prog_id = $_POST['prg_id'];
	$rib_id = $_POST['rib_id'];	
	
	$stmt = $db->prepare('UPDATE dir_programs SET program_ribbon = :program_ribbon WHERE program_id = :program_id');
		
	$stmt->bindParam(':program_ribbon', $rib_id);
	$stmt->bindParam(':program_id', $prog_id);
	
	$stmt->execute();
	
	/*** proceed to buld display ***/
	
	/* retrieve config vars */
	
	$stmt_conf1 = $db->prepare('SELECT web1_path_img_ribbons FROM config');	
	$stmt_conf1->execute();
	$row_conf1 = $stmt_conf1->fetch(PDO::FETCH_ASSOC);	
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT * FROM dir_programs WHERE program_id = :program_id');	
	$stmt->execute(array(':program_id' => $prog_id));	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* format some vars */
	
	if ($rrows['program_status'] == 0)	
		$status = '<span class="text-success">Activo</span>';
	else
		$status = '<span class="text-danger">Inactivo</span>';
	
	if ($rrows['program_feature'] == 0)	
		$feature = '<span class="text-secondary">No Destacado</span>';
	else
		$feature = '<span class="text-success">Destacado</span>';
	
	/* display results */
	
	include 'admin_program_general_info_disp.php';	

?>