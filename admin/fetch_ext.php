<?php  

	require('includes/config.php');
	
	if(isset($_POST["id"])) {
	
		$stmt = $db->prepare('SELECT * FROM dir_programs_extensions WHERE ext_id = :ext_id');
		$stmt->execute(array(':ext_id' => $_POST['id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>