<?php  

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	if(isset($_POST["rate_id"])) {
	
		$stmt = $db->prepare('SELECT * FROM dir_programs_rates WHERE program_rates_id = :program_rates_id');
		$stmt->execute(array(':program_rates_id' => $_POST['rate_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>