<?php

	/* check.php */
	
	/*** db connections, check login credentials and set session ***/

	/* declare constants */

	define ("PEPPER",'s4l7S4!t'); //random string for extra salt
	define ("WEBSITE",'www.travelnor.com');  //your web site without http:// without final /
	define ("SCRIPTFOLDER",'/login'); //direcory of the script start with a / if you installed the script in the root write just a / never finish with a /

	/* db connection */

	require_once('pdo_db.php');
	
	/* generate random sequence or numbers and letter avoid problems with special chars */
	
	function aZ ($n=12) {
		$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$bytes = random_ver($n);
		$result = "";
		foreach (str_split($bytes) as $byte) $result .= $chars[ord($byte) % strlen($chars)];
		return $result;
	}

	/* generate random and avoid compatibility problem with php version */
	
	function random_ver ($n = 10) {	
	
		$v = (int)phpversion()+0;
		
		if ($v < 7) {
			
			/* if php version < 7 use the old function for generate random bytes */
			
			return openssl_random_pseudo_bytes($n);
			
		} else {
			
			/* random_bytes is better but works only with php version > 7 */
			
			return random_bytes($n);
			
		}	
		
	}

	/* debug = var for testing and debug meg display */

	$debug = "";

	/* logout requested */
	
	if (isset($_GET["logout"]) == 1 && isset($_SESSION["user"])) {
		
		$del=$db->prepare("DELETE FROM auth_tokens WHERE userid = ".$_SESSION["user"]);
		$del->execute();
		
		setcookie("remember", "", 111, '/',WEBSITE); //destroy cookie
		session_unset();
		session_destroy();   // delete Session
		unset($_COOKIE["remember"]); // unset the cookie now, so is not valid for this page too 
		
		$debug.="<br>cookie deleted, session destroyed<br>";	
		
	} 
	 
	/*** session Time Update ***/

	/* Expire the session if user is inactive for 15 minutes or more */	
	/* close the browser then open again the Secure Login script */
	
	$expireAfter = 15;

	/* Check if "last action" session variable has been set */
	
	//if(isset($_SESSION['last_action'])){
		
		/* Figure out how many seconds have passed since the user was last active */
		
		//$secondsInactive = time() - $_SESSION['last_action'];
		
		/* Convert our minutes into seconds */
		
		//$expireAfterSeconds = $expireAfter * 60;
		
		/* Check to see if they have been inactive for too long */
		
		//$debug.="last action: $secondsInactive seconds ago<br>";
		
		//if($secondsInactive >= $expireAfterSeconds){
			
			/* User has been inactive for too long. Proceed to kil session */

			//session_unset();
			//session_destroy();
			
			//$debug.="session destroy for inactivity<br>";
			
		//}  
	//}
	
	/* Assign the current timestamp as the user's latest activity */
	
	$_SESSION['last_action'] = time();

	/*** CHECK AUTO LOG-IN WITH COOKIE ***/

	/* if session is not set, but cookie exists */
	
	if (empty($_SESSION['user']) && !empty($_COOKIE['remember']) && $_GET["logout"]!=1) {

		$debug.="cookie read<br>";
		
		list($selector, $authenticator) = explode(':', urldecode($_COOKIE['remember']));
		
		/* get from database the row with id and token related to selector code in the cookie */
	
		$sql = $db->prepare("SELECT * FROM auth_tokens WHERE selector = ? limit 1");
		$sql->bindParam(1, $selector);
		$sql->execute();
		$row = $sql->fetch(PDO::FETCH_ASSOC);

		if (empty($authenticator) or empty($selector)) $debug.="cookie invalid format<br>";

		/* continue to check the authenticator only if the selector in the cookie is present in the database */
		
		if (($sql->rowCount() > 0) && !empty($authenticator) && !empty($selector)) { 

			$debug.="cookie valid format<br>";
		
			/* the token provided is like the token in the database */
			/* the functions password_verify and password_hard add secure salt and avoid timing attacks */
		  
			if (password_verify(base64_decode($authenticator), $row['hashedvalidator'])) {
				
				$_SESSION['user'] = $row['userid'];
		  
				/* update database with a new token for the same selector and set the cookie again */
				
				$authenticator = bin2hex(random_ver(33));
				$res=$db->prepare("UPDATE auth_tokens SET hashedvalidator = ? , expires = FROM_UNIXTIME(".(time() + 864000*7).") , ip = ? WHERE selector = ?");
				$res->execute(array(password_hash($authenticator, PASSWORD_DEFAULT, ['cost' => 12]),$_SERVER['REMOTE_ADDR'],$selector));
				
				/* set the cookie */
				
				$setc=setcookie(
					'remember',
					$selector.':'.base64_encode($authenticator),
					time() + 864000*7, // the cookie will be valid for 7 days, or till log-out (if u want change it, modify the login.php file too)
					'/',
					WEBSITE,
					false, // TLS-only set to true if u have a website on https://
					false  // http-only
				);
			
				$debug.="cookie right selector<br>cookie right token<br>set a new token in DB and in cookie<br>session set<br>";
				
			} else { // selector exists but token doesnt match. that could be a secure problem, all selector/authenticator in database for that user will be deleted		
		 
				$res=$db->prepare("DELETE FROM auth_tokens WHERE userid = ".$row["userid"]);
				$res->execute();
		  
				$debug.="cookie right selector<br>cookie wrong token (all DB entry for that user are deleted)<br>";
			}
			
		} else {
			
			$debug.="selector not found in DB<br>";
			
		}

	} else {
		
		$debug.="skip the cookie check: ";
		
		if (!empty($_SESSION['user'])) $debug.="session already set<br>";
		if (empty($_COOKIE['remember'])) $debug.="no cookie set<br>";
		
	}

?>