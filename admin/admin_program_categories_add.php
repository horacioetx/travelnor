<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

    /* save new item */

	try {	
        
        $stat = 0;
		
        $stmt = $db->prepare('INSERT dir_hotels_categories (cat_name, cat_order) VALUES (:cat_name, :cat_order)');
                                
        $stmt->execute(array(':cat_name' => $_POST['cat_name'],
                            ':cat_order' => $_POST['cat_order']));

        $error = "Contacto Agregado!";                   
        
    } catch (PDOException $e) {
		
		$error = '<div class="alert alert-danger" role="alert"><strong>Error during ' . $e . '</strong></div>';
		$stat = 1;
				
	}

	/* return */

	$result = array('stat' => $stat, 'msg' => $error);
	
	echo json_encode($result);

?>