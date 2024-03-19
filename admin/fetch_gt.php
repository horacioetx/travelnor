<?php  

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

	/* fetch data */
	
	if(isset($_POST["id"])) {
	
		$stmt = $db->prepare('SELECT * FROM dir_programs_gt WHERE gt_id = :gt_id');
		$stmt->execute(array(':gt_id' => $_POST['id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>