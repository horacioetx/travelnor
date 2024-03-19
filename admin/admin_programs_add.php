<?php

    /* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* add new item routine */

	try {	

        $stat = 0;

        $stmt = $db->prepare('INSERT INTO dir_programs (program_code, program_name, program_classif, program_classif2, program_status) VALUES (:program_code, :program_name, :program_classif, :program_classif2, :program_status)');
                                
        $stmt->bindParam(':program_code', $_POST['program_code']);
        $stmt->bindParam(':program_name', $_POST['program_name']);
        $stmt->bindParam(':program_classif', $_POST['program_classif']);
        $stmt->bindParam(':program_classif2', $_POST['program_classif2']);
        $stmt->bindParam(':program_status', $_POST['program_status']);

        $stmt->execute();		
        
        $latest_id = $db->lastInsertId(); 
		
		$error = "Programa Agregado!";

    } catch (PDOException $e) {
		
		$error = '<div class="alert alert-danger" role="alert"><strong>Error during ' . $e . '</strong></div>';
		$stat = 1;
				
	}

    /* return to dir_contacts.php */

	$result = array('stat' => $stat, 'lastid' => $latest_id, 'msg' => $error);
	
	echo json_encode($result);

?>