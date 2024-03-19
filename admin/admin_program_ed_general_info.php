<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* fetch data */	
	
	$stmt = $db->prepare("UPDATE dir_programs SET 
							program_name = :program_name,
							program_duration = :program_duration,
							program_code = :program_code,
							program_feature = :program_feature,
							program_order = :program_order,								
							program_classif = :program_classif,
							program_classif2 = :program_classif2,
							program_feature = :program_feature,							
							program_status = :program_status
							WHERE program_id = :program_id");
							
	$stmt->execute(array(':program_name' => $_POST['e_program_name'],
						 ':program_duration' => $_POST['e_program_duration'],
						 ':program_code' => $_POST['e_program_code'],
						 ':program_feature' => $_POST['e_program_feature'],
						 ':program_order' => $_POST['e_program_order'],
						 ':program_classif' => $_POST['e_program_classif'],
						 ':program_classif2' => $_POST['e_program_classif2'],						 
						 ':program_status' => $_POST['e_program_status'],
						 ':program_id' => $_POST['e_program_id0']));
	
	/*** proceed to buld display ***/
	
	/* retrieve config vars */
	
	$stmt_conf1 = $db->prepare('SELECT web1_path_img_ribbons FROM config');	
	$stmt_conf1->execute();
	$row_conf1 = $stmt_conf1->fetch(PDO::FETCH_ASSOC);	
	
	$prog_id = $_POST['e_program_id0'];
	
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