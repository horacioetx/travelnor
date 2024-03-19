<?php  

	require('includes/config.php');
	
	if(isset($_POST["id"])) {
	
		$stmt = $db->prepare('SELECT * FROM dir_programs_included WHERE prog_inc_id = :prog_inc_id');
		$stmt->execute(array(':prog_inc_id' => $_POST['id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>