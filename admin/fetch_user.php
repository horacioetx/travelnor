<?php  

	require('includes/config.php');
	
	if(isset($_POST["memberID"])) {
	
		$stmt = $db->prepare('SELECT * FROM members WHERE memberID = :memberID');
		$stmt->execute(array(':memberID' => $_POST['memberID']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>