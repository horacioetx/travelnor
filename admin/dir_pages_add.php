<?php

    /* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* add new item routine */

	try {	

        $stat = 0;

        $stmt = $db->prepare('INSERT INTO dir_web_pages (page_name, page_status) VALUES (:page_name, :page_status)');
                                
        $stmt->bindParam(':page_name', $_POST['page_name']);
        $stmt->bindParam(':page_status', $_POST['page_status']);

        $stmt->execute();		
        
        $latest_id = $db->lastInsertId(); 
		
		$error = "Página Web Agregada!";

    } catch (PDOException $e) {
		
		$error = '<div class="alert alert-danger" role="alert"><strong>Error during ' . $e . '</strong></div>';
		$stat = 1;
				
	}

    /* return to dir_contacts.php */

	$result = array('stat' => $stat, 'lastid' => $latest_id, 'msg' => $error);
	
	echo json_encode($result);

?>