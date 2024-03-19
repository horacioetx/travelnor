<?php  

	require('includes/config.php');
	
	if(isset($_POST["prg_id"])) {
	
		$stmt = $db->prepare('SELECT program_subtitle2 FROM dir_programs WHERE program_id = :program_id');
		$stmt->execute(array(':program_id' => $_POST['prg_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
?>