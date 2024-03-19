<?php  

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

	/* fetch data */
	
	if(isset($_POST["prg_id"])) {
	
		$stmt = $db->prepare('SELECT program_name, program_duration, program_code, program_feature, program_order, program_classif, program_classif2, program_status FROM dir_programs WHERE program_id = :program_id');
		$stmt->execute(array(':program_id' => $_POST['prg_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>