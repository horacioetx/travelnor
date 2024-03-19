<?php

	/* admin_web_config_ed.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* regiter user routine */
	
	$msgstat = 1;
	$error = "";
    $config_id = 1;		

	do {
		
		/* everything is validated and proceed to edit */

		try {				
			
			$stmt = $db->prepare("UPDATE config SET 
							company_name = :company_name,
							company_website = :company_website,
							company_email = :company_email,
							currency_main = :currency_main,
                            currency = :currency,
                            currency_position = :currency_position,
                            currency_secondary = :currency_secondary,
                            currency_2 = :currency_2,
                            currency_2_position = :currency_2_position,
                            currency_2_status = :currency_2_status,
                            maxdays = :maxdays
							WHERE config_id = :config_id");
							
            $stmt->execute(array(':company_name' => $_POST['company_name'],
                                 ':company_website' => $_POST['company_website'],
                                 ':company_email' => $_POST['company_email'],
                                 ':currency_main' => $_POST['currency_main'],
                                 ':currency' => $_POST['currency_symbol1'],
                                 ':currency_position' => $_POST['currency_position'],
                                 ':currency_secondary' => $_POST['currency_secondary'],
                                 ':currency_2' => $_POST['currency_symbol2'],
                                 ':currency_2_position' => $_POST['currency_2_position'],
                                 ':currency_2_status' => $_POST['currency_2_status'],
                                 ':maxdays' => $_POST['maxdays'],
                                 ':config_id' => $config_id));
			
			$msgstat = 0;
			
		} catch (PDOException $e) {
			
			$error = '<div class="alert alert-danger" role="alert"><strong>Error during ' . $e . '</strong></div>';
					
		}

		$registered = 1;

	} while(0);

	/* return  */

	$result = array('msgstat' => $msgstat, 'msg' => $error);
	
	echo json_encode($result);

?>

