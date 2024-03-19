<?php

	/* dir_users_edit.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* regiter user routine */
	
	$msgstat = 1;
	$error = "";		

	do {
		
		/* everything is validated and proceed to edit user */

		try {				
			
			$sql = $db->prepare("UPDATE utenti SET first_name=?, last_name=?, level=? WHERE id=?");
			$sql->bindParam(1, $_POST["efirst_name"]);
			$sql->bindParam(2, $_POST["elast_name"]);
			$sql->bindParam(3, $_POST["elevel"]);
			$sql->bindParam(4, $_POST["eid"]);
			
			$sql->execute();
			
			$msgstat = 0;
			
			/* sends email to user that info was updated */
			
			
			
			
			/******/
			
		} catch (PDOException $e) {
			
			$error = '<div class="alert alert-danger" role="alert"><strong>Error during ' . $e . '</strong></div>';
					
		}

		$registered = 1;

	} while(0);

	/* return to dir_users.php */

	$result = array('msgstat' => $msgstat, 'msg' => $error);
	
	echo json_encode($result);

?>

