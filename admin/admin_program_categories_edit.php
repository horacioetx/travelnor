<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

	$msgstat = 1;
	$error = "";		

	do {

        try {	
	
            $stmt = $db->prepare("UPDATE dir_hotels_categories SET 
                                    cat_name = :cat_name,
                                    cat_order = :cat_order
                                    WHERE cat_id = :cat_id");
                                
            $stmt->execute(array(':cat_name' => $_POST['e_cat_name'],
                                  ':cat_order' => $_POST['e_cat_order'],
                                  ':cat_id' => $_POST['e_cat_id']));

            $msgstat = 0;

            $error = "Item editado satisfactoriamente!";
        

        } catch (PDOException $e) {

            $error = '<div class="alert alert-danger" role="alert"><strong>Error during ' . $e . '</strong></div>';
                    
        }

    } while(0);

    /* return to dir_users.php */

    $result = array('msgstat' => $msgstat, 'msg' => $error);

    echo json_encode($result);

?>