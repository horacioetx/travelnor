<?php

	/* database connection routine */

	ob_start();
	
	session_start();
	
	//set timezone
	
	date_default_timezone_set('Europe/Madrid');
	
	//set localize language for dates
	
	setlocale(LC_ALL, 'es_ES.UTF8');
	
	//database credentials	

	define('DBHOST','50.87.253.77');
	define('DBUSER','nddinfos_traveln');
	define('DBPASS','Sheremetievo-2');
	define('DBNAME','nddinfos_travelnor');
	
	//application address
	
	define('DIR','http://nddinfosystems.com/travelnor/');
	define('SITEEMAIL','muro@travelnor.com');
	
	try {
		
		//create PDO connection
		
		//$db = new PDO("mysql:host=".DBHOST.";port=8889;charset=UTF8;dbname=".DBNAME, DBUSER, DBPASS);
		$db = new PDO("mysql:host=".DBHOST.";port=3306;charset=UTF8;dbname=".DBNAME, DBUSER, DBPASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	} catch(PDOException $e) {
		
		//show error
		echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		exit;
		
	}
	
	//include the user class, pass in the database connection
	
	include('classes/user.php');
	include('classes/phpmailer/mail.php');
	
	$user = new User($db);
	
?>