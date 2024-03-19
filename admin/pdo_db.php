<?php
	
	/* make database connection */

	ob_start();
	
	session_start();
	
	/* set timezone */
	
	date_default_timezone_set('America/Vancouver');
	
	/* database credentials */
	
	define('DBHOST','50.87.253.77');
	define('DBUSER','nddinfos_traveln');
	define('DBPASS','Sheremetievo-2');
	define('DBNAME','nddinfos_travelnor');
	
	try{
		
		/* Actual PDO connection */
		
		/* PRODUCTION. Activate when in production */
		
		$db = new PDO("mysql:host=".DBHOST.";port=3306;charset=UTF8;dbname=".DBNAME, DBUSER, DBPASS);
		
		/*  DEVELOPMENT. Activate when in developemnet */
		
		// $db = new PDO("mysql:host=".DBHOST.";port=3306;charset=UTF8;dbname=".DBNAME, DBUSER, DBPASS);
		
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			

		/* connect to config table to retrieve info for setting */
		
		$stmt = $db->prepare("SELECT * FROM config LIMIT 1"); 
		$stmt->execute(); 
		$conrow = $stmt->fetch();			
		
	} catch(PDOException $ex){		

		die("Unable to Connect");
		
	}
	
?>