<?php

	//include config
	
	require_once('includes/config.php');
	
	//retrieve system config info
	
	$stmt = $db->prepare("SELECT * FROM config LIMIT 1"); 
	$stmt->execute(); 
	$conr = $stmt->fetch();
	
	//check if already logged in move to home page
	
	if( $user->is_logged_in() ){ header('Location: index.php'); } 
	
	//process login form if submitted
	
	if(isset($_POST['submit'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if($user->login($username,$password)){ 
		
			$_SESSION['username'] = $username;
			//header('Location: index.php'); // este es el bueno. Cuando ya no se use el provisonal de abajo: admin_provisional.php
			
			header('Location: home.php');
			exit;
		
		} else {
			
			$error[] = 'Wrong username or password. Try again.';
			
		}
		
	} //end if submit
	
	//define page title
	
	$title = 'Login';
	
	
?>



<!DOCTYPE html>
<html lang="en">

	<head>
	
		<!-- Required meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- favicon -->
		
		<link rel="apple-touch-icon" sizes="180x180" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/logos/favicon.png">	
		<title><?php echo $title ?></title>

		<title>Travelnor - Dashboard</title>

		<!-- vendor css -->
		
		<link href="../lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">

		<!-- Bracket CSS -->
		
		<link rel="stylesheet" href="../css/bracket.css">
		<link rel="stylesheet" href="../css/bracket.oreo.css">
		
		<!-- Login page custom CSS -->
		
		<link rel="stylesheet" href="../css/login.css">		
	
	</head>

	<body>

		<div class="d-flex align-items-center justify-content-center bg-primary ht-100v">

			<div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded">
			
				<!-- <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> bracket <span class="tx-primary">plus</span> <span class="tx-normal">]</span></div> -->
				
				<div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal"><img src="images/logos/logo.png" style="width:250px;"></div>
				
				<div class="tx-center mg-b-60">Dashboard - Login</div>			
			
				<?php
						
					//check for any errors
					
					if(isset($error)){
						foreach($error as $error){
							echo '<p class="alert alert-danger">'.$error.'</p>';
						}
					}			
					
					if(isset($_GET['action'])){
						switch ($_GET['action']) {
							case 'active':
								echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
								break;
							case 'reset':
								echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
								break;
							case 'resetAccount':
								echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
								break;
						}
					}
				
				?>
			
			
			<form role="form" method="post" autocomplete="off">

				<div class="form-group">
					<input type="text" class="form-control" name="username" placeholder="Usuario">
				</div><!-- form-group -->
				
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password">
					<a href="" class="tx-primary tx-12 d-block mg-t-10">Olvidé mi password?</a>
				</div><!-- form-group -->
				
				<button type="submit" name="submit" class="btn btn-block btn-primary">Login</button>
			
			</form>			
			
		  </div><!-- login-wrapper -->
		  
		</div><!-- d-flex -->

		<script src="../lib/jquery/jquery.min.js"></script>
		<script src="../lib/jquery-ui/ui/widgets/datepicker.js"></script>
		<script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>

	</body>
  
</html>
