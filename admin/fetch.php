<?php  

	require('includes/config.php');
	
	if(isset($_POST["iti_id"])) {
	
		$stmt = $db->prepare('SELECT * FROM programs_itineraries WHERE iti_id = :iti_id');
		$stmt->execute(array(':iti_id' => $_POST['iti_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>