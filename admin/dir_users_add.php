<?php

	/* dir_users_add.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* regiter user routine */
	
	$msgstat = 1;
	$error = "";
		
	$_POST["email"]=trim($_POST["email"]);

	do {
		
		/* check if email is valid, if the 2 password match and is atleast 8 char long, usefull if js is disable on user browser */
		
		if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false or !preg_match('/@.+\./', $_POST["email"])) {
			$error = '<div class="alert alert-danger" role="alert"><strong>Invalid Email. Try again.</strong></div>';
			$msgstat = 1;
			break;
		}
		
		if ($_POST["password"]!= $_POST["confirm_password"]) {
			$error = '<div class="alert alert-danger" role="alert"><strong>Password mismatch. Try again.</strong></div>';
			$msgstat = 1;
			break;
		}
		
		if (strlen($_POST["password"])<8) {
			$error = '<div class="alert alert-danger" role="alert"><strong>Password too short (minimum 8 character). Try again.</strong></div>';
			$msgstat = 1;
			break;
		}

		/* check if email already registerd in DB */
		
		$sql = $db->prepare("SELECT * FROM utenti WHERE email=?");
		$sql->bindParam(1, $_POST["email"]);
		$sql->execute();
		$exists=$sql->rowCount();

		if ($exists) {
			$error = '<div class="alert alert-danger" role="alert"><strong>Email Already Registered. Try again.</strong></div>';
			$msgstat = 1;
			break;
		}
		
		/* everything is validated and proceed to add new user */

		/* save new user in the DB, using the PEPPER constant defined in the check.php as additional salt */
		/* Hash a new password for storing in the database */
		/* The function automatically generates a cryptographically safe salt *
		/* IMPORTNAT: if remove PEPPER or change it remember to do that in the login.php too */
		
		$hash = password_hash($_POST['password'].PEPPER, PASSWORD_DEFAULT, ['cost' => 12]);

		try {				
			
			$sql = $db->prepare("INSERT INTO utenti (email,password,first_name,last_name,level) VALUES (?,?,?,?,?)");
			$sql->bindParam(1, $_POST["email"]);
			$sql->bindParam(2, $hash);
			$sql->bindParam(3, $_POST["first_name"]);
			$sql->bindParam(4, $_POST["last_name"]);
			$sql->bindParam(5, $_POST["level"]);
			
			$sql->execute();
			
			$msgstat = 0;
			
			/* sends email to new user with registration information */
			
			
			
			
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

