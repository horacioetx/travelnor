<?php

	/* admin_web_tickers_ed.php */
	
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
							ticker_txt = :ticker_txt,
							ticker_txt_main = :ticker_txt_main,
							ticker_active = :ticker_active
							WHERE config_id = :config_id");
							
            $stmt->execute(array(':ticker_txt' => $_POST['ticker_txt'],
                                 ':ticker_txt_main' => $_POST['ticker_txt_main'],
                                 ':ticker_active' => $_POST['ticker_active'],
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

