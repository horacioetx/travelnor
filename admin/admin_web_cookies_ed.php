<?php

	/* admin_web_cookies_ed.php */
	
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
							cookies_txt = :cookies_txt,
                            cookies_link = :cookies_link,
                            cookies_button_txt = :cookies_button_txt
							WHERE config_id = :config_id");
							
            $stmt->execute(array(':cookies_txt' => $_POST['cookies_txt'],
                                 ':cookies_link' => $_POST['cookies_link'],
                                 ':cookies_button_txt' => $_POST['cookies_button_txt'],
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

