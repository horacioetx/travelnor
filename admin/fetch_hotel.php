<?php  

	require('includes/config.php');
	
	if(isset($_POST["hotel_id"])) {
	
		$stmt = $db->prepare('SELECT * FROM dir_programs_hotels WHERE hotel_id = :hotel_id');
		$stmt->execute(array(':hotel_id' => $_POST['hotel_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>