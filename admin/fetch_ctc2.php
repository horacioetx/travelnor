<?php  

	require('includes/config.php');
	
	if(isset($_POST["contact_id"])) {
	
		$stmt = $db->prepare('SELECT * FROM dir_subcontacts WHERE subcontact_id = :subcontact_id');
		$stmt->execute(array(':subcontact_id' => $_POST['contact_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
?>