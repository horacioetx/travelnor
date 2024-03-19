<?php

	/* login.php */

	/* db connection and session setup */
	
	include("check.php"); 

	/* if session is set means that the user is already logged in, so doesnt show the login page to an user already logged */
	
	if (isset($_SESSION['user'])) { header('Location: home'); }
	
	/*** verify credentials ***/

	/* if login form is submitted */
	
	if (isset($_POST["login"])) {

		$_POST["email"]=trim($_POST["email"]);

		do { 
			
			/* if not valid email "end cicle" and show again the login form */
	
			if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)===false or !preg_match('/@.+\./', $_POST["email"])) {
				$message="Opss! That is an invalid email";
				break;
			}

			/*** ADD A DELAY FOR AVOID BRUTAL FORCE ATTACKS  ***/
			
			/* otherwise read from database how many login attemps in the last 10 minutes from the same IP address */
			
			$sql = $db->prepare("SELECT data FROM log_accessi WHERE ip='".$_SERVER['REMOTE_ADDR']."' and accesso=0 and data>date_sub(now(), interval 10 minute) ORDER BY data DESC");
			$sql->execute();
			$attempts=$sql->rowCount();
			$last=$sql->fetchColumn();
			
			$last=strtotime($last);
			$delay=min(max(($attempts-3),0)*4,30); //after 3rd wrong try, add a delay of (# attempts * 4) as seconds (maximum 30 seconds each try)
			
			/* if there are many tries in few second, show a messagge and "end cicle" so doesnt check the email/pw this time 
			
			if (time()<($last+$delay)) {
				$message="Too many attempts. Wait $delay seconds before retry!";
				break;		
			}
			*/
			/* check if user exists */

			$sql = $db->prepare("SELECT * FROM utenti WHERE email=?");
			$sql->bindParam(1, $_POST["email"]);
			$sql->execute();
			$rows = $sql->fetch(PDO::FETCH_ASSOC);	

			/* check if password type is match with password in the database */
			/* using php function password_hash in the register.php and password_verify here */
			/* I add the constant PEPPER has salt (see check.php) the system already set a secure salt with the function password_hash */
			/* (if remove PEPPER or change it remember to do that in the register.php too) */

			$checked = password_verify($_POST['password'].PEPPER, $rows["password"]);
			
			if (($checked) and ($rows["level"] <> 9)) { // if email/pw are right:

				$_SESSION['user'] = $rows["id"];
				$_SESSION['member_fullname'] = $rows["first_name"] . ' ' . $rows["last_name"];
				$_SESSION['level'] = $rows["level"];
				
				/* and if remember me checked send the cookie */
				
				if (isset($_POST["remember"])) {
				
					if ($_POST["remember"]=="true") {
					
						/* create a random selector and auth code in the token database */					
						/* function aZ is in the check.php file */
						
						$selector = aZ();
						$authenticator = bin2hex(random_ver(33));
						$res=$db->prepare("INSERT INTO auth_tokens (selector,hashedvalidator,userid,expires,ip) VALUES (?,?,?,FROM_UNIXTIME(".(time() + 864000*7)."),?)");
						$res->execute(array($selector,password_hash($authenticator, PASSWORD_DEFAULT, ['cost' => 12]),$rows['id'],$_SERVER['REMOTE_ADDR']));			
					
						/* set the cookie */
					
						setcookie(
							'remember',
							$selector.':'.base64_encode($authenticator),
							(time() + 864000*7), // the cookie will be valid for 7 days, or till log-out
							'/',
							WEBSITE,
							false, // TLS-only
							false  // http-only
						);
						
					}
					
				}

				/* redirect to page with content only for members */
			
				header("location:home.php");		
			
			} else { // if email/pw are wrong 
			
				$message=($attempts>1)?"Opss! Wrong credentials. Try again. ($attempts attempts)":"Oops! Wrong credentials' Try again.";              
			
			}
			
			/* set timezone */
	
			date_default_timezone_set('America/Vancouver');

			/* save the access log */		
		
			$sql = $db->prepare("INSERT INTO log_accessi (ip, mail_immessa, accesso) VALUES (? ,? ,?)");
			$sql->bindParam(1, $_SERVER['REMOTE_ADDR']);
			$sql->bindParam(2, $_POST["email"]);
			$sql->bindParam(3, $checked, PDO::PARAM_INT);
			$sql->execute();

		} while(0);

	}
	
	/*** declare initial vars for login.php only ***/
	
	/* declare company name */
	
	if (isset($conrow['company_name'])<> null)	{
		$title = $conrow['company_name'] . ' - Dashboard Login';
	} else {
		$title = "Dashboard - Login";
		$login_company = $title;
	}
	
	/* declare logo */
		
	if (isset($conrow['dash_logo']))
		$logo = '<img src="images/logos/' . $conrow['dash_logo'] . '" style="height:60px; width:auto; ">';
	else
		$logo = '<i class="fab fa-earlybirds fa-3x"></i>';	
		
	/* declare card header bg */
		
	if (isset($conrow['dash_bg_color']))
		$bgcolour = $conrow['dash_bg_color'];
	else
		$bgcolour = "76a4d5";
	
	
	

?>

<!DOCTYPE html>
<html>

	<head>
	
		<!-- meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $title; ?></title>
		
		<!-- favicon -->
		


		<!-- fonts -->
		
		<link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

		<!-- Custom CSS -->
		
		<link rel="stylesheet" href="css/easion.css">	
		
		<!-- title -->
		
		<title><?php echo $title; ?></title>
		
	</head>
		
	<body class="bg-secondary">
	
		<div class="container">
			<div class="row">
				<div class="col-md-12 min-vh-100 d-flex flex-column justify-content-center">
					<div class="row">
						<div class="col-lg-6 col-md-8 mx-auto">
						
							<div class="card easion-card shadow shadow-sm border-0">
							
								<div class="card-header text-center p-4" style="background-color:#<?php echo $bgcolour; ?>;">								
									<div class="my-3 mx-auto text-center w-100"><?php echo $logo; ?></div>								
									<h4 class="mb-0 text-white mx-auto"><strong><?php echo $login_company; ?></strong></h4>
								</div>
								
								<div class="card-body">
								
									<?php
									
										/* display messages if exists */
										
										if (isset($message)) { echo '<div class="alert alert-danger text-center" role="alert"><strong>' . $message . '</strong></div>'; }
									
									?>
								
									<?php if (empty($_SESSION["user"])) { ?>
								
										<div class="login-form">
											<form method="post">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Email" name="email" required>
												</div>
												<div class="form-group">
													<input type="password" class="form-control" placeholder="Password" name="password" required>
												</div>
												<div class="form-group">
													<button type="submit" name="login" class="btn btn-sm btn-danger btn-block">Log in</button>
												</div>
												<div class="clearfix">
													<label class="float-left form-check-label">
													<input type="checkbox" name="remember"><strong> Remember me</strong></label>
													<a href="reset" class="float-right">Forgot Password?</a>
												</div>        
											</form>
										</div>
										
									<?php } ?>
									
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- js -->
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
		<!-- custom js -->
		
		<script src="js/easion.js"></script>				
	
	</body>
	
</html>