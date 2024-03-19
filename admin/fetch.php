<?php  

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

	/* fetch data */
	
	if(isset($_POST["iti_id"])) {
	
		$stmt = $db->prepare('SELECT * FROM programs_itineraries WHERE iti_id = :iti_id');
		$stmt->execute(array(':iti_id' => $_POST['iti_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>